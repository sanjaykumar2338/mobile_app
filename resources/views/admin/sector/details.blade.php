@extends('admin.layouts.master')

@section('page')
    Sector Details
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Sector Detail</h4>
                   
                </div>
                  <div style="float: right;margin: 7px;">
                <a class="btn btn-primary" href="javascript:history.back()">BACK</a> 
                <a class="btn btn-primary" href="{{URL('/admin/dashboard')}}">Home</a> 
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <tbody>

                        <tr>
                            <th>ID</th>
                            <td>{{ $category->id }}</td>
                        </tr>

                        <tr>
                            <th>Name</th>
                            <td>{{ $category->name }}</td>
                        </tr>

                        <tr>
                            <th>Created At</th>
                            <td>{{ $category->created_at->diffForHumans() }}</td>
                        </tr>

                        <tr>
                            <th>Updated At</th>
                            <td>{{ $category->updated_at->diffForHumans() }}</td>
                        </tr>

                        <tr>
                            <th>Image</th>
                            <td><img src="{{ url('uploads') . '/'. $category->image}}" alt="" class="img-thumbnail" style="width: 150px;"></td>
                        </tr>

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection