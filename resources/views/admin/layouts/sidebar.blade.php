<div class="sidebar" data-background-color="white" data-active-color="danger">

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="" class="simple-text">
                Shopping - Admin
            </a>
        </div>

        <ul class="nav">
            <li class="@php if(str_contains(Request::url(), 'dashboard')) { echo 'active'; } @endphp">
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="ti-panel"></i>
                    <p>Dashboard</p>
                </a>
            </li>            
            <li class="@php if(str_contains(Request::url(), 'products')) { echo 'active'; } @endphp">
                <a href="{{ url('/admin/products') }}">
                    <i class="ti-view-list-alt"></i>
                    <p>View Products</p>
                </a>
            </li>
            <li class="@php if(str_contains(Request::url(), 'category')) { echo 'active'; } @endphp">
                <a href="{{ url('/admin/category') }}">
                    <i class="ti-view-list-alt"></i>
                    <p>Category</p>
                </a>
            </li>
            <li class="@php if(str_contains(Request::url(), 'city')) { echo 'active'; } @endphp">
                <a href="{{ url('/admin/city') }}">
                    <i class="ti-view-list-alt"></i>
                    <p>City</p>
                </a>
            </li>
            <li class="@php if(str_contains(Request::url(), 'sector')) { echo 'active'; } @endphp">
                <a href="{{ url('/admin/sector') }}">
                    <i class="ti-view-list-alt"></i>
                    <p>Sector</p>
                </a>
            </li>
            <li class="@php if(str_contains(Request::url(), 'apartment')) { echo 'active'; } @endphp">
                <a href="{{ url('/admin/apartment') }}">
                    <i class="ti-view-list-alt"></i>
                    <p>Apartment</p>
                </a>
            </li>
            <li class="@php if(str_contains(Request::url(), 'orders')) { echo 'active'; } @endphp">
                <a href="{{ url('/admin/orders') }}">
                    <i class="ti-calendar"></i>
                    <p>Orders</p>
                </a>
            </li>            
            <li class="@php if(str_contains(Request::url(), 'users')) { echo 'active'; } @endphp">
                <a href="{{ url('/admin/users') }}">
                    <i class="fa fa-users"></i>
                    <p>Customers</p>
                </a>
            </li>
        </ul>
    </div>
</div>
