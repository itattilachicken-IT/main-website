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

            <h1>Account Settings</h1>

            {{-- Profile Information --}}
            <div class="settings-card">
                <h2>Profile Information</h2>

                <form method="POST" action="#">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" value="John">
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" value="Investor">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="john@email.com">
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" value="+254712345678">
                    </div>

                    <button type="submit" class="btn-primary">Save Changes</button>
                </form>
            </div>

            {{-- Security Section --}}
            <div class="settings-card">
                <h2>Security</h2>

                <form method="POST" action="#">
                    @csrf

                    <div class="form-group">
                        <label>Current Password</label>
                        <input type="password" name="current_password">
                    </div>

                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="new_password">
                    </div>

                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" name="confirm_password">
                    </div>

                    <button type="submit" class="btn-primary">Update Password</button>
                </form>
            </div>

            {{-- Notifications Section --}}
            <div class="settings-card">
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

            </div>

        </div>
</div>
</div>

    </main>
</div>

</body>
</html>
