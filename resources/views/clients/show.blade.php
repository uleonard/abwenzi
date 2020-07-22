@extends('layouts.management')
<style>
    .applications .card{
        background-color:#f7f6f0;
    }
    .row{
        
        padding-top:5px;
        padding-bottom:10px;
    }
    
</style>
@section('content')
<div class="col-md-12">
    <div class="card"> 
        <div class="card-header content-header">Clients / Profile</div>
            <div>
                <a href="{{route('clients.index')}}">
                    <i class="fa fa-arrow-left"></i>Back
                </a>
            </div>

                <div class="row" style="margin:5px;">                
            
                <div class="col-md-4">
                    <div class="card section" >

                        <div class="card-header" > Client Details</div>                       
                            <div style="text-align:center;">
                                @if($row->gender=="Female")
                                    <img src="{{asset('/images/female.jpg')}}" style="width:150px;">
                                @else
                                    <img src="{{asset('/images/male.png')}}" style="width:150px;">
                                @endif
                            </div>

                            <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Client Name
                                <span class="badge badge-pill">{{$row->firstname." ".$row->surname}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Client ID
                                <span class="badge  badge-pill">{{$row->id}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Gender
                                <span class="badge  badge-pill">{{$row->gender}}</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                DOB
                                <span class="badge  badge-pill">{{$row->dob}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Physical Address
                                <span class="badge  badge-pill">{{$row->physical_address}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Phone
                                <span class="badge  badge-pill">{{$row->phone}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Phone (Other)
                                <span class="badge  badge-pill">{{$row->phone_other}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Date Created
                                <span class="badge  badge-pill">{{$row->created_at}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Entered By
                                <span class="badge  badge-pill">{{$row->user_entered->name}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Date Edited
                                <span class="badge  badge-pill">{{$row->updated_at}}</span>
                            </li>
                            
                        </ul>


                    </div>
                    
                </div>
                <div class="col-md-8">
                    <div class="card section">

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
                                            <td>{{$loan->date_authorized->format('d M Y')}}</td>
                                            <td>{{number_format($loan->amount,2)}}</td>
                                            <td>{{number_format($loan->interest,2)}}</td>
                                            <td>{{number_format($loan->amount + $loan->interest,2)}}</td>
                                            <td>{{number_format($loan->amount + $loan->interest - $loan->balance,2)}}</td>
                                            <td>{{$loan->due_date->format('d M Y')}}</td>
                                            <td>{{$loan->status}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        
                        

                    </div>
                </div>
        </div>
</div>
@endsection