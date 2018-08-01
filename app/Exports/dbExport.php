<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Model\ConfirmEnrolled;

use Carbon\Carbon;

class dbExport implements FromView
{
    public function view(): View
    {
		
        return view('database', [
            'confirmEnrolled' => ConfirmEnrolled::with(['enrollee', 'course', 'schedule'])
                ->orderBy('created_at', 'DESC')->get()
        ]);
    }
}