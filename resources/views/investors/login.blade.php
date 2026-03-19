<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Attila Investor Login</title>

<style>
:root{
    --gold:#FFC300;
    --gold-soft:#FCCC32;
    --red:#C1121F;
    --green:#2E7D32;
    --orange:#FF6D19;
    --white:#FFFFFF;
    --black:#000000;
}

/* ===== PAGE ===== */

body{
    margin:0;
    font-family: system-ui,-apple-system,"Segoe UI",Roboto,Arial;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background-color: whitesmoke;
    color:#111;
}

/* ===== CARD ===== */

.login-card{
    width:100%;
    max-width:420px;
    padding:38px;
    border-radius:18px;
    background:rgba(255,255,255,0.96);
    box-shadow:0 30px 80px rgba(0,0,0,0.35);
    backdrop-filter: blur(10px);
}

/* ===== LOGO ===== */

.logo{
    text-align:center;
    font-weight:800;
    font-size:22px;
    color:var(--red);
    letter-spacing:1px;
    margin-bottom:6px;
}

.title{
    text-align:center;
    font-size:24px;
    font-weight:700;
    margin-bottom:26px;
}

/* ===== FORM ===== */

label{
    font-size:13px;
    font-weight:600;
}

.input{
    width:100%;
    padding:12px;
    margin-top:6px;
    border-radius:10px;
    border:1px solid #ddd;
    font-size:14px;
    transition:.2s;
}

.input:focus{
    outline:none;
    border-color:var(--gold);
    box-shadow:0 0 0 3px rgba(255,195,0,0.35);
}

.field{
    margin-bottom:18px;
}

/* ===== BUTTON ===== */

.submit-btn{
    width:100%;
    padding:13px;
    border:0;
    border-radius:12px;
    font-weight:700;
    font-size:15px;
    cursor:pointer;
    background:linear-gradient(135deg, var(--gold), var(--gold-soft));
    color:#000;
    transition:.25s;
}

.submit-btn:hover{
    transform:translateY(-1px);
    box-shadow:0 8px 18px rgba(0,0,0,0.25);
}

/* ===== FOOTER ===== */

.footer{
    margin-top:20px;
    text-align:center;
    font-size:13px;
    color:#555;
}

.footer a{
    color:var(--red);
    font-weight:700;
    text-decoration:none;
}

.footer a:hover{
    text-decoration:underline;
}

/* ===== ERROR BOX ===== */

.error-box{
    background:#fee2e2;
    border:1px solid #fecaca;
    color:#b91c1c;
    padding:12px;
    border-radius:10px;
    margin-bottom:16px;
    font-size:13px;
}

/* ===== MOBILE ===== */

@media(max-width:480px){
    .login-card{
        margin:20px;
        padding:28px;
    }
}
</style>
</head>
<body>

<div class="login-card">

    <div class="logo">ATTILA CHICKEN</div>
    <div class="title">Investor Portal Login</div>

    @if ($errors->any())
    <div class="error-box">
        <ul style="margin:0;padding-left:18px">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('investors.login') }}">
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

    </form>

    <div class="footer">
        Back to <a href="{{ url('/') }}">Home</a>
    </div>

</div>

</body>
</html>