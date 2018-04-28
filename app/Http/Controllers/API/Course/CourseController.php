<?php

namespace App\Http\Controllers\API\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Course\CourseInterface;

class CourseController extends Controller
{

	protected $course;

    public function __construct(CourseInterface $course){
    	$this->course = $course;
    }

    public function index(){

    	return response()->json([
    			'courses' => $this->course->all()
    		]);
    }
}
