<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\SundayClass;

class UpdateUserClass extends Command
{
    protected $signature = 'user:update-class {email} {class_id}';
    protected $description = 'Update user\'s Sunday class';

    public function handle()
    {
        $email = $this->argument('email');
        $classId = $this->argument('class_id');

        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email {$email} not found!");
            return;
        }

        $class = SundayClass::find($classId);
        
        if (!$class) {
            $this->error("Class with ID {$classId} not found!");
            return;
        }

        $user->sunday_class_id = $classId;
        $user->save();

        $this->info("Successfully updated {$user->name}'s class to: {$class->name}");
    }
} 