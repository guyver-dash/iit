<?php namespace App\Repo\CivilStatus;

use App\Repo\BaseRepository;
use App\CivilStatus;

class CivilStatusRepository extends BaseRepository implements CivilStatusInterface{

	public function __construct(){

		$this->modelName = new CivilStatus();
	}


}