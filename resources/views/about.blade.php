<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from validthemes.net/site-template/tekni/about-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Sep 2025 11:46:58 GMT -->
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="DataPave Solution">

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

    <!-- Start Preloader 
    ============================================= -->
    <!-- <div id="preloader">
        <div class="tranzi-loader-inner">
           <div class="tranzi-loader">
              <span class="tranzi-loader-item"></span>
              <span class="tranzi-loader-item"></span>
              <span class="tranzi-loader-item"></span>
              <span class="tranzi-loader-item"></span>
              <span class="tranzi-loader-item"></span>
              <span class="tranzi-loader-item"></span>
              <span class="tranzi-loader-item"></span>
              <span class="tranzi-loader-item"></span>
           </div>
        </div>
     </div> -->
    <!-- preloader end -->

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
                                <li class="dropdown megamenu-fw megamenu-style-one">
                                    <a href="{{ url('/') }}" >Home</a>
                                  
                                </li>
                                <li>
                                    <a href="{{ route('about') }}" >About</a>
                                 
                                </li>
                                <li>
                                    <a href="{{ route('services') }}"  >Services</a>
                                 
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
                    <h1>About Us</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li>About</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Start About 
    ============================================= -->
    <div class="about-style-one-area default-padding">
        <div class="shape-animated-left">
            <img src="{{ asset('assets/img/shape/3.png') }}" alt="Image Not Found">
            <img src="{{ asset('assets/img/shape/4.png') }}" alt="Image Not Found">
        </div>
        <div class="container">
            <div class="row align-center">
                <div class="about-style-one col-xl-5 col-lg-6">
                    <div class="about-thumb">
                        <img class="wow fadeInRight" src="{{ asset('assets/img/about/1.jpg') }}" alt="Image Not Found">
                        <!-- <div class="about-card wow fadeInUp" data-wow-delay="500ms">
                            <ul>
                                <li>
                                    <div class="icon">
                                        <i class="flaticon-license"></i>
                                    </div>
                                    <div class="fun-fact">
                                        <div class="counter">
                                            <div class="timer" data-to="36" data-speed="2000">36</div>
                                            <div class="operator">+</div>
                                        </div>
                                        <span class="medium">Years of experience</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="flaticon-global"></i>
                                    </div>
                                    <div class="fun-fact">
                                        <div class="counter">
                                            <div class="timer" data-to="120" data-speed="2000">120</div>
                                            <div class="operator">K</div>
                                        </div>
                                        <span class="medium">Worldwide Clients</span>
                                    </div>
                                </li>
                            </ul>
                        </div> -->
                        <div class="thumb-shape-bottom wow fadeInDown" data-wow-delay="300ms">
                            <img src="{{ asset('assets/img/illustration/4.png') }}" alt="Image Not Found">
                        </div>
                    </div>
                </div>
                <div class="about-style-one col-xl-6 col-lg-5  offset-xl-1 offset-lg-1">
                    <h4 class="sub-title">About Our Company</h4>
                    <h2 class="title split-text mb-25">Discover Innovative Solutions & Technology</h2>
                    <div class="wow fadeInUp" data-wow-delay="200ms">
                        <p>
                            Our company specializes in delivering cutting-edge Data Engineering & Analytics services tailored to help organizations leverage data for optimal decision-making. We excel in building scalable data architectures, implementing machine learning (ML) models, automating data pipelines, and ensuring compliance with industry standards. 
                        <div class="accordion mt-30" id="faqAccordion">
                            <div class="accordion-single">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Data Engineering & Pipelines
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>
                                            Proficiency in cloud-native tools like DataFlow and Data Fusion for robust, efficient data pipelines.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-single">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Cloud Platforms
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>
                                            Specialized in automating processes for regulated environments, ensuring compliance with standards.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-single">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Data Visualization & Insights
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p>
                                            o	Development of interactive dashboards with PowerBI and Metabase to present actionable insights.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About -->


      <div class="process-style-two-area default-padding bottom-less bg-dark text-light">
        <div class="shape">
            <img src="{{ asset('assets/img/shape/46.html') }}" alt="Image Not Found">
        </div>
        <div class="container">
            <div class="left-heading">
                <div class="row">
                    <div class="col-lg-4">
                        <h4 class="sub-title">Why Choose Us</h4>
                        <h2 class="title">Driving Growth Through Data & Innovation </h2>
                    </div>
                    <div class="col-lg-6 offset-lg-2">
                        <p>
                           We are dedicated to helping you unlock the full potential of your data, turning it into a powerful tool for business success. Whether you need to streamline data operations, leverage advanced analytics, or automate machine learning workflows, we have the expertise to drive transformation.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <!-- Single Item -->
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="process-style-two">
                        <span>01</span>
                        <h4>Expertise</h4>
                        <p>
                            Proven track record across multiple industries, combining technical prowess with a strategic approach to data engineering and analytics.
                        </p>
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/24.png') }}" alt="Image Not Found">
                        </div>
                    </div>
                </div>
                <!-- End Single Item -->
                <!-- Single Item -->
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="process-style-two">
                        <span>02</span>
                        <h4>Scalability</h4>
                        <p>
                             Ability to design scalable, flexible solutions tailored to meet the needs of any organization, from startups to large enterprises.
                        </p>
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/25.png') }}" alt="Image Not Found">
                        </div>
                    </div>
                </div>
                <!-- End Single Item -->
                <!-- Single Item -->
                <div class="col-lg-4 col-md-6 mb-30">
                    <div class="process-style-two">
                        <span>03</span>
                        <h4>Efficiency</h4>
                        <p>
                         Focus on optimizing performance, cost, and automation to ensure that your data infrastructure is running at peak efficiency.
                            
                        </p>
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/26.png') }}" alt="Image Not Found">
                        </div>
                    </div>
                </div>
                <!-- End Single Item -->
            </div>
        </div>
    </div> 

    <!-- Start Process
    ============================================= -->
   
    <!-- End Process -->

    <!-- Start Partner Area  
    ============================================= -->
    
    <!-- End Partner Area -->

    <!-- Start Team 
    ============================================= -->
   
    <!-- End Team Area -->

    <!-- Start Testimonials 
    ============================================= -->
     <div class="testimonial-style-one-area default-padding">
        <div class="container">
            <div class="row align-center">

                <div class="col-lg-4">
                    <div class="testimonial-thumb wow fadeInUp">
                        <div class="thumb-item">
                            <img src="{{ asset('assets/img/illustration/5.png') }}" alt="illustration">
                            <div class="mini-shape">
                                <img src="{{ asset('assets/img/shape/19.png') }}" alt="illustration">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 offset-lg-1">
                    <div class="testimonial-carousel swiper wow fadeInUp" data-wow-delay="200ms">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Single item -->
                            <div class="swiper-slide">
                                <div class="testimonial-style-one">
                                    
                                    <div class="item">
                                        <div class="content">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <h2>Reliable Data Engineering Partner</h2>
                                            <p>
                                                “Working with this team has been transformative for our business. They built
                    scalable real-time data pipelines, integrated external data sources, and deployed
                    predictive ML models that improved our operational efficiency by over 20%.”
                                            </p>
                                        </div>
                                        <div class="provider">
                                            <i class="flaticon-quote"></i>
                                            <div class="info">
                                                <!-- <h4>Matthew J. Wyman</h4> -->
                                                <span> FinTech Corp</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single item -->
                            <!-- Single item -->
                            <div class="swiper-slide">
                                <div class="testimonial-style-one">
                                    <div class="item">
                                        <div class="content">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <h2>Cutting-Edge Machine Learning Expertise</h2>
                                            <p>
                                                “Their machine learning solutions have given us a competitive advantage.
                    From predictive payment models to automated CI/CD pipelines, everything was
                    delivered with precision.”
                                            </p>
                                        </div>
                                        <div class="provider">
                                            <i class="flaticon-quote"></i>
                                            <div class="info">
                                                <!-- <h4>Anthom Bu Spar</h4> -->
                                                <span>Head of Operations</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single item -->
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Testimonails  -->

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
                        <!-- <ul class="footer-social">
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
                        </ul> -->
                    </div>
                </div>
                <div class="widget address">
                    <div>
                        <ul>
                            <li>
                                <div class="content">
                                    <p>Address</p> 
                                    <strong>4500 Forbes Blvd Lanham 20706</strong>
                                </div>
                            </li>
                            <li>
                                <div class="content">
                                    <p>Email</p> 
                                    <strong>info@datapavellc.com</strong>
                                </div>
                            </li>
                            <li>
                                <div class="content">
                                    <p>Phone</p> 
                                    <strong>2404596084</strong>
                                </div>
                            </li>
                            <li>
                                <div class="content">
                                    <p>Fax</p> 
                                    <strong>2403666783</strong>
                                </div>
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

<!-- Mirrored from validthemes.net/site-template/tekni/about-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Sep 2025 11:46:58 GMT -->
</html>