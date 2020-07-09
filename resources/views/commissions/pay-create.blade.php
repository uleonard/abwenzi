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
    <div class="card-header content-header">Commissions : Pay</div>
    <div class="row">                

                <div class="col-md-12">
                    <div class="card" style="font-size:16px;font-weight:bold;">
                        You are about to make commission payment of MWK {{number_format($row->commission,2)}}
                        for agent {{$row->user->name}}, on interest realized from client {{$row->comm_loan->owner->firstname . " " .$row->comm_loan->owner->surname}}
                    </div>

                    <div class="card">
                        <form method="POST" action="{{ route('commissions.pay.store') }}" class="form form-inline">
                            @csrf  
                            <input type="hidden" name="commission" value="{{$row->id}}">
                            <select name="payment_method" class="form-control">
                                <option value="">Payment Method</option>
                                <option value="Cash" >Cash</option>
                                <option value="Bank" >Bank</option>
                                <option value="Bank" >Mobile Wallet</option>
                            </select>             
                           
                            <input type="date" name="trans_date" class="form-control" >
                             
                            <input type="submit" value="Save Payment" class="btn btn-primary">

                        </form>
                        
                    </div>
                       
                    

                </div>
        </div>
@endsection