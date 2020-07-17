@extends('layouts.management')
<style>
    .applications .card{
        background-color:#f7f6f0;
    }
</style>
@section('content')

<div class="col-md-12 container">
    <div class="card"> 
        <div class="card-header content-header">Loans / New Loan</div>
        <div>
            <a href="{{route('clients.index')}}">
                <i class="fa fa-arrow-left"></i>Back
            </a>
        </div>
    </div>
</div>
          

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-body">


                            <div class="card" style="margin:20px;margin-top:0px;padding:20px;">
                                
                                <h4 class="section-header">CLIENT DETAILS</h4>
                                    <span><strong>Client Name</strong>   : {{$row->firstname}} {{$row->surname}}</span>
                                    <span><strong>Client Number</strong> : {{$row->id}}</span>
                                    


                            <!---end of card-->
                            </div>

                    
                            <form method="POST" action="{{ route('loans.store') }}"   enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="client" value="{{$row->id}}">

                                <div class="card" style="margin-left:20px;margin-right:20px;padding:20px;">
                    
                                    <h4 class="section-header">LOAN DETAILS</h4>

                                        <div class="form-group row">
                                            <label for="loan_type" class="col-md-4 col-form-label text-md-right">{{ __('Type of Loan') }}</label>

                                            <div class="col-md-6">
                                                <select class="form-control" name="loan_type">
                                                    @foreach($loan_types as $type)
                                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                                    @endforeach
                                                </select>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                                            <div class="col-md-6">
                                                <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount">

                                                @error('amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="source_of_funds" class="col-md-4 col-form-label text-md-right">{{ __('Source of Funds') }}</label>

                                            <div class="col-md-6">
                                                <input id="source_of_funds" type="text" class="form-control @error('source_of_funds') is-invalid @enderror" name="source_of_funds" value="{{ old('source_of_funds') }}" required autocomplete="source_of_funds" >

                                                @error('source_of_funds')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="date_applied" class="col-md-4 col-form-label text-md-right">{{ __('Date of application') }}</label>

                                            <div class="col-md-6">
                                                <input id="date_applied" type="date" class="form-control @error('date_applied') is-invalid @enderror" name="date_applied" value="{{ old('date_applied') }}" required autocomplete="date_applied" >

                                                @error('date_applied')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="collateral" class="col-md-4 col-form-label text-md-right">{{ __('Collateral') }}</label>

                                            <div class="col-md-6">
                                                <input type="text" id="collateral" class="form-control @error('collateral') is-invalid @enderror" value="{{ old('collateral') }}" name="collateral" >
                        

                                                @error('collateral')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="collateral_attachment" class="col-md-4 col-form-label text-md-right">{{ __('Attach Collateral document') }}</label>

                                            <div class="col-md-6">
                                                <input id="collateral_attachment" type="file" class="form-control @error('collateral_attachment') is-invalid @enderror" name="collateral_attachment" value="{{ old('collateral_attachment') }}" autocomplete="collateral_attachment" >

                                                @error('collateral_attachment')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    



                                    <!-- END OF INNER CARD-->
                                </div>

                            
                                <div class="card" style="margin-left:20px;margin-right:20px;padding:20px;">
                    
                                    <h4 class="section-header">OFFICIAL USE</h4>

                                        <div class="form-group row">
                                            <label for="processed_by" class="col-md-4 col-form-label text-md-right">{{ __('Processed By') }}</label>

                                            <div class="col-md-6">
                                                <select class="form-control" name="processed_by">
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                                
                                            </div>
                                        </div>

                                                                                <div class="form-group row">
                                            <label for="date_processed" class="col-md-4 col-form-label text-md-right">{{ __('Date Processed') }}</label>

                                            <div class="col-md-6">
                                                <input id="date_processed" type="date" class="form-control @error('date_processed') is-invalid @enderror" name="date_processed" value="{{ old('date_processed') }}" required autocomplete="date_processed" >

                                                @error('date_processed')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="authorized_by" class="col-md-4 col-form-label text-md-right">{{ __('Authorizedd By') }}</label>

                                            <div class="col-md-6">
                                                <select class="form-control" name="authorized_by">
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                                
                                            </div>
                                        </div>

                                                                                <div class="form-group row">
                                            <label for="date_authorized" class="col-md-4 col-form-label text-md-right">{{ __('Date Authorized') }}</label>

                                            <div class="col-md-6">
                                                <input id="date_authorized" type="date" class="form-control @error('date_authorized') is-invalid @enderror" name="date_authorized" value="{{ old('date_authorized') }}" required autocomplete="date_authorized" >

                                                @error('date_authorized')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>


                                    <!-- END OF INNER CARD-->
                                </div>

                                
                                <div class="card" style="margin:20px;padding:20px;">
                    
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-default">
                                                SAVE LOAN APPLICATION
                                            </button>
                                        </div>
                                    </div>

                                <!---end of card-->
                                </div>
                                   
                                
                            </form>
                        </div>
            </div>
        </div>
    </div>
</div>


@endsection
