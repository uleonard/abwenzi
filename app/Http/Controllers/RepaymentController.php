<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Repayment;
use App\Loan;
use App\Cash;

use Auth;

class RepaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
     * -------------------------------------------------
     * STEPS
     * ~~~~~~~~~~
     * [1] - Save the loan repayment 
     * [2] - Update the balance in the Loan model
     * [3] - If this is final payment AND the loan was processed by AGENT, then 
     *       update the agent commission to qualified (i.e. qualified to 1 in Commission model)
     * [4] - Enter the repayment in the Cash model 
     * 
     */
    public function store(Request $request)
    {
        /** GET THE CURRENT USER  */
        
        $current_user = Auth::id();
       // $current_user = 1;

        /**
         * STEP [1] - Save the loan repayment 
         **/

        $repay = new Repayment;
        $repay->loan = $request['loan'];
        $repay->amount = $request['amount'];
        $repay->date_paid = $request['date_paid'];
        $repay->receipt = $request['receipt'];
        $repay->entered_by = $current_user; 
        $repay->save();


        /**
         * STEP [2] - Update the balance in the loan model
         **/

        $loan = Loan::find($request['loan']);
        $loan->balance = $loan->balance - $request['amount'];
        $loan->save();

        /**
         * STEP [3] - If this is final payment AND the loan was processed by AGENT, then 
         *        update the agent commission to qualified (i.e. qualified to 1 in Commission model) 
         **/
        if($loan->balance <= 0){
            $user = User::find($loan->processed_by);
            if($user->role=="AGENT"){
                $loan->commission->has_qualified = 1;
                $loan->commission->save();
            }
        }

        /**
         * STEP [4] - Enter the repayment as a debot entry in Cash model
         * 
         */

        $c = Cash::latest('id')->first();
        $balance = $request['amount'];
        if($c)
            $balance = $c->balance + $balance;   

        $cash = new Cash;
        $cash->trans_date = $request['date_paid'];;
        $cash->description = "Loan repayment from " . $loan->owner->surname . " " .  $loan->owner->firstname . " for loan ID ABW".$loan->id;
        $cash->entry = "DR";
        $cash->amount = $request['amount'];;
        $cash->balance = $balance;
        $cash->entered_by = $current_user;
        $cash->save();


        return redirect('/loans/'.$loan->id); 
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repayment = Repayment::find($id);

        $request->comment = "VOIDED";
        $repayment->save();

    }
}
