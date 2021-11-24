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
            <button class="btn btn-primary btn-sm mt-2" type="submit"><i class="fe fe-sliders"></i> Filter</button>
        </div>
    </div>

    <input type="hidden" name="export" id="export" value="">

</form>