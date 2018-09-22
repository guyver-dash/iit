<?php

namespace App\Http\Controllers\API\TrainingPayments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\TrainingPayment;
use Riskihajar\Terbilang\Facades\Terbilang;
use Carbon\Carbon;

class TrainingPaymentsController extends Controller
{
    public function __construct(){
        $this->middleware(['role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
                'trainingPayments' => TrainingPayment::orderBy('created_at', 'DESC')->paginate(15)
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        


        TrainingPayment::create($request->all());
        
        return response()->json([
                $request->all()
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        return response()->json([
                'trainingPayment' => TrainingPayment::where('id', $id)->first()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $trainingPayment = TrainingPayment::find($id);
        $trainingPayment->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'prefix' => $request->prefix,
                'receipt_no' => $request->receipt_no,
                'paid_amount' => $request->paid_amount,
                'received_amount' => $request->received_amount,
                'change' => $request->received_amount - $request->paid_amount,
                'remarks' => $request->remarks,
                'created_at' => $request->created_at,
            ]);
        return response()->json([

                true
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainingPayment = TrainingPayment::find($id);
        $trainingPayment->delete();
        
        return response()->json([
                $id
            ]);
    }

    public function search(){

        $request = app()->make('request');

        $tp = TrainingPayment::where('firstname', 'LIKE', '%' . $request->string . '%')
                    ->orWhere('lastname', 'LIKE', '%' . $request->string . '%')
                    ->orderBy('created_at', 'DESC')->paginate(15);

        return response()->json([
                'trainingPayments' => $tp
            ]);
    }

    public function receiptNo(){

        return response()->json([
                'receiptNo' => TrainingPayment::max('receipt_no')
            ]);
    }

    public function print($id){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('legal', 'portrait');

        $trainingPayment = TrainingPayment::where('id', $id)->first();


        $payDate = substr(Carbon::parse($trainingPayment->created_at)->toDayDateTimeString(), 0, -8);

        $name = $trainingPayment->firstname . ' ' . $trainingPayment->lastname;
        $amountWords = ucwords(Terbilang::make($trainingPayment->paid_amount, ' Pesos'));
        $paidAmount = '&#8369;' . number_format($trainingPayment->paid_amount,  2, '.', ',');
        $givenAmount = '&#8369;' . number_format($trainingPayment->received_amount,  2, '.', ',');
        $change = '&#8369;' . number_format($trainingPayment->change,  2, '.', ',');
        $receiptNo = $trainingPayment->prefix . '-' .$trainingPayment->receipt_no;
        $remarks = $trainingPayment->remarks;
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
                    <strong>Received from: </strong> $name <br />
                </p>
            </div>
            <div>
                <p> 
                    <strong>The sum of Peso/s: </strong> $amountWords <br />
                </p>
            </div>
            <div style='clear:both'>
                <p> <strong>Due Amount:: </strong>$paidAmount <br />
                    <strong>Received Amount:: </strong> $givenAmount <br />
                    <strong>Change: </strong>$change <br />
                </p>
                <p> <strong>Remarks: </strong> $remarks </p>
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
                    <strong>Receipt No.:</strong> <br />
                    <strong>Received from: </strong> $name <br />
                </p>
            </div>
            <div>
                <p> 
                    <strong>The sum of Peso/s: </strong> $amountWords <br />
                </p>
            </div>
            <div style='clear:both'>
                <p> <strong>Due Amount:: </strong>$paidAmount <br />
                    <strong>Received Amount:: </strong> $givenAmount <br />
                    <strong>Change: </strong>$change <br />
                </p>
                <p> <strong>Remarks: </strong> $remarks </p>
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
