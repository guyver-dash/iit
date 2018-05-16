<?php

use Illuminate\Database\Seeder;
use App\Model\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();
        $roles = ['admin', 'registrar', 'student'];


        foreach ($roles as $key => $value) {
        	Role::create([
        			'name' => $value,
        			'desc' => $value . ' desc'
        		]);
        }
    }
}
