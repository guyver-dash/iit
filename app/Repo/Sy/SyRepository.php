<?php namespace App\Repo\Sy;

use App\Repo\BaseRepository;
use App\Sy;

class SyRepository extends BaseRepository implements SyInterface{

	public function __construct(){

		$this->modelName = new Sy();
	}


}