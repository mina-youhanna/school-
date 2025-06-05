<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StudyClass;

class CheckClasses extends Command
{
    protected $signature = 'classes:check';
    protected $description = 'Check the classes in the database';

    public function handle()
    {
        $maleClasses = StudyClass::where('gender', 'male')->get();
        $femaleClasses = StudyClass::where('gender', 'female')->get();

        $this->info('Male Classes:');
        $this->table(
            ['ID', 'Name', 'Stage', 'Gender'],
            $maleClasses->map(function ($class) {
                return [
                    'id' => $class->id,
                    'name' => $class->name,
                    'stage' => $class->stage,
                    'gender' => $class->gender,
                ];
            })
        );

        $this->info('Female Classes:');
        $this->table(
            ['ID', 'Name', 'Stage', 'Gender'],
            $femaleClasses->map(function ($class) {
                return [
                    'id' => $class->id,
                    'name' => $class->name,
                    'stage' => $class->stage,
                    'gender' => $class->gender,
                ];
            })
        );

        $this->info('Total Classes: ' . ($maleClasses->count() + $femaleClasses->count()));
    }
} 