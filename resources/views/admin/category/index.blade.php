@extends('admin.layouts.master')

@section('page')
    Categories
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">

            @include('admin.layouts.message')

            <div class="card">
                <div class="header">
                    <h4 class="title">Categories</h4>
                    <p class="category">List of all categories</p>
                </div>
                <div style="float: right;margin: 7px;">
                    <a class="btn btn-primary" href="{{ url('/admin/category/create') }}">Add Category</a>
                    <a class="btn btn-primary" href="{{URL('/admin/dashboard')}}">Home</a> 
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($category as $cat)
                            <tr>
                                <td>{{ $cat->id }}</td>
                                <td>{{ $cat->name }}</td>
                                <td><img src="{{ url('uploads').'/'. $cat->image }}" alt="{{ $cat->image }}" style="width:50px;" class="img-thumbnail"></td>
                                <td>

                                    {{ Form::open(['route' => ['category.destroy', $cat->id], 'method'=>'DELETE']) }}
                                        {{ Form::button('<span class="fa fa-trash"></span>', ['type'=>'submit','class'=>'btn btn-danger btn-sm','onclick'=>'return confirm("Are you sure you want to delete this?")'])  }}
                                        {{ link_to_route('category.edit','', $cat->id, ['class' => 'btn btn-info btn-sm ti-pencil']) }}
                                        {{ link_to_route('category.show','', $cat->id, ['class' => 'btn btn-primary btn-sm ti-list']) }}
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