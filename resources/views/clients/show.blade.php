@extends('layouts.management')
<style>
    .applications .card{
        background-color:#f7f6f0;
    }
</style>
@section('content')
    <div class="card-header content-header">
    <a href="{{ route('clients.index') }}"> Clients</a> >>
    Profile
    </div>
    <div class="row" style="margin-top:10px;margin-left:10px;">                

                <div class="col-md-4">
                    <div class="card" >

                        <div class="card-header" > Client Details</div>                       
                            <div style="text-align:center;">
                            
                                <img src="{{asset('/images/female.jpg')}}" style="width:150px;">

                            </div>

                            <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Client Name
                                <span class="badge badge-primary badge-pill">{{$row->firstname." ".$row->surname}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Client ID
                                <span class="badge badge-primary badge-pill">{{$row->id}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Gender
                                <span class="badge badge-primary badge-pill">{{$row->gender}}</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                DOB
                                <span class="badge badge-primary badge-pill">{{$row->dob}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Physical Address
                                <span class="badge badge-primary badge-pill">{{$row->physical_address}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Phone
                                <span class="badge badge-primary badge-pill">{{$row->phone}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Phone (Other)
                                <span class="badge badge-primary badge-pill">{{$row->phone_other}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Date Created
                                <span class="badge badge-primary badge-pill">{{$row->created_at}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Entered By
                                <span class="badge badge-primary badge-pill">{{$row->user_entered->name}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Date Edited
                                <span class="badge badge-primary badge-pill">{{$row->updated_at}}</span>
                            </li>
                            
                        </ul>


                    </div>
                    
                </div>
                <div class="col-md-7">
                    <div class="card">

                        <div class="card-header" > Loans </div>                       

                            <div class="table-reponsive">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Date Authorized</th>
                                            <th>Amount</th>
                                            <th>Interest</th>
                                            <th>Total</th>
                                            <th>Amount Paid</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($row->loans as $loan)
                                        <tr>
                                            <td>{{$loan->date_authorized}}</td>
                                            <td>{{$loan->amount}}</td>
                                            <td>{{$loan->interest}}</td>
                                            <td>{{$loan->amount + $loan->interest}}</td>
                                            <td>{{$loan->amount + $loan->interest - $loan->balance}}</td>
                                            <td>{{$loan->due_date}}</td>
                                            <td>{{$loan->status}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        
                        

                    </div>
                </div>
        </div>
@endsection