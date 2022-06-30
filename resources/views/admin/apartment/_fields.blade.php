<div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
    {{ Form::label('product_name', 'City') }}
    <select name="city" id="city" class="form-control border-input">
        <option value="">--Select City--</option>
        @foreach($city as $cit)
            <option {{$apartment->city==$cit->id ? 'selected':''}} value="{{$cit->id}}">{{$cit->name}}</option>
        @endforeach
    </select>
    <span class="text-danger">{{ $errors->has('city') ? $errors->first('city') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('sector') ? 'has-error' : '' }}">
    {{ Form::label('product_name', 'Sector') }}
    <select name="sector" id="sector" class="form-control border-input">
        <option value="">--Select Sector--</option>
    </select>
    <span class="text-danger">{{ $errors->has('sector') ? $errors->first('sector') : '' }}</span>
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {{ Form::label('product_name', 'Apartment Name') }}
    {{ Form::text('name',$apartment->name,['class'=>'form-control border-input','placeholder'=>'Apartment']) }}
    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $("#city").change(function(){
        id = this.value;
        $('#sector').empty();

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        jQuery.ajax({
          url: "{{ url('/admin/apartment/get_sector') }}",
          method: 'post',
          data: {
             id: id,
             _token: CSRF_TOKEN,
          },
          success: function(result){
            // console.log(result);
            if(result.sector.length){
                result.sector.forEach(function(value, key, myArray) {
                    //console.log(value,key,myArray)
                    $('#sector').append($('<option>', { 
                        value: value.id,
                        text : value.name 
                    }));
                });
            }
        }});
    });

    $("#city").trigger("change");

</script>

@if($apartment->sector!="")
<script type="text/javascript">
    $('#sector').val({{$apartment->sector}}).change();
</script>
@endif