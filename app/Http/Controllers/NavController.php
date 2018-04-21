<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repo\Course\CourseInterface;
use App\Repo\Admission\AdmissionInterface;
use App\Repo\Sy\SyInterface;
use App\Repo\YearLevel\YearLevelInterface;
use App\Repo\Semester\SemesterInterface;
use App\Repo\Schedule\ScheduleInterface;
use App\Repo\Gender\GenderInterface;
use App\Repo\CivilStatus\CivilStatusInterface;

class NavController extends Controller
{
    

    public function home(){

    	return view('nav.home');
    }

    public function about(){

    	return view('nav.about');
    }

    public function enroll(){
       
    	return view('nav.enroll');
    }

    public function enrollData(CourseInterface $course, AdmissionInterface $admission, SyInterface $sy, YearLevelInterface $yearLevel, SemesterInterface $semester, ScheduleInterface $schedule, GenderInterface $gender, CivilStatusInterface $civilstatus ){

        return response()->json([

                'admissions' => $admission->orderBy('name', 'asc')->select('id', 'name')->get(),
                'courses' => $course->orderBy('name', 'asc')->select('id', 'name')->get(),
                'schoolyears' => $sy->orderBy('name', 'asc')->select('id', 'name')->get(),
                'semesters' => $semester->orderBy('name', 'asc')->select('id', 'name')->get(),
                'schedules' => $schedule->orderby('days', 'asc')->get(),
                'genders' => $gender->orderBy('name', 'asc')->select('id', 'name')->get(),
                'civilstatus' => $civilstatus->orderBy('name', 'asc')->select('id', 'name')->get()


            ]);

    }

}
