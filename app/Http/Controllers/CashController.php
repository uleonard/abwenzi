<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cash;

class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Cash::all();

        return view('cash.index',
                [
                    'rows'=>$rows,
                    'year'=>date('Y'),
                    'month'=>date('m')
                ]);
    }

    public function search(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        
        $rows = Cash::whereYear('trans_date',$year)
                      ->whereMonth('trans_date',$month)
                      ->get();
                      
        return view('cash.index',
                [
                    'rows'=>$rows,
                    'year'=>$year,
                    'month'=>$month
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
        //
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
