<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Enquiry</title>
</head>

<body>
    <h2>New Product Enquiry Received</h2>

    <p><strong>Product:</strong> {{ $enquiry->product->name ?? 'N/A' }}</p>
    <p><strong>Name:</strong> {{ $enquiry->name }}</p>
    <p><strong>Email:</strong> {{ $enquiry->email }}</p>
    <p><strong>Contact Number:</strong> {{ $enquiry->contact_number }}</p>
    <p><strong>Message:</strong> {{ $enquiry->message }}</p>

    {{-- @if ($enquiry->file)
        <p><strong>Attached File:</strong> File is attached to this email.</p>
    @endif --}}

</body>

</html>
