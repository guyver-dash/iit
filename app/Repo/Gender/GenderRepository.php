<?php namespace App\Repo\Gender;

use App\Repo\BaseRepository;
use App\Gender;

class GenderRepository extends BaseRepository implements GenderInterface{

	public function __construct(){

		$this->modelName = new Gender();
	}


}