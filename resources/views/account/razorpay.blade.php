<!DOCTYPE html>
<html>
<head>
    <title>Razorpay Checkout</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>

<script>
var options = {
    "key": "{{ $setting->razorpay_key }}",
    "amount": "{{ $amount }}",
    "currency": "INR",
    "name": "AdtroTalky",
    "description": "Wallet Recharge",
    "order_id": "{{ $order->id }}",

    "handler": function (response){
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = "{{ Asset('razorpayVerify') }}";

        form.innerHTML = `
            @csrf
            <input type="hidden" name="razorpay_payment_id" value="${response.razorpay_payment_id}">
            <input type="hidden" name="razorpay_order_id" value="${response.razorpay_order_id}">
            <input type="hidden" name="razorpay_signature" value="${response.razorpay_signature}">
        `;

        document.body.appendChild(form);
        form.submit();
    },

    "prefill": {
        "name": "{{ $user->name ?? '' }}",
        "email": "{{ $user->email ?? '' }}",
        "contact": "{{ $user->phone ?? '' }}"
    },

    "theme": {
        "color": "#4A1594"
    }
};

var rzp = new Razorpay(options);
rzp.open();
</script>

</body>
</html>
