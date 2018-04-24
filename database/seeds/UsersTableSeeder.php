<?php

use Illuminate\Database\Seeder;
use App\Model\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $faker = Faker\Factory::create();

        User::create([
        		'firstname' => 'Jhon',
        		'lastname' => 'Doe',
        		'email' => 'jhoaan@rbestore.com',
                'mobile' => '123456789311',
        		'password' => Hash::make('12345678')

        	]);

        User::create([
                'firstname' => 'user 1',
                'lastname' => 'user 1',
                'email' => 'user1@rbestore.com',
                'mobile' => '12345678914',
                'password' => Hash::make('12345678')

            ]);

    }
}
