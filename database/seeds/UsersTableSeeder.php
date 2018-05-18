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

        $user = User::create([
        		'firstname' => 'Victor',
        		'lastname' => 'Arcenal',
        		'email' => 'admin@iitcebu.net',
                'mobile' => '123456789311',
        		'password' => Hash::make('12345678')

        	]);

        $user->roles()->attach($user->id,[
                'user_id' => $user->id,
                'role_id' => 1
            ]);


       $user = User::create([
                'firstname' => 'user 1',
                'lastname' => 'user 1',
                'email' => 'user1@rbestore.com',
                'mobile' => '12345678914',
                'password' => Hash::make('12345678')

            ]);

       $user->roles()->attach($user->id,[
                'user_id' => $user->id,
                'role_id' => 2
            ]);

    }
}
