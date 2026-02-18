<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    protected string $flagPath;

    public function __construct()
    {
        $this->flagPath = storage_path('framework/maintenance.flag');
    }

    public function index()
    {
        $maintenance = file_exists($this->flagPath);
        return view('admin.maintenance', compact('maintenance'));
    }

    public function toggle(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $adminUsername = 'admin';
    $adminPassword = 'secret123';

    if ($request->username !== $adminUsername || $request->password !== $adminPassword) {
        return response()->json(['message' => 'Invalid credentials'], 403);
    }

    $flagPath = storage_path('framework/maintenance.flag');

    if (file_exists($flagPath)) {
        unlink($flagPath);
        $message = 'Maintenance mode disabled';
    } else {
        file_put_contents($flagPath, now());
        $message = 'Maintenance mode enabled';
    }

    return response()->json(['message' => $message]);
}

}
