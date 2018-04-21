<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(SyTableSeeder::class);
        $this->call(AdmissionsTableSeeder::class);
        $this->call(YearLevelsTableSeeder::class);
        $this->call(SemestersTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(CivilStatusTableSeeder::class);
    }
}
