<?php

namespace Database\Seeders;

use App\Data\ClassesData;
use App\Models\StudyClass;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    public function run()
    {
        try {
            // Add male classes
            foreach (ClassesData::getMaleClasses() as $classData) {
                StudyClass::updateOrCreate(
                    ['id' => $classData['id']],
                    [
                        'name' => $classData['name'],
                        'stage' => $classData['stage'],
                        'schedule' => $classData['schedule'],
                        'place' => $classData['place'],
                        'saint_image' => $classData['saintImage'],
                        'gender' => 'male',
                    ]
                );
            }

            // Add female classes
            foreach (ClassesData::getFemaleClasses() as $classData) {
                StudyClass::updateOrCreate(
                    ['id' => $classData['id']],
                    [
                        'name' => $classData['name'],
                        'stage' => $classData['stage'],
                        'schedule' => $classData['schedule'],
                        'place' => $classData['place'],
                        'saint_image' => $classData['saintImage'],
                        'gender' => 'female',
                    ]
                );
            }

            \Log::info('Classes seeded successfully');
        } catch (\Exception $e) {
            \Log::error('Error seeding classes: ' . $e->getMessage());
            throw $e;
        }
    }
} 