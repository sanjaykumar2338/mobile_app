@extends('admin.layouts.master')

@section('page')
    Apartment Details
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Apartment Detail</h4>
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
                            <td>{{ $apartment->id }}</td>
                        </tr>

                        <tr>
                            <th>Name</th>
                            <td>{{ $apartment->name }}</td>
                        </tr>

                        <tr>
                            <th>Created At</th>
                            <td>{{ $apartment->created_at->diffForHumans() }}</td>
                        </tr>

                        <tr>
                            <th>Updated At</th>
                            <td>{{ $apartment->updated_at->diffForHumans() }}</td>
                        </tr>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection