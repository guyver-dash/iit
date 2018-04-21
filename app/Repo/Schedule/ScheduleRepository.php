<?php namespace App\Repo\Schedule;

use App\Repo\BaseRepository;
use App\Schedule;

class ScheduleRepository extends BaseRepository implements ScheduleInterface{

	public function __construct(){

		$this->modelName = new Schedule();
	}


}