<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Attila Investor Login</title>

<style>
body{
    margin:0;
    font-family: system-ui,-apple-system,"Segoe UI",Roboto,Arial;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    
}

.login-card{
    width:100%;
    max-width:420px;
    padding:34px;
    border-radius:16px;
    background:rgba(255,255,255,0.97);
    box-shadow:0 25px 60px rgba(0,0,0,0.25);
}

.logo{
    text-align:center;
    font-weight:700;
    font-size:20px;
    margin-bottom:10px;
}

.title{
    text-align:center;
    font-size:22px;
    font-weight:600;
    margin-bottom:22px;
}

label{
    font-size:13px;
    font-weight:600;
}

.input{
    width:100%;
    padding:11px;
    margin-top:6px;
    border-radius:8px;
    border:1px solid #ddd;
    font-size:14px;
    transition:.2s;
}

.input:focus{
    outline:none;
    border-color:#111;
    box-shadow:0 0 0 3px rgba(0,0,0,0.08);
}

.field{
    margin-bottom:18px;
}

.submit-btn{
    width:100%;
    padding:12px;
    border:0;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
    background:#111;
    color:#fff;
    transition:.2s;
}

.submit-btn:hover{
    background:#000;
}

.footer{
    margin-top:18px;
    text-align:center;
    font-size:13px;
    color:#666;
}

.footer a{
    color:#000;
    font-weight:600;
    text-decoration:none;
}

.error-box{
    background:#fee2e2;
    border:1px solid #fecaca;
    color:#b91c1c;
    padding:12px;
    border-radius:8px;
    margin-bottom:15px;
    font-size:13px;
}

@media(max-width:480px){
    .login-card{
        margin:20px;
        padding:26px;
    }
}
</style>
</head>
<body>

<div class="login-card">

    <div class="logo">ATTILA</div>
    <div class="title">Sign in to Dashboard</div>

    @if ($errors->any())
    <div class="error-box">
        <ul style="margin:0;padding-left:18px">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ url('investors.login') }}">
    @csrf

    <div class="field">
        <label>Email</label>
        <input class="input" name="email" type="email" required autofocus>
    </div>

    <div class="field">
        <label>Password</label>
        <input class="input" name="password" type="password" required>
    </div>

    <button type="submit" class="submit-btn">
        Sign In
    </button>

    <a type="submit" class="submit-btn" href="{{ url('investors/views/home') }}">Sign in</a> <a type="submit" class="submit-btn" href="{{ url('investors/views/admin-dashboard') }}">Admin</a>
    

    </form>

    <div class="footer">
        Back to <a href="{{ url('/') }}">Home</a>
    </div>

</div>

</body>
</html>