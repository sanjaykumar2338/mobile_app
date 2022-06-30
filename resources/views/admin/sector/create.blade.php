@extends('admin.layouts.master')

@section('page')
    Sector
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-10 col-md-10">
            @include('admin.layouts.message')
            <div class="card">
                <div class="header">
                    <h4 class="title">Add Sector</h4>
                </div>

                <div class="content">
                    {!! Form::open(['url' => 'admin/sector', 'files'=>'true']) !!}
                    <div class="row">
                        <div class="col-md-12">

                            @include('admin.sector._fields')

                            <div class="form-group">
                                {{ Form::submit('Add Sector', ['class'=>'btn btn-primary']) }}
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