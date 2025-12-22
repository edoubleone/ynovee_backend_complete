<header class="th-header header-layout1 header-absolute">
            <div class="container">
                <div class="menu-area">
                    <div class="menu-top">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-sm-between">
                                <div class="col-auto">
                                    <div class="header-logo">
                                        <a href="{{ route('home') }}">
                                            <img src="{{ asset('assets/img/BreemLogo.svg') }}" alt="Medova " />
                                        </a>
                                    </div>
                                </div>
                                <div class="col-auto d-none d-sm-block">
                                    <div class="header-info-wrap">
                                        <div class="header-info">
                                            <div class="header-info_icon">
                                                <i class="fa-solid fa-envelope"></i>
                                            </div>
                                            <div class="media-body">
                                                <span class="header-info_label">Mail</span>
                                                <p class="header-info_link">
                                                    <a href="mailto:Breemhealthcare@gmail.com">Breemhealthcare@gmail.com</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="divided"></div>
                                        <div class="header-info">
                                            <div class="header-info_icon">
                                                <i class="fa-solid fa-location-dot"></i>
                                            </div>
                                            <div class="media-body">
                                                <span class="header-info_label">Address</span>
                                                <p class="header-info_link">562 Washington Boulevard, New York</p>
                                            </div>
                                        </div>
                                        <div class="divided"></div>
                                        <div class="header-info">
                                            <div class="header-info_icon">
                                                <i class="fa-solid fa-clock"></i>
                                            </div>
                                            <div class="media-body">
                                                <span class="header-info_label">Openning Hour</span>
                                                <p class="header-info_link">09:30AM- 10:30PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="header-button">
                                        <form class="search-form">
                                            <input type="text" placeholder="Search..." />
                                            <button type="submit">
                                                <i class="fa-light fa-magnifying-glass"></i>
                                            </button>
                                        </form>

                                        <a href="#" class="icon-btn sideMenuToggler d-none d-lg-block">
                                            <img src="{{ asset('assets/img/icon/grid.svg') }}" alt="" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sticky-wrapper">
                        <div class="container">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto">
                                    <div class="header-wrapp">
                                        <div class="header-logo style1">
                                            <a href="home-medical-clinic.html">
                                                <img src="{{ asset('assets/img/BreemLogo.svg') }}" alt="Medova " />
                                            </a>
                                        </div>
                                        <nav class="main-menu style2 d-none d-lg-inline-block">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('home') }}">Home</a>
                                                </li>
                                                <li><a href="{{ route('about') }}">About Us</a></li>
                                                <li><a href="{{ route('services') }}">Services</a></li>
                                               
                                                <!-- <li> <a href="doctor-details.html">Doctors Details</a></li> -->
                                                <li><a href="{{ route('contact') }}">Contact</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="header-button d-none d-lg-block">
                                        <a href="{{ route('contact') }}" class="th-btn style2">
                                            Make Appointment
                                            <i class="fa-solid fa-calendar-days ms-2"></i>
                                        </a>
                                        <a href="{{ route('contact') }}" class="th-btn">
                                            <img src="assets/img/icon/alarm.svg" alt="" />
                                            24 Hour Emergency Aid
                                        </a>
                                    </div>
                                    <button type="button" class="th-menu-toggle d-inline-block d-lg-none">
                                        <i class="far fa-bars"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</header>