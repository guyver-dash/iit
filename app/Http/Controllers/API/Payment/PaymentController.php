<?php

namespace App\Http\Controllers\API\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Payment;
use App\Model\ConfirmEnrolled;
use Riskihajar\Terbilang\Facades\Terbilang;
class PaymentController extends Controller
{
    
    public function index(){
        $request = app()->make('request');
    	return response()->json([
    			'payments' => Payment::with('confirmEnrolled.enrollee')->orderBy('created_at', 'DESC')->paginationPay(),
                'confirmEnrolled' => ConfirmEnrolled::where('id', $request->confirmEnrolledId)->with('balances')->first(),
                'receipt_no' => Payment::max('receipt_no')
    		]);
    }

    public function edit($id){

        $payment = Payment::where('id', $id)->with(['confirmEnrolled.enrollee', 'balance'])->first();
        $balances = ConfirmEnrolled::where('id', $payment->confirm_enrollee_id)->with('balances')->first();
        return response()->json([
            'payment' => $payment,
            'balances' => $balances
            ]);
    }

    public function store(){
    	$request = app()->make('request');
    	$payment = Payment::create( $request->all() );
    	return response()->json([
    			'sucess' => true,
                'id' => $payment->id
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
            })->with(['confirmEnrolled.enrollee'])->paginationPay();

        return response()->json([
            'payments' => $payments
            ]);
    }

    public function print($id){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('legal', 'portrait');

        $payment = Payment::where('id', $id)->with(['confirmEnrolled.enrollee', 'confirmEnrolled.course'])->first();

        $payDate = $payment->created_at;
        $studentIdNo = $payment->confirmEnrolled->enrollee->idno;
        $course = $payment->confirmEnrolled->course->name;
        $name = $payment->confirmEnrolled->enrollee->lastname . ', ' . $payment->confirmEnrolled->enrollee->firstname;
        $amount = $payment->amount;
        $amountWords = ucwords(Terbilang::make($payment->amount_charge, ' Pesos'));
        $balance = $payment->balance->name;
        $paidAmount = $payment->amount_charge;
        $givenAmount = $payment->amount_given;
        $change = $payment->change;

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
                    <strong>Receipt No.:</strong> <br />
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
                <p> <strong>Due Amount:: </strong>&#8369; $paidAmount <br />
                    <strong>Received Amount:: </strong>&#8369; $givenAmount <br />
                    <strong>Change: </strong>
                    <span>&#8369;</span> $change <br />
                </p>
            </div>
            <div style='border-top: 1px dotted grey;'>
                <p>
                    <strong>Received by: </strong> Arcenal Jr, Victor Dimpas (Finance Officer)<br>

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
