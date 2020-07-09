@extends('layouts.management')
<style>
    .card-columns .card{
        //background-color:#d1cbab;
        background-color:#f7f6f0;;
        font-size: 25px;
        //opacity:0.5;
    }
    .card a:hover{
        text-decoration:none;
    }
</style>
@section('content')      

        <div class="col-md-12">
            <div class="card">
                <div class="card-header content-header">Dashboard - Welcome Umali Leonard</div>

                <div class="card-body">
                    
                    <div class="card-columns">
                        <div class="card">                            
                            <a href="{{route('loans.index')}}" >  
                                <div class="card-body text-center">
                                    <div class="card-text">
                                        <i class="fa fa-envelope fa-2x"></i><br>Loans 
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="card">                            
                            <a href="{{route('clients.index')}}" >  
                                <div class="card-body text-center">
                                    <div class="card-text">
                                        <i class="fa fa-envelope fa-2x"></i><br>Clients 
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="card"> 
                            <a href="{{route('home')}}" >                           
                                <div class="card-body text-center">
                                    <div class="card-text">
                                        <i class="fa fa-check fa-2x"></i><br>Equity & Savings
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card">   
                            <a href="{{route('commissions.index')}}" >                           
                                <div class="card-body text-center">
                                    <div class="card-text">
                                        <i class="fa fa-ban fa-2x"></i><br>Commissions
                                    </div>
                                </div>
                             </a>
                        </div>

                        <div class="card">   
                            <a href="#" >                           
                                <div class="card-body text-center">
                                    <div class="card-text">
                                        <i class="fa fa-ban fa-2x"></i><br>Shareholders
                                    </div>
                                </div>
                             </a>
                        </div>
                        <div class="card">   
                            <a href="#" >                           
                                <div class="card-body text-center">
                                    <div class="card-text">
                                        <i class="fa fa-ban fa-2x"></i><br>Cash Flow
                                    </div>
                                </div>
                             </a>
                        </div>
                    </div>
                    <div class="card-columns">                            
                        <div class="card">   
                            <a href="{{route('home')}}" >                           
                                <div class="card-body text-center">
                                    <div class="card-text">
                                        <i class="fa fa-user fa-2x"></i><br>Expenses
                                    </div>
                                </div>
                             </a>
                        </div>
                        <div class="card">   
                            <a href="{{route('register')}}" >                           
                                <div class="card-body text-center">
                                    <div class="card-text">
                                        <i class="fa fa-user fa-2x"></i><br>Users
                                    </div>
                                </div>
                             </a>
                        </div>
                                                        
                    
                    </div>
                </div>

            </div>

            <div class="card">
               <div class="card-body">
                    
                    <div class="card-columns">
                        <div class="card">                            
                             
                                <div class="card-body text-center">
                                    <div class="card-text">
                                        <i class="fa fa-envelope fa-2x"></i><br> 10
                                    </div>
                                </div>
                            
                        </div>
                        
                        <div class="card"> 
                                                       
                                <div class="card-body text-center">
                                    <div class="card-text">
                                        <i class="fa fa-check fa-2x"></i><br>2
                                    </div>
                                </div>
                            
                        </div>
                        <div class="card">   
                                                      
                                <div class="card-body text-center">
                                    <div class="card-text">
                                        <i class="fa fa-ban fa-2x"></i><br>5
                                    </div>
                                </div>
                             
                        </div>
                    </div>
                    
                </div>

            </div>


        </div>

@endsection