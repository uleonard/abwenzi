@extends('layouts.management')
<style>
    .applications .card{
        background-color:#f7f6f0;
    }
    .number{
        text-align:right;
    }
    .sections{
        padding:10px;
        margin-top:10px;
        
    }
    span{
        font-weight:bold;
        font-size:16px;
        color:#dec32a;
    }
    .total-line{
        font-weight:bold;
        font-size:16px;
        color:#dec32a; 
    }
</style>
@section('content')
    
    
        <div class="col-md-12">
            <div class="card"> 
                <div class="card-header content-header">Shareholders / Profile</div>
                    <div>
                        <a href="{{route('shareholders.index')}}">
                            <i class="fa fa-arrow-left"></i>Back
                        </a>
                    </div>


                    <div class="card">
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                    </div>

                    <div>
                        <span>Surname</span>: {{$row->surname}} | 
                        <span>Firstname</span>: {{$row->firstname}} | 
                        <span>Firstname</span>: {{$row->firstname}} | 
                        <span>Gender</span>: {{$row->gender}} | 
                        <span>Phone</span>: {{$row->phone}} | 
                        <span>Email</span>: {{$row->email}} | 
                    </div>
                   
                    <div class="row">
                        <div class="col-md-4">
                             <div class="card sections">
                                <h3>Equity</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Trans Date</th>
                                                <th>Entry</th>
                                                <th>Amount</th>
                                                <th>Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = 0;?>
                                            @foreach($row->equities as $equity)
                                            <tr>
                                                <td>{{$equity->trans_date}}</td>
                                                <td>{{$equity->entry}}</td>
                                                <td>{{$equity->amount}}</td>
                                                <td>{{$equity->comment}}</td>
                                            </tr>
                                            <?php $total = $total + $equity->amount;?>
                                            @endforeach
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="total-line">
                                The total equity is MWK {{number_format($total,2)}}
                            </div>
                            <div>
                                <a href="#" data-toggle="modal" data-target="#modal-create-equity" style="cursor:grab;">
                                    <i class="fa fa-plus"></i>Add Equity
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card sections">
                                <h3>Savings</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Trans Date</th>
                                                <th>Entry</th>
                                                <th>Amount</th>
                                                <th>Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $total = 0;?>
                                            @foreach($row->savings as $saving)
                                            <tr>
                                                <td>{{$saving->trans_date}}</td>
                                                <td>{{$saving->entry}}</td>
                                                <td>{{$saving->amount}}</td>
                                                <td>{{$saving->comment}}</td>
                                            </tr>
                                            <?php $total = $total + $saving->amount;?>
                                            @endforeach
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="total-line">
                                The total savings is MWK {{number_format($total,2)}}
                            </div>
                            <div>
                                <a href="#" data-toggle="modal" data-target="#modal-create-savings" style="cursor:grab;">
                                    <i class="fa fa-plus"></i>Add Savings
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card sections">
                                <h3>Beneficiaries</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Surname</th>
                                                <th>Firstname</th>
                                                <th>dob</th>
                                                <th>Relationship</th>
                                                <th>Percent</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($row->beneficiaries as $ben)
                                            <tr>
                                                <td>{{$ben->surname}}</td>
                                                <td>{{$ben->firstname}}</td>
                                                <td>{{$ben->dob}}</td>
                                                <td>{{$ben->relationship}}</td>
                                                <td>{{$ben->percent}}</td>
                                            </tr>
                                            @endforeach
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div>
                                <a href="#" data-toggle="modal" data-target="#modal-create" style="cursor:grab;">
                                    <i class="fa fa-plus"></i>Create Beneficiary
                                </a>
                            </div>
                        </div>
                    </div>


                    <!----START OF MODAL PAGE---->
                   
                    <div class="modal" id="modal-create">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Create Beneficiary</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('beneficiaries.store') }}" class="form">
                                                @csrf  
                                                <input type="hidden" name="shareholder" value="{{$row->id}}">
                                                <input type="text" id="firstname" name="firstname" placeholder="Enter firstname here" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname')}}">
                                                @error('firstname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <input type="text" id="surname" name="surname" placeholder="Enter surname here" class="form-control @error('surname') is-invalid @enderror" value="{{ old('surname')}}">
                                                @error('surname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <input type="date" id="dob" name="dob" placeholder="Enter DOB here" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob')}}">
                                                @error('dob')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <input type="text" id="relationship" name="relationship" placeholder="Enter relationship here" class="form-control @error('relationship') is-invalid @enderror" value="{{ old('relationship')}}">
                                                @error('relationship')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <input type="text" id="percent" name="percent" placeholder="Enter percent here" class="form-control @error('percent') is-invalid @enderror" value="{{ old('percent')}}">
                                                @error('percent')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                

                                                <input type="submit" value="Create Beneficiary" class="btn btn-primary" style="margin-top:5px">

                                            </form>



                                        </div>
                                        
                                        <!-- Modal footer 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                         -->
                                    </div>
                                </div>
                            </div>
                   
                    <!----END OF MODAL PAGE---->



                    
                    <!----START OF EQUITY MODAL PAGE---->
                   
                    <div class="modal" id="modal-create-equity">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Equity</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                        
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('equities.store') }}" class="form">
                                        @csrf  
                                        <input type="hidden" name="shareholder" value="{{$row->id}}">
                                        <input type="date" id="trans_date" name="trans_date" placeholder="Enter date here" class="form-control @error('trans_date') is-invalid @enderror" value="{{ old('trans_date')}}">
                                        @error('trans_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <select id="entry" name="entry" class="form-control @error('entry') is-invalid @enderror" value="{{ old('entry')}}">
                                            <option value="DEPOSIT">Deposit</option>
                                            <option value="WITHDRAW">Withdraw</option>
                                        </select>
                                        @error('entry')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <input type="text" id="amount" name="amount" placeholder="Enter amount here" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount')}}">
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        
                                        <textarea id="comment" name="comment" cols="30" rows="1"placeholder="Enter comment here" class="form-control @error('comment') is-invalid @enderror">{{ old('comment')}}</textarea>
                                        @error('comment')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <input type="submit" value="Save Equity" class="btn btn-primary" style="margin-top:5px">

                                    </form>



                                </div>
                                
                                <!-- Modal footer 
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                    -->
                            </div>
                        </div>
                    </div>
                   
                    <!----END OF EQUITY MODAL PAGE---->


                    <!----START OF SAVINGS PAGE---->
                   
                    <div class="modal" id="modal-create-savings">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Equity</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                        
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('savings.store') }}" class="form">
                                        @csrf  
                                        <input type="hidden" name="shareholder" value="{{$row->id}}">
                                        <input type="date" id="trans_date" name="trans_date" placeholder="Enter date here" class="form-control @error('trans_date') is-invalid @enderror" value="{{ old('trans_date')}}">
                                        @error('trans_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <select id="entry" name="entry" class="form-control @error('entry') is-invalid @enderror" value="{{ old('entry')}}">
                                            <option value="">Select transaction type</option>
                                            <option value="DEPOSIT">Deposit</option>
                                            <option value="WITHDRAW">Withdraw</option>
                                        </select>
                                        @error('entry')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <input type="text" id="amount" name="amount" placeholder="Enter amount here" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount')}}">
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        
                                        <textarea id="comment" name="comment" cols="30" rows="1"placeholder="Enter comment here" class="form-control @error('comment') is-invalid @enderror">{{ old('comment')}}</textarea>
                                        @error('comment')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <input type="submit" value="Save Savings" class="btn btn-primary" style="margin-top:5px">

                                    </form>



                                </div>
                                
                                <!-- Modal footer 
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                    -->
                            </div>
                        </div>
                    </div>
                   
                    <!----END OF SAVINGS MODAL PAGE---->




                </div>
        </div>
@endsection