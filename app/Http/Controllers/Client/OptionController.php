<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\OptionValue;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;



class OptionController extends Controller
{
    public function index(): View
    {
        $options = Option::latest()->get();
        return view('client.option.index', compact('options'));
    }

    public function create(): View
    {
        return view('client.option.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // 'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2096',
            'option_name_en' => 'required',
            'option_name_ar' => 'required',
            'input_type' => ['required', Rule::in(['select', 'radio', 'checkbox', 'text', 'textarea', 'file', 'date', 'time', 'datetime'])],
            'serial' => 'required',
            'option_values' => 'nullable'
        ]);

        // Handle image upload
        // $filename = '';
        // if ($request->file('image')) {
        //     $filename = $request->file('image')->store('option', 'public');
        // }
        // Create Option
        $option = new Option();
        $option->option_name_en = $request->option_name_en;
        $option->option_name_ar = $request->option_name_ar;
        $option->input_type = $request->input_type;
        $option->serial = $request->serial;
        $option->save();


        // Insert Option Values
        if ($request->has('option_values')) {
            $optionValuesJson = $request->input('option_values');
            $optionValues = is_string($optionValuesJson) ? json_decode($optionValuesJson, true) : $optionValuesJson;

            if (is_array($optionValues)) {
                foreach ($optionValues as $data) {
                    $optionValue = new OptionValue();
                    $optionValue->option_id = $option->id;
                    $optionValue->option_name_en = $data['name_en'] ?? null;
                    $optionValue->option_name_ar = $data['name_ar'] ?? null;
                    $optionValue->serial = $data['sort_order'] ?? null;
                    $optionValue->image = $data['image'] ?? null;
                    $optionValue->save();
                }
            }
        }


        return redirect()->route('client.option.index')->with('success', 'Option and its values added successfully!');
    }


    public function edit($id): View
    {
        $option = Option::with('option_values')->findOrFail($id);
        $InputType = Option::whereIn('input_type', ['select', 'radio', 'checkbox'])->get();

        return view('client.option.update', compact('option', 'InputType'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'option_name_en' => 'required|string',
            'option_name_ar' => 'required|string',
            'input_type'     => 'required',
            'serial'         => 'required|numeric',
            'option_value_name_en.*' => 'nullable|string',
            'option_value_name_ar.*' => 'nullable|string',
            'option_value_serial.*'  => 'nullable|numeric',
        ]);

        // 1. Find the main Option
        $option = Option::findOrFail($id);

        // 2. Update the main Option
        $option->update([
            'option_name_en' => $request->option_name_en,
            'option_name_ar' => $request->option_name_ar,
            'input_type'     => $request->input_type,
            'serial'         => $request->serial,
        ]);

        // 3. Create new option_values if present
        if ($request->has('option_value_name_en') && is_array($request->option_value_name_en)) {
            foreach ($request->option_value_name_en as $index => $name_en) {
                $name_ar = $request->option_value_name_ar[$index] ?? null;
                $serial  = $request->option_value_serial[$index] ?? null;

                // Skip empty values
                if (!$name_en && !$name_ar) continue;

                OptionValue::create([
                    'option_id'         => $option->id,
                    'option_name_en'    => $name_en,
                    'option_name_ar'    => $name_ar,
                    'serial'            => $serial,
                    'image'             => null, // You can handle file upload here if needed
                ]);
            }
        }

        return redirect()->route('client.option.index')->with('success', 'Option updated successfully!');
    }


    public function option_value_update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'option_name_en' => 'required|string|max:255',
            'option_name_ar' => 'required|string|max:255',
            'serial' => 'nullable|integer',
        ]);

        // Find the option value by ID
        $optionValue = OptionValue::find($id);

        if (!$optionValue) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        // Update fields
        $optionValue->option_name_en = $request->option_name_en;
        $optionValue->option_name_ar = $request->option_name_ar;
        $optionValue->serial = $request->serial;

        // Save the updated record
        $optionValue->save();

        return response()->json(['success' => true, 'message' => 'Record updatesafsdd successfully']);
    }

    public function option_value_delete($id): RedirectResponse
    {
        $option_value = OptionValue::findOrFail($id);
        // $path = public_path('storage\\' . $option_value->image);
        // if (File::exists($path)) {
        //     File::delete($path);
        // }
        $option_value->delete();
        return redirect()->back()->with('success', 'Option Value Delete successfully');
    }


    public function delete($id): RedirectResponse
    {
        $option = Option::findOrFail($id);
        // $path = public_path('storage\\' . $option->image);
        // if (File::exists($path)) {
        //     File::delete($path);
        // }
        $option->delete();
        return redirect()->route('client.option.index')->with('success', 'Option Delete successfully');
    }

    public function update_status($id): RedirectResponse
    {
        $option = Option::findOrFail($id);
        if ($option->status == 1) {
            $option->status = 0;
            $option->save();

            return redirect()->route('client.option.index')->with('success', 'Option Status un-active successfully');
        } else {
            $option->status = 1;
            $option->save();

            return redirect()->route('client.option.index')->with('success', 'Option Status active successfully');
        }
    }
}
