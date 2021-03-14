<?php

namespace Database\Seeders;

use App\Models\Mark;
use App\Models\Module;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Disable forein key checks before truncating all tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('student_classes')->truncate();
        DB::table('students')->truncate();
        DB::table('teachers')->truncate();
        DB::table('modules')->truncate();
        DB::table('marks')->truncate();
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Dont forget to edit factories if you edit these values
        StudentClass::factory(3)->create();
        Student::factory(8)->create();
        Teacher::factory(3)->create();
        Module::factory(8)->create();
        Mark::factory(30)->create();

        User::factory(3)->state(new Sequence(
            [
                'name' => 'Karine',
                'email' => 'karine@gmail.com',
            ],
            [
                'name' => 'Nicolas',
                'email' => 'nicolas@gmail.com',
            ],
            [
                'name' => 'Alexis',
                'email' => 'alexis@gmail.com',
            ],
        ))->create();
    }
}
