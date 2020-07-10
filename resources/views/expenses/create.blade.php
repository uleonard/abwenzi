@extends('layouts.management')
<style>
    .applications .card{
        background-color:#f7f6f0;
    }
    .number{
        text-align:right;
    }
    .row .card{
        margin-top:20px;
        padding:20px;
    }
</style>
@section('content')
    <div class="card-header content-header">Expenses | New Expense</div>
    <div class="row">
                <div class="col-md-4"> </div>               

                <div class="col-md-4">
                    
                    
                    <div class="card">
                        <h4>Please enter expense details below </h4>
                        <form method="POST" action="{{ route('expenses.store') }}" class="form">
                            @csrf  
                            <select id="category" name="category" class="form-control @error('category') is-invalid @enderror" required>
                                <option value="">Select category here</option>
                                @foreach($rows as $category)
                                    <option value="{{$category->id}}">{{$category->category}}</option>
                                @endforeach
                            </select>

                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input type="date" id="trans_date" name="trans_date" class="form-control @error('trans_date') is-invalid @enderror" value="{{ old('trans_date') }}">

                            @error('trans_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter description here" cols="30" rows="2">{{ old('description') }}</textarea>
                            
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input type="text" id="amount" name="amount" placeholder="Enter amount here" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}">
                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input type="submit" value="Save Expense" class="btn btn-primary" style="margin-top:5px">


                        </form>
                        
                    </div>


                </div>
        </div>
@endsection