@extends('admin.layouts.master')

@section('page')
    Orders
@endsection

@section('content')
    <div class="row">

        <div class="col-md-12">

            @include('admin.layouts.message')

            <div class="card">
                <div class="header">
                    <h4 class="title">Orders</h4>
                    <p class="category">List of all orders</p>
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
                            <th>User</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>City</th>
                            <th>Sector</th>
                            <th>Apartment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach ($orders as $order)
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                                <td>
                                @foreach ($order->products as $item)
                                    <table class="table">
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                        </tr>
                                    </table>
                                    @endforeach
                                </td>

                                <td>
                                    @foreach ($order->orderItems as $item)
                                        <table class="table">
                                            <tr>
                                                <td>{{ $item->quantity }}</td>
                                            </tr>
                                        </table>
                                    @endforeach
                                </td>

                                <td>{{ $order->city_name }}</td>
                                <td>{{ $order->apartment_name }}</td>
                                <td>{{ $order->sector_name }}</td>

                                <td>
                                    @if ($order->status)
                                        <span class="label label-success">Confirmed</span>
                                    @else
                                        <span class="label label-warning">Pending</span>
                                    @endif
                                </td>

                            <td>

                                @if ($order->status)
                                    {{ link_to_route('order.pending','Pending', $order->id, ['class'=>'btn btn-warning btn-sm']) }}
                                @else
                                    {{ link_to_route('order.confirm','Confirm', $order->id, ['class'=>'btn btn-success btn-sm']) }}
                                @endif

                                {{ link_to_route('orders.show','Details', $order->id, ['class'=>'btn btn-success btn-sm']) }}

                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                     {!! $orders->render() !!}
                </div>
            </div>
        </div>


    </div>
@endsection