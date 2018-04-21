<?php namespace App\Repo\Semester;

use App\Repo\BaseRepository;
use App\Semester;

class SemesterRepository extends BaseRepository implements SemesterInterface{

	public function __construct(){

		$this->modelName = new Semester();
	}


}