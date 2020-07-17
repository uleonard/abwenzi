@extends('layouts.management')
<style>
    .applications .card{
        background-color:#f7f6f0;
    }
</style>
@section('content')

<div class="col-md-12 container">
    <div class="card"> 
        <div class="card-header content-header">Clients / New Client</div>
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


                          

                    
                            <form method="POST" action="{{ route('clients.store') }}"   enctype="multipart/form-data">
                                @csrf

                                <div class="card" style="margin-left:20px;margin-right:20px;padding:20px;">
                    
                                    <h4 class="section-header">CLIENT DETAILS</h4>

                                        

                                        <div class="form-group row">
                                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Firstname') }}</label>

                                            <div class="col-md-6">
                                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname">

                                                @error('firstname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                                            <div class="col-md-6">
                                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname">

                                                @error('surname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="sex" class="col-md-4 col-form-label text-md-right">{{ __('Sex') }}</label>

                                            <div class="col-md-6">
                                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender" >
                                                    <option value="Female">Female</option>
                                                    <option value="Male">Male</option>
                                                </select>

                                                @error('gender')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of birth') }}</label>

                                            <div class="col-md-6">
                                                <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob" >

                                                @error('dob')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="id_type" class="col-md-4 col-form-label text-md-right">{{ __('ID Type') }}</label>

                                            <div class="col-md-6">                                                
                                                <select id="id_type" class="form-control @error('id_type') is-invalid @enderror" name="id_type" value="{{ old('id_type') }}" required autocomplete="id_type" >
                                                    <option value="1">National ID</option>
                                                    <option value="2">Passport</option>
                                                    <option value="3">Driver's Licence</option>
                                                    <option value="4">Employment ID</option>
                                                </select>

                                                @error('id_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="id_number" class="col-md-4 col-form-label text-md-right">{{ __('ID Number') }}</label>

                                            <div class="col-md-6">
                                                <input type="text" id="id_number" class="form-control @error('id_number') is-invalid @enderror" value="{{ old('id_number') }}" name="id_number" >
                        

                                                @error('id_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="physical_address" class="col-md-4 col-form-label text-md-right">{{ __('Physical Address') }}</label>

                                            <div class="col-md-6">
                                                <textarea id="physical_address" class="form-control @error('physical_address') is-invalid @enderror" 
                                                name="physical_address" >{{ old('physical_address') }}</textarea>

                                                @error('physical_address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone number') }}</label>

                                            <div class="col-md-6">
                                                <input type="tel" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" name="phone" required>
                        

                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="phone_other" class="col-md-4 col-form-label text-md-right">{{ __('Other phone number') }}</label>

                                            <div class="col-md-6">
                                                <input type="tel" id="phone_other" class="form-control @error('phone_other') is-invalid @enderror" value="{{ old('phone_other') }}" name="phone_other" placeholder="Optional">
                        

                                                @error('phone_other')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                            <div class="col-md-6">
                                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" >
                        

                                                @error('email')
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
                                            <button type="submit" class="btn btn-default">
                                                SAVE & NEXT
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
