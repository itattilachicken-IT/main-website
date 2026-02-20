<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attila Investor Dashboard</title>

    <style>
        body{
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial;
            margin:0;
            background:#f7f7f8;
        }

        .wrap{
            max-width:420px;
            margin:80px auto;
            padding:28px;
            background:#fff;
            border-radius:10px;
            border:1px solid #e9e9ea;
            box-shadow:0 8px 20px rgba(0,0,0,0.05);
        }

        h1{
            margin:0 0 18px;
            font-size:22px;
            text-align:center;
        }

        /* Role Switch */
        .role-switch{
            display:flex;
            margin-bottom:20px;
            border-radius:8px;
            overflow:hidden;
            border:1px solid #ddd;
        }

        .role-btn{
            flex:1;
            padding:10px;
            border:0;
            background:#f3f3f3;
            cursor:pointer;
            font-weight:600;
        }

        .role-btn.active{
            background:#1b1b18;
            color:white;
        }

        label{
            display:block;
            margin-top:12px;
            font-size:13px;
        }

        input[type="email"], 
        input[type="password"]{
            width:100%;
            padding:10px;
            margin-top:6px;
            border:1px solid #ddd;
            border-radius:6px;
        }

        .actions{
            margin-top:18px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        button.submit-btn{
            background:#1b1b18;
            color:#fff;
            border:0;
            padding:10px 14px;
            border-radius:6px;
            cursor:pointer;
        }

        .note{
            color:#6b6b6b;
            font-size:13px;
        }

        .error-box{
            color:#b91c1c;
            margin-bottom:10px;
        }
    </style>
</head>

<body>

<div class="wrap">

    <h1>Sign in</h1>

    {{-- Role Switch --}}
    <div class="role-switch">
        <button type="button" class="role-btn active" onclick="setRole('investor', this)">Investor</button>
        <button type="button" class="role-btn" onclick="setRole('admin', this)">Admin</button>
    </div>

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

        {{-- Hidden role field --}}
        <input type="hidden" name="role" id="role" value="investor">

        <label>Email</label>
        <input name="email" type="email" required autofocus>

        <label>Password</label>
        <input name="password" type="password" required>

        <div class="actions">
            <div class="note">Select Investor or Admin to login <a href="{{ url('/') }}">Back to Home</a></div>
            <a type="submit" class="submit-btn" href="{{ url('investors/views/home') }}">Sign in</a>
            <a type="submit" class="submit-btn" href="{{ url('investors/views/admin-dashboard') }}">Admin</a>
        </div>
    </form>

</div>

<script>
function setRole(role, el) {
    document.getElementById("role").value = role;

    document.querySelectorAll(".role-btn").forEach(btn => {
        btn.classList.remove("active");
    });

    el.classList.add("active");
}
</script>

</body>
</html>
