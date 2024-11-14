<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
</head>
<body>

    <img src="{{ $message->embedData(file_get_contents($logoPath), 'logo.jpg', 'image/jpeg') }}" style="width: 300px; height: 300px;">
    <p>Hi {{ $user->fullname }},</p>
    <p>Thank you for your order!</p>
    <p>We will send you another email once the items in your order have been shipped.</p>
    <p>Please find below, the summary of your order {{ $checkout->order_id }}</p>
    <h5>Payment Type: {{ $paymentMethod }}</h5>

    <h4>Order Details:</h4>
    <table style="border-collapse: collapse; width: 100%; text-align: center; border: 1px solid #000;" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th style="border: 1px solid #000;">Product</th>
                <th style="border: 1px solid #000;">Name</th>
                <th style="border: 1px solid #000;">Quantity</th>
                <th style="border: 1px solid #000;">Price (₹)</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                @foreach ($cartItems as $item)
                <td style="border: 1px solid #000;">
                <a href="{{ route('product.show', ['id' => $item['product_id']]) }}" target="_blank">
                    <img src="{{ $message->embedData(file_get_contents(public_path('productsimg/' . $item['image'])), $item['image'], 'image/jpeg') }}" style="width: 50px; height: 50px;">
                </a>
                </td>
                <td style="border: 1px solid #000;">
                    <a href="{{ route('product.show', ['id' => $item['product_id']]) }}" target="_blank" style="color: black; text-decoration: none;">{{ $item['name'] }} </a>
                </td>
                {{-- @endforeach --}}
                {{-- <td style="border: 1px solid #000;">{{ $quantities }}</td>
                <td style="border: 1px solid #000;">{{ $prices }}</td> --}}
                <td style="border: 1px solid #000;">{{ $item['quantity'] }}</td>
                    <td style="border: 1px solid #000;">₹{{ $item['price'] }}</td>
                </tr>
                @endforeach
            </tr>

        </tbody>
    </table>

    <p style="margin-top: 30px;">Outstanding Amount Payable on Delivery: ₹{{ $checkout->total_cost }}</p>

    <h4>Delivery Address:</h4>
    <table style="border-collapse: collapse; width: 100%; text-align: center; border: 1px solid #000;" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th style="border: 1px solid #000;">Name</th>
                <th style="border: 1px solid #000;">Address</th>
                <th style="border: 1px solid #000;">Contact</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #000;">{{ $checkoutData['name'] }}</td>
                <td style="border: 1px solid #000;">{{ $checkoutData['address'] }}</td>
                <td style="border: 1px solid #000;">{{ $checkoutData['contact_number'] }}</td>
            </tr>
        </tbody>
    </table>

    <table style="border-collapse: collapse; width: 100%; text-align: center; border: 1px solid #000; margin-top:20px;" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th style="border: 1px solid #000;">What Next?</th>
                <th style="border: 1px solid #000;">Any Questions?</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #000;">You will receive an email with your courier Tracking ID & a link to track your order.</td>
                <td style="border: 1px solid #000;">Get in touch with our team on 8980405701</td>

            </tr>
        </tbody>
    </table>

    <p>Thank you for shopping!</p>
    <p>veehaagate.com</p>

    {{-- <h4>What Next?</h4>
    <p>You will receive an email with your courier Tracking ID & a link to track your order.</p>
    <h4>Any Questions?</h4>
    <p>Get in touch with our team on 8980405701</p> --}}
</body>
</html>
