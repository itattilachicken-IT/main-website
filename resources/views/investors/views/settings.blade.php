@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>

    @vite('resources/css/app2.css')
    @vite('resources/js/app2.js')
</head>

<body>
    
<div class="dashboard-layout">

    {{-- Sidebar / Navigation --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main class="main-content">
        @include('partials.topbar')

        <section class="section">
<div class="container">

        <div class="settings-wrapper">



        {{-- Profile Information --}}
        <div class="settings-card p-6 bg-white rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4">Profile Information</h2>

            <form method="POST" action="{{ route('account.updateProfile') }}">
                @csrf

                <div class="form-row grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label class="block font-medium mb-1">Full Name</label>
                        <input type="text" name="full_name"
                            value="{{ old('full_name', $user->full_name) }}"
                            class="w-full border border-gray-300 rounded px-3 py-2">
                    </div>

                    <div class="form-group">
                        <label class="block font-medium mb-1">Email</label>
                        <input type="email" name="email"
                            value="{{ old('email', $user->email) }}"
                            class="w-full border border-gray-300 rounded px-3 py-2">
                    </div>

                    <div class="form-group md:col-span-2">
                        <label class="block font-medium mb-1">Phone</label>
                        <input type="text" name="phone"
                            value="{{ old('phone', $user->phone) }}"
                            class="w-full border border-gray-300 rounded px-3 py-2">
                    </div>
                </div>

                <button type="submit" class="btn-primary px-4 py-2 mt-4 inline-block">Save Changes</button>
            </form>
        </div>

        {{-- Security Section --}}
        <div class="settings-card p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Security</h2>

            <form method="POST" action="{{ route('account.updatePassword') }}">
                @csrf

                <div class="form-group mb-4">
                    <label class="block font-medium mb-1">Current Password</label>
                    <input type="password" name="current_password"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div class="form-group mb-4">
                    <label class="block font-medium mb-1">New Password</label>
                    <input type="password" name="new_password"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <div class="form-group mb-4">
                    <label class="block font-medium mb-1">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                </div>

                <button type="submit" class="btn-primary px-4 py-2 mt-2 inline-block">Update Password</button>
            </form>
        </div>

            {{-- Notifications Section --}}
            <!-- <div class="settings-card">
                <h2>Notifications</h2>

                <div class="notification-item">
                    <span>Email Notifications</span>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="notification-item">
                    <span>SMS Notifications</span>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="notification-item">
                    <span>Payment Alerts</span>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>

            </div> -->

        </div>
</div>
</div>

    </main>
</div>

</body>
</html>
