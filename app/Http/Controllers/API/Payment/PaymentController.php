<?php

namespace App\Http\Controllers\API\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Payment;
use Riskihajar\Terbilang\Facades\Terbilang;
class PaymentController extends Controller
{
    
    public function index(){

    	return response()->json([
    			'payments' => Payment::with('confirmEnrolled.enrollee')->orderBy('created_at', 'DESC')->paginationPay()
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

    public function destroy($id){

        Payment::find($id)->delete();

        return response()->json([
                'sucess' => true
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
        $amountWords = ucfirst(Terbilang::make($payment->amount_charge, ' Pesos'));

        $pdf->loadHTML("
            <style>
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
            <p>
                    <strong>Paid Date: </strong> $payDate <br>
                    <strong>Receipt No.:</strong> <br />
                    <strong>Student ID No.:  </strong> $studentIdNo <br />
                    <strong>Course: </strong> $course

                </p>

                <p> <strong>Received from: </strong> $name <br />
                    <strong>The sum of Peso/s: </strong> $amountWords <br />
                    <strong>As Payment for: </strong> <br />
                </p>
            ");
        return $pdf->stream();
    }
}
