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

class StartUpController extends Controller
{
    public function index(){

    	return response()->json([

    			'courses' => Course::all(),
    			'schoolYears' => SchoolYear::all(),
    			'yearLevels' => YearLevel::all(),
    			'semeters' => Semester::all(),
    			'schedules' => Schedule::all(),
    			'provinces' => Province::all(),

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


    public function getQuestionAns(){

        return response()->json([
                'questions' => Question::with('answers')->get()
            ]);

        
    }

    
}
