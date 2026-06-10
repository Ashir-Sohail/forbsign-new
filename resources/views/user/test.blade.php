// Fetch the product base price
$product = Product::find($productId);
$basePrice = $product->price;

// Collect all selected product_option_value IDs (from request)
$selectedOptionIds = $request->input('option_values'); // e.g. [2,5]

// Get sum of all option prices
$optionPriceAdjustment = ProductOptionValue::whereIn('id', $selectedOptionIds)
                        ->sum('price');

// Calculate final price
$finalPrice = $basePrice + $optionPriceAdjustment;

// Store in order_items with final price
OrderItem::create([
    'order_id' => $orderId,
    'product_id' => $productId,
    'quantity' => $quantity,
    'price' => $finalPrice,
]);
