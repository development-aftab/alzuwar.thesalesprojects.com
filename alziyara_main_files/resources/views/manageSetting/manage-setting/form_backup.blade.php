<div class="form-group {{ $errors->has('product_category') ? 'has-error' : ''}}">
    <label for="product_category" class="col-md-4 control-label">{{ 'Product Category' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="product_category" type="number" id="product_category" value="{{ $managesetting->product_category??''}}" >
        {!! $errors->first('product_category', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('package_deals_type_id') ? 'has-error' : ''}}">
    <label for="package_deals_type_id" class="col-md-4 control-label">{{ 'Package Deals Type' }}</label>
    <div class="col-md-6">
        {{--<input class="form-control" name="package_deals_type_id" type="number" id="package_deals_type_id" value="{{ $managesetting->package_deals_type_id??''}}" >--}}
        <select class="form-control" name="package_deals_type_id" id="package_deals_type_id" required>
            @foreach($PackageDealType as $PackageDealTypes)
                <option value="{{$PackageDealTypes->id}}" >{{$PackageDealTypes->package_deals_type_desc??''}}</option>
            @endforeach
        </select>
        {!! $errors->first('package_deals_type_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('package_deals_name') ? 'has-error' : ''}}">
    <label for="package_deals_name" class="col-md-4 control-label">{{ 'Package Deals Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="package_deals_name" type="text" id="package_deals_name" value="{{ $managesetting->package_deals_name??''}}" >
        {!! $errors->first('package_deals_name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('package_deals_desc') ? 'has-error' : ''}}">
    <label for="package_deals_desc" class="col-md-4 control-label">{{ 'Package Deals Desc' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="package_deals_desc" type="text" id="package_deals_desc" value="{{ $managesetting->package_deals_desc??''}}" >
        {!! $errors->first('package_deals_desc', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('package_deals_itinerary') ? 'has-error' : ''}}">
    <label for="package_deals_itinerary" class="col-md-4 control-label">{{ 'Package Deals Itinerary' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="package_deals_itinerary" type="text" id="package_deals_itinerary" value="{{ $managesetting->package_deals_itinerary??''}}" >
        {!! $errors->first('package_deals_itinerary', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('package_deals_status') ? 'has-error' : ''}}">
    <label for="package_deals_status" class="col-md-4 control-label">{{ 'Package Deals Status' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="package_deals_status" type="text" id="package_deals_status" value="{{ $managesetting->package_deals_status??''}}" >
        {!! $errors->first('package_deals_status', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="col-md-4 control-label">{{ 'Price' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="price" type="text" id="price" value="{{ $managesetting->price??''}}" >
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('max_occupancy') ? 'has-error' : ''}}">
    <label for="max_occupancy" class="col-md-4 control-label">{{ 'Max Occupancy' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="max_occupancy" type="text" id="max_occupancy" value="{{ $managesetting->max_occupancy??''}}" >
        {!! $errors->first('max_occupancy', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('package_deals_time') ? 'has-error' : ''}}">
    <label for="package_deals_time" class="col-md-4 control-label">{{ 'Package Deals Time' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="package_deals_time" type="text" id="package_deals_time" value="{{ $managesetting->package_deals_time??''}}" >
        {!! $errors->first('package_deals_time', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('package_deals_location') ? 'has-error' : ''}}">
    <label for="package_deals_location" class="col-md-4 control-label">{{ 'Package Deals Location' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="package_deals_location" type="text" id="package_deals_location" value="{{ $managesetting->package_deals_location??''}}" >
        {!! $errors->first('package_deals_location', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('house_rules') ? 'has-error' : ''}}">
    <label for="house_rules" class="col-md-4 control-label">{{ 'House Rules' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="house_rules" type="text" id="house_rules" value="{{ $managesetting->house_rules??''}}" >
        {!! $errors->first('house_rules', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('display_on_home_page') ? 'has-error' : ''}}">
    <label for="display_on_home_page" class="col-md-4 control-label">{{ 'Display On Home Page' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="display_on_home_page" type="text" id="display_on_home_page" value="{{ $managesetting->display_on_home_page??''}}" >
        {!! $errors->first('display_on_home_page', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sort_order') ? 'has-error' : ''}}">
    <label for="sort_order" class="col-md-4 control-label">{{ 'Sort Order' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="sort_order" type="number" id="sort_order" value="{{ $managesetting->sort_order??''}}" >
        {!! $errors->first('sort_order', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('package_deals_create_by') ? 'has-error' : ''}}">
    <label for="package_deals_create_by" class="col-md-4 control-label">{{ 'Package Deals Create By' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="package_deals_create_by" type="text" id="package_deals_create_by" value="{{ $managesetting->package_deals_create_by??''}}" >
        {!! $errors->first('package_deals_create_by', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
