<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Loan;
use App\LoanType;
use App\Commission;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::all();
        return $loans;
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
     * 
     * ----------------------------------------------------------------
     * STEPS
     * ~~~~~
     * [1] - Calculates due date and interest rate
     * [2] - Save the loan model
     * [3] - If this client is through an agent, then calculate and save agent's commission
     * [4] - Send email to the client about the loan processed
     * ----------------------------------------------------------------
     */
    public function store(Request $request)
    {
        $loan_type = LoanType::find($resquest['loan_type']);

        /**Calculate the loan repayment due date from day of loan authorization */
        $date = Carbon::createFromFormat('Y.m.d', $request['date_authorized']);
        $due_date = $date->addDays($loan_type->duration);
        
        /**Calculate the interest rate for the loan obtained */
        $interest = ($loan_type->interest / 100) * $request['amount'];
         
        $current_user = Auth::id();
        
        $loan = new Loan;
        $loan->loan_number = $loan_number;
        $loan->client = $request['client'];
        $loan->loan_type = $request['loan_type'];
        $loan->amount = $request['amount'];
        $loan->source_of_funds = $request['source_of_funds'];
        $loan->date_applied = $request['date_applied'];
        $loan->processed_by = $request['processed_by'];
        $loan->date_processed = $request['date_processed'];
        $loan->authorizedd_by = $request['authorized_by'];
        $loan->date_authorized = $request['date_authorized'];
        $loan->due_date = $due_date;
        $loan->interest = $interest;
        $loan->balance = $request['amount'] + $interest;
        $loan->entered_by = $current_user;
        //SAVE AND RETURN THE AUTO INCREMENT ID;
        $loan_id = $loan->save();

        /**
         * IF THE PROCESSED_BY'S ROLE AN AGENT THEN ADD COMMISSION RECORD
         */
        $user = User::find($request['processed_by']);
        if($user->role=="AGENT"){
            /**CALCULATE THE COMMISSION */
            $settings = Setting::where('setting','=','commission_rate')->last();
            $comm_rate = $settings->value / 100;
            //ADD COMMISSION RECORD
            $com = new Commission;
            $com->agent = $user->id;
            $com->loan = $loan_id; //Maybe this works also: $loan->id;
            $com->commission = $interest * $comm_rate; 
            $com->has_qualified = 0; 
            $com->is_paid = 0; 
            $comm->save();
        }


        /**
         * SEND EMAIL TO THE CLIENT 
         * 
        */


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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
