    <div class="main-sidebar d-md-block collapse">
        <div class="sidebar-sticky">
          <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
                <div class="profile row mx-0 border-bottom p-3">
                    <div class="bg-profile">{{  substr(Session::get('name'), 0, 1) }}</div>
                    <div class="w-auto text-light px-2">                         
                        <div class="name"><a href="#profile">{{  Session::get('name') }}</a></div>
                        <div class="badge bg-success status">Online</div>
                        <div class="logout">
                            <a href="{{url('logout')}}"><i class="icofont-sign-out"></i> <span>Logout</span></a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard')}}" class="nav-link align-middle px-3">
                    <i class="icofont-home mx-2"></i> <span class="ms-1 d-inline">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#submenu" data-toggle="collapse" class="nav-link align-middle px-3">
                    <i class="icofont-user mx-2"></i> <span class="ms-1 d-inline">Item</span>
                    <i class="icofont-caret-down"></i>
                </a>
                <ul class="collapse nav flex-column ms-1 submenu" id="submenu">
                    <li class="w-100">
                        <a href="{{url('additem')}}" class="nav-link px-4"><i class="icofont-ui-add mx-2"></i> <span class="d-inline">Add Item</span></a>
                    </li>
                    <li class="w-100">
                        <a href="{{url('itemlist')}}" class="nav-link px-4"><i class="icofont-listine-dots mx-2"></i> <span class="d-inline">Item List</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#submenu1" data-toggle="collapse" class="nav-link align-middle px-3">
                    <i class="icofont-cart mx-2"></i> <span class="ms-1 d-inline">Transaction</span>
                    <i class="icofont-caret-down"></i>
                </a>
                <ul class="collapse nav flex-column ms-1 submenu" id="submenu1">
                    <li class="w-100">
                        <a href="{{url('addtransaction')}}" class="nav-link px-4"><i class="icofont-ui-add mx-2"></i> <span class="d-inline">Add Transaction</span></a>
                    </li>
                    <li class="w-100">
                        <a href="{{url('transactionlist')}}" class="nav-link px-4"><i class="icofont-listine-dots mx-2"></i> <span class="d-inline">Transaction List</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#submenu2" data-toggle="collapse" class="nav-link align-middle px-3">
                    <i class="icofont-basket mx-2"></i> <span class="ms-1 d-inline">Purchase</span>
                    <i class="icofont-caret-down"></i>
                </a>
                <ul class="collapse nav flex-column ms-1 submenu" id="submenu2">
                    <li class="w-100">
                        <a href="{{url('addpurchase')}}" class="nav-link px-4"><i class="icofont-ui-add mx-2"></i> <span class="d-inline">Add Purchase</span></a>
                    </li>
                    <li class="w-100">
                        <a href="{{url('purchaselist')}}" class="nav-link px-4"><i class="icofont-listine-dots mx-2"></i> <span class="d-inline">Purchase List</span></a>
                    </li>
                    <li class="w-100">
                        <a href="{{url('purchasecompletelist')}}" class="nav-link px-4"><i class="icofont-listine-dots mx-2"></i> <span class="d-inline">Complete List</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#submenu3" data-toggle="collapse" class="nav-link align-middle px-3">
                    <i class="icofont-picture mx-2"></i> <span class="ms-1 d-inline">Report</span>
                    <i class="icofont-caret-down"></i>
                </a>
                <ul class="collapse nav flex-column ms-1 submenu" id="submenu3">
                    <li class="w-100">
                        <a href="{{url('yearlyreport')}}" class="nav-link px-4"><i class="icofont-listine-dots mx-2"></i> <span class="d-inline">Monthly Report</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#submenu4" data-toggle="collapse" class="nav-link align-middle px-3">
                    <i class="icofont-picture mx-2"></i> <span class="ms-1 d-inline">Brand/Categories</span>
                    <i class="icofont-caret-down"></i>
                </a>
                <ul class="collapse nav flex-column ms-1 submenu" id="submenu4">
                    <li class="w-100">
                        <a href="{{url('addbrand')}}" class="nav-link px-4"><i class="icofont-ui-add mx-2"></i> <span class="d-inline">Add Brand</span></a>
                    </li>
                    <li class="w-100">
                        <a href="{{url('brandlist')}}" class="nav-link px-4"><i class="icofont-listine-dots mx-2"></i> <span class="d-inline">Brand List</span></a>
                    </li>
                    <li class="w-100">
                        <a href="{{url('addcategory')}}" class="nav-link px-4"><i class="icofont-ui-add mx-2"></i> <span class="d-inline">Add Category</span></a>
                    </li>
                    <li class="w-100">
                        <a href="{{url('categorylist')}}" class="nav-link px-4"><i class="icofont-listine-dots mx-2"></i> <span class="d-inline">Category List</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#submenu5" data-toggle="collapse" class="nav-link align-middle px-3">
                    <i class="icofont-picture mx-2"></i> <span class="ms-1 d-inline">Customer</span>
                    <i class="icofont-caret-down"></i>
                </a>
                <ul class="collapse nav flex-column ms-1 submenu" id="submenu5">
                    <li class="w-100">
                        <a href="{{url('addcustomer')}}" class="nav-link px-4"><i class="icofont-ui-add mx-2"></i> <span class="d-inline">Add Customer</span></a>
                    </li>
                    <li class="w-100">
                        <a href="{{url('customerlist')}}" class="nav-link px-4"><i class="icofont-listine-dots mx-2"></i> <span class="d-inline">Customer List</span></a>
                    </li>
                </ul>
            </li>
          </ul>
        </div>
      </div>