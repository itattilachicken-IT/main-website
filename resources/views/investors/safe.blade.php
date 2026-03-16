<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Safe Reset — Admin</title>
<style>
    .container { max-width: 600px; margin: 50px auto; text-align: center; }
    .btn-danger { background-color: #e53e3e; color: #fff; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px; }
    .btn-danger:hover { background-color: #c53030; }
    .alert-success { color: #2f855a; background-color: #f0fff4; padding: 10px; margin-bottom: 20px; border-radius: 5px; }
    .alert-error { color: #c53030; background-color: #fff5f5; padding: 10px; margin-bottom: 20px; border-radius: 5px; }
</style>
</head>
<body>

<div class="dashboard-layout">
    @include('partials.header')
    <main class="main-content">
        @include('partials.topbar')

        <section class="section">
            <div class="container">

                <h1>Safe Reset Page</h1>
                <p>This button will safely clear test data and uploaded files. It <strong>will not</strong> delete system files or your full database.</p>

                {{-- Alerts --}}
                @if(session('success'))
                    <div class="alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert-error">{{ session('error') }}</div>
                @endif

                {{-- Safe Reset Form --}}
                <form action="{{ route('investors.safe') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-danger">Clear Test Data</button>
                </form>

            </div>
        </section>
    </main>
</div>

</body>
</html>