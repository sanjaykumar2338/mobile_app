@extends('admin.layouts.master')

@section('page')
    Edit Apartment
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-10 col-md-10">
            @include('admin.layouts.message')
            <div class="card">
                <div class="header">
                    <h4 class="title">Edit Apartment</h4>
                </div>

                <div class="content">
                    {!! Form::open(['url' => ['admin/apartment', $apartment->id], 'files'=>'true', 'method'=>'put']) !!}
                    <div class="row">
                        <div class="col-md-12">

                            @include('admin.apartment._fields')

                            <div class="form-group">
                                {{ Form::submit('Update Apartment', ['class'=>'btn btn-primary']) }}
                                <a class="btn btn-primary" href="javascript:history.back()">BACK</a> 
                                <a class="btn btn-primary" href="{{URL('/admin/dashboard')}}">Home</a> 
                            </div>

                        </div>

                    </div>


                    <div class="clearfix"></div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@endsection