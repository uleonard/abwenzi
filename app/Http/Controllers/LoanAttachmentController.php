<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LoanAttachment;

class LoanAttachmentController extends Controller
{
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
        $request->validate([
            'attachment' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'name' => 'required',
         ]);
         
     
         $attachment = time().'.'.$request->attachment->extension();  
         
         /*******
          * UPLOAD THE ATTACHMENT
         */ 
         $request->attachment->move(public_path('storage/loans'), $attachment);
        
          
         $loan_att = new LoanAttachment;
         $loan_att->name = $request['name'];
         $loan_att->loan = $request['loan'];
         $loan_att->attachment = $attachment;
         
         $loan_att->save();
 
 
         return redirect("loans/".$request['loan']);
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
