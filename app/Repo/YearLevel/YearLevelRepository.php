<?php namespace App\Repo\YearLevel;

use App\Repo\BaseRepository;
use App\YearLevel;

class YearLevelRepository extends BaseRepository implements YearLevelInterface{

	public function __construct(){

		$this->modelName = new YearLevel();
	}


}