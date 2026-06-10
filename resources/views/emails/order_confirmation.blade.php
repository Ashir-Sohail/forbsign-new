<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
</head>

<body>
    <h1>Order Confirmation</h1>


    @if ($isAdmin)
        <p>Hello Admin,</p>
        <p>An order has been placed by {{ $order->user->name }} ({{ $order->user->email }}).</p>
    @else
        <p>Hello {{ $order->user->name }},</p>
        <p>Your order #{{ $order->id }} has been placed successfully.</p>
    @endif

    <p><strong>Total:</strong> {{ config('app.currency.symbol') }}{{ $order->total }}</p>
    <p><strong>Status:</strong> {{ $order->order_status }}</p>

    <h2>Order Items</h2>
    <ul>
        @foreach ($orderItems as $item)
            <li>
                <strong>Product:</strong> {{ $item->product->name ?? 'N/A' }}<br>
                <strong>Quantity:</strong> {{ $item->quantity }}<br>


                @php
                    $customization = json_decode($item->customization, true);
                @endphp

                @if ($customization)
                    <strong>Customization:</strong>
                    <ul>
                        @foreach ($customization as $key => $value)
                            <li>{{ ucfirst($key) }}: {{ $value }}</li>
                        @endforeach
                    </ul>
                @endif
            </li>
            <hr>
        @endforeach
    </ul>


    @if ($isAdmin)
        <p>This is an admin notification.</p>
    @endif

</body>

</html>
