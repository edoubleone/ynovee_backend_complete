<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from validthemes.net/site-template/tekni/contact-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Sep 2025 11:46:57 GMT -->
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tekni - IT Solutions & Services Template">

    <!-- ========== Page Title ========== -->
    <title>DataPave Solution</title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/elegant-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/flaticon-set.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/validnavs.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/unit-test.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <!-- ========== End Stylesheet ========== -->

</head>

<body>

    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->
    

    <!-- Start Header Top 
    ============================================= -->
    <div class="top-bar-area top-bar-style-one bg-dark text-light">
        <div class="container">
            <div class="row align-center">
                <div class="col-xl-6 col-lg-8 offset-xl-3 pl-30 pl-md-15 pl-xs-15">
                    <ul class="item-flex">
                        <li>
                            <i class="fas fa-map-marker-alt"></i> 4500 Forbes Blvd Lanham 20706
                        </li>
                        <li>
                            <a href="tel:2404596084"><i class="fas fa-phone-alt"></i> 2404596084</a>
                        </li>
                        <li>
                            <i class="fas fa-fax"></i> 2403666783
                        </li>
                    </ul>
                </div>
                <div class="col-xl-3 col-lg-4 text-end">
                    <div class="social">
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top -->

    <!-- Header 
    ============================================= -->
    <header>
        <!-- Start Navigation -->
        <nav class="navbar mobile-sidenav navbar-style-one navbar-sticky navbar-default validnavs white navbar-fixed no-background">

            <div class="container">
                <div class="row align-center">

                    <!-- Start Header Navigation -->
                    <div class="col-xl-2 col-lg-3 col-md-2 col-sm-1 col-1">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                                <i class="fa fa-bars"></i>
                            </button>
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ asset('assets/img/logo.png') }}" class="logo" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <!-- End Header Navigation -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="col-xl-6 offset-xl-1 col-lg-6 col-md-4 col-sm-4 col-4">
                        <div class="collapse navbar-collapse" id="navbar-menu">

                            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                                <i class="fa fa-times"></i>
                            </button>
                            
                            <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                                <li class="">
                                    <a href="{{ url('/') }}" class="">Home</a>
                                    <!-- <ul class="dropdown-menu megamenu-content" role="menu">
                                        <li>
                                            <div class="col-menu-wrap">
                                                <div class="col-item">
                                                    <div class="menu-thumb">
                                                        <img src="{{ asset('assets/img/demo/home-1.jpg') }}" alt="Image Not Found">
                                                        <div class="overlay">
                                                            <a href="index.html">Multipage</a>
                                                            <a href="index-op.html">One Page</a>
                                                        </div>
                                                    </div>
                                                    <h6 class="title"><a href="index.html">Home It Solutions</a></h6>
                                                </div>
                                                <div class="col-item">
                                                    <div class="menu-thumb">
                                                        <img src="{{ asset('assets/img/demo/home-2.jpg') }}" alt="Image Not Found">
                                                        <div class="overlay">
                                                            <a href="index-2.html">Multipage</a>
                                                            <a href="index-2-op.html">One Page</a>
                                                        </div>
                                                    </div>
                                                    <h6 class="title"><a href="index-2.html">Home Technology</a></h6>
                                                </div>
                                                <div class="col-item">
                                                    <div class="menu-thumb">
                                                        <img src="{{ asset('assets/img/demo/home-3.jpg') }}" alt="Image Not Found">
                                                        <div class="overlay">
                                                            <a href="index-3.html">Multipage</a>
                                                            <a href="index-3-op.html">One Page</a>
                                                        </div>
                                                    </div>
                                                    <h6 class="title"><a href="index-3.html">Home Tech Solution</a></h6>
                                                </div>
                                                <div class="col-item">
                                                    <div class="menu-thumb">
                                                        <img src="{{ asset('assets/img/demo/home-4.jpg') }}" alt="Image Not Found">
                                                        <div class="overlay">
                                                            <a href="index-4.html">Multipage</a>
                                                            <a href="index-4-op.html">One Page</a>
                                                        </div>
                                                    </div>
                                                    <h6 class="title"><a href="index-4.html">Home It Management</a></h6>
                                                </div>
                                                <div class="col-item">
                                                    <div class="menu-thumb">
                                                        <img src="{{ asset('assets/img/demo/home-5.jpg') }}" alt="Image Not Found">
                                                        <div class="overlay">
                                                            <a href="index-5.html">Multipage</a>
                                                            <a href="index-5-op.html">One Page</a>
                                                        </div>
                                                    </div>
                                                    <h6 class="title"><a href="index-5.html">Home Data Science</a></h6>
                                                </div>
                                                <div class="col-item">
                                                    <div class="menu-thumb">
                                                        <img src="{{ asset('assets/img/demo/home-6.jpg') }}" alt="Image Not Found">
                                                        <div class="overlay">
                                                            <a href="index-6.html">Multipage</a>
                                                            <a href="index-6-op.html">One Page</a>
                                                        </div>
                                                    </div>
                                                    <h6 class="title"><a href="index-6.html">Digital It Solution</a></h6>
                                                </div>
                                                
                                            </div>
                                            <div class="megamenu-banner">
                                                <img src="{{ asset('assets/img/about/1.jpg') }}" alt="Image Not Found">
                                                <a href="https://www.youtube.com/watch?v=aTC_RNYtEb0" class="popup-youtube video-play-button"><i class="fas fa-play"></i></a>
                                                <h6 class="title"><a href="#">Watch Intro Video</a></h6>
                                            </div>
                                        </li>
                                    </ul> -->
                                </li>
                                <li class="">
                                    <a href="{{ route('about') }}" class="about.html
                            " >About</a>
                                    
                                </li>
                                <li class="">
                                    <a href="{{ route('services') }}" class="">Services</a>
                                  
                                </li>
                                
                                <li><a href="{{ route('contact') }}">contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.navbar-collapse -->

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-7 col-7">
                        <div class="attr-right">
                            <!-- Start Atribute Navigation -->
                            <div class="attr-nav">
                                <ul>
                                    <li class="button">
                                        <a href="{{ route('contact') }}">Get consultant</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- End Atribute Navigation -->
        
                        </div>
                    </div>

                </div>         
                <!-- Main Nav -->

                <!-- Overlay screen for menu -->
                <div class="overlay-screen"></div>
                <!-- End Overlay screen for menu -->
            </div>   
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Header -->
    

    <!-- Start Breadcrumb 
    ============================================= -->
    <div class="breadcrumb-area bg-cover shadow theme-hard text-center text-light" data-bg-image="{{ asset('assets/img/banner/8.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1>Contact Us</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li>Contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Start Contact Us 
    ============================================= -->
    <div class="contact-style-one-area overflow-hidden default-padding">

        <div class="contact-shape">
            <img src="{{ asset('assets/img/shape/37.html') }}" alt="Image Not Found">
        </div>
       
        <div class="container">
            <div class="row align-center">

                <div class="contact-stye-one col-lg-5 mb-md-50 mb-xs-20">

                    <div class="contact-style-one-info">
                        <h2 class="split-text">Contact Information</h2>
    <p class="wow fadeInUp" data-wow-delay="100ms">
        Get in touch with us for inquiries, partnerships, or support. Our team is always ready to assist you with any information you need.
    </p>

    <ul>
        <li class="wow fadeInUp">
            <div class="icon">
                <i class="fas fa-phone-alt"></i>
            </div>
            <div class="content">
                <h5 class="title">Hotline</h5>
                <a href="tel:2404596084">2404596084</a>
            </div>
        </li>
        <li class="wow fadeInUp" data-wow-delay="300ms">
            <div class="icon">
                <i class="fas fa-fax"></i>
            </div>
            <div class="content">
                <h5 class="title">Fax</h5>
                <a href="#">2403666783</a>
            </div>
        </li>
        <li class="wow fadeInUp" data-wow-delay="500ms">
            <div class="icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="info">
                <h5 class="title">Our Location</h5>
                <p>
                    4500 Forbes Blvd Lanham 20706
                </p>
            </div>
        </li>
        <li class="wow fadeInUp" data-wow-delay="700ms">
            <div class="icon">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <div class="info">
                <h5 class="title">Official Email</h5>
                <a href="mailto:info@datapavellc.com.com">info@datapavellc.com</a>
            </div>
        </li>
    </ul>
                    </div>
                </div>
                
                <div class="contact-stye-one col-lg-7 pl-60 pl-md-15 pl-xs-15">
                    <div class="contact-form-style-one">
                        <h5 class="sub-title">Have Questions?</h5>
                        <h2 class="title">Send us a Message</h2>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('contact.store') }}" method="POST" class="contact-form contact-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control" id="email" name="email" placeholder="Email*" type="email" required>
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control" id="phone" name="phone" placeholder="Phone" type="text">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group comments">
                                        <textarea class="form-control" id="comments" name="comments" placeholder="Tell Us About Project *" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" name="submit" id="submit">
                                        <i class="fa fa-paper-plane"></i> Get in Touch
                                    </button>
                                </div>
                            </div>
                            <!-- Alert Message -->
                            <div class="col-lg-12 alert-notification">
                                <div id="message" class="alert-msg"></div>
                            </div>
                        </form>
                    </div>
                </div>

                

            </div>
        </div>
    </div>
    <!-- End Contact -->

    <!-- Start Map 
    ============================================= -->
    <div class="maps-area bg-gray overflow-hidden">
        <div class="google-maps">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3017.479597844043!2d-76.8540196233447!3d38.94054397172059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89b7c6de5f425459%3A0x1d208980f2e40a0!2s4500%20Forbes%20Blvd%2C%20Lanham%2C%20MD%2020706%2C%20USA!5e0!3m2!1sen!2sus!4v1697456234567!5m2!1sen!2sus"></iframe>
        </div>
    </div>
    <!-- End Map -->

    <!-- Start Footer 
    ============================================= -->
    <footer class="bg-dark text-light bg-cover" data-bg-image="{{ asset('assets/img/shape/banner-8.jpg') }}">
        <div class="footer-shape">
            <div class="item">
                <img src="{{ asset('assets/img/shape/7.png') }}" alt="Shape">
            </div>
            <div class="item">
                <img src="{{ asset('assets/img/shape/9.png') }}" alt="Shape">
            </div>
        </div>
        <div class="container">
            <div class="f-items relative pt-70 pb-120 pt-xs-0 pb-xs-50">
                <div class="row">
                    <div class="col-lg-4 col-md-6 footer-item pr-50 pr-xs-15">
                        <div class="f-item about">
                            <img class="logo" src="{{ asset('assets/img/logo-light-solid.png') }}" alt="Logo">
                            <p>
                                Our company specializes in delivering cutting-edge Data Engineering & Analytics services tailored to help organizations leverage data for optimal decision-making
                            </p>
                            <div class="opening-hours">
                                <h5>Contact Information</h5>
                                <ul>
                                    <li> 
                                        <div class="working-day">Phone:</div>
                                        <div class="marker"></div>
                                        <div class="working-hour">2404596084</div>
                                    </li>
                                    <li>
                                        <div class="working-day">Fax:</div>
                                        <div class="marker"></div>
                                        <div class="working-hour">2403666783</div>
                                    </li>
                                    <li>
                                        <div class="working-day">Email:</div>
                                        <div class="marker"></div>
                                        <div class="working-hour">info@datapavellc.com</div>
                                    </li>
                                    <li>
                                        <div class="working-day">Address:</div>
                                        <div class="marker"></div>
                                        <div class="working-hour">4500 Forbes Blvd Lanham 20706</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 footer-item">
                        <div class="f-item link">
                            <h4 class="widget-title">Our Company</h4>
                            <ul>
                                <li>
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('about') }}">About Us</a>
                                </li>
                                <li>
                                    <a href="{{ route('services') }}">Service</a>
                                </li>
                                <li>
                                    <a href="{{ route('contact') }}">Contact</a>
                                </li>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 footer-item">
                         <div class="f-item link">
                            <h4 class="widget-title">Our Services</h4>
                            <ul>
                                <li>
                                    <a href="{{ route('services') }}">Data Engineering & Pipelines</a>
                                </li>
                                <li>
                                    <a href="{{ route('services') }}">Cloud Platforms</a>
                                </li>
                                <li>
                                    <a href="{{ route('services') }}">Machine Learning & Automation</a>
                                </li>
                                <li>
                                    <a href="{{ route('services') }}">APIs & Integrations</a>
                                </li>
                                <li>
                                    <a href="{{ route('services') }}">Data Visualization & Insights</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 footer-item">
                        <h4 class="widget-title">Newsletter</h4>
                        <p>
                            Join our subscribers list to get the latest <br> news and special offers.
                        </p>
                        <div class="f-item newsletter">
                            <form action="#">
                                <input type="email" placeholder="Your Email" class="form-control" name="email">
                                <button type="submit">
                                    <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 17L17 1H7.8" stroke="#232323" stroke-width="2"></path>
                                    </svg>
                                </button>  
                            </form>
                        </div>
                        <ul class="footer-social">
                            <li>
                                <a href="#">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <p>&copy; Copyright 2025. All Rights Reserved by <a href="https://edoubleone.net/" target="_blank">Edoubleone Inc</a></p>
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->

    </footer>
    <!-- End Footer -->
    
    <!-- jQuery Frameworks
    ============================================= -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/progress-bar.min.js') }}"></script>
    <script src="{{ asset('assets/js/circle-progress.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/count-to.js') }}"></script>
    <script src="{{ asset('assets/js/YTPlayer.min.js') }}"></script>
    <script src="{{ asset('assets/js/validnavs.js') }}"></script>
    <script src="{{ asset('assets/js/gsap.js') }}"></script>
    <script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('assets/js/SplitText.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const breadcrumbArea = document.querySelector('.breadcrumb-area');
            if (breadcrumbArea && breadcrumbArea.dataset.bgImage) {
                breadcrumbArea.style.backgroundImage = `url(${breadcrumbArea.dataset.bgImage})`;
            }
        });
    </script>

</body>

<!-- Mirrored from validthemes.net/site-template/tekni/contact-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Sep 2025 11:46:58 GMT -->
</html>