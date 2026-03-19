<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from validthemes.net/site-template/tekni/services.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Sep 2025 11:46:58 GMT -->
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
                            <a class="navbar-brand" href="{{ route('home') }}">
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
                                    <a href="{{ route('home') }}" >Home</a>
                                  
                                </li>
                                <li>
                                    <a href="{{ route('about') }}" >About</a>
                                   
                                </li>
                                <li >
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
                    <h1>Our Services</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li>Services</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Start Servics Style One 
    ============================================= -->
    <div class="services-style-one-area default-padding bg-gray bg-cover" data-bg-image="{{ asset('assets/img/shape/banner.jpg') }}">
        <div class="center-shape" data-bg-image="{{ asset('assets/img/shape/5.png') }}"></div>
        <div class="service-style-one-items">
            <div class="container">

                <div class="row align-center">
                     <!-- Single Item -->
                     <div class="col-lg-8 mb-30 mb-xs-50 mb-md-50">
                        <h4 class="sub-title">What we do</h4>
                        <h2 class="title split-text">Data-Driven Solutions That Transform Your Business</h2>

                       
                    </div>
                    <!-- Single Item -->
                    <!-- Single Item -->
                    <div class="col-lg-4 mb-30">
                        <div class="services-style-one-item wow fadeInUp" id="data-engineering">
                            <div class="icon">
                                <img src="{{ asset('assets/img/icon/1.png') }}" alt="Image Not Found">
                            </div>
                            <h4><a href="#data-engineering">Data Engineering & Pipelines</a></h4>
                             <ul class="list-style-one" style="margin-bottom: 15px;">
                                <li>Design and implement scalable ETL/ELT workflows.</li>
                                <li>Expertise in tools such as Python, Apache Airflow, DBT, Databricks, and Apache Beam for data processing.</li>
                                <li>Proficiency in cloud-native tools like DataFlow and Data Fusion for robust, efficient data pipelines..</li>
                           
                            </ul>
                           
                        </div>
                    </div>
                    <!-- Single Item -->
                </div>

                <div class="row align-center">
                    <!-- Single Item -->
                    <div class="col-lg-4 mb-30">
                        <div class="services-style-one-item wow fadeInUp" data-wow-delay="100ms" id="cloud-platforms">
                            <div class="icon">
                                <img src="{{ asset('assets/img/icon/2.png') }}" alt="Image Not Found">
                            </div>
                              <ul style="margin-bottom: 15px;">
                                <h4><a href="#cloud-platforms">Cloud Platform</a></h4>
                            <ul class="list-style-one" style="margin-bottom: 15px;">
                                <li>Deep expertise in leading cloud platforms including AWS, Azure, and GCP.</li>
                                <li>Experience in migrating workloads to the cloud, automating infrastructure, and optimizing cloud costs to improve operational efficiency.</li>
                           
                            </ul>
                        </div>
                    </div>
                    <!-- Single Item -->
                    <!-- Single Item -->
                    <div class="col-lg-4 mb-30">
                        <div class="services-style-one-item wow fadeInUp" data-wow-delay="200ms" id="machine-learning">
                            <div class="icon">
                                <img src="{{ asset('assets/img/icon/3.png') }}" alt="Image Not Found">
                            </div>
                            <h4><a href="#machine-learning">Machine Learning & Automation</a></h4>
                              <ul style="margin-bottom: 15px;">
                            <ul class="list-style-one" style="margin-bottom: 15px;">
                                <li>Development and deployment of predictive ML models using Python and Apache Spark.</li>
                                <li>Creation of automated CI/CD pipelines with GitHub Actions for streamlined workflows.</li>
                                <li>Specialized in automating processes for regulated environments, ensuring compliance with standards.</li>
                            </ul>
                            
                        </div>
                    </div>
                    <!-- Single Item -->
                    <!-- Single Item -->
                    <div class="col-lg-4 mb-30">
                        <div class="services-style-one-item wow fadeInUp" data-wow-delay="300ms" id="apis">
                            <div class="icon">
                                <img src="{{ asset('assets/img/icon/4.png') }}" alt="Image Not Found">
                            </div>
                            <h4><a href="#apis">APIs & Integrations:</a></h4>
                            <ul style="margin-bottom: 15px;">
                            <ul class="list-style-one" style="margin-bottom: 15px;">
                                <li>Design and implement scalable ETL/ELT workflows.</li>
                                <li>Expertise in tools such as Python, Apache Airflow, DBT, Databricks, and Apache Beam for data processing.</li>
                                <li>Proficiency in cloud-native tools like DataFlow and Data Fusion for robust, efficient data pipelines.</li>
                            </ul>
                          
                        </div>
                    </div>
                    <div class="col-lg-4 mb-30">
                        <div class="services-style-one-item wow fadeInUp" data-wow-delay="300ms" id="data-visualization">
                            <div class="icon">
                                <img src="{{ asset('assets/img/icon/4.png') }}" alt="Image Not Found">
                            </div>
                            <h4><a href="#data-visualization">Data Visualization & Insights:</a></h4>
                             <ul style="margin-bottom: 15px;">
                            <ul class="list-style-one" style="margin-bottom: 15px;">
                                <li>Development of interactive dashboards with PowerBI and Metabase to present actionable insights.</li>
                                <li>Transform raw data into meaningful business intelligence that supports growth and strategic decisions.</li>
                                
                            </ul>
                          
                           
                        </div>
                    </div>
                    <div class="col-lg-4 mb-30">
                        <div class="services-style-one-item wow fadeInUp" data-wow-delay="300ms" id="compliance-security">
                            <div class="icon">
                                <img src="{{ asset('assets/img/icon/4.png') }}" alt="Image Not Found">
                            </div>
                            <h4><a href="#compliance-security">Compliance & Security</a></h4>
                              <ul style="margin-bottom: 15px;">
                            <ul class="list-style-one" style="margin-bottom: 15px;">
                                <li>Strong focus on aligning data infrastructure with data governance and privacy regulations.</li>
                                <li>Implementation of security best practices to safeguard sensitive information and ensure compliance with relevant industry standards.</li>
                                
                            </ul>
                        </div>
                    </div>
                   
                    <!-- Single Item -->
                </div>

            </div>
        </div>
        
    </div>
    <!-- End Services Style One -->

    <!-- Start Process
    ============================================= -->
 
    <!-- End Process -->

    <!-- Start Partner Area  
    ============================================= -->
    <!-- <div class="partner-style-one-area default-padding bg-gray bg-cover" style="background-image: url(assets/img/shape/banner.jpg);">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-5">
                    <div class="partner-map wow fadeInUp" style="background-image: url(assets/img/shape/map.png);">
                        <h2 class="mask-text" style="background-image: url(assets/img/banner/6.jpg);">80</h2>
                        <h4>Partners in world wide</h4>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="partner-items wow fadeInUp" data-wow-delay="150ms">
                        <ul>
                            <li><img src="assets/img/logo/1.png" alt="Image Not FOund"></li>
                            <li><img src="assets/img/logo/2.png" alt="Image Not FOund"></li>
                            <li><img src="assets/img/logo/7.png" alt="Image Not FOund"></li>
                            <li><img src="assets/img/logo/4.png" alt="Image Not FOund"></li>
                            <li><img src="assets/img/logo/5.png" alt="Image Not FOund"></li>
                            <li><img src="assets/img/logo/6.png" alt="Image Not FOund"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End Partner Area -->

    <!-- Start Team 
    ============================================= -->
    
    <!-- End Team Area -->

    <!-- Start Request Call Back 
    ============================================= -->
    <div class="request-call-back-area bg-dark text-light default-padding">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-6">
                    <h2 class="title split-text">Ready to Transform Your Data Strategy?</h2>

                    <a class="btn btn-theme btn-md radius animation wow fadeInUp" data-wow-delay="100ms" href="{{ route('contact') }}">Request a Call</a>
                </div>
                <div class="col-lg-6 text-end">
                    <div class="achivement-counter text-light">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Request Call Back  -->

    <!-- Start Pricing 
    ============================================= -->
    
    <!-- End Pricng -->

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
                                    <a href="{{ route('services') }}#data-engineering">Data Engineering & Pipelines</a>
                                </li>
                                <li>
                                    <a href="{{ route('services') }}#cloud-platforms">Cloud Platforms</a>
                                </li>
                                <li>
                                    <a href="{{ route('services') }}#machine-learning">Machine Learning & Automation</a>
                                </li>
                                <li>
                                    <a href="{{ route('services') }}#apis">APIs & Integrations</a>
                                </li>
                                <li>
                                    <a href="{{ route('services') }}#data-visualization">Data Visualization & Insights</a>
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
                    <div class="col-lg-6 text-end">
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
            // Set background images for elements with data-bg-image attribute
            const bgElements = document.querySelectorAll('[data-bg-image]');
            bgElements.forEach(function(element) {
                element.style.backgroundImage = `url(${element.dataset.bgImage})`;
            });
        });
    </script>
</body>

<!-- Mirrored from validthemes.net/site-template/tekni/services.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Sep 2025 11:46:58 GMT -->
</html>