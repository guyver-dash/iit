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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(RolesTableSeeder::class);
        $this->call(StudentTypeTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RequirementsTableSeeder::class);
        $this->call(PoliciesTableSeeder::class);
        $this->call(YearLevelsTableSeeder::class);
        $this->call(EducationalAttainmentTableSeeder::class);
        $this->call(SemestersTableSeeder::class);
        $this->call(SchoolYearsTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(CivilStatusTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    }
}
