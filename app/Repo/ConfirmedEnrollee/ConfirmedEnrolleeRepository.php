<?php 

namespace App\Repo\ConfirmedEnrollee;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\ConfirmEnrolled;
use App\Model\Sibling;

class ConfirmedEnrolleeRepository extends BaseRepository implements ConfirmedEnrolleeInterface{

	public function __construct(){

		$this->modelName = new ConfirmEnrolled();
	}

	  public function update($request, $id){

        $confirmedEnroll = $this->modelName->find($id);
        $confirmedEnroll->schedule_id = $request->confirmedEnrolled['schedule_id'];
        $confirmedEnroll->school_year_id = $request->confirmedEnrolled['school_year_id'];
        $confirmedEnroll->semester_id = $request->confirmedEnrolled['semester_id'];
        $confirmedEnroll->year_level_id = $request->confirmedEnrolled['year_level_id'];
        $confirmedEnroll->start_time = $request->confirmedEnrolled['start_time'];
        $confirmedEnroll->end_time = $request->confirmedEnrolled['end_time'];
        $confirmedEnroll->status = $request->confirmedEnrolled['status'];
        $confirmedEnroll->lrn = $request->confirmedEnrolled['lrn'];
        $confirmedEnroll->update();

        $confirmedEnroll->enrollee->firstname = $request->confirmedEnrolled['enrollee']['firstname'];
        $confirmedEnroll->enrollee->lastname = $request->confirmedEnrolled['enrollee']['lastname'];
        $confirmedEnroll->enrollee->middlename = $request->confirmedEnrolled['enrollee']['middlename'];
        $confirmedEnroll->enrollee->suffix = $request->confirmedEnrolled['enrollee']['suffix'];
        $confirmedEnroll->enrollee->nickname = $request->confirmedEnrolled['enrollee']['nickname'];
        $confirmedEnroll->enrollee->age = $request->confirmedEnrolled['enrollee']['age'];
        $confirmedEnroll->enrollee->birthday = $request->confirmedEnrolled['enrollee']['birthday'];
        $confirmedEnroll->enrollee->birth_place = $request->confirmedEnrolled['enrollee']['birth_place'];
        $confirmedEnroll->enrollee->educ_at_id = $request->confirmedEnrolled['enrollee']['educ_at_id'];
        $confirmedEnroll->enrollee->sex = $request->confirmedEnrolled['enrollee']['sex'];
        $confirmedEnroll->enrollee->landline = $request->confirmedEnrolled['enrollee']['landline'];
        $confirmedEnroll->enrollee->mobile = $request->confirmedEnrolled['enrollee']['mobile'];
        $confirmedEnroll->enrollee->email = $request->confirmedEnrolled['enrollee']['email'];
        $confirmedEnroll->enrollee->religion = $request->confirmedEnrolled['enrollee']['religion'];
        $confirmedEnroll->enrollee->citizenship = $request->confirmedEnrolled['enrollee']['citizenship'];
        $confirmedEnroll->enrollee->present_province_id = $request->confirmedEnrolled['enrollee']['present_province_id'];
        $confirmedEnroll->enrollee->present_city_id = $request->confirmedEnrolled['enrollee']['present_city_id'];
        $confirmedEnroll->enrollee->present_zipcode = $request->confirmedEnrolled['enrollee']['present_zipcode'];
        $confirmedEnroll->enrollee->present_address = $request->confirmedEnrolled['enrollee']['present_address'];
        $confirmedEnroll->enrollee->permanent_province_id = $request->confirmedEnrolled['enrollee']['permanent_province_id'];
        $confirmedEnroll->enrollee->permanent_city_id = $request->confirmedEnrolled['enrollee']['permanent_city_id'];
        $confirmedEnroll->enrollee->permanent_zipcode = $request->confirmedEnrolled['enrollee']['permanent_zipcode'];
        $confirmedEnroll->enrollee->permanent_address = $request->confirmedEnrolled['enrollee']['permanent_address'];
        $confirmedEnroll->enrollee->father_lastname = $request->confirmedEnrolled['enrollee']['father_lastname'];
        $confirmedEnroll->enrollee->father_firstname = $request->confirmedEnrolled['enrollee']['father_firstname'];
        $confirmedEnroll->enrollee->father_middlename = $request->confirmedEnrolled['enrollee']['father_middlename'];
        $confirmedEnroll->enrollee->father_occupation = $request->confirmedEnrolled['enrollee']['father_occupation'];
        $confirmedEnroll->enrollee->father_contact_number = $request->confirmedEnrolled['enrollee']['father_contact_number'];
        $confirmedEnroll->enrollee->father_province_id = $request->confirmedEnrolled['enrollee']['father_province_id'];
        $confirmedEnroll->enrollee->father_city_id = $request->confirmedEnrolled['enrollee']['father_city_id'];
        $confirmedEnroll->enrollee->father_zipcode = $request->confirmedEnrolled['enrollee']['father_zipcode'];
        $confirmedEnroll->enrollee->father_address = $request->confirmedEnrolled['enrollee']['father_address'];
        $confirmedEnroll->enrollee->mother_firstname = $request->confirmedEnrolled['enrollee']['mother_firstname'];
        $confirmedEnroll->enrollee->mother_lastname = $request->confirmedEnrolled['enrollee']['mother_lastname'];
        $confirmedEnroll->enrollee->mother_middlename = $request->confirmedEnrolled['enrollee']['mother_middlename'];
        $confirmedEnroll->enrollee->mother_occupation = $request->confirmedEnrolled['enrollee']['mother_occupation'];
        $confirmedEnroll->enrollee->mother_contact_number = $request->confirmedEnrolled['enrollee']['mother_contact_number'];
        $confirmedEnroll->enrollee->mother_province_id = $request->confirmedEnrolled['enrollee']['mother_province_id'];
        $confirmedEnroll->enrollee->mother_city_id = $request->confirmedEnrolled['enrollee']['mother_city_id'];
        $confirmedEnroll->enrollee->mother_zipcode = $request->confirmedEnrolled['enrollee']['mother_zipcode'];
        $confirmedEnroll->enrollee->mother_address = $request->confirmedEnrolled['enrollee']['mother_address'];
        $confirmedEnroll->enrollee->name_of_school = $request->confirmedEnrolled['enrollee']['name_of_school'];
        $confirmedEnroll->enrollee->school_province_id = $request->confirmedEnrolled['enrollee']['school_province_id'];
        $confirmedEnroll->enrollee->school_city_id = $request->confirmedEnrolled['enrollee']['school_city_id'];
        $confirmedEnroll->enrollee->school_zipcode = $request->confirmedEnrolled['enrollee']['school_zipcode'];
        $confirmedEnroll->enrollee->school_address = $request->confirmedEnrolled['enrollee']['school_address'];
        $confirmedEnroll->enrollee->update();
        $confirmedEnroll->enrollee->siblings()->detach();

        foreach ($confirmedEnroll->enrollee->siblings as $key => $value) {
            $value->delete();
        }
        
        if(count($request->confirmedEnrolled['enrollee']['siblings']) > 0){
            foreach ($request->confirmedEnrolled['enrollee']['siblings'] as $key => $value) {
                $sibling = Sibling::create([
                        'name' => $value['name'],
                        'age' => $value['age'],
                        'school_name' => $value['school_name'],
                        'occupation' => $value['occupation']
                    ]);

                Sibling::find($sibling->id)->enrollee()->attach($sibling->id, [
                        'sibling_id' => $sibling->id,
                        'enrollee_id' => $confirmedEnroll->enrollee->id
                    ]);
            }
        }


        $confirmedEnroll->enrollee->answers()->detach();

        foreach ($request->confirmedEnrolled['enrollee']['answers'] as $key => $value) {
            $confirmedEnroll->enrollee->answers()->attach(
                    $confirmedEnroll->enrollee->id,
                    ['answer_id' => $value['id'],
                    'enrollee_id' => $confirmedEnroll->enrollee->id
                ]);
        }
        
        $confirmedEnroll->enrollee->requirementsDoc()->detach();

        foreach ($request->requirementsDocs as $key => $value) {

            $confirmedEnroll->enrollee->requirementsDoc()->attach(
                    $confirmedEnroll->enrollee->id,
                    ['requirement_doc_id' => $value,
                    'enrollee_id' => $confirmedEnroll->enrollee->id
                ]);
        }


        return response()->json($request->confirmedEnrolled['enrollee']['requirements_doc'] );
    }
	
	
}