<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Maintenance Mode</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 100px auto; background: #fff; padding: 30px; text-align: center; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.2);}
        h1 { color: #333; margin-bottom: 20px; }
        .status { font-weight: bold; color: #008a00; }
        .btn { padding: 10px 20px; font-size: 16px; background: #008a00; color: #fff; border: none; border-radius: 5px; cursor: pointer; margin-top: 20px; }
        .btn:hover { background: #005f00; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Maintenance Mode</h1>
        <p>Current status: <span class="status">{{ file_exists(storage_path('framework/maintenance.flag')) ? 'Enabled' : 'Disabled' }}</span></p>
        <button id="toggleMaintenance" class="btn">Toggle Maintenance</button>
    </div>

    <script>
        function toggleMaintenance(username, password) {
            fetch("{{ route('admin.maintenance.toggle') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ username, password })
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                location.reload();
            })
            .catch(err => console.error(err));
        }

        // Button click
        document.getElementById('toggleMaintenance').addEventListener('click', () => {
            const username = prompt("Enter admin username:");
            const password = prompt("Enter admin password:");
            if (username && password) toggleMaintenance(username, password);
        });

        // Keyboard shortcut: Ctrl + M
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key.toLowerCase() === 'm') {
                e.preventDefault();
                const username = prompt("Enter admin username:");
                const password = prompt("Enter admin password:");
                if (username && password) toggleMaintenance(username, password);
            }
        });
    </script>
</body>
</html>
