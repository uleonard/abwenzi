@extends('layouts.management')
<style>
    .applications .card{
        background-color:#f7f6f0;
    }
</style>
@section('content')

<!--<div class="container">-->
    
        <h3>Loans: {{$year}} - {{$month}}</h3>
        <div class="card">
            <form method="POST" action="{{ route('loans.search') }}" class="form form-inline">
                @csrf  
                <select name="year" class="form-control">
                    @for($year=2020;$year<= date('Y');$year++)
                        <option value="{{$year}}">{{$year}}</option>
                    @endfor
                </select> 
                <select name="month" class="form-control">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>             
                <input type="text" name="search" class="form-control" placeholder="Search by name, loan ID">        
                
                <select name="processed_by" class="form-control">
                    <option value="--">----Processed By----</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>

                <select name="authorized_by" class="form-control">
                    <option value="--">----Authorized By----</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
                
                <input type="submit" value="Search" class="btn btn-primary">

            </form>
        </div>
        <div class="table-responsive">
            <table class="table  table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>SN</th>
                        <th>CLIENT</th>
                        <th>DATE APPLIED</th>
                        <th>LOAN TYPE</th>
                        <th>AMOUNT</th>
                        <th>INTEREST</th>
                        <th>BALANCE</th>
                        <th>DUE DATE</th>
                        <th>DATE PROCESSED</th>
                        <th>PROCESSED BY</th>
                        <th>DATE AUTHORIZED</th>
                        <th>AUTHORIZED BY</th>
                        <th>DAYS TO DUE</th>
                    </tr>
                </thead>
                <tbody>
                <?php $count = 1;?>
                @foreach($rows as $row)
                <tr>
                    <td><a href="{{route('loans.show',['loan'=>$row->id])}}">{{$count++}}</a></td>
                    <td>{{$row->owner->firstname}}</td>
                    <td>{{$row->date_applied}}</td>
                    <td>{{$row->type->name}}</td>
                    <td>{{$row->amount}}</td>
                    <td>{{$row->interest}}</td>
                    <td>{{$row->balance}}</td>
                    <td>{{$row->due_date}}</td>
                    <td>{{$row->date_processed}}</td>
                    <td>{{$row->processor->name}}</td>
                    <td>{{$row->date_authorized}}</td>
                    <td>{{$row->authorizer->name}}</td>
                    <td>
                        <?php 
                            //Reference: https://stackoverflow.com/questions/52884922/laravel-display-difference-between-two-dates-in-blade/52885035

                            $days = round((strtotime($row->due_date) - time()) / 86400);
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

<!--</div>-->

@endsection


