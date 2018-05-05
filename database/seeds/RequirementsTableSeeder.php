<?php

use Illuminate\Database\Seeder;
use App\Model\Requirement;
use App\Model\RequirementDoc;

class RequirementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requirements')->truncate();
        DB::table('requirements_doc')->truncate();

        $requirement =  Requirement::create([
                'name' => 'Highschool Graduate'
            ]);

        $requirementsDoc = [
        	'Report card (original)',
        	'Good moral',
        	'Form 137 (school to school)'
        ];

        foreach ($requirementsDoc as $key => $value) {
        	
        	$requirementsDoc = new RequirementDoc();
            $requirementsDoc->name = $value;

            Requirement::find($requirement->id)
                    ->requirementsDoc()
                    ->save($requirementsDoc);
        	
        }

        $requirement =  Requirement::create([
                'name' => 'For ALS'
            ]);

        $requirementsDoc = [
            'ALS Certification'
        ];

        foreach ($requirementsDoc as $key => $value) {
            
            $requirementsDoc = new RequirementDoc();
            $requirementsDoc->name = $value;

            Requirement::find($requirement->id)
                    ->requirementsDoc()
                    ->save($requirementsDoc);
            
        }


         $requirement =  Requirement::create([
                'name' => 'For College (Level/Degree)'
            ]);
         

        $requirementsDoc = [
            'Honorable Dismissal',
            'TOR',
            'Good Moral'
        ];

        foreach ($requirementsDoc as $key => $value) {
            
            $requirementsDoc = new RequirementDoc();
            $requirementsDoc->name = $value;

            Requirement::find($requirement->id)
                    ->requirementsDoc()
                    ->save($requirementsDoc);
            
        }


        $requirement =  Requirement::create([
                'name' => 'Additional Requirements'
            ]);

        $requirementsDoc = [
            'NSO Birth Certificate (original)',
            '2x2 colored picture white background (2 pcs)',
            'long brown envelope with plastic'
        ];

        foreach ($requirementsDoc as $key => $value) {
            
            $requirementsDoc = new RequirementDoc();
            $requirementsDoc->name = $value;

            Requirement::find($requirement->id)
                    ->requirementsDoc()
                    ->save($requirementsDoc);
            
        }
    }
}
