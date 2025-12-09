<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Test Login for All Users ===\n\n";

$testPasswords = ['password', 'password123', '12345678', 'admin123', 'golden123'];

$users = User::whereIn('role', ['admin', 'doctor', 'parent'])->get();

foreach ($users as $user) {
    echo "User: {$user->email} (Role: {$user->role})\n";
    
    foreach ($testPasswords as $testPwd) {
        if (Hash::check($testPwd, $user->password)) {
            echo "  ✓ Password is: {$testPwd}\n";
            break;
        }
    }
    
    echo "\n";
}
