@extends('layouts.management')
<style>
    .applications .card{
        background-color:#f7f6f0;
    }
    .number{
        text-align:right;
    }
</style>
@section('content')
<div class="col-md-12">
    <div class="card"> 
        <div class="card-header content-header">Commissions</div>
        <div>
            <a href="{{route('home')}}">
                <i class="fa fa-arrow-left"></i>Back
            </a>
            | <a href="{{route('clients.create')}}"> <i class="fa fa-plus"></i>New Client</a>
        </div>
                    <div class="card">
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                    </div>
                    
                    <div class="card">
                        <form method="POST" action="{{ route('commissions.search') }}" class="form form-inline">
                            @csrf  
                            <select name="year" class="form-control">
                                @for($yr=2020;$yr<= date('Y');$yr++)
                                    <option value="{{$yr}}" <?php if($year==$yr) echo "selected" ?>>{{$yr}}</option>
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
                           
                            <select name="agent" class="form-control">
                                <option value="--">All agents</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" <?php if($agent==$user->id) echo "selected" ?>>{{$user->name}}</option>
                                @endforeach
                            </select>

                            <select name="has_qualified" class="form-control">
                                <option value="">Qualified|Not Qualified</option>
                                <option value="1" <?php if($has_qualified=='1') echo "selected" ?> >Qualified</option>
                                <option value="0" <?php if($has_qualified=='0') echo "selected" ?>>Not Qualified</option>
                            </select>

                            <select name="is_paid" class="form-control">
                                <option value="">Paid|Not Paid</option>
                                <option value="1" <?php if($is_paid=='1') echo "selected" ?> >Paid</option>
                                <option value="0" <?php if($is_paid=='0') echo "selected" ?>>Not Paid</option>
                            </select>

                            
                            <input type="submit" value="Search" class="btn btn-primary">

                        </form>
                        
                    </div>
                        
                        <div class="card">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Agent</th>
                                        <th>Client</th>
                                        <th class="number">Loan Amount</th>
                                        <th class="number"> Interest</th>
                                        <th class="number">Commission</th>
                                        <th>Has Qualified</th>
                                        <th>Is Paid</th>
                                        <th>Date Paid</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1;?>
                                <?php $total_comm = 0;?>
                                @foreach($rows as $row)
                                <tr>
                                    <td>{{$count++}}</td>
                                    <td>{{$row->user->name}}</td>
                                    <td>{{$row->comm_loan->owner->surname . " " . $row->comm_loan->owner->firstname}}</td>
                                    <td class="number">{{number_format($row->comm_loan->amount, 2)}}</td>
                                    <td class="number">{{number_format($row->comm_loan->interest,2)}}</td>
                                    <td class="number">{{number_format($row->commission,2)}}</td>
                                    
                                    <td>
                                        <?php if($row->has_qualified) 
                                                echo "YES";
                                             else 
                                                echo ""; 
                                        ?>
                                    </td>
                                    <td>
                                        <?php if($row->is_paid) 
                                                echo "YES";
                                             else 
                                                echo ""; 
                                        ?>
                                    </td>
                                    <td>{{$row->date_paid}}</td>
                                    @if($row->has_qualified && !$row->is_paid)
                                        <td><a href="{{route('commissions.pay.create',['id'=>$row->id])}}">Pay</a></td>
                                    @else
                                        <td> </td>
                                    @endif
                                </tr>
                                    <?php $total_comm = $total_comm + $row->commission;?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card" style="font-size:18px;font-weight:bold;">
                        Total Commission is MWK {{number_format($total_comm,2)}}
                    </div>

                </div>
        </div>
@endsection