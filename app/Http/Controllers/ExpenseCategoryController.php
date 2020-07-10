<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseCategory;
use Session;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ExpenseCategory::all();
       
        return view('expenses.categories.index',['rows'=>$categories]);
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
        $request->validate([
            'description' => 'required',
            'category' => 'required',
         ]);
        
        $c = new ExpenseCategory;
        $c->category = $request->category;
        $c->description = $request->description;
        $c->save();

        Session::flash('message', 'New expense category added'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('/exp/categories');

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
        $c = ExpenseCategory::find($id);
        $c->category = $request->category;
        $c->description = $request->description;
        $c->save();

        Session::flash('message', 'Expense category has been updated'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('/exp/categories');

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
