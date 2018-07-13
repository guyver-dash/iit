<?php

namespace App\Http\Controllers\API\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Payment;
use App\Model\SchoolYear;
use App\Model\ConfirmEnrolled;
use Riskihajar\Terbilang\Facades\Terbilang;
use Carbon\Carbon;
use App\Model\Balance;

class PaymentController extends Controller
{

    public function __construct(){
        $this->middleware(['role:admin']);
    }
    
    public function index(){
        $request = app()->make('request');
    	return response()->json([
    			'payments' => Payment::with(['confirmEnrolled.enrollee', 'balance'])->orderBy('created_at', 'DESC')->paginationPay(),
                'confirmEnrolled' => ConfirmEnrolled::where('id', $request->confirmEnrolledId)->with('balances')->first(),
                'receipt_no' => Payment::max('receipt_no')
    		]);
    }

    public function edit($id){

        $payment = Payment::where('id', $id)->with(['confirmEnrolled.enrollee', 'balance'])->first();
        $balances = ConfirmEnrolled::where('id', $payment->confirm_enrollee_id)->with('balances')->first();
        return response()->json([
            'payment' => $payment,
            'balances' => $balances,
            'schoolYears' => SchoolYear::all()
            ]);
    }

    public function store(){
    	$request = app()->make('request');
    	$payment = Payment::create( $request->all() );
        
        $totalAmountGiven = Payment::where('confirm_enrollee_id', $request->confirm_enrollee_id)
            ->where('balance_id', $payment->balance_id)
            ->sum('amount_charge');

        $updatePayment = Payment::find($payment->id);
        $updatePayment->total_amount_given = $totalAmountGiven;
        $updatePayment->update();

    	return response()->json([
    			'sucess' => true,
                'id' => $payment->id,
    		]);
    }

    public function update($id){

        $request = app()->make('request');
        
        $payment = Payment::find($id);
        $payment->update($request->all()['payment']);
        return response()->json([
                'success' => true
            ]);
    }

    public function destroy($id){

        Payment::find($id)->delete();

        return response()->json([
                'sucess' => true
            ]);
    }

