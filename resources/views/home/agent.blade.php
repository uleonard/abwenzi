@extends('layouts.management')
<style>
    .card-columns .card{
        //background-color:#d1cbab;
        background-color:#f7f6f0;;
        font-size: 16px;
        //opacity:0.5;
        text-align:center;
        padding:5px;
    }
    .card a:hover{
        text-decoration:none;
    }

    .card-head, thead{
        background-color:#dec32a;
    }
    .card-body{
        font-size:18px;
    }
    .card .statistics{

        text-align:center;
        padding:5px;
    }
    tbody{
        background-color:#f7f6f0;
        margin-top:5px;
    }
    

   


</style>
@section('content')    

    <div class="row">
        <div class="col-md-3" style="padding-left:20px;">
            <div class="content-header">Menu</div>
            <div class="d-flex flex-column">
                <a href="{{route('loans.index')}}"><div class="p-2"><i class="fa fa-dollar fa-x1"></i> Loans </div></a>
               <a href="{{route('commissions.index')}}"><div class="p-2"><i class="fa fa-balance-scale fa-x1"></i> Commissions </div></a>
               
            </div>
        </div>
            <div class="col-md-5">
                <div class="content-header">Statistics</div>
                
                    <div class="card-columns">
                        
                        <div class="card statistics">
                            <div class="card-head">
                                <span>Interest - Month</span>
                            </div>
                            <div class="card-body">
                                MWK <br>
                                {{number_format($stat['interest_month'],2)}}
                            </div> 
                        </div>
                        <div class="card statistics">
                            <div class="card-head">
                                <span>Interest - Year</span>
                            </div>
                            <div class="card-body">
                                MWK <br>
                                {{number_format($stat['interest_year'],2)}}
                            </div> 
                        </div>
                        <div class="card statistics">
                            <div class="card-head">
                                <span>Commission Payable</span>
                            </div>
                            <div class="card-body">
                                MWK <br>
                                {{number_format($stat['commission'],0)}}
                            </div>
                            
                            
                        </div>
                    </div>
                    
                     <div class="card-columns">
                        
                        
                        <div class="card statistics">
                            <div class="card-head">
                                <span>Defaulters - Year</span>
                            </div>
                            <div class="card-body">
                                {{number_format($stat['defaulters_year'],0)}}
                            </div>
                            
                            
                        </div>
                   
                        
                        <div class="card statistics">
                            <div class="card-head">
                                <span>Loans - Month</span>
                            </div>
                            <div class="card-body">
                                {{number_format($stat['loans_month'],0)}}
                            </div>
                            
                            
                        </div>
                        <div class="card statistics">
                            <div class="card-head">
                                <span>Loans - Year</span>
                            </div>
                            <div class="card-body">
                                {{number_format($stat['loans_year'],0)}}
                            </div>
                            
                            
                        </div>
                    </div>
                 
            </div>
            <div class="col-md-4" style="padding-right:20px;">
                <div class="content-header">Loans Due</div>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Balance</th>
                                <th>Due Date</th>
                                <th>Days</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                               @foreach($loans as $loan)
                                <tr>
                                    <td>{{$loan->owner->surname}}</td>
                                    <td>{{$loan->balance}}</td>
                                    <td>{{$loan->due_date->format('d M Y')}}</td>
                                    <td>
                                        <?php 
                                            //Reference: https://stackoverflow.com/questions/52884922/laravel-display-difference-between-two-dates-in-blade/52885035

                                            $days = round((strtotime($loan->due_date) - time()) / 86400) + 1;
                                            if($days>0)
                                                echo $days;
                                            else
                                                echo "Past due";
                                        ?>
                        
                                    </td>
                                </tr>
                                @endforeach
                            
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

   
@endsection