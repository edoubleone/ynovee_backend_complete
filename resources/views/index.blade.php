<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from validthemes.net/site-template/tekni/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Sep 2025 11:45:40 GMT -->
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
    <div class="top-bar-area top-bar-style-two">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-8">
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
                <div class="col-lg-4 text-end">
                    <div class="call-entry">
                        <div class="icon">
                            <i class="fas fa-comments-alt-dollar"></i>
                        </div>
                        <div class="info">
                            <p>Have any Questions?</p>
                            <h5><a href="mailto:info@crysta.com">info@datapavellc.com</a></h5>
                        </div>
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
        <nav class="navbar mobile-sidenav navbar-theme-secodnary navbar-common navbar-sticky navbar-default validnavs">

            <!-- Start Top Search -->
            <div class="top-search">
                <div class="container-xl">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                    </div>
                </div>
            </div>
            <!-- End Top Search -->


            <div class="container nav-box d-flex justify-content-between align-items-center">            

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('assets/img/logo-light-solid.png') }}" class="logo logo-display" alt="Logo">
                        <img src="{{ asset('assets/img/logo.png') }}" class="logo logo-scrolled" alt="Logo">
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Main Nav -->
                <div class="main-nav-content">
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-menu">

                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-times"></i>
                        </button>
                        
                        <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                            <li><a href="{{ route('home') }}" class="dropdown-toggle" data-toggle="dropdown">Home</a> </li>
                            <li class=""><a href="{{ route('about') }}" class="dropdown-toggle" data-toggle="dropdown">About</a> </li>          
                            </li>
                            <li><a href="{{ route('services') }}" class="dropdown-toggle" data-toggle="dropdown" >Services</a>                             </li>
                           
                            <li><a href="{{ route('contact') }}">contact</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->

                    <div class="attr-right">
                        <!-- Start Atribute Navigation -->
                        <div class="attr-nav attr-box">
                            <ul>
                                <li class="search"><a href="#"><i class="far fa-search"></i></a></li>
                                <li class="side-menu">
                                <a href="#">
                                    <span class="bar-1"></span>
                                    <span class="bar-2"></span>
                                    <span class="bar-3"></span>
                                </a>
                            </li>
                            </ul>
                        </div>
                        <!-- End Atribute Navigation -->
                    </div>

                    <!-- Start Side Menu -->
                    <div class="side">
                        <a href="#" class="close-side"><i class="icon_close"></i></a>
                        <div class="widget">
                            <div class="logo">
                                <img src="{{ asset('assets/img/logo-light-solid.png') }}" alt="Logo">
                            </div>
                            <p>
                                Our company specializes in delivering cutting-edge Data Engineering & Analytics services tailored to help organizations leverage data for optimal decision-making. We excel in building scalable data architectures, implementing machine learning (ML) models, automating data pipelines, and ensuring compliance with industry standards. 
                            </p>
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
                        <div class="widget newsletter">
                            <h4>Get Subscribed!</h4>
                            <form action="#">
                                <div class="input-group stylish-input-group">
                                    <input type="email" placeholder="Enter your e-mail" class="form-control" name="email">
                                    <span class="input-group-addon">
                                        <button type="submit">
                                            <i class="arrow_right"></i>
                                        </button>  
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div class="widget social">
                            <ul class="link">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                            </ul>
                        </div>

                    </div>
                    <!-- End Side Menu -->
                    

                    <!-- Overlay screen for menu -->
                    <div class="overlay-screen"></div>
                    <!-- End Overlay screen for menu -->

                </div>
                <!-- Main Nav -->

            </div>   
            <!-- Overlay screen for menu -->
            <div class="overlay-screen"></div>
            <!-- End Overlay screen for menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Header -->

    <!-- Start Banner Area 
    ============================================= -->
   <div class="banner-area banner-style-one shadow zoom-effect overflow-hidden text-light">
        <!-- Slider main container -->
        <div class="banner-fade">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">

                <!-- Single Item -->
                <div class="swiper-slide banner-style-one">
                    <div class="banner-thumb bg-cover shadow theme" style="background: url(assets/img/banner/1.jpg);"></div>
                    <div class="container">
                        <div class="row align-center">
                            <div class="col-xl-8 offset-xl-4">
                                <div class="content">
                                    <h4>Data Innovation</h4>
<h2>Turning Complex Data into Scalable Solutions</h2>

                                    <div class="button mt-40">
                                        <a class="btn btn-theme btn-md radius animation" href="{{ route('about') }}">Discover More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shape -->
                    <div class="banner-shape-bg">
                        <img src="{{ asset('assets/img/shape/1.png') }}" alt="Shape">
                    </div>
                    <!-- End Shape -->
                </div>
                <!-- End Single Item -->

                <!-- Single Item -->
                <div class="swiper-slide banner-style-one">
                    <div class="banner-thumb bg-cover shadow theme" style="background: url(assets/img/banner/2.jpg);"></div>
                    <div class="container">
                        <div class="row align-center">
                            <div class="col-xl-8 offset-xl-4">
                                <div class="content">
                                    <h4>Advanced Analytics</h4>
