

<ul class="app-menu">
    @if (Auth::user()->role==1)

    <li><a class="app-menu__item {{(request()->is('dashboard'))?'active':''}}"   href="{{route('dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
    <li><a class="app-menu__item {{(request()->is('admin/products*'))?'active':''}}" href="{{route('admin.products')}}"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Products</span></a></li>
    <li><a class="app-menu__item {{(request()->is('admin/comment*'))?'active':''}}" href="{{route('admin.moderate')}}"><i class="app-menu__icon fa fa-comments-o"></i><span class="app-menu__label">Moderate Comments</span></a></li>
    <li><a class="app-menu__item {{(request()->is('admin/user*'))?'active':''}}" href="{{route('admin.user')}}"><i class="app-menu__icon fa fa-user-md"></i><span class="app-menu__label">Users</span></a></li>
    <li><a class="app-menu__item {{(request()->is('admin/sales*'))?'active':''}}" href="{{route('admin.sales')}}"><i class="app-menu__icon fa fa-user-md"></i><span class="app-menu__label">Sales Reports</span></a></li>

{{--    <li><a class="app-menu__item {{(request()->is('sales*'))?'active':''}}" href="{{route('sales.sales')}}"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Orders</span></a></li>--}}

    @elseif(Auth::user()->role==2)
    <li><a class="app-menu__item {{(request()->is('sales*'))?'active':''}}" href="{{route('sales.sales')}}"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Sales</span></a></li>
    @elseif(Auth::user()->role==3)

    <li><a class="app-menu__item {{(request()->is('customer'))?'active':''}}" href="{{route('customer.index')}}"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">My Orders</span></a></li>

    @endif


</ul>
