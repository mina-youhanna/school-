<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // التحقق من هيكل جدول users
    $columns = DB::select("DESCRIBE users");
    
    echo "هيكل جدول users:\n";
    foreach ($columns as $column) {
        echo "- {$column->Field} ({$column->Type})\n";
    }
    
} catch (Exception $e) {
    echo "خطأ: " . $e->getMessage() . "\n";
} 