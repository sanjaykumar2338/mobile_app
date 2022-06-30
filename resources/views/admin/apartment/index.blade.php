@extends('admin.layouts.master')

@section('page')
    Apartment
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            @include('admin.layouts.message')

            <div class="card">
                <div class="header">
                    <h4 class="title">Apartment</h4>
                    <p class="category">List of all Apartment</p>
                    <a style="float:right;" href="{{ url('/admin/apartment/create') }}">                       
                        <p>Add Apartment</p>
                    </a>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($apartment as $cat)
                            <tr>
                                <td>{{ $cat->id }}</td>
                                <td>{{ $cat->name }}</td>
                                <td>
                                    {{ Form::open(['route' => ['apartment.destroy', $cat->id], 'method'=>'DELETE']) }}
                                        {{ Form::button('<span class="fa fa-trash"></span>', ['type'=>'submit','class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("Are you sure you want to delete this?")'])  }}
                                        {{ link_to_route('apartment.edit','', $cat->id, ['class' => 'btn btn-info btn-sm ti-pencil']) }}
                                        {{ link_to_route('apartment.show','', $cat->id, ['class' => 'btn btn-primary btn-sm ti-list']) }}
                                    {{ Form::close() }}

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>


@endsection