    public function search(){
        $request = app()->make('request');
        $payments = Payment::whereHas('enrollee', function($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->orWhere('firstname', 'LIKE', '%'. $request->search . '%');
                    $query->orWhere('lastname', 'LIKE', '%'. $request->search . '%');

                });
            })->with(['confirmEnrolled.enrollee', 'balance'])->paginationPay();

        return response()->json([
            'payments' => $payments
            ]);
    }
    public function summaryAll(){
         $request = app()->make('request');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('legal', 'portrait');

        $payments = Payment::where('confirm_enrollee_id', $request->confirmEnrolledId)
            ->with(['confirmEnrolled.enrollee', 'confirmEnrolled', 'balance'])->orderBy('created_at', 'DESC')->get();
        $payment = Payment::where('confirm_enrollee_id', $request->confirmEnrolledId)
            ->with(['confirmEnrolled.enrollee', 'confirmEnrolled', 'balance'])->orderBy('created_at', 'DESC')->first();

        if ( count($payments) > 0) {
            
        $examPeriod = $request->examPeriod;
        $semester = $payment->confirmEnrolled->semester->name;
        $schoolYear = $payment->confirmEnrolled->schoolYear->sy;
        $date = Carbon::now()->toDayDateTimeString();
        $or = $payment->prefix . '-' . $payment->receipt_no;
        $idno = $payment->confirmEnrolled->enrollee->idno;
        $name = $payment->confirmEnrolled->enrollee->lastname  . ', ' . $payment->confirmEnrolled->enrollee->firstname;
        $course = $payment->confirmEnrolled->course->name;
        $schedule = $payment->confirmEnrolled->schedule->name;

        $trPaid = '';
        $amountDue = '&#8369;' . number_format($request->dueAmount,  2, '.', ',');
        $dueDate =  Carbon::parse($request->dueDate)->format('l jS \\of F Y'); 
        $balanceIdChecker = '';
        foreach ($payments as $value) {
            $searchBal = Balance::where('id', $value->balance->id)
                        ->whereHas('confirmEnrolled', function($query) use ($payment, $value) {
                            $query->where('confirm_enrolled_id', $payment->confirmEnrolled->id);
                        })->with('confirmEnrolled')->first();

            if ($searchBal != null) {
                            $discount = collect($searchBal->confirmEnrolled)
                            ->where('pivot.confirm_enrolled_id', $payment->confirmEnrolled->id)
                            ->where('pivot.balance_id', $value->balance->id)
                            ->first()->pivot->discount;
            }            
            

            $amountPaid = '&#8369;' . number_format($value->amount_charge,  2, '.', ',');
            $balanceName = $value->balance->name;
            $createdAt = substr($value->created_at->toDayDateTimeString(), 0, -7);


            if ($discount > 0) {
                $discountShow = "<br /> Less: " .  number_format($discount,  2, '.', ',');
                $balance = '&#8369;' . number_format($value->balance->amount,  2, '.', ',');
                $newBalance = $value->balance->amount - $discount;
                $newBalanceFormatted =  '&#8369;' . number_format($newBalance,  2, '.', ',');
                $remain = '&#8369;' . number_format($newBalance -  $value->total_amount_given,  2, '.', ',');
            }else{
                $balance = '&#8369;' . number_format($value->balance->amount,  2, '.', ',');
                $discountShow = '';
                $newBalanceFormatted = '';
                $remain = '&#8369;' . number_format($value->balance->amount - $value->total_amount_given,  2, '.', ',');

            }
            

            $trPaid .= "<tr>
                        <td>$or</td>
                        <td> $balanceName </td>
                        <td> $balance $discountShow <br />
                            <span style='color:green'>$newBalanceFormatted</span>
                        </td>
                        <td> $amountPaid </td>
                        <td> $remain </td>
                        <td>$createdAt</td>
                        </tr>
                       ";

        }


        $pdf->loadHTML("
            <style>
                *{
                    font-family:'DeJaVu Sans Mono',monospace;
                }
                body{
                    font-size: 8px;
                    font-family: Arial, Helvetica, sans-serif;
                }
                table, table th, table td {
                     border-collapse: collapse; 
                     padding: 5px;
                     width: 100%;

                }

            </style>

                <img src='images/logos/logo.png' width='120' style='padding: 0px;margin: 0px; margin-top: -20px; float: right' />
            <div style='margin-left: 100px;'>
            <div style='padding:0; margin:0; font-size:9px;' align='center'> <strong> Intellisense Institute of Technology </strong> </div>
             <div align='center' style='padding:0; margin:0; font-size:10px;'>
                2F Aspac Building, Guizo
            </div>
             <p align='center' style='padding:0; margin:0; font-size:10px;'>
                    Mandaue City, Cebu
                    (032) 4172412
                </p>


                <p align='center'> <strong style='font-size: 14px;'> STATEMENT OF ACCOUNT </strong> </p>
                
            </div>
            <div style='width: 300px;float:left;'>
                <p>
                    <strong>Date: </strong> $date <br />
                    <strong>Exam Period: </strong> $examPeriod<br>
                    <strong>Semester:</strong> $semester<br />
                    <strong>School Year:  </strong>  $schoolYear<br />

                </p>
            </div>
            <div>
                <p> <strong>Student ID No.: </strong>   $idno<br />
                    <strong>Name: </strong>  $name <br />
                    <strong>Course: </strong> $course<br />
                    <strong>Schedule: </strong> $schedule <br />
                </p>
            </div>
            <table id='first' border='1'>
                <tr>
                    <th>OR</th>
                    <th>Balance Name</th>
                    <th>Balance Amount</th>
                    <th>Paid</th>
                    <th>Remaining</th>
                    <th>Paid Date</th>
                </tr>

                $trPaid

            </table> 
             <p style='color:red;'> 
                    <strong>Amount Due: </strong> $amountDue <br />
                    <strong>Due Date: $dueDate </strong>
                </p>
            <div style='border-top: 1px dotted grey;'>
                <p>
                    <strong>Received by: </strong> Rosello, Fairlane (Finance Officer)<br>

                </p>
                <p align='center'>
                    All Rights Reserved @IIT 2015<br />
                    <strong>Disclaimer: </strong> 
                    This is a temporary receipt.
                </p>
            </div>

            ");
        return $pdf->stream();
        }
    }
    public function summary(){
        $request = app()->make('request');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('legal', 'portrait');

        $payment = Payment::orWhere('confirm_enrollee_id', $request->confirmEnrolledId)
            ->whereHas('confirmEnrolled', function($query) use ($request) {
                $query->where('semester_id', $request->semester);
                $query->where('school_year_id', $request->schoolYear);
            })->with(['confirmEnrolled.enrollee', 'confirmEnrolled', 'balance'])->first();

        $payments = Payment::orWhere('confirm_enrollee_id', $request->confirmEnrolledId)
            ->whereHas('confirmEnrolled', function($query) use ($request) {
                $query->where('semester_id', $request->semester);
                $query->where('school_year_id', $request->schoolYear);
            })->with(['confirmEnrolled.enrollee', 'balance.confirmEnrolled'])->orderBy('created_at', 'DESC')->get();
        if ( count($payments) > 0) {
            
        $examPeriod = $request->examPeriod;
        $semester = $payment->confirmEnrolled->semester->name;
        $schoolYear = $payment->confirmEnrolled->schoolYear->sy;
        $date = Carbon::now()->toDayDateTimeString();
        $or = $payment->prefix . '-' . $payment->receipt_no;
        $idno = $payment->confirmEnrolled->enrollee->idno;
        $name = $payment->confirmEnrolled->enrollee->lastname  . ', ' . $payment->confirmEnrolled->enrollee->firstname;
        $course = $payment->confirmEnrolled->course->name;
        $schedule = $payment->confirmEnrolled->schedule->name;

        $trPaid = '';
        $amountDue = '&#8369;' . number_format($request->dueAmount,  2, '.', ',');
        $dueDate =  Carbon::parse($request->dueDate)->format('l jS \\of F Y'); 
        $balanceIdChecker = '';
        foreach ($payments as $value) {
            $searchBal = Balance::where('id', $value->balance->id)
                        ->whereHas('confirmEnrolled', function($query) use ($payment, $value) {
                            $query->where('confirm_enrolled_id', $payment->confirmEnrolled->id);
                        })->with('confirmEnrolled')->first();

            if ($searchBal != null) {
                            $discount = collect($searchBal->confirmEnrolled)
                            ->where('pivot.confirm_enrolled_id', $payment->confirmEnrolled->id)
                            ->where('pivot.balance_id', $value->balance->id)
                            ->first()->pivot->discount;
            }            
            

            $amountPaid = '&#8369;' . number_format($value->amount_charge,  2, '.', ',');
            $balanceName = $value->balance->name;
            $createdAt = substr($value->created_at->toDayDateTimeString(), 0, -7);


            if ($discount > 0) {
                $discountShow = "<br /> Less: " .  number_format($discount,  2, '.', ',');
                $balance = '&#8369;' . number_format($value->balance->amount,  2, '.', ',');
                $newBalance = $value->balance->amount - $discount;
                $newBalanceFormatted =  '&#8369;' . number_format($newBalance,  2, '.', ',');
                $remain = '&#8369;' . number_format($newBalance -  $value->total_amount_given,  2, '.', ',');
            }else{
                $balance = '&#8369;' . number_format($value->balance->amount,  2, '.', ',');
                $discountShow = '';
                $newBalanceFormatted = '';
                $remain = '&#8369;' . number_format($value->balance->amount - $value->total_amount_given,  2, '.', ',');

            }
            

            $trPaid .= "<tr>
                        <td>$or</td>
                        <td> $balanceName </td>
                        <td> $balance $discountShow <br />
                            <span style='color:green'>$newBalanceFormatted</span>
                        </td>
                        <td> $amountPaid </td>
                        <td> $remain </td>
                        <td>$createdAt</td>
                        </tr>
                       ";

        }


        $pdf->loadHTML("
            <style>
                *{
                    font-family:'DeJaVu Sans Mono',monospace;
                }
                body{
                    font-size: 8px;
                    font-family: Arial, Helvetica, sans-serif;
                }
                table, table th, table td {
                     border-collapse: collapse; 
                     padding: 5px;
                     width: 100%;

                }

            </style>

                <img src='images/logos/logo.png' width='120' style='padding: 0px;margin: 0px; margin-top: -20px; float: right' />
            <div style='margin-left: 100px;'>
            <div style='padding:0; margin:0; font-size:9px;' align='center'> <strong> Intellisense Institute of Technology </strong> </div>
             <div align='center' style='padding:0; margin:0; font-size:10px;'>
                2F Aspac Building, Guizo
            </div>
             <p align='center' style='padding:0; margin:0; font-size:10px;'>
                    Mandaue City, Cebu
                    (032) 4172412
                </p>


                <p align='center'> <strong style='font-size: 14px;'> STATEMENT OF ACCOUNT </strong> </p>
                
            </div>
            <div style='width: 300px;float:left;'>
                <p>
                    <strong>Date: </strong> $date <br />
                    <strong>Exam Period: </strong> $examPeriod<br>
                    <strong>Semester:</strong> $semester<br />
                    <strong>School Year:  </strong>  $schoolYear<br />

                </p>
            </div>
            <div>
                <p> <strong>Student ID No.: </strong>   $idno<br />
                    <strong>Name: </strong>  $name <br />
                    <strong>Course: </strong> $course<br />
                    <strong>Schedule: </strong> $schedule <br />
                </p>
            </div>
            <table id='first' border='1'>
                <tr>
                    <th>OR</th>
                    <th>Balance Name</th>
                    <th>Balance Amount</th>
                    <th>Paid</th>
                    <th>Remaining</th>
                    <th>Paid Date</th>
                </tr>

                $trPaid

            </table> 
             <p style='color:red;'> 
                    <strong>Amount Due: </strong> $amountDue <br />
                    <strong>Due Date: $dueDate </strong>
                </p>
            <div style='border-top: 1px dotted grey;'>
                <p>
                    <strong>Received by: </strong> Rosello, Fairlane (Finance Officer)<br>

                </p>
                <p align='center'>
                    All Rights Reserved @IIT 2015<br />
                    <strong>Disclaimer: </strong> 
                    This is a temporary receipt.
                </p>
            </div>

            ");
        return $pdf->stream();
        }
    }

    public function print($id){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('legal', 'portrait');

        $payment = Payment::where('id', $id)->with(['confirmEnrolled.enrollee', 'confirmEnrolled.course'])->first();

        $payDate = $payment->created_at->toDayDateTimeString();
        $studentIdNo = $payment->confirmEnrolled->enrollee->idno;
        $course = $payment->confirmEnrolled->course->name;
        $name = $payment->confirmEnrolled->enrollee->lastname . ', ' . $payment->confirmEnrolled->enrollee->firstname;
        $amount = $payment->amount;
        $receiptNo = $payment->prefix . '-' . $payment->receipt_no;
        $amountWords = ucwords(Terbilang::make($payment->amount_charge, ' Pesos'));
        $balance = $payment->balance->name;
        $paidAmount = '&#8369;' . number_format($payment->amount_charge,  2, '.', ',');
        $givenAmount = '&#8369;' . number_format($payment->amount_given,  2, '.', ',');
        $change = '&#8369;' . number_format($payment->change,  2, '.', ',');

        $pdf->loadHTML("
            <style>
                *{
                    font-family:'DeJaVu Sans Mono',monospace;
                }
                body{
                    font-size: 11px;
                    font-family: Arial, Helvetica, sans-serif;
                }

            </style>

                <img src='images/logos/logo.png' width='120' style='padding: 0px;margin: 0px; margin-top: -20px; float: right' />
            <div style='margin-left: 100px;'>
            <div style='padding:0; margin:0; font-size:12px;' align='center'> <strong> Intellisense Institute of Technology </strong> </div>
             <div align='center' style='padding:0; margin:0; font-size:10px;'>
                2F Aspac Building, Guizo
            </div>
             <p align='center' style='padding:0; margin:0; font-size:10px;'>
                    Mandaue City, Cebu
                    (032) 4172412
                </p>


                <p align='center'> <strong style='font-size: 14px;'> ACKNOWLEDGEMENT RECEIPT </strong> </p>
                <br />
                <br />
                
            </div>
            <div style='width: 300px;float:left;'>
                <p>
                    <strong>Paid Date: </strong> $payDate <br>
                    <strong>Receipt No.:</strong> $receiptNo <br />
                    <strong>Student ID No.:  </strong> $studentIdNo <br />
                    <strong>Course: </strong> $course

                </p>
            </div>
            <div>
                <p> <strong>Received from: </strong> $name <br />
                    <strong>The sum of Peso/s: </strong> $amountWords <br />
                    <strong>As Payment for: </strong> $balance<br />
                </p>
            </div>
            <div style='clear:both'>
                <p> <strong>Due Amount:: </strong>$paidAmount <br />
                    <strong>Received Amount:: </strong> $givenAmount <br />
                    <strong>Change: </strong>$change <br />
                </p>
            </div>
            <div style='border-top: 1px dotted grey;'>
                <p>
                    <strong>Received by: </strong> Rosello, Fairlane (Finance Officer)<br>

                </p>
                <p align='center'>
                    All Rights Reserved @IIT 2015<br />
                    <strong>Disclaimer: </strong> 
                    This is a temporary receipt.
                </p>
            </div>

            <br />
            <br />
            <div style='border-top: 1px dotted grey;'></div>
            <br />
            <br />
            <br />
            <br />
                <img src='images/logos/logo.png' width='120' style='padding: 0px;margin: 0px; margin-top: -20px; float: right' />
            <div style='margin-left: 100px;'>
            <div style='padding:0; margin:0; font-size:12px;' align='center'> <strong> Intellisense Institute of Technology </strong> </div>
             <div align='center' style='padding:0; margin:0; font-size:10px;'>
                2F Aspac Building, Guizo
            </div>
             <p align='center' style='padding:0; margin:0; font-size:10px;'>
                    Mandaue City, Cebu
                    (032) 4172412
                </p>


                <p align='center'> <strong style='font-size: 14px;'> ACKNOWLEDGEMENT RECEIPT </strong> </p>
                <br />
                <br />
                
            </div>
            <div style='width: 300px;float:left;'>
                <p>
                    <strong>Paid Date: </strong> $payDate <br>
                    <strong>Receipt No.:</strong> $receiptNo <br />
                    <strong>Student ID No.:  </strong> $studentIdNo <br />
                    <strong>Course: </strong> $course

                </p>
            </div>
            <div>
                <p> <strong>Received from: </strong> $name <br />
                    <strong>The sum of Peso/s: </strong> $amountWords <br />
                    <strong>As Payment for: </strong> $balance<br />
                </p>
            </div>
            <div style='clear:both'>
                <p> <strong>Due Amount:: </strong>$paidAmount <br />
                    <strong>Received Amount:: </strong> $givenAmount <br />
                    <strong>Change: </strong>$change <br />
                </p>
            </div>
            <div style='border-top: 1px dotted grey;'>
                <p>
                    <strong>Received by: </strong> Rosello, Fairlane (Finance Officer)<br>

                </p>
                <p align='center'>
                    All Rights Reserved @IIT 2015<br />
                    <strong>Disclaimer: </strong> 
                    This is a temporary receipt.
                </p>
            </div>

            ");
        return $pdf->stream();
    }
}
