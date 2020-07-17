@extends('layouts.management')
<style>
    .applications .card{
        background-color:#f7f6f0;
    }
</style>
@section('content')

<!--<div class="container">-->
<div class="col-md-12">
    <div class="card"> 
        <div class="card-header content-header">Loans</div>
            <div class="card" style="margin-top:5px;">
                <form method="POST" action="{{ route('loans.search') }}" class="form form-inline">
                    @csrf  
                    <select name="year" class="form-control">
                        @for($year=2020;$year<= date('Y');$year++)
                            <option value="{{$year}}">{{$year}}</option>
                        @endfor
                    </select> 
                    <select name="month" class="form-control">
                        <option value="--">All months</option>
                        <option value="01" <?php if($month=='01') echo "selected" ?> >January</option>
                        <option value="02" <?php if($month=='02') echo "selected" ?>>February</option>
                        <option value="03" <?php if($month=='03') echo "selected" ?>>March</option>
                        <option value="04" <?php if($month=='04') echo "selected" ?>>April</option>
                        <option value="05" <?php if($month=='05') echo "selected" ?>>May</option>
                        <option value="06" <?php if($month=='06') echo "selected" ?>>June</option>
                        <option value="07" <?php if($month=='07') echo "selected" ?>>July</option>
                        <option value="08" <?php if($month=='08') echo "selected" ?>>August</option>
                        <option value="09" <?php if($month=='09') echo "selected" ?>>September</option>
                        <option value="10" <?php if($month=='10') echo "selected" ?>>October</option>
                        <option value="11" <?php if($month=='11') echo "selected" ?>>November</option>
                        <option value="12" <?php if($month=='12') echo "selected" ?>>December</option>
                    </select>             
                    <input type="text" name="search" class="form-control" placeholder="Search by name, loan ID">        
                    <!--
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
                    -->
                    <input type="submit" value="Search" class="btn btn-primary">

                </form>
            </div>
            <div class="table-responsive">
                <table class="table  table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Client</th>
                            <th>Date Applied</th>
                            <th>Loan Type</th>
                            <th>Amount</th>
                            <th>Interest</th>
                            <th>Balance</th>
                            <th>Due Date</th>
                            <th>Date Processed</th>
                            <th>Processed BY</th>
                            <th>Date Authorized</th>
                            <th>Authorized By</th>
                            <th>Days to Due</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $count = 1;?>
                    @foreach($rows as $row)
                    <tr>
                        <td><a href="{{route('loans.show',['loan'=>$row->id])}}">{{$count++}}</a></td>
                        <td>{{$row->owner->surname." ".$row->owner->firstname}}</td>
                        <td>{{$row->date_applied->format('d M Y')}}</td>
                        <td>{{$row->type->name}}</td>
                        <td>{{$row->formatted_amount}}</td>
                        <td>{{$row->formatted_interest}}</td>
                        <td>{{$row->formatted_balance}}</td>
                        <td>{{$row->due_date->format('d M Y')}}</td>
                        <td>{{$row->date_processed->format('d M Y')}}</td>
                        <td>{{$row->processor->name}}</td>
                        <td>{{$row->date_authorized->format('d M Y')}}</td>
                        <td>{{$row->authorizer->name}}</td>
                        <td>
                            <?php 
                                //Reference: https://stackoverflow.com/questions/52884922/laravel-display-difference-between-two-dates-in-blade/52885035

                                $days = round((strtotime($row->due_date) - time()) / 86400);
                                if($days>0)
                                    echo $days;
                                else if($row->balance>0)
                                    echo "Past due";
                                else
                                    echo "--";
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


