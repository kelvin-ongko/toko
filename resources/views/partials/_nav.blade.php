<!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container">

      <div class="logo float-left">
        <h1 class="text-light"><a href="{{ url('') }}"><span>Keong</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu float-right d-none d-md-block">
        <ul >
          @if(\Session::has('login'))
          <li class="drop-down"><a href="#">{{ Session::get('name') }}</a>
            <ul class="nav-dropdown">
              <li><a href="{{ url('admin/dashboard') }}"><i class="icofont-home"></i> Dashboard</a></li>
              <li class="drop-down"><a href="#"><i class="icofont-cart"></i>Transaction</a>
                <ul>
                  <li><a href="{{ url('addtransaction') }}"><i class="icofont-ui-add"></i>Add Transaction</a></li>
                  <li><a href="{{ url('transactionlist') }}"><i class="icofont-users"></i> Transaction List</a></li>
                </ul>
              </li>
              <li class="drop-down"><a href="#"><i class="icofont-basket"></i>Purchase</a>
                <ul>
                  <li><a href="{{ url('addpurchase') }}"><i class="icofont-ui-add"></i>Add Purchase</a></li>
                  <li><a href="{{ url('purchaselist') }}"><i class="icofont-users"></i> Purchase List</a></li>
                </ul>
              </li>
              <li class="drop-down"><a href="#"><i class="icofont-picture"></i> Report</a>
                <ul>
                  <li><a href="{{ url('yearlyreport') }}"><i class="icofont-ui-listine-dots"></i> Report List</a></li>
                </ul>
              </li>
              <li><a href="{{ url('logout') }}"><i class="icofont-sign-out"></i> logout</a></li>
            </ul>
          </li>
          @else
          <!-- <li><a href="{{ url('login') }}"><i class="icofont-ui-user"></i> Login Illustrator</a></li> -->
          @endif
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->