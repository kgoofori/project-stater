<form id="filter-form">
    <div class="row">
        <div class="col">
            <div class="input-group input-group-flush">
                <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fe fe-search"></i>
                </span>
                </div>
                <input class="form-control list-search" name="s" value="{{ request('s') }}" type="search" placeholder="Search keyword">
            </div>
        </div>
        <div class="col-auto">
            <div class="input-group input-group-flush">
                <input class="form-control list-search" data-toggle="flatpickr" name="from" type="date" placeholder="From Date">
            </div>
        </div>
        <div class="col-auto">
            <div class="input-group input-group-flush">
            <input class="form-control list-search" data-toggle="flatpickr" id="toDate" name="to" type="date" placeholder="To Date">
            </div>
        </div>
        @if (isset($users))
        <div class="col-auto">
            <select name="user" class="custom-select sm" data-toggle="select">
                <option {{ request('user') == 'any' ? 'selected' : ''}} value="any">Any</option>
                @foreach ($users as $user)
                    <option {{ request('user') == $user->id ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        @endif
        
        <div class="col-auto">
            <select name="status" class="custom-select sm">
                <option {{ request('status') == 'any' ? 'selected' : ''}} value="any">Any</option>
                <option {{ request('status') == 'PROCESSING' ? 'selected' : ''}} value="PROCESSING">PROCESSING</option>
                <option {{ request('status') == 'CONFIRMED' ? 'selected' : ''}} value="CONFIRMED">CONFIRMED</option>
                <option {{ request('status') == 'CANCELED' ? 'selected' : ''}} value="CANCELED">CANCELED</option>
                <option {{ request('status') == 'CLOSED' ? 'selected' : ''}} value="CLOSED">CLOSED</option>
                <option {{ request('status') == 'CHECKED_IN' ? 'selected' : ''}} value="CHECKED_IN">CHECKED IN</option>
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary btn-sm mt-2" type="submit"><i class="fe fe-sliders"></i> Filter</button>
        </div>
    </div>

    <input type="hidden" name="export" id="export" value="">

</form>