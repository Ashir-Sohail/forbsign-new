<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductOptionValue;
use App\Models\ProductSize;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\ProductOption;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::where('client_id', auth()->guard('client')->id())->get();
        return view('client.product.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::whereNull('parent_id')->where('client_id', auth()->guard('client')->id())->get(); // where parent_id null
        $brands = Brand::where('client_id', auth()->guard('client')->id())->get();
        $options = Option::with('option_values')->where('client_id', auth()->guard('client')->id())->get();
        return view('client.product.create', compact('categories', 'brands', 'options'));
    }

    public function getSubCategory(Request $request)
    {
        $parentId = $request->parent_id;
        $subCategories = Category::where('parent_id', $parentId)->get();
        return response()->json($subCategories);
    }

    public function getOptionValues($id)
    {
        $optionValues = OptionValue::where('option_id', $id)
            ->get(['id', 'option_name_en']); // Only retrieve 'id' and 'option_name_en'

        return response()->json($optionValues);
    }

    public function store(ProductStoreRequest $request): RedirectResponse
    {
        // Temporarily generate slug to use as folder name
        $slug = Str::slug($request->name);
        $folder = 'products/' . $slug;

        $filename = '';
        if ($request->file('featured_image')) {
            $filename = $request->file('featured_image')->store($folder, 's3');
        }

        $multipleImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store($folder, 's3');
                $multipleImages[] = $path;
            }
        }
        $product = new Product();
        $product->name = $request->name;
        $product->client_id = auth()->guard('client')->id();
        $product->slug = Str::slug($request->name);
        $product->featured_image = $filename;
        $product->images = json_encode($multipleImages);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->meta_title = $request->meta_title;
        $product->meta_keyword = $request->meta_keyword;
        $product->meta_description = $request->meta_description;
        $product->meta_url = $request->meta_url;
        $product->current_price = $request->current_price;
        $product->previous_price = $request->previous_price;
        $product->points = $request->points;
        $product->weight = $request->weight;
        $product->cat_id = $request->cat_id;
        $product->brand_id = $request->brand_id;
        $product->total_stock = $request->total_stock;
        $product->images = json_encode($multipleImages);
        $product->informative = $request->informative;


        $product->save();


        // if ($request->sizes) {
        //     foreach ($request->sizes as $index => $size) {
        //         ProductSize::create([
        //             'product_id' => $product->id,
        //             'size' => $size,
        //         ]);
        //     }
        // }

        if ($request->has('product_option')) {
            foreach ($request->product_option as $option) {
                // Save the product-option relationship
                $productOption = ProductOption::create([
                    'product_id' => $product->id,
                    'option_id' => $option['option_id'],
                    'required' => $option['required'] ?? false,
                ]);

                // Now insert all product option values
                if (isset($option['product_option_value']) && is_array($option['product_option_value'])) {

                    foreach ($option['product_option_value'] as $value) {
                        ProductOptionValue::create([
                            'product_id' => $product->id,
                            'option_value_id' => $value['option_value_id'],
                            'quantity' => $value['quantity'],
                            'subtract' => $value['subtract'],
                            'price_prefix' => $value['price_prefix'],
                            'price' => $value['price'],
                            'points_prefix' => $value['points_prefix'],
                            'points' => $value['points'],
                            'weight_prefix' => $value['weight_prefix'],
                            'weight' => $value['weight'],
                        ]);
                    }
                }
            }
        }
        return redirect()->route('client.product.index')->with('success', 'Product Add successfully');
    }

    private function getCategoryHierarchy($categoryId)
    {
        $categories = [];
        $current = Category::find($categoryId);

        while ($current) {
            $categories[] = $current->id;
            $current = $current->parent; // using $category->parent relationship
        }

        return array_reverse($categories); // Top-level → leaf
    }



    public function edit($id)
    {
        $viewMode = false;

        $product = Product::with([
            'productOptions.option.option_values',
            'productOptionValues.option_values.option'
        ])->findOrFail($id);

        $options = Option::with('option_values')->get();
        $brands = Brand::where('client_id', auth()->guard('client')->id())->get();
        $categories = Category::whereNull('parent_id')->where('client_id', auth()->guard('client')->id())->get();
        $categoryIds = $this->getCategoryHierarchy($product->cat_id);

        // Check if the last category in the chain exists (i.e., the assigned category wasn't deleted)
        if (!empty($categoryIds)) {
            $lastCategoryId = end($categoryIds);
            if (!Category::find($lastCategoryId)) {
                // The assigned category was deleted
                $categoryIds = [];
                // Optionally, flash a warning to the session
                session()->flash('warning', 'The previously assigned category no longer exists. Please select a new category.');
            }
        }

        if (request()->has('view')) {
            $viewMode = true;
        }

        $groupedProductOptions = $product->productOptions
            ->groupBy('option_id');

        // dd($product);
        return view('client.product.update', compact(
            'product',
            'options',
            'groupedProductOptions',
            'brands',
            'categories',
            'viewMode',
            'categoryIds',
        ));
    }



    public function update(ProductUpdateRequest $request, $id): RedirectResponse
    {

        $product = Product::findOrFail($id);

        $slug = Str::slug($request->name);
        $folder = 'products/' . $slug;

        // ---------- FEATURED IMAGE ----------
        if ($request->file('featured_image')) {
            if ($product->featured_image && Storage::disk('s3')->exists($product->featured_image)) {
                Storage::disk('s3')->delete($product->featured_image);
            }

            $filename = $request->file('featured_image')->store($folder, 's3');
            Storage::disk('s3')->setVisibility($filename, 'public');
        } else {
            $filename = $product->featured_image;
        }

        // ---------- MULTIPLE IMAGES ----------
        $existingImages = $request->input('existing_images', []); // Images user kept
        $previousImages = json_decode($product->images, true) ?? [];
        $imagesToDelete = array_diff($previousImages, $existingImages);
        $newImages = [];

        // Delete removed images from S3
        foreach ($imagesToDelete as $imgPath) {
            if (Storage::disk('s3')->exists($imgPath)) {
                Storage::disk('s3')->delete($imgPath);
            }
        }

        // Upload new images to S3
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store($folder, 's3');
                Storage::disk('s3')->setVisibility($path, 'public');
                $newImages[] = $path;
            }
        }

        // Final merged image array
        $finalImages = array_merge($existingImages, $newImages);
        $product->images = json_encode($finalImages);



        $product->name = $request->name;
        $product->slug = Str::slug($request->name);

        $product->featured_image = $filename;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        // $product->specifications = json_encode($request->specifications);
        $product->meta_title = $request->meta_title;
        $product->meta_url = $request->meta_url;
        $product->meta_keyword = $request->meta_keyword;
        $product->meta_description = $request->meta_description;
        $product->current_price = $request->current_price;
        $product->previous_price = $request->previous_price;
        $product->points = $request->points;
        $product->weight = $request->weight;
        //  Properly assign last selected category
        $catIds = $request->cat_ids;
        $product->cat_id = end($catIds);
        $product->brand_id = $request->brand_id;
        $product->total_stock = $request->total_stock;
        $product->informative = $request->informative;


        $product->save();


        // code to insert update product size
        // if ($request->sizes) {
        //     foreach ($request->sizes as $index => $size) {
        //         // Check if this size already exists for this product
        //         $alreadyExists = ProductSize::where('product_id', $product->id)
        //             ->where('size', $size)
        //             ->exists();

        //         // If it does not exist, insert it
        //         if (!$alreadyExists) {
        //             ProductSize::create([
        //                 'product_id' => $product->id,
        //                 'size' => $size,
        //             ]);
        //         }
        //     }
        // }


        $product->productOptions()->delete(); // Clear existing product options
        $product->productOptionValues()->delete(); // Clear existing product option values
        if ($request->has('product_option')) {
            foreach ($request->product_option as $option) {
                // Save the product-option relationship
                $productOption = ProductOption::create([
                    'product_id' => $product->id,
                    'option_id' => $option['option_id'],
                    'required' => $option['required'] ?? false,
                ]);

                // Now insert all product option values
                if (isset($option['product_option_value']) && is_array($option['product_option_value'])) {

                    foreach ($option['product_option_value'] as $value) {
                        ProductOptionValue::create([
                            'product_id' => $product->id,
                            'option_value_id' => $value['option_value_id'],
                            'quantity' => $value['quantity'],
                            'subtract' => $value['subtract'],
                            'price_prefix' => $value['price_prefix'],
                            'price' => $value['price'],
                            'points_prefix' => $value['points_prefix'],
                            'points' => $value['points'],
                            'weight_prefix' => $value['weight_prefix'],
                            'weight' => $value['weight'],
                        ]);
                    }
                }
            }
        }



        return redirect()->route('client.product.index')->with('success', 'Product Update successfully');
    }

    public function delete($id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $hasOrder = \App\Models\OrderItem::where('product_id', $product->id)->exists();

        if ($hasOrder) {
            return redirect()->back()->with('error', 'Cannot delete: this product is associated with one or more orders.');
        }
        // Delete featured image from S3
        if ($product->featured_image && Storage::disk('s3')->exists($product->featured_image)) {
            Storage::disk('s3')->delete($product->featured_image);
        }

        // Delete gallery images from S3
        if ($product->images) {
            $images = json_decode($product->images, true);
            if (is_array($images)) {
                foreach ($images as $img) {
                    if (Storage::disk('s3')->exists($img)) {
                        Storage::disk('s3')->delete($img);
                    }
                }
            }
        }
        $product->delete();
        return redirect()->route('client.product.index')->with('success', 'Product delete successfully');
    }

    public function update_status($id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        if ($product->status == 1) {
            $product->status = 0;
            $product->save();

            return redirect()->route('client.product.index')->with('success', 'Product Status un-active successfully');
        } else {
            $product->status = 1;
            $product->save();
            return redirect()->route('client.product.index')->with('success', 'Product Status active successfully');
        }
    }
}
