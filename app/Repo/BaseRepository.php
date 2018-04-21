<?php namespace App\Repo;

class BaseRepository {

	protected $modelName;

	public function all(){

		return $this->modelName->all();
	}

	public function orderBy($value, $op){

		return $this->modelName->orderby($value, $op);
	}
}