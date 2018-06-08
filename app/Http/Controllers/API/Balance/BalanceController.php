<?php

namespace App\Http\Controllers\API\Balance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Balance\BalanceInterface;

class BalanceController extends Controller
{
    protected $balance;

    public function __construct(BalanceInterface $balance){
    	$this->middleware(['role:admin']);
    	$this->balance = $balance;
    }

    public function index(){

        return response()->json([
                'balances' => $this->balance->index()
            ]);
    }

    public function edit($id){

        return response()->json([
                'balance' => $this->balance->where('id', $id)->first()
            ]);
    }

    public function store(){
    	
    	$request = app()->make('request');
    	$this->balance->store($request);

        return response()->json([
                'success' => true
            ]);
    }

    public function destroy($id){
        
        $this->balance->destroy($id);

        return response()->json([
                'success' => true
            ]);
    }

    public function update($id){
        $this->balance->update(app()->make('request')->all()['editBalance'], $id);
        return response()->json([
                'success' => true
            ]);
    }

    public function search(){

        return response()->json([
                'balances' => $this->balance->search()
            ]);
    }


}
