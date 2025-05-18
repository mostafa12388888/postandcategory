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
                         <a href="{{ route('register') }}">Register</a>
                         <a href="{{ route('login') }}">Login</a>
                     @endguest
                     @auth
                         <a href="javascript:void(0)"
                             onclick="if(confirm('Do you want to logout?')){ document.getElementById('formLogOut').submit(); } return false;">Log
                             out</a>

                         <form id="formLogOut" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>

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
                         <img src="{{ asset('assets/frontEnd') }}{{ $getSettings->logo }}" alt="Logo" />
                     </a>
                 </div>
             </div>
             <div class="col-lg-6 col-md-4">

             </div>
             <div class="col-lg-3 col-md-4">
                 <div class="b-search">
                     <input type="text" placeholder="Search" />
                     <button><i class="fa fa-search"></i></button>
                 </div>
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
             <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                 <span class="navbar-toggler-icon"></span>
             </button>

             <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                 <div class="navbar-nav mr-auto">
                     <a href="/" class="nav-item nav-link active">Home</a>
                     <div class="nav-item dropdown">
                         <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dropdown Category</a>
                         <div class="dropdown-menu">
                             @foreach ($categories as $category)
                                 <a href="{{ route('frontend.category.posts', $category->slug) }}" class="dropdown-item"
                                     title="{{ $category->name }}"> {{ $category->name }}</a>
                             @endforeach
                         </div>
                     </div>
                    @auth
                    <a href="{{route('frontend.dashboard.profile')}}" class="nav-item nav-link">Dashboard</a>

                    @endauth
                    @auth
                    @if (auth()->user()->role=='admin')

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Dropdown Admin</a>
                        <div class="dropdown-menu">
                                <a href="{{ route('frontend.admin.post') }}" class="dropdown-item"
                                    title="show table posts">Show Posts</a>
                                <a href="/users" class="dropdown-item"
                                    title="show table posts">Show Users</a>
                                <a href="/roles" class="dropdown-item"
                                    title="show table posts">Show Roles</a>
                        </div>
                    </div>
                    @endif

                    @endauth


                 </div>
                 <div class="social ml-auto">
                     <a href="{{ $getSettings->twitter }}" title='twitter'><i class="fab fa-twitter"></i></a>
                     <a href="{{ $getSettings->facebook }}" title='facebook'><i class="fab fa-facebook-f"></i></a>
                     <a href="{{ $getSettings->twitter }}" title='linkedin'><i class="fab fa-linkedin-in"></i></a>
                     <a href="{{ $getSettings->instagram }}" title='instagram'><i class="fab fa-instagram"></i></a>
                     <a href="{{ $getSettings->youtube }}" title='youtube'><i class="fab fa-youtube"></i></a>
                 </div>
             </div>
         </nav>
     </div>
 </div>
 <!-- Nav Bar End -->
