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
            <div class="card-header content-header">Expenses</div>
                    <div>
                        <a href="{{route('expenses.categories.index')}}">Categories</a>
                        <a href="{{route('expenses.create')}}">New Expense</a>
                    </div>

                    <div class="card">
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                    </div>
                    
                    <div class="card">
                        <form method="POST" action="{{ route('expenses.search') }}" class="form form-inline">
                            @csrf  
                            <select name="year" class="form-control">
                                @for($yr=2020;$yr<= date('Y');$yr++)
                                    <option value="{{$yr}}" <?php if($year==$yr) echo "selected" ?>>{{$yr}}</option>
                                @endfor
                            </select> 
                            <select name="month" class="form-control">
                                <option value="--">All months</option>
                                <option value="01" <?php if($month=='01') echo "selected" ?> >January</option>
                                <option value="02" <?php if($month=='02') echo "selected" ?>>February</option>
                                <option value="03" <?php if($month=='03') echo "selected" ?>>March</option>
                                <option value="04" <?php if($month=='04') echo "selected" ?>>April</option>
                                <option value="05" <?php if($month=='05') echo "selected" ?>>May</option>
                                <option value="06" <?php if($month=='06') echo "selected" ?>>June</option>
                                <option value="07" <?php if($month=='07') echo "selected" ?>>July</option>
                                <option value="08" <?php if($month=='08') echo "selected" ?>>August</option>
                                <option value="09" <?php if($month=='09') echo "selected" ?>>September</option>
                                <option value="10" <?php if($month=='10') echo "selected" ?>>October</option>
                                <option value="11" <?php if($month=='11') echo "selected" ?>>November</option>
                                <option value="12" <?php if($month=='12') echo "selected" ?>>December</option>
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
                                        <th>Trans Date</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Entry</th>
                                        <th class="number">Amount</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 1;?>
                                <?php $total = 0;?>
                                @foreach($rows as $row)
                                <tr>
                                    <td><a href="{{route('cash.show',['cash'=>$row->id])}}">{{$count++}}</a></td>
                                    <td>{{$row->trans_date}}</td>
                                    <td>{{$row->expense_category->category}}</td>
                                    <td>{{$row->description}}</td>
                                    <td>{{$row->entry}}</td>
                                    <td class="number">
                                        <?php if($row->amount<0)
                                                echo "(".number_format(0-$row->amount,2).")";
                                            else
                                                echo number_format($row->amount, 2);
                                        ?>
                                    </td>
                                    
                                </tr>
                                    <?php $total = $total + $row->amount;?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card" style="font-size:18px;font-weight:bold;">
                        Total expenses for the selected period is MWK {{number_format($total,2)}}
                    </div>

                </div>
        </div>
@endsection