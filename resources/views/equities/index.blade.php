@extends('layouts.management')
<style>
    .applications .card{
        background-color:#f7f6f0;
    }
    .number{
        text-align:right;
    }
    .form-control,.btn{
        margin-top:10px;
        //border-color: 1px solid #dec32a;
    }
</style>
@section('content')
    
    
        <div class="col-md-12">
            <div class="card"> 
            <div class="card-header content-header">Shareholders / Equuity & Savings</div>
                    <div>
                    <a href="{{route('shareholders.index')}}">
                        <i class="fa fa-arrow-left"></i>Go back
                    </a>
                    
                    </div>

                    <div class="card">
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                    </div>
                    
                    <div class="card">
                        <form method="POST" action="{{ route('equities.search') }}" class="form form-inline">
                            @csrf  
                            <select class="form-control" name="type">
                                <option value="EQUITY">Equity</option>
                                <option value="SAVINGS">Savings</option>
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
                                        <th>Shareholder</th>
                                        <th>Trans Date</th>
                                        <th>Entry</th>
                                        <th>Comment</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1;?>
                                @foreach($rows as $row)
                                <tr>
                                    <td>{{$count++}}</td>
                                    <td>{{$row->owned_by->surname . " " . $row->owned_by->firstname}}</td>
                                    <td>{{$row->trans_date}}</td>
                                    <td>{{$row->entry}}</td>
                                    <td>{{$row->comment}}</td>
                                    <td>
                                        <?php 
                                            if($row->amount < 0)
                                                echo "(".number_format(0 - $row->amount,2).")";
                                            else
                                            echo number_format($row->amount,2);
                                        ?>
                                    </td>
                                    <td> <a href="{{route('equities.destroy')}}"><i class="fa fa-minus"></i>Void</a></td>                                    
                                </tr>
                                   
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>



                    
                    <!----START OF MODAL PAGE---->
                   
                            <div class="modal" id="modal-create">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Create shareholder</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('shareholders.store') }}" class="form">
                                                @csrf  
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

                                                <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror">
                                                    <option value="Female">Female</option>
                                                    <option value="Male">Male</option>
                                                </select>
                                                @error('gender')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <input type="phone" id="phone" name="phone" placeholder="Enter phone here" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone')}}">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <input type="email" id="email" name="email" placeholder="Enter email here" class="form-control @error('email') is-invalid @enderror" value="{{ old('email')}}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                

                                                <input type="submit" value="Create Shareholder" class="btn btn-primary" style="margin-top:5px">

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




                </div>
        </div>
@endsection