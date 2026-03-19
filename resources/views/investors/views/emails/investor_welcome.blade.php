<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Investor Portal Access</title>
</head>
<body>

<p>Dear {{ $name }},</p>

<p>Welcome to the Attila Investor Portal.</p>

<p>Your account has been successfully created.</p>

<p><strong>Login Details:</strong></p>

<p>
Email: {{ $email }} <br>
Password: {{ $password }}
</p>

<p>
👉 Login here: <a href="{{ $loginUrl }}">{{ $loginUrl }}</a>
</p>

<p><strong>IMPORTANT:</strong><br>
For security reasons, you are required to reset your password immediately after your first login.
</p>

<p>Best regards,<br>
Attila Investor Relations Team</p>

</body>
</html>