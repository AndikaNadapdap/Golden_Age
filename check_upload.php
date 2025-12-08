<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Stimulation;

// Cek stimulation dengan ID 2
$stimulation = Stimulation::find(2);

if ($stimulation) {
    echo "Stimulation found: {$stimulation->title}\n";
    echo "Current image: " . ($stimulation->image ?? 'null') . "\n";
    
    // Cek folder
    $storagePath = storage_path('app/public/stimulations');
    echo "\nStorage path: {$storagePath}\n";
    echo "Path exists: " . (file_exists($storagePath) ? 'YES' : 'NO') . "\n";
    echo "Is writable: " . (is_writable($storagePath) ? 'YES' : 'NO') . "\n";
    
    // List files
    if (file_exists($storagePath)) {
        $files = scandir($storagePath);
        echo "\nFiles in stimulations folder:\n";
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                echo "- {$file}\n";
            }
        }
    }
} else {
    echo "Stimulation not found\n";
}
