<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Model\Payment;
use Carbon\Carbon;

class InvoicesExport implements FromView
{
    public function view(): View
    {
    	$request = app()->make('request');
		
        return view('collections', [
            'payments' => Payment::where('created_at', '>=', $request->startDate)
	    		->where('created_at', '<=', $request->endDate)
            	->with(['confirmEnrolled.enrollee', 'confirmEnrolled', 'balance'])
            	->get(),
            'startDate' => Carbon::parse($request->startDate)->toDayDateTimeString(),
            'endDate' => Carbon::parse($request->endDate)->toDayDateTimeString()
        ]);
    }
}