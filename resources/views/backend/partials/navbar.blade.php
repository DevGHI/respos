<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" width="110" height="66" class="" src="{{url('uploads/logo.jpg')}}" /> <br>
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{Auth::user()->name}}</strong>
                             </span> <span class="text-muted text-xs block">{{Auth::user()->role->display_name}} <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="{{url('settings/profile')}}">@lang('menu.profile')</a></li>
                            
                            <li><a href="{{ url('/logout') }}">@lang('menu.logout')</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        
                    </div>
                </li>
				 @permission('dashboard')
				 <li @if(Request::segment(1) == "admin" or Request::segment(1) == "dashboard") class="active" @endif><a href="{{ url('dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">@lang('menu.dashboard')<span></a></li>
				 @endpermission
                 @permission('add_sale')
				 <li @if(Request::segment(1) == "sales" and Request::segment(2) == "create") class="active" @endif><a href="{{ url('sales/create') }}"><i class="fa fa-diamond"></i> <span class="nav-label">@lang('menu.point_of_sale')<span></a></li>
				 @endpermission
                 @permission('view_expense')
				 <li @if(Request::segment(1) == "expenses") class="active" @endif><a href="{{ url('expenses') }}"><i class="fa fa-diamond"></i> <span class="nav-label">@lang('menu.expenses')<span></a></li>
				
				  <li @if(Request::segment(1) == "online-orders") class="active" @endif><a href="{{ url('online-orders') }}"><i class="fa fa-list"></i> <span class="nav-label">@lang('menu.online_orders')<span></a></li>
				  @endpermission
                 @permission('view_sale')
				  <li  @if((Request::segment(1) == "orders" or Request::segment(1) == "sales") and Request::segment(2) == "") class="active" @endif>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">@lang('menu.sales')</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li @if(Request::segment(1) == "sales" and Request::segment(2) == "") class="active" @endif><a href="{{ url('sales') }}">@lang('menu.pos_sales')</a></li>
                         <li @if(Request::segment(1) == "orders" ) class="active" @endif><a href="{{ url('orders') }}">@lang('menu.order_sales')</a></li>
                       
                    </ul>
                </li>
				 @endpermission
                 @permission('view_products')
				
                    <?php /* <li><a href="{{ url('customers') }}"> <i class="fa fa-users"></i> <span class="nav-label">Customers <span></a></li>
                    <li><a href="{{ url('suppliers') }}"> <i class="fa fa-users"></i> <span class="nav-label">Suppliers <span></a></li> */ ?>
					
                <li @if((Request::segment(1) == "categories" or Request::segment(1) == "products") and Request::segment(2) == "") class="active" @endif>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">@lang('menu.products')</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li @if(Request::segment(1) == "categories" and Request::segment(2) == "") class="active" @endif><a href="{{ url('categories') }}">@lang('menu.categories')</a></li>
                        <li @if(Request::segment(1) == "products" and Request::segment(2) == "") class="active" @endif><a href="{{ url('products') }}">@lang('menu.products')</a></li>
                       
                    </ul>
                </li>
				@endpermission
                
                   
    <?php /* <li>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Inventories</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                       <li><a href="{{ url('inventories/receivings') }}">Receivings</a></li>
                            <li><a href="{{ url('inventories/adjustments') }}">Adjustments</a></li>
                            <li><a href="{{ url('inventories/trackings') }}">Trackings</a></li>
                       
                    </ul>
                </li> */ ?>
                 @permission('reports')
                <li <?php if(Request::segment(1) == "reports") { ?>  class="active"; <?php  } ?>>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">@lang('menu.reporting')</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li @if((Request::segment(1) == "reports" and Request::segment(2) == "sales")) class="active" @endif><a href="{{ url('reports/sales') }}">@lang('menu.sales_report')</a></li>
                        <li @if((Request::segment(1) == "reports" and Request::segment(2) == "sales_by_products")) class="active" @endif><a href="{{ url('reports/sales_by_products') }}">@lang('menu.product_by_sales')</a></li>
                        <li @if((Request::segment(1) == "reports" and Request::segment(2) == "graphs")) class="active" @endif><a href="{{ url('reports/graphs') }}">@lang('menu.graphs')</a></li>
                        <li @if((Request::segment(1) == "reports" and Request::segment(2) == "expenses")) class="active" @endif><a href="{{ url('reports/expenses') }}">@lang('menu.expense_report')</a></li>
                        <li @if((Request::segment(1) == "reports" and Request::segment(2) == "staff_log")) class="active" @endif><a href="{{ url('reports/staff_log') }}">@lang('menu.staff_logs')</a></li>
						
						<li @if((Request::segment(1) == "reports" and Request::segment(2) == "staff_sold")) class="active" @endif><a href="{{ url('reports/staff_sold') }}">@lang('menu.sales_manager_sold')</a></li>
						
                       
                    </ul>
                </li>
				@endpermission
                 @permission('setting')
				 <li @if(Request::segment(2) == "general") class="active" @endif>
                    <a href="{{ url('settings/general') }}"><i class="fa fa-gear"></i> <span class="nav-label"> @lang('menu.settings')</span></a>
                </li>
				
                 <!--<li @if(Request::segment(1) == "settings" and ((Request::segment(2) == "general" or Request::segment(2) == "html" ))) class="active" @endif>
                    <a href="#"><i class="fa fa-gear"></i> <span class="nav-label"> Settings </span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li @if(Request::segment(1) == "settings" and (Request::segment(2) == "general" )) class="active" @endif><a href="{{ url('settings/general') }}">General Setting</a></li>
                        <li @if(Request::segment(1) == "editor" and (Request::segment(2) == "html" )) class="active" @endif><a href="{{ url('editor/html') }}">Code Editor</a></li> 
                       
                    </ul>
                </li>-->
                @endpermission

                <li @if(Request::segment(1) == "tables") class="active" @endif>
                    <a href="{{ url('tables') }}"><i class="fa fa-list"></i> <span class="nav-label"> @lang('menu.tables')</span></a>
                </li>

                 @permission('users')
				
                
                <li @if(Request::segment(1) == "users") class="active" @endif>
                    <a href="{{ url('users') }}"><i class="fa fa-users"></i> <span class="nav-label"> @lang('menu.users')</span></a>
                </li>
				@endpermission
                 @permission('roles')
				
				<li @if(Request::segment(1) == "roles") class="active" @endif>
                    <a href="{{ url('roles') }}"><i class="fa fa-users"></i> <span class="nav-label"> @lang('menu.roles')</span></a>
                </li>
				@endpermission
                 @permission('frontend_setting')
                
                <li @if((Request::segment(1) == "settings" or Request::segment(1) == "sliders" or Request::segment(1) == "pages") and ((Request::segment(2) == "homepage" or Request::segment(2) == "menu_management"  or Request::segment(2) == ""))) class="active" @endif>
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">@lang('menu.frontend_website')</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li @if((Request::segment(2) == "homepage" )) class="active" @endif><a href="{{ url('settings/homepage') }}">@lang('menu.homepage_setting')</a></li>
                        <li @if((Request::segment(1) == "sliders" )) class="active" @endif><a href="{{ url('sliders') }}">@lang('menu.sliders')</a></li>
                        <li @if((Request::segment(1) == "pages" )) class="active" @endif><a href="{{ url('pages') }}">@lang('menu.pages')</a></li>
                        <?php /* 
                        <li @if((Request::segment(2) == "menu_management" )) class="active" @endif><a href="{{ url('settings/menu_management') }}">@lang('menu.menu_management')</a></li>
                        */ ?>
                       
                    </ul>
                </li>
                @endpermission
                
            @permission('Profile')
				<li @if((Request::segment(2) == "profile" )) class="active" @endif>
                    <a href="{{url('settings/profile')}}"><i class="fa fa-user"></i> <span class="nav-label"> @lang('menu.profile') </span></a>
                </li>
				@endpermission
                <li>
                    <a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> <span class="nav-label"> @lang('menu.logout') </span></a>
                </li>
                
            </ul>

        </div>
    </nav>
