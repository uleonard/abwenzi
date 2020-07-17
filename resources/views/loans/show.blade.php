@extends('layouts.management')
<style>
    .applications .card{
        background-color:#f7f6f0;
    }
    .badge{
        background-color:#7c754e;
        color:#FFFFFF;
    }
    .details{
        background-color:#f7f6f0;
    }
</style>
@section('content')
<div class="col-md-12">
    <div class="card"> 
        <div class="card-header content-header">Loans / Loan Details / {{$row->owner->surname . " " . $row->owner->firstname}}</div>
            <div class="row justify-content-left">
                <div class="col-md-4 details">

                        <h3>Loan Details</h3>

                        <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Client Name
                            <span class="badge  badge-pill">{{$row->owner->firstname. " ".$row->owner->surname}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Client ID
                            <span class="badge badge-pill">{{$row->owner->id}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Loan Type
                            <span class="badge  badge-pill">{{$row->type->name}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Date Applied
                            <span class="badge  badge-pill">{{$row->date_applied->format('d M Y')}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Date Processed
                            <span class="badge  badge-pill">{{$row->date_processed->format('d M Y')}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Processed By
                            <span class="badge  badge-pill">{{$row->processor->name}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Date Authorized
                            <span class="badge  badge-pill">{{$row->date_authorized->format('d M Y')}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Authorized By
                            <span class="badge  badge-pill">{{$row->authorizer->name}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Amount
                            <span class="badge  badge-pill">{{$row->formatted_amount}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Interest
                            <span class="badge  badge-pill">{{$row->formatted_interest}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Balance
                            <span class="badge badge-pill">{{$row->formatted_balance}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Repayment Due
                            <span class="badge  badge-pill">{{$row->due_date->format('d M Y')}}</span>
                        </li>
                    </ul>

                    <h3>Attachments</h3>
                    <ul class="list-group">
                        @foreach($row->attachments as $attachment)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{$attachment->name}}
                            <span class="badge  badge-pill">
                               <a href="{{asset('storage/loans/'.$attachment->attachment)}}" target="_blank"> View or Download</a>
                            </span>
                        </li>
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a id="upload" onclick="displayAttachmentForm()" style="color:blue;cursor:grab;">Upload attachment</a>
                            <div id="attachments" style="display:none;">
                                <form enctype="multipart/form-data" method="POST" action="{{ route('loans.attachments.store') }}" class="form">
                                    @csrf  
                                    <input type="hidden" name="loan" value="{{$row->id}}">
                                    <select name="name" id="name" class="form-control" required>
                                        <option value="Collateral">Collateral</option>
                                        <option value="Client ID">Client ID</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <input type="file" class="form-control" name="attachment" required>
                                    <input type="submit" class="btn btn-primary" value="UPLOAD">
                                </form>
                            </div>             
                        </li>
                    </ul>

                    </div>
                    <div class="col-md-8 details">

                        <h3>Repayments Made</h3>

                    
                        <?php $balance = $row->amount + $row->interest; ?>
                        @foreach ($row->repayments as $repayment)
                            <?php $balance = $balance - $repayment->amount; ?>
                            <div class="card bg-light text-dark" style="margin-top:10px;">
                                <div class="card-body">
                                    The loan repayment of <strong>MWK{{number_format($repayment->amount,2)}}</strong> was made on <strong>{{$repayment->date_paid->format('d M Y')}}</strong> for 
                                    the loan obtained on <strong>{{$row->date_authorized->format('d M Y')}}</strong>
                                    amounting to <strong>MWK{{number_format($row->amount,2)}}</strong>. The remaining balance is <strong>MWK{{number_format($balance,2)}}</strong> payable not later than
                                    <strong>{{ $row->due_date->format('d M Y') }}</strong>

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
    </div>
</div>

<script>
    function displayAttachmentForm() {
    document.getElementById("attachments").style.display = "block";
    document.getElementById("upload").style.display = "none";
    }
</script>

@endsection


