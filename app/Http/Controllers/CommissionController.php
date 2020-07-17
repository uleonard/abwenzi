<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Commission;
use \App\User;
use \App\Cash;

use Auth;
use Session;

class CommissionController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Commission::whereYear('created_at',date('Y'))->get();

        $users = User::where('role','AGENT')->get();

        return view('commissions.index',
                [
                    'rows'=>$rows,
                    'users'=>$users,
                    'year'=>date('Y'),
                    'month'=>'--',
                    'agent'=>'--',
                    'is_paid'=>'',
                    'has_qualified'=>'',
                ]);
    }

    /**
     * Search the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * ----------------------------------------------------------------
     * STEPS
     * ~~~~~~~~
     * [1] - Search by Date .....
     * 
     * ------------------------------------------------------------------
     */
    public function search(Request $request)
    {
        
        $year = $request['year'];
        $month = $request['month'];        
        $agent = $request['agent'];
        $is_paid = $request['is_paid'];
        $has_qualified = $request['has_qualified'];
        $rows = [];
        if($month=="--" && $agent=="--"){
            $rows = Commission::whereYear('created_at',$year)
                    ->where('has_qualified','LIKE','%'.$has_qualified)
                    ->where('is_paid','LIKE','%'.$is_paid)
                    ->get();
        }
        else if($agent=="--"){
            $rows = Commission::whereYear('created_at',$year)
                    ->whereMonth('created_at',$month)
                    ->where('has_qualified','LIKE','%'.$has_qualified)
                    ->where('is_paid','LIKE','%'.$is_paid)
                    ->get();
        }
        else if($month=="--"){
            $rows = Commission::whereYear('created_at',$year)
                    ->where('agent',$agent)
                    ->where('has_qualified','LIKE','%'.$has_qualified)
                    ->where('is_paid','LIKE','%'.$is_paid)
                    ->get();
        }
        else{
            $rows = Commission::whereYear('created_at',$year)
                        ->whereMonth('created_at',$month)
                        ->where('agent',$agent)
                        ->where('has_qualified','LIKE','%'.$has_qualified)
                        ->where('is_paid','LIKE','%'.$is_paid)
                        ->get();
        }

        $users = User::where('role','AGENT')->get();

        return view('commissions.index',
                [
                    'rows'=>$rows,
                    'users'=>$users,
                    'year'=>$year,
                    'month'=>$month,
                    'agent'=>$agent,
                    'is_paid'=>$is_paid,
                    'has_qualified'=>$has_qualified,
                ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payCreate($id)
    {
        $row = Commission::find($id);
        return view('commissions.pay-create',['row'=>$row]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * ------------------------------------------------------
     * STEPS
     * ~~~~~~~~
     * [1] - Update is_paid attribute in the Commission model
     * [2] - Create new record in the Cash model as a credit entry with description
     *       "Commission paid to XXXX by CASH"
     */
    public function payStore(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'trans_date' => 'required',
         ]);

         $commission = $request->commission;
         $payment_method = $request->payment_method;
         $trans_date = $request->trans_date;

         /**STEP 1: UPDATE THE Commission MODEL */

         $comm = Commission::find($commission);
         $comm->is_paid = 1;
         $comm->date_paid = date('Y-m-d');
         $comm->save();

        /**STEP 2: CREATE A CASH RESOURCE */
        
        $description = "Commission paid to " . $comm->user->name . " by " . $payment_method;
        $current_user = Auth::id();
        //$current_user = 2;
        
        $c = Cash::latest('id')->first();
        $balance = 0-$comm->commission;
        if($c)
            $balance = $c->balance + $balance;   

        $cash = new Cash;
        $cash->trans_date = $trans_date;
        $cash->description = $description;
        $cash->entry = "CR";
        $cash->amount = 0-$comm->commission;
        $cash->balance = $balance;
        $cash->entered_by = $current_user;
        $cash->save();


        Session::flash('message', 'Commission paid successfully'); 
        Session::flash('alert-class', 'alert-info'); 
        
        return redirect('/commissions/'); 

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
