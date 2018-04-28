<?php

namespace App\Http\Controllers\API\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Role\RoleInterface;

class RoleController extends Controller
{
    
    public function __construct(RoleInterface $role){

    }
}
