<?php

use Illuminate\Database\Seeder;
use App\Model\Policy;

class PoliciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('policies')->truncate();

        $policies = ['I understand that I\'m temporarily enrolled at Intellisense Institute of Technology and I am aware that I will only be officially enrolled once the following school requirements have been completed and submitted.', 'I understand that all fees are NON-REFUNDABLE UPON ENROLLMENT. I have read/understand this policy and I certify all entries are true and correct.'];

        foreach ($policies as $key => $value) {
        	
        	Policy::create([
        			'name' => $value
        		]);
        }
    }
}
