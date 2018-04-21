<?php namespace App\Repo;

interface BaseInterface{

	public function all();

	public function orderBy($value, $op );
}