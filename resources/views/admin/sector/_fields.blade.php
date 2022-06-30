<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {{ Form::label('product_name', 'City') }}
    <select name="city" class="form-control border-input">
        <option value="">--Select City--</option>
        @foreach($city as $cit)
            <option {{@$sector->city==@$cit->id ? 'selected':''}} value="{{$cit->id}}">{{$cit->name}}</option>
        @endforeach
    </select>
    <span class="text-danger">{{ $errors->has('city') ? $errors->first('city') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {{ Form::label('product_name', 'Sector Name') }}
    {{ Form::text('name',@$sector->name,['class'=>'form-control border-input','placeholder'=>'Macbook pro']) }}
    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
</div>