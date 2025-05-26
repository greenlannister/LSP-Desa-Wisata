<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Aria is a business focused HTML landing page template built with Bootstrap to help you create lead generation websites for companies and their services.">
    <meta name="author" content="Inovatik">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
	<meta property="og:site_name" content="" /> <!-- website name -->
	<meta property="og:site" content="" /> <!-- website link -->
	<meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
	<meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
	<meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
	<meta property="og:url" content="" /> <!-- where do you want your post to link to -->
	<meta property="og:type" content="article" />

    <!-- Website Title -->
    <title>{{ $title }}</title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="{{ asset('fe/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('fe/css/fontawesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('fe/css/swiper.css') }}" rel="stylesheet">
	<link href="{{ asset('fe/css/magnific-popup.css') }}" rel="stylesheet">
	<link href="{{ asset('fe/css/styles.css') }}" rel="stylesheet">
	
	<!-- Favicon  -->
    <link rel="icon" href="{{ asset('image/logo.png') }}">

    {{-- // Dari be --}}
      <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('sig/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('sig/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('sig/css/material-dashboard.css?v=3.2.0') }}" rel="stylesheet" />
  <link id="pagestyle" rel="stylesheet" href="{{ asset ('fe/css/styles.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

    <!-- Header -->
    @if ($title === 'Home')
    <header id="header" class="header">
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-container">
                            <h1>DESA <span id="js-rotating">WISATA, INDONESIA, INDAH</span></h1>
                            <p class="p-heading p-large">Discover the enchanting beauty of Indonesia — a land of thousands of islands, rich cultures, and breathtaking natural wonders waiting to be explored with us.</p>
                            <a class="btn-solid-lg page-scroll" href="/package-dwp">DISCOVER</a>
                        </div>
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of header-content -->
    </header> <!-- end of header -->
    <!-- end of header -->

    @else
    <header id="header" class="header">
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-container">
                            <h1>Desa Danau Toba</h1>
                        </div>
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of header-content -->
    </header> <!-- end of header -->
    <!-- end of header -->

    @endif
<body data-spy="scroll" data-target=".fixed-top">
    
    <!-- Preloader -->
	<div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->
    

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark navbar-custom fixed-top">
        <!-- Logo -->
        <a class="navbar-brand logo-image" href="/">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" style="height: 50px; width: auto;">
        </a>        
        <h2 class="text-logo">Desa Danau Toba</h2>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <!-- Menu Items -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="/" class="nav-link {{ $title === 'Home' ? 'active' : '' }}">Home</a>
                </li>
                <li class="nav-item">
                    <a href="/about-dwp" class="nav-link {{ $title === 'About' ? 'active' : '' }}">About Us</a> 
                </li>
                
                <!-- Services Dropdown (Fixed) -->
                <li class="nav-item dropdown">
                    <!-- Toggle Dropdown -->
                    <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false" onclick="event.preventDefault()">
                        Services
                    </a>
                    
                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                        <li>
                            <a class="dropdown-item {{ $title === 'Packages' ? 'active' : '' }}" href="/package-dwp">
                                Package
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item {{ $title === 'Homestay' ? 'active' : '' }}" href="/homestay-dwp">
                                Homestay
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item {{ $title === 'News' ? 'active' : '' }}" href="/news-dwp">
                                News
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item {{ $title === 'Discount' ? 'active' : '' }}" href="/discount-dwp">
                                Discount
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="/contact-dwp" class="nav-link {{ $title === 'Contact' ? 'active' : '' }}">Contact</a>
                </li>
    
                @if(Auth::check())
                    <!-- User Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Hallo {{ Auth::user()->pelanggan->nama_pelanggan ?? 'User' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <li class="nav-item">
                        <a href="/regis-dwp" class="nav-link {{ $title === 'Register' ? 'active' : '' }}">Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="/login" class="nav-link {{ $title === 'Login' ? 'active' : '' }}">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
                    <!-- end of navbar -->
    <!-- end of navbar -->

    {{-- Logic Start --}}

    @if ($title==='Home' or $title==='About')
		@yield('about')
	@endif
    @if ($title==='Home')
        @yield('discount')
        @yield('package')
        @yield('testi')
		@yield('news')
	@endif
    @if ($title==='About')
        @yield('service')
        @yield('karyawan')
        @yield('testi')
    @endif
    @if ($title==='Packages')
        @yield('package')
    @endif
    @if ($title==='News')
        @yield('news')
    @endif
    @if ($title==='Contact')
        @yield('contact')
    @endif
    @if ($title==='Discount')
        @yield('discount')
    @endif
    @if ($title==='Homestay')
        @yield('homestay')
    @endif
    @if ($title==='Reservasi')
        @yield('reservasi')
    @endif
    

    {{-- Logic End --}}
    

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-container about">
                        <h4>Discover Lake Toba</h4>
                        <p class="white">We're dedicated to showcasing the breathtaking beauty and rich Batak culture of Lake Toba and Samosir Island. Our mission is to provide unforgettable experiences while preserving this natural wonder for future generations.</p>
                        <div class="social-icons">
                            <!-- Your social media icons here -->
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-container">
                        <h4>Quick Links</h4>
                        <ul class="list-unstyled li-space-lg white">
                            <li>
                                <a class="white" href="/home-dwp">Home</a>
                            </li>
                            <li>
                                <a class="white" href="/about-dwp">About</a>
                            </li>
                            <li>
                                <a class="white" href="/service-dwp">Services</a>
                            </li>
                            <li>
                                <a class="white" href="/contact-dwp">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-container">
                        <h4>Resources</h4>
                        <ul class="list-unstyled li-space-lg">
                            <li>
                                <a class="white" href="package-dwp">Packages</a>
                            </li>
                            <li>
                                <a class="white" href="news-dwp">News</a>
                            </li>
                            <li>
                                <a class="white" href="discount-dwp">Discounts</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-container">
                        <h4>Members</h4>
                        <ul class="list-unstyled li-space-lg">
                            <li>
                                <a class="white" href="/register-dwp">Register</a>
                            </li>
                            <li>
                                <a class="white" href="{{ route('login') }}">Login</a>
                            </li>
                            <li>
                                <a class="white" href="/privacy-policy">Privacy Policy</a>
                            </li>
                            <li>
                                <a class="white" href="/terms-conditions">Terms & Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end of footer -->  
    <!-- end of footer -->


    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="white copyright">Copyright © 2023 Lake Toba Tourism. All rights reserved.</p>
                </div>
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright --> 
    <!-- end of copyright -->
    
    	
    <!-- Scripts -->
    <script src="{{ asset('fe/js/jquery.min.js') }}"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="{{asset ('fe/js/popper.min.js') }}"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="{{ asset('fe/js/bootstrap.min.js') }}"></script> <!-- Bootstrap framework -->
    <script src="{{ asset('fe/js/jquery.easing.min.js') }}"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="{{ asset('fe/js/swiper.min.js') }}"></script> <!-- Swiper for image and text sliders -->
    <script src="{{ asset('fe/js/jquery.magnific-popup.js') }}"></script> <!-- Magnific Popup for lightboxes -->
    <script src="{{ asset('fe/js/morphext.min.js') }}"></script> <!-- Morphtext rotating text in the header -->
    <script src="{{ asset('fe/js/isotope.pkgd.min.js') }}"></script> <!-- Isotope for filter -->
    <script src="{{ asset('fe/js/validator.min.js') }}"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="{{ asset('fe/js/scripts.js') }}"></script> <!-- Custom scripts -->
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>