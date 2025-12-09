<?php

// Test login manual
use App\Models\User;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Checking Users in Database ===\n\n";

$users = User::select('id', 'name', 'email', 'role', 'status')->get();

echo "Total users: " . $users->count() . "\n\n";

foreach ($users as $user) {
    echo sprintf(
        "ID: %d | Email: %s | Role: %s | Status: %s\n",
        $user->id,
        $user->email,
        $user->role ?? 'N/A',
        $user->status ?? 'N/A'
    );
}

echo "\n=== Testing Login Credentials ===\n\n";

// Test if admin user exists
$admin = User::where('email', 'admin@example.com')->first();
if ($admin) {
    echo "Admin user found: " . $admin->email . "\n";
    echo "Can authenticate: " . (Hash::check('password', $admin->password) ? 'YES' : 'NO') . "\n";
} else {
    echo "Admin user NOT found\n";
}
