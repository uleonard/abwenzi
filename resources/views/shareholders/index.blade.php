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
                <div class="card-header content-header">Shareholders</div>
                    <div>
                    <a href="#" data-toggle="modal" data-target="#modal-create" style="cursor:grab;">
                        <i class="fa fa-plus"></i>New Shareholder
                    </a>

                    <a href="{{route('equities.index')}}">
                        <i class="fa fa-reorder"></i>Equity & Savings
                    </a>
                    </div>

                    <div class="card">
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                    </div>
                    
                    <div class="card">
                        <form method="POST" action="{{ route('shareholders.search') }}" class="form form-inline">
                            @csrf  
                            <input type="text" class="form-control" name="search" placeholder="Search by name">
                            <input type="submit" value="Search" class="btn btn-primary">

                        </form>
                        
                    </div>
                        
                        <div class="card">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Surname</th>
                                        <th>Firstname</th>
                                        <th>Gender</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Equity</th>
                                        <th>Savings</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1;?>
                                @foreach($rows as $row)
                                <tr>
                                    <td><a href="{{route('shareholders.show',['id'=>$row->id])}}">{{$count++}}</a></td>
                                    <td>{{$row->surname}}</td>
                                    <td>{{$row->firstname}}</td>
                                    <td>{{$row->gender}}</td>
                                    <td>{{$row->phone}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>
                                        @php $total = 0; @endphp
                                        @foreach($row->equities as $equity)
                                            @php $total = $total + $equity->amount; @endphp
                                        @endforeach
                                        @php echo number_format($total,2) @endphp
                                    </td>
                                    <td>
                                        @php $total = 0; @endphp
                                            @foreach($row->savings as $saving)
                                                @php $total = $total + $saving->amount; @endphp
                                            @endforeach
                                        @php echo number_format($total,2) @endphp
                                    </td>
                                    <td> <a href="{{route('shareholders.edit')}}"></a>Edit</td>
                                    
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