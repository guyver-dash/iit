<?php

use Illuminate\Database\Seeder;
use App\Model\RequirementDoc;

class RequirementsDocTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('requirements_doc')->truncate();

        $req1 = ['Report card (original)', 'Good moral', 'FORM 137(school to school)'];

        foreach ($req1 as $key => $value) {
        	RequirementDoc::create([
        			'name' => $value,
        			'requirement_id' => 1
        		]);
        }

        $req2 = ['ALS Certification'];

        foreach ($req2 as $key => $value) {
        	RequirementDoc::create([
        			'name' => $value,
        			'requirement_id' => 2
        		]);
        }

        $req3 = ['Honorable Dismissal', 'TOR', 'Good Moral'];

        foreach ($req3 as $key => $value) {
        	RequirementDoc::create([
        			'name' => $value,
        			'requirement_id' => 3
        		]);
        }

        $req4 = ['NSO Birth Certificate (original)', '2x2 colored picture white background (2 pcs)', 'long brown envelope with plastic'];

        foreach ($req4 as $key => $value) {
        	RequirementDoc::create([
        			'name' => $value,
        			'requirement_id' => 4
        		]);
        }
    }
}
