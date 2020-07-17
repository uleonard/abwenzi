<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Equity;
use App\Savings;
use Auth;
use Session;

class EquityController extends Controller
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
        $rows = Equity::all();
        return view('equities.index',['rows'=>$rows]);
    }

    public function search(Request $request)
    {
        $type = $request->type;
        $rows = [];

        if($type == "EQUITY"){

            $rows = Equity::all();
        }
        else{
            $rows = Savings::all();   

        }

        return view('equities.index',['rows'=>$rows]);

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
        $eq = new Equity;
        $eq->shareholder = $request->shareholder;
        $eq->trans_date = $request->trans_date;
        $eq->entry = $request->entry;
        $eq->amount = $request->amount;
        $eq->comment = $request->comment;
        $eq->entered_by = $current_user;
        $eq->save();

        
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
