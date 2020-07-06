@extends('layouts.management')
<style>
    .applications .card{
        background-color:#f7f6f0;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-4">

                <h3>Loan Details</h3>

                <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Client Name
                    <span class="badge badge-primary badge-pill">{{$row->owner->firstname}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Client ID
                    <span class="badge badge-primary badge-pill">{{$row->owner->id}}</span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Loan Type
                    <span class="badge badge-primary badge-pill">{{$row->type->name}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Date Applied
                    <span class="badge badge-primary badge-pill">{{$row->date_applied}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Date Processed
                    <span class="badge badge-primary badge-pill">{{$row->date_processed}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Processed By
                    <span class="badge badge-primary badge-pill">{{$row->processor->name}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Date Authorized
                    <span class="badge badge-primary badge-pill">{{$row->date_authorized}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Authorized By
                    <span class="badge badge-primary badge-pill">{{$row->authorizer->name}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Amount
                    <span class="badge badge-primary badge-pill">{{$row->amount}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Interest
                    <span class="badge badge-primary badge-pill">{{$row->interest}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Balance
                    <span class="badge badge-primary badge-pill">{{$row->balance}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Repayment Due
                    <span class="badge badge-primary badge-pill">{{$row->due_date}}</span>
                </li>
            </ul>

            <h3>Attachments</h3>

            </div>
            <div class="col-md-8">

                <h3>Repayments Made</h3>

               
                <?php $balance = $row->amount + $row->interest; ?>
                @foreach ($row->repayments as $repayment)
                    <?php $balance = $balance - $repayment->amount; ?>
                    <div class="card bg-light text-dark" style="margin-top:10px;">
                        <div class="card-body">
                            The loan repayment of <strong>MWK{{$repayment->amount}}</strong> was made on <strong>{{$repayment->date_paid}}</strong> for 
                            the loan obtained on <strong>{{$row->date_authorized}}</strong>
                            amounting to <strong>MWK{{$row->amount}}</strong>. The remaining balance is <strong>MWK{{$balance}}</strong> payable not later than
                            <strong>{{$row->due_date}}</strong>

                        </div>
                    </div>
                    
                @endforeach

                @if($row->balance>0)

                    <div class="card bg-light text-dark" style="margin-top:10px;">
                        <div class="card-body">
                            <form method="post" action="{{route('repayments.store')}}" class="form form-inline">
                                @csrf
                                <input type="hidden" name="loan" value="{{$row->id}}">
                                
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Amount</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Amount" name="amount">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Date</span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="Payment Date"  name="date_paid">
                                    
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Receipt</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Receipt" name="receipt">
                                    
                                </div>
                                <div class="input-group mb-3">
                                    <button type="submit" class="btn btn-primary">SAVE</button>
                                </div>
                            </form>

                        </div>
                    </div>

                @endif

            </div>
        </div>
</div>

@endsection


