<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deposit Received - Attila Chicken</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: Arial, sans-serif; background-color: #fff7f7; margin:0; padding:0;">
    <div style="max-width:600px; margin:20px auto; background:#fff; border-radius:8px; border:1px solid #f5c6c6; box-shadow:0 2px 5px rgba(0,0,0,0.05); overflow:hidden;">
        
        {{-- Header --}}
        <div style="background:#fe0000; padding:15px; text-align:center;">
            <img src="https://attilachicken.com/images/logo2.jpg" alt="Attila Chicken" style="width:150px; max-width:80%;">
        </div>

        {{-- Body --}}
        <div style="padding:25px;">
            <h2 style="color:#fe0000; margin-bottom:10px;">Deposit Received!</h2>
            
            <p style="font-size:16px; line-height:1.5; margin-bottom:15px;">
                Hi <strong>{{ $order->customer_name }}</strong>,<br>
                Thank you for making a **deposit payment** of <strong>KSh {{ number_format($order->paid_amount, 2) }}</strong> for your Attila Chicken order <strong>#{{ $order->id }}</strong>.
            </p>

            {{-- Order summary --}}
            <div style="background:#fff3f3; border-radius:5px; padding:15px; margin-bottom:15px;">
                <p style="margin:5px 0;"><strong>Order ID:</strong> #{{ $order->id }}</p>
                <p style="margin:5px 0;"><strong>Total Amount:</strong> KSh {{ number_format($order->total_amount, 2) }}</p>
                <p style="margin:5px 0; color:#fe0000;"><strong>Amount Paid:</strong> KSh {{ number_format($order->paid_amount, 2) }}</p>
                <p style="margin:5px 0; color:#fe0000;"><strong>Remaining Balance:</strong> KSh {{ number_format($order->balance, 2) }}</p>
            </div>

            <p style="font-size:14px; line-height:1.5; color:#555;">
                Please note that the remaining balance will have to be paid before or during delivery. For any help, reach out to our support team.
            </p>

            <p style="font-size:13px; color:#555; margin-top:20px;">
                The Attila Chicken Team<br>
                <a href="https://attilachicken.com" style="color:#fe0000; text-decoration:none;">www.attilachicken.com</a>
            </p>
        </div>
    </div>
</body>
</html>
