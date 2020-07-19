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
    
    
        <div class="col-md-12">
            <div class="card"> 
            <div class="card-header content-header">Expenses / Categories</div>
                    <div>
                        <a href="{{route('expenses.index')}}"><i class="fa fa-arrow-left"></i> Go to expenses</a> 
                        
                    </div>

                    <div class="card">
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                    </div>
                    
                    <div class="card">
                        <form method="POST" action="{{ route('expenses.categories.store') }}" class="form form-inline">
                            @csrf  
                            <input type="text" id="category" name="category" placeholder="Enter category here" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}">
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter description here" cols="30" rows="1">{{ old('description') }}</textarea>
                            
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <input type="submit" value="Save Category" class="btn btn-primary" style="margin-top:5px">

                        </form>
                        
                    </div>
                        
                        <div class="card">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1;?>
                                @foreach($rows as $row)
                                <tr>
                                    <td>{{$count++}}</td>
                                    <td>{{$row->category}}</td>
                                    <td>{{$row->description}}</td>
                                    <td>                                        
                                        <a data-toggle="modal" data-target="#modal-edit-{{$row->id}}" style="cursor:grab;">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit
                                            
                                        </a>
                                        
                                    </td>
                                    
                                </tr>                                    
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>   


                    <!----START OF MODAL PAGE---->
                    @foreach($rows as $row)
                            <div class="modal" id="modal-edit-{{$row->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Editing Category</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('expenses.categories.update',['id'=>$row->id]) }}" class="form">
                                                @csrf  
                                                <input type="text" id="category" name="category" placeholder="Enter category here" class="form-control @error('category') is-invalid @enderror" value="{{ $row->category }}">
                                                @error('category')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter description here" cols="30" rows="1">{{ $row->description }}</textarea>
                                                
                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <input type="submit" value="Save Category" class="btn btn-primary" style="margin-top:5px">

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
                    @endforeach
                    <!----END OF MODAL PAGE---->


                </div>
        </div>
@endsection