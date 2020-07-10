<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Expense;
use App\ExpenseCategory;
use Auth;
use Session;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Expense::all();

        return view('expenses.index',
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
        
        $rows = Expense::whereYear('trans_date',$year)
                      ->whereMonth('trans_date',$month)
                      ->get();
                      
        return view('expenses.index',
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
        $expenses = ExpenseCategory::all();
        return view('expenses.create',['rows'=>$expenses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'trans_date' => 'required',
            'description' => 'required',
            'category' => 'required',
            'amount' => 'required|numeric',
         ]);
        
        $current_user = Auth::id();
        
        $expense = new Expense;
        $expense->category = $request->category;
        $expense->trans_date = $request->trans_date;
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->entered_by = $current_user;
        $expense->save();

        
        Session::flash('message', 'New expense added'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('/expenses');


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
