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

        // foreach ($request->answers as $key => $value) {
        //      Enrollee::find($enrollee->id)->answers()->attach($enrollee->id, [
        //             'enrollee_id' => $enrollee->id,
        //             'answer_id' => $value->id
        //         ] );    
        // }
        return response()->json($request->answers)
       
    }

    
}
