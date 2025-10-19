

    <!-- Top Bar Start -->
    <div class="top-bar">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="tb-contact">
              <p><i class="fas fa-envelope"></i>info@mail.com</p>
              <p><i class="fas fa-phone-alt"></i>+012 345 6789</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="tb-menu">
              @guest
              <a href="{{ route('login') }}">login</a>
              <a href="{{ route('register') }}">register</a>
              @endguest
              @auth
              <a href="javascript:viod(0)" onclick="if(confirm('do you went logout')){document.getElementById('formLogout').submit()} return false">logout</a>
                  <form action="{{ route('logout') }}" id="formLogout" method="post"> @csrf</form>
              @endauth
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Top Bar Start -->

    <!-- Brand Start -->
    <div class="brand">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4">
            <div class="b-logo">
              <a href="index.html">
                <img src="{{asset('assets/front')}}/img/logo.png" alt="Logo" />
              </a>
            </div>
          </div>
          <div class="col-lg-6 col-md-4">
            <div class="b-ads">
              <a href="https://htmlcodex.com">
                <img src="{{asset('assets/front')}}/img/ads-1.jpg" alt="Ads" />
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <form action="{{ route('front.search.store') }}" method="post">
              @csrf
              <div class="b-search">
                <input type="text" name="search" placeholder="Search" />
                <button><i class="fa fa-search"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Brand End -->

    <!-- Nav Bar Start -->
    <div class="nav-bar">
      <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
          <a href="#" class="navbar-brand">MENU</a>
          <button
            type="button"
            class="navbar-toggler"
            data-toggle="collapse"
            data-target="#navbarCollapse"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div
            class="collapse navbar-collapse justify-content-between"
            id="navbarCollapse"
          >
            <div class="navbar-nav mr-auto">
              <a href="{{ route('front.index') }}" class="nav-item nav-link active">Home</a>
              <div class="nav-item dropdown">
                <a
                  href="{{ route('front.getAllCategories') }}"
                  class="nav-link dropdown-toggle"
                  data-toggle="dropdown"
                  >Categories</a
                >
                <div class="dropdown-menu">
                  <a href="{{ route('front.getAllCategories') }}" class="dropdown-item">All categories</a>
                  @foreach ($categories as $category)
                  <a href="{{ route('front.getCategory',$category->slug) }}" class="dropdown-item">{{ $category->name }}</a>
                      
                  @endforeach
                </div>
              </div>
              <a href="{{ route('front.contact.index') }}" class="nav-item nav-link">Contact Us</a>
              <a href="dashboard.html" class="nav-item nav-link">Dashboard</a>
            </div>
            <div class="social ml-auto">
              <a href=""><i class="fab fa-twitter"></i></a>
              <a href=""><i class="fab fa-facebook-f"></i></a>
              <a href=""><i class="fab fa-linkedin-in"></i></a>
              <a href=""><i class="fab fa-instagram"></i></a>
              <a href=""><i class="fab fa-youtube"></i></a>
            </div>
          </div>
        </nav>
      </div>
    </div>
    <!-- Nav Bar End -->