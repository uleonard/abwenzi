@extends('layouts.management')
<style>
    .applications .card{
        background-color:#f7f6f0;
    }
</style>
@section('content')
<div class="col-md-12">
    <div class="card"> 
        <div class="card-header content-header">Clients</div>
        <div>
            <a href="{{route('home')}}">
                <i class="fa fa-arrow-left"></i>Back
            </a>
            | <a href="{{route('clients.create')}}"> <i class="fa fa-plus"></i>New Client</a>
        </div>
                   <div class="card">

                        <div>
                            

                            <form method="POST" action="{{ route('clients.search') }}" class="form form-inline">
                                @csrf                                             
                                <input type="text" name="search" class="form-control" value="{{$search}}" placeholder="Search by name or ID">        
                                <input type="submit" value="Search" class="btn btn-primary">

                            </form>
                        
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>ID</th>
                                        <th>Surname</th>
                                        <th>Firstname</th>
                                        <th>Gender</th>
                                        <th>DOB</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1;?>
                                @foreach($rows as $row)
                                <tr>
                                    <td><a href="{{route('clients.show',['client'=>$row->id])}}">{{$count++}}</a></td>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->surname}}</td>
                                    <td>{{$row->firstname}}</td>
                                    <td>{{$row->gender}}</td>
                                    <td>{{$row->dob}}</td>
                                    <td>{{$row->physical_address}}</td>
                                    <td>{{$row->phone}} | {{$row->phone_other}}</td>
                                    <td>{{$row->email}}</td>
                                    <td><a href="{{route('loans.create',['id'=>$row->id])}}" 
                                            data-toggle="tooltip" data-placement="bottom" title="New loan">
                                            <i class="fa fa-plus"></i><i class="fa fa-dollar"></i> 
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
        </div>

        
        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();   
            });
        </script>
@endsection