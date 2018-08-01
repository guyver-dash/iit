<?php

namespace App\Http\Controllers\API\Collections;

use App\Exports\InvoicesExport;
use App\Exports\dbExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\TrainingPayment;
use Carbon\Carbon;

class CollectionController extends Controller
{
    public function export() 
	{
		
	    return \Excel::download(new InvoicesExport, 'invoices.xlsx');
	}

	public function dbExport(){
		return \Excel::download(new dbExport, 'enrollees.xlsx');
	}

	
}
