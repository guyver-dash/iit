<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Course;
use App\Model\SchoolYear;
use App\Model\YearLevel;
use App\Model\Semester;
use App\Model\Schedule;
use App\Model\Province;
use App\Model\City;
use App\Model\Question;
use App\Model\Answer;
use App\Model\Requirement;
use App\Model\Policy;
use App\Model\CivilStatus;
use App\Model\Enrollee;
use App\Model\EducAtt;
use App\Model\Sibling;
use App\Model\ConfirmEnrolled;
use App\Model\Role;


class StartUpController extends Controller
{
    public function index(){

    	return response()->json([

    			'courses' => Course::all(),
    			'schoolYears' => SchoolYear::all(),
    			'yearLevels' => YearLevel::all(),
    			'schedules' => Schedule::all(),
    			'provinces' => Province::all(),
                'semesters' => Semester::all(),
                'schedules' => Schedule::all(),
                'questions' => Question::with('answers')->get(),
                'requirements' => Requirement::with('requirementsDoc')->get(),
                'policies' => Policy::all(),
                'civilStatus' => CivilStatus::all(),
                'educAtt' => EducAtt::all()

    		]);
    }

    public function getCities($provinceId){

    	return response()->json([

    			'cities' => City::where('province_id', $provinceId)->get()
    		]);
    }

    public function getCityZipCode($cityId){

    	return response()->json([

    			'city' => City::where('id', $cityId)->first()
    		]);
    }


    public function getQuestionId($answerId){

        $answer = Answer::where('id', $answerId)->first();

        return response()->json([
                'questionId' => $answer->question_id
            ]);

        
    }

    public function enrollment(){

        $request = app()->make('request');

        $enrollee = Enrollee::create($request->all());

        foreach ($request->answers as $key => $value) {
             Enrollee::find($enrollee->id)->answers()->attach($enrollee->id, [
                    'enrollee_id' => $enrollee->id,
                    'answer_id' => $value['answerId']
                ] );    
        }

        foreach ($request->requirementsDocs as $key => $value) {
            
            Enrollee::find($enrollee->id)->requirementsDoc()->attach($enrollee->id, [
                    'enrollee_id' => $enrollee->id,
                    'requirement_doc_id' => $value
                ]);
        }

        if(count($request->siblings) > 0){

            foreach ($request->siblings as $key => $value) {
                $sibling = Sibling::create([

                        'name' => $value['name'],
                        'age' => $value['age'],
                        'occupation' => $value['occupation'],
                        'school_name' => $value['school_name']

                    ]);
                Enrollee::find($enrollee->id)->siblings()->attach($enrollee->id, [
                        'enrollee_id' => $enrollee->id,
                        'sibling_id' => $sibling->id
                    ]);
            }
        }
        

        ConfirmEnrolled::create([
                'enrollee_id' => $enrollee->id,
                'school_year_id' => $request->school_year_id,
                'year_level_id' => $request->year_level_id,
                'semester_id' => $request->semester_id,
                'schedule_id' => $request->schedule_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time
            ]);



        return response()->json([
                'success' => true
            ]);
       
    }

    public function getRoles(){

        return response()->json([
                'roles' => Role::all()
            ]);
    }

    
}
