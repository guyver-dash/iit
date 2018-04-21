<?php namespace App\Repo\Course;

use App\Repo\BaseRepository;
use App\Course;

class CourseRepository extends BaseRepository implements CourseInterface{

	public function __construct(){

		$this->modelName = new Course();
	}


}