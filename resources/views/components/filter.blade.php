<div class="input-group mb-3 col-sm-4 col-md-6 col-lg-4">
    <select id="filter" name="filter" class="form-control select2" aria-describedby="btn-filter">
        {{ $slot }}
    </select>
    <div class="input-group-append">
        <button class="btn btn-primary" type="submit" id="button-filter">Filter</button>
    </div>
</div>
