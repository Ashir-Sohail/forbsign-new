<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation</title>
</head>

<body>
    <h1>Thank you for your order!</h1>
    <p>Order ID: {{ $order->id }}</p>
    <p>Total: ${{ $order->total }}</p>
    <p>We'll notify you once it ships.</p>
</body>

</html>
