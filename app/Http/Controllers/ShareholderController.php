<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shareholder;
use Session;

class ShareholderController extends Controller
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
        $shareholders = Shareholder::all();

        return view('shareholders.index',['rows'=>$shareholders]);
    }

    public function search(Request $request)
    {
        $surname = $request->search;
        $firstname = $request->search;

        $rows = Shareholder::where('surname','LIKE','%'.$surname.'%')
                            ->orWhere('firstname','LIKE','%'.$firstname.'%')
                            ->get();

        return view('shareholders.index',['rows'=>$rows]);

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
            'firstname' => 'required',
            'surname' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required',
         ]);

        $shareholder = new Shareholder;
        $shareholder->firstname = $request->firstname;
        $shareholder->surname = $request->surname;
        $shareholder->gender = $request->gender;
        $shareholder->phone = $request->phone;
        $shareholder->email = $request->email;
        $shareholder->save();

        Session::flash('message', 'Shareholder created successfully'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('/shareholders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shareholder = Shareholder::find($id);

        return view('shareholders.show',['row'=>$shareholder]);
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
