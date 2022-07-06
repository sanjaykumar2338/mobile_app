@extends('admin.layouts.master')

@section('page')
    Customers
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Customers</h4>
                    <p class="category">List of all Customers</p>
                </div>
                 <div style="float: right;margin: 7px;">
                    <a class="btn btn-primary" href="javascript:history.back()">BACK</a> 
                    <a class="btn btn-primary" href="{{URL('/admin/dashboard')}}">Home</a> 
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Registered at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)

                            <tr>

                                <td>{{ $user->id }}</td>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td>
                                    <button class="btn btn-sm btn-success ti-close" title="Block User"></button>

                                   {{ link_to_route('users.show', 'Order Details', $user->id, ['class'=>'btn btn-success btn-sm']) }}

                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {!! $users->render() !!}
                </div>
            </div>
        </div>
    </div>

@endsection