<h2>Empowering Businesses with Data-Driven Insights</h2>

                                    <div class="button mt-40">
                                        <a class="btn btn-theme btn-md radius animation" href="{{ route('about') }}">Discover More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shape -->
                    <div class="banner-shape-bg">
                        <img src="{{ asset('assets/img/shape/1.png') }}" alt="Shape">
                    </div>
                    <!-- End Shape -->
                </div>
                <!-- End Single Item -->

            </div>

            <!-- Navigation -->
            <div class="swiper-button-prev">
                <i class="fas fa-angle-left"></i>
            </div>
            <div class="swiper-button-next">
                <i class="fas fa-angle-right"></i>
            </div>

        </div>  
    </div>
    <!-- End Main -->


    <!-- Start Features 
    ============================================= -->
    <!--  -->
    <!-- End Features -->

    <!-- Start About 
    ============================================= -->
    <div class="about-style-three-area overflow-hidden default-padding-top shape-light-bottom">
        <!-- <div class="shape-right-bottom-actual">
            <img src="assets/img/shape/51.html" alt="Image Not Found">
        </div> -->
        <div class="container">
            <div class="row">

                <div class="col-lg-6 about-style-three">
                    <h4 class="sub-title">About Company</h4>
                    <h2 class="title split-text">Building Scalable Data Solutions for Growth</h2>
                    <div class="thumb mt-10 mt-xs-15">
                        <img src="{{ asset('assets/img/banner/9.jpg') }}" alt="Image Not Found">
                       
                    </div>
                </div>

                <div class="col-lg-5 offset-lg-1 about-style-three">
                 
                    <p class="wow fadeInUp">
                        Our company specializes in delivering cutting-edge Data Engineering & Analytics services tailored to help organizations leverage data for optimal decision-making. We excel in building scalable data architectures, implementing machine learning (ML) models, automating data pipelines, and ensuring compliance with industry standards. 
                    </p>
                    <div class="mt-50 mt-xs-30">
                        <div class="list-item-style-two wow fadeInUp">
                            <div class="number"><i class="fas fa-check"></i></div>
                            <div class="info">
                                <h4>Our Team</h4>
                                <p>
                                    Our team utilizes the latest cloud technologies and best practices to drive business growth and operational efficiency.
                                </p>
                            </div>
                        </div>
                        <div class="list-item-style-two wow fadeInUp" data-wow-delay="500ms">
                            <div class="number"><i class="fas fa-check"></i></div>
                            <div class="info">
                                <h4>Our Vision</h4>
                                <p>
                                    To be the trusted global leader in data engineering and analytics, empowering organizations to transform raw data into actionable intelligence. We envision a future where businesses of all sizes can seamlessly leverage cloud technologies, automation, and machine learning to drive innovation, achieve operational excellence, and make confident data-driven decisions
                                </p>
                            </div>
                        </div>
                    </div>

                  

                </div>

            </div>
        </div>



    </div>
    <!-- End About -->

    <div class="services-style-five-area default-padding bottom-less">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4 class="sub-title">What we do</h4>
                        <h2 class="title split-text">Data-Driven Solutions That Power Business Growth</h2>

                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <!-- Single Item -->
                <div class="col-xl-4 col-lg-6 col-md-6 mb-30 services-style-five hover-active-item active">
                    <div class="item">
                        <!-- <div class="shape">
                            <img src="assets/img/shape/25.html" alt="Image Not Found">
                        </div> -->
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/34.png') }}" alt="Image Not Found">
                        </div>
                        <h4><a href="#">Data Engineering & Pipelines:</a></h4>
                        
                        <ul>
                            <li><p>Design and implement scalable ETL/ELT workflows</p></li>
                            <li><p>Expertise in tools such as Python, Apache Airflow, DBT, Databricks, and Apache Beam for data processing.</p></li>
                            <li><p>Proficiency in cloud-native tools like DataFlow and Data Fusion for robust, efficient data pipelines.</p></li>
                        </ul>
                    </div>
                </div>
                <!-- End Single Item -->
                <!-- Single Item -->
                <div class="col-xl-4 col-lg-6 col-md-6 mb-30 services-style-five hover-active-item">
                    <div class="item">
                        <!-- <div class="shape">
                            <img src="assets/img/shape/25.html" alt="Image Not Found">
                        </div> -->
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/35.png') }}" alt="Image Not Found">
                        </div>
                        <h4><a href="#">Machine Learning & Automation</a></h4>
                    
                         <ul>
                            <li><p>Development and deployment of predictive ML models using Python and Apache Spark.</p></li>
                            <li><p>Creation of automated CI/CD pipelines with GitHub Actions for streamlined workflows.</p></li>
                            <li><p>Specialized in automating processes for regulated environments, ensuring compliance with standards.</p></li>
                        </ul>
                    </div>
                </div>
                <!-- End Single Item -->
                <!-- Single Item -->
                <div class="col-xl-4 col-lg-6 col-md-6 mb-30 services-style-five hover-active-item">
                    <div class="item">
                        <!-- <div class="shape">
                            <img src="assets/img/shape/25.html" alt="Image Not Found">
                        </div> -->
                        <div class="icon">
                            <img src="{{ asset('assets/img/icon/36.png') }}" alt="Image Not Found">
                        </div>
                        <h4><a href="#">Data Visualization & Insights:</a></h4>
                        
                        <ul>
                            <li><p>Development of interactive dashboards with PowerBI and Metabase to present actionable insights.</p></li>
                            <li><p>Transform raw data into meaningful business intelligence that supports growth and strategic decisions.</p></li>
                        
                        </ul>
                    </div>
                </div>
                <!-- End Single Item -->
            </div>
        </div>
          <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <a class="btn btn-theme btn-md radius animation wow fadeInUp" href="{{ route('services') }}">View all services</a>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Services 
    ============================================= -->
    <!-- -->
    <!-- End Services -->

    <!-- Start Technology Index 
    ============================================= -->
    <!-- <div class="technology-index-area default-padding bg-dark text-light" style="background-image: url(assets/img/shape/20.html);">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-6 pr-60 pr-md-15 pr-xs-15">
                    <div class="thumb-style-one wow fadeInRight">
                        <img src="assets/img/about/1.html" alt="Image Not Found">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4 class="sub-title">Technology Index</h4>
                    <h2 class="title split-text">We’re using latest technology in projects</h2>
                    <div class="wow fadeInUp" data-wow-delay="100ms">
                        <p>
                           Our company specializes in delivering cutting-edge Data Engineering & Analytics services tailored to help organizations leverage data for optimal decision-making. We excel in building scalable data architectures, implementing machine learning (ML) models, automating data pipelines, and ensuring compliance with industry standards. 
                        </p>
                        <ul class="tech-index-items">
                            <li>
                                <a href="#">
                                    <div class="left">
                                        <div class="icon">
                                            <i class="fab fa-android"></i>
                                        </div>
                                        <h4>Android</h4>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="left">
                                        <div class="icon">
                                            <i class="fab fa-apple"></i>
                                        </div>
                                        <h4>IOS</h4>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="left">
                                        <div class="icon">
                                            <i class="fas fa-robot"></i>
                                        </div>
                                        <h4>AI</h4>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="left">
                                        <div class="icon">
                                            <i class="fas fa-router"></i>
                                        </div>
                                        <h4>IOT</h4>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End Technology Index  -->

    <!-- Start Team 
    ============================================= -->

    <!-- End Team -->

        <!-- Start Partner Area  
    ============================================= -->
   <div class="project-style-one-area default-padding bg-gradient bottom-shape-light">
        <div class="container">
            <div class="heading-left text-light">
                <div class="row">
                    <div class="col-xl-5 col-lg-7">
                        <div class="content-left">
                            <h5 class="sub-title">Popular Projects</h5>
                            <h2 class="title split-text">Our most recent Completed Projects</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Slider main container -->
                    <div class="project-style-one-carousel swiper wow fadeInUp">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">

                            <!-- Single Item -->
                            <div class="swiper-slide">
                                <div class="project-style-one">
                                    <div class="row align-bottom">
                                        <div class="col-lg-7 pr-0 pr-md-15 pr-xs-15 pl-md-15 pl-xs-15">
                                            <div class="thumb">
                                                <img src="{{ asset('assets/img/projects/1.jpg') }}" alt="Image Not Found">
                                            </div>
                                        </div>
                                        <div class="col-lg-5 pl-0 pl-md-15 pl-xs-15 pr-md-15 pr-xs-15">
                                            <div class="info">
                                                <span></span>
                                                <h2><a href="project-details.html">Real-Time Data Infrastructure </a></h2>
                                                <p>
                                                    Built scalable data pipelines using PySpark, Snowflake, and DBT to enable real-time data processing, resulting in faster, more accurate business decisions.
                                                </p>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Item -->

                            <!-- Single Item -->
                            <div class="swiper-slide">
                                <div class="project-style-one">
                                    <div class="row align-bottom">
                                        <div class="col-lg-7 pr-0 pr-md-15 pr-xs-15 pl-md-15 pl-xs-15">
                                            <div class="thumb">
                                                <img src="{{ asset('assets/img/projects/2.jpg') }}" alt="Image Not FOund">
                                            </div>
                                        </div>
                                        <div class="col-lg-5 pl-0 pl-md-15 pl-xs-15 pr-md-15 pr-xs-15">
                                            <div class="info">
                                                <span>Artificial Intelligence</span>
                                                <h2><a href="">Predictive ML Models </a></h2>
                                                <p>
                                                   Developed and deployed payment likelihood models, improving payment recovery effectiveness by 20%, leading to significant business improvements.
                                                </p>
                                               
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                             <div class="swiper-slide">
                                <div class="project-style-one">
                                    <div class="row align-bottom">
                                        <div class="col-lg-7 pr-0 pr-md-15 pr-xs-15 pl-md-15 pl-xs-15">
                                            <div class="thumb">
                                                <img src="{{ asset('assets/img/projects/2.jpg') }}" alt="Image Not FOund">
                                            </div>
                                        </div>
                                        <div class="col-lg-5 pl-0 pl-md-15 pl-xs-15 pr-md-15 pr-xs-15">
                                            <div class="info">
                                                <span>Artificial Intelligence</span>
                                                <h2><a href="project-details.html">Enterprise-Grade Integrations</a></h2>
                                                <p>
                                                   Integrated enterprise systems with external data sources to create unified data environments for seamless analysis and reporting.
                                                </p>

                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- Single Item -->

                        </div>

                        <!-- Navigation -->
                        <div class="project-swiper-nav">

                            <!-- Pagination -->
                            <div class="project-pagination"></div>

                            <div class="project-button-prev"></div>
                            <div class="project-button-next"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Partner Area -->

    <!-- Start Mission & Vision 
    ============================================= -->
    <div class="mission-vision-style-one-area bg-cover bg-gray overflow-hidden default-padding" data-bg-image="{{ asset('assets/img/shape/22.html') }}">

        <div class="shape-top-left">
            <img src="{{ asset('assets/img/shape/47.png') }}" alt="Shape">
        </div>


        <div class="container">
            <div class="row align-center">

                <div class="col-lg-6">

                    <div class="nav nav-tabs mission-tab-navs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-id-1" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true">
                            Our Team
                        </button>
                        <button class="nav-link" id="nav-id-2" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">
                            Our Vision
                        </button>
                    </div>

                    <div class="tab-content mission-tab-content" id="nav-tabContent">
                        <!-- Tab Single Item -->
                        <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="nav-id-1">
                            <h2 class="title split-text">Driven by Passion, Guided by Data</h2>
                            <div class="wow fadeInUp" data-wow-delay="100ms">
                                <p>
                                   Our team utilizes the latest cloud technologies and best practices to drive business growth and operational efficiency.
                                </p>
                                <!-- Progress Bar Start -->
                                <!-- <div class="progress-style-one">
                                    <div class="progress-box">
                                        <h5>Our capabilities</h5>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" data-width="70">
                                                 <span>70%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress-box">
                                        <h5>Our responsible</h5>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" data-width="85">
                                                <span>85%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- End Progressbar -->
                            </div>
                        </div>
                        <!-- End Tab Single Item -->

                        <!-- Tab Single Item -->
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="nav-id-2">
                            <h2 class="title">Shaping Intelligence, Empowering Growth</h2>
                            <p>
                                To be the trusted global leader in data engineering and analytics, empowering organizations to transform raw data into actionable intelligence. We envision a future where businesses of all sizes can seamlessly leverage cloud technologies, automation, and machine learning to drive innovation, achieve operational excellence, and make confident data-driven decisions
                            </p>
                        
                        </div>
                        <!-- End Tab Single Item -->
                    </div>


                </div>

                <div class="col-lg-6 pl-100 pl-md-15 pl-xs-15 mt-md-50 mt-xs-40">
                    <div class="thumb-style-two">
                        <img class="wow fadeInUp" src="{{ asset('assets/img/about/7.jpg') }}" alt="Image Not Found">
                        <div class="card-style-one wow fadeInDown" data-wow-delay="100ms">
                            <div class="icon">
                                <img src="{{ asset('assets/img/icon/16.png') }}" alt="Image Not Found">
                            </div>
                            <h4>Innovative IT Solutions for the Modern Workplace</h4>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- End Mission & Vision  -->

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

    <!-- Start Blog 
    ============================================= -->
 
    <!-- End Blog  -->

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
                                    <a href="about-us.html">Home</a>
                                </li>
                                <li>
                                    <a href="faq.html">About Us</a>
                                </li>
                                <li>
                                    <a href="about-us.html">Service</a>
                                </li>
                                <li>
                                    <a href="pricing.html">Contact</a>
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

</body>

<!-- Mirrored from validthemes.net/site-template/tekni/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Sep 2025 11:45:55 GMT -->
</html>