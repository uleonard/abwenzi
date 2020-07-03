<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "ZIKOMO";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                
        /*
        $request->validate([
            'business_name' => 'required',
            'owner_name' => 'required',
            'business_licence' => 'mimes:pdf,jpg,png|max:2048',
            'tax_clearance' => 'mimes:pdf,jpg,png|max:2048',
            'registration_certificate' => 'mimes:pdf,jpg,png|max:2048',
        ]);
        */
    
       // $track_password = time();
        $id_attachment = time().'.'.$request->id_attachment->extension();  
        
        /*******
         * UPLOAD THE ATTACHMENT
        */ 
        $request->id_attachment->move(public_path('../uploads/clients'), $id_attachment);
       

        //$current_user = Auth::id();
        $current_user = 1;
        
        $client = new Client;
        $client->firstname = $request['firstname'];
        $client->surname = $request['surname'];
        $client->gender = $request['gender'];
        $client->dob = $request['dob'];
        $client->id_type = $request['id_type'];
        $client->id_number = $request['id_number'];
        $client->physical_address = $request['physical_address'];
        $client->phone = $request['phone'];
        $client->phone_other = $request['phone_other'];
        $client->email = $request['email'];
        $client->entered_by = $current_user;
        $client->id_attachment = $id_attachment;
        
        $client->save();

        $url = "loans/".$client->id."/create";

        return redirect($url);
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
