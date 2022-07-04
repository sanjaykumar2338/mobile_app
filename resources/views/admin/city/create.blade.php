@extends('admin.layouts.master')

@section('page')
    City
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-10 col-md-10">
            @include('admin.layouts.message')
            <div class="card">
                <div class="header">
                    <h4 class="title">Add City</h4>
                </div>

                <div class="content">
                    {!! Form::open(['url' => 'admin/city', 'files'=>'true']) !!}
                    <div class="row">
                        <div class="col-md-12">

                            @include('admin.city._fields')

                            <div class="form-group">
                                {{ Form::submit('Add City', ['class'=>'btn btn-primary']) }}
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