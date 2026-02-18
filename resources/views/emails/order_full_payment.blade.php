<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmed - Attila Chicken</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #fff7f7; color: #000; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 20px auto; background: #fff; border-radius: 8px; border: 1px solid #f5c6c6; box-shadow: 0 2px 5px rgba(0,0,0,0.05); overflow: hidden;">
        
        <!-- Header -->
        <div style="background: #fe0000; padding: 15px; text-align: center;">
            <img src="https://attilachicken.com/images/logo2.jpg" alt="Attila Chicken" style="width: 150px;">
        </div>

        <!-- Body -->
        <div style="padding: 25px;">
            <h2 style="color: #fe0000;">Order Confirmed!</h2>
            <p style="font-size: 16px; line-height: 1.6;">
                Hi {{ $order->customer_name }},<br><br>
                We’re excited to let you know that your payment of 
                <strong>KSh {{ number_format($order->paid_amount) }}</strong> has been received in full.  
                Your Attila Chicken order is now being prepared for delivery. 🍗
            </p>

            <p style="font-size: 15px; margin-top: 20px; line-height: 1.6;">
                Here are your order details:
            </p>
            <ul style="font-size: 15px; line-height: 1.6; color: #000;">
                <li><strong>Order ID:</strong> #{{ $order->id }}</li>
                <li><strong>Total Amount:</strong> KSh {{ number_format($order->total_amount) }}</li>
                <li><strong>Delivery Address:</strong> {{ $order->customer_address }}</li>
                <li><strong>Status:</strong> Pending Delivery</li>
            </ul>

         

            <p style="font-size: 14px; color: #555;">
                Thank you for choosing Attila Chicken!  
                Your satisfaction means everything to us.
            </p>

            <p style="font-size: 13px; color: #555;">
                — The Attila Chicken Team<br>
                <a href="https://attilachicken.com" style="color: #fe0000; text-decoration: none;">www.attilachicken.com</a>
            </p>
        </div>
    </div>
</body>
</html>
