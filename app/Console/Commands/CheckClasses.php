<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SundayClass;

class CheckClasses extends Command
{
    protected $signature = 'check:classes';
    protected $description = 'Check all Sunday classes in the database';

    public function handle()
    {
        $classes = SundayClass::all();
        
        $this->info('All Sunday Classes:');
        foreach ($classes as $class) {
            $this->line("ID: {$class->id} - Name: '{$class->name}'");
        }
    }
} 