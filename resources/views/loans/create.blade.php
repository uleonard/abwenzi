<form class="card card-sm" method="post" action="{{route('loans.store')}}">
    @csrf
    <div class="card-body row no-gutters align-items-center">
        <div class="col-auto">
            <i class="fas fa-search h4 text-body"></i>
        </div>
        <!--end of col-->
        <div class="col">
            <input class="form-control form-control-lg form-control-borderless" 
            type="search" name="search"  value="{{ old('search') }}" 
            required autofocus
            placeholder="Search by application number | business name | owner name">
        </div>
        <!--end of col-->
        <div class="col-auto">
            <button class="btn btn-lg btn-primary" type="submit">Search</button>
        </div>
        <!--end of col-->
    </div>
</form>
