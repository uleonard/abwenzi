@extends('layouts.management')
<style>
    .applications .card{
        background-color:#f7f6f0;
    }
</style>
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header content-header">Loan Application Form</div>

                <div class="card-body">


                          

                    
                            <form method="POST" action="{{ route('loans.store') }}"   enctype="multipart/form-data">
                                @csrf

                                <div class="card" style="margin-left:20px;margin-right:20px;padding:20px;">
                    
                                    <h4 class="section-header">CLIENT DETAILS</h4>

                                        <div class="form-group row">
                                            <label for="business_name" class="col-md-4 col-form-label text-md-right">{{ __('Type of Loan') }}</label>

                                            <div class="col-md-6">
                                                <select class="form-control">
                                                    <option value="1">MTHANDIZI</option>
                                                    <option value="2">MSAMALA</option>
                                                    <option value="3">MAZIKO</option>
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
                                                <input id="date_applied" type="text" class="form-control @error('date_applied') is-invalid @enderror" name="date_applied" value="{{ old('date_applied') }}" required autocomplete="date_applied" >

                                                @error('date_applied')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="collateral" class="col-md-4 col-form-label text-md-right">{{ __('ID Type') }}</label>

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
                                            <label for="id_attachment" class="col-md-4 col-form-label text-md-right">{{ __('Attach ID document') }}</label>

                                            <div class="col-md-6">
                                                <input id="id_attachment" type="file" class="form-control @error('id_attachment') is-invalid @enderror" name="id_attachment" value="{{ old('id_attachment') }}" autocomplete="id_attachment" >

                                                @error('id_attachment')
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
                                            <button type="submit" class="btn btn-primary">
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
