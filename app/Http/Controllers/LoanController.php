<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Loan;
use App\LoanType;
use App\Commission;
use App\Client;
use App\User;


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

        return view('loans.index',['rows'=>$loans]);
        //return $loans;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $client = Client::find($id);
        $loan_types = LoanType::all();
        $users = \App\User::all();
        
        return view('loans.create')
            ->with([
                'row'=>$client,
                'loan_types'=>$loan_types,
                'users'=>$users
                ]);
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
        $loan_type = LoanType::find($request['loan_type']);

        //return $request['loan_type'];

        /**Calculate the loan repayment due date from day of loan authorization */
        $date = Carbon::createFromFormat('Y-m-d', $request['date_authorized']);
        $due_date = $date->addDays($loan_type->duration);
        
        /**Calculate the interest rate for the loan obtained */
        $interest = ($loan_type->interest_rate / 100) * $request['amount'];
         
        //return [$due_date,$interest];

        //$current_user = Auth::id();
        $current_user = 1;
        
        $loan = new Loan;
        $loan->number = 0;
        $loan->client = $request['client'];
        $loan->loan_type = $request['loan_type'];
        $loan->amount = $request['amount'];
        $loan->source_of_funds = $request['source_of_funds'];
        $loan->date_applied = $request['date_applied'];
        $loan->processed_by = $request['processed_by'];
        $loan->date_processed = $request['date_processed'];
        $loan->authorized_by = $request['authorized_by'];
        $loan->date_authorized = $request['date_authorized'];
        $loan->due_date = $due_date;
        $loan->interest = $interest;
        $loan->balance = $request['amount'] + $interest;
        $loan->entered_by = $current_user;
        //SAVE AND RETURN THE AUTO INCREMENT ID;
        $loan->save();

        /**
         * IF THE PROCESSED_BY'S ROLE AN AGENT THEN ADD COMMISSION RECORD
         */
        $user = User::find($request['processed_by']);
        if($user->role=="AGENT"){
            /**CALCULATE THE COMMISSION */
            $settings = \App\Setting::where('setting','commission_rate')->latest('id')->first();
           
            $comm_rate = $settings->value / 100;
            //ADD COMMISSION RECORD
            $com = new Commission;
            $com->agent = $user->id;
            $com->loan = $loan->id; 
            $com->commission = $interest * $comm_rate; 
            $com->has_qualified = 0; 
            $com->is_paid = 0; 
            $com->save();
        }


        /**
         * SEND EMAIL TO THE CLIENT 
         * 
        */


        return redirect('/loans/'.$loan->id)
                ->with(['message'=>'Loan saved successfully']); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loan = Loan::find($id);

        return view('loans.show',['row'=>$loan]);
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
     * 
     * -----------------------------------------------------------------
     * STEPS
     * ~~~~~
     * [1] - Get the commission and loan models for deletion
     * [2] - Update the STATUS property of commission model to DELETED/VOIDED
     * [3] - Update the STATUS property of loan model to DELETED/VOIDED
     * -----------------------------------------------------------------
     */
    public function destroy($id)
    {
        $comm = Loan::find($id)->commission;
        $loan = Loan::find($id);

        //UPDATE commission model
        $comm->status = "VOIDED";
        //$comm->save();

        //UPDATE loan model
        $loan->status = "VOIDED";
        //$loan->save();

        //YOU CAN HAVE save() METHODS AS A TRANSACTION
        DB::transaction(function() use ($comm, $loan) {
            $comm->save(); 
            $loan->save();
        });

        //return view('loans.list',['rows'=>$loans]);

    }
}
