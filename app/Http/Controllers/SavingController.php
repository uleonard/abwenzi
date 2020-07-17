<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Savings;
use Auth;
use Session;

class SavingController extends Controller
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
        //
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
        $current_user = Auth::id();
        $amount = $request->amount;
        if($request->entry == "WITHDRAW")
            $amount = 0-$amount;

        $savings = new Savings;
        $savings->shareholder = $request->shareholder;
        $savings->trans_date = $request->trans_date;
        $savings->entry = $request->entry;
        $savings->amount = $amount;
        $savings->comment = $request->comment;
        $savings->entered_by = $current_user;
        $savings->save();

        
        Session::flash('message', 'Equity (sahres) added successfully'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('/shareholders/'.$request->shareholder);
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
