  <div class="sidemenu-wrapper shopping-cart">
            <div class="sidemenu-content">
                <button class="closeButton sideMenuCls">
                    <i class="far fa-times"></i>
                </button>
            </div>
        </div>
        <div class="sidemenu-wrapper">
            <div class="sidemenu-content">
                <button class="closeButton sideMenuCls">
                    <i class="far fa-times"></i>
                </button>
                <div class="widget footer-widget mb-0">
                    <div class="th-widget-about">
                        <!-- <div class="about-logo">
                            <a href="index.html"><img src="assets/img/logo.svg" alt="Medova " /></a>
                        </div> -->
                        <p class="about-text">
                            Breem Healthcare delivers compassionate, personalized care, treating every patient like family with innovative solutions and a commitment to excellence.
                        </p>
                    </div>
                </div>

                <div class="widget footer-widget">
                    <h3 class="widget_title">Social Media:</h3>
                    <div class="th-social">
                        <a href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com/Breemhealthcare?t=e5WMs_tGhI9a-MQItUejlw&s=09"><i class="fab fa-twitter"></i></a>
                        <a href="https://pinterest.com/"><i class="fab fa-pinterest-p"></i></a>
                        <a href="https://linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.instagram.com/breemhealthcare?igsh=MWRsMXQzeGI1YXpubA=="><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup-search-box d-none d-lg-block">
            <button class="searchClose"><i class="fal fa-times"></i></button>
            <form action="#">
                <input type="text" placeholder="What are you looking for?" />
                <button type="submit"><i class="fal fa-search"></i></button>
            </form>
        </div>
        <div class="th-menu-wrapper">
            <div class="th-menu-area text-center">
                <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
                <div class="mobile-logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/img/BreemLogo.svg') }}" alt="BreemHealthcare " /></a>
                </div>
                <div class="th-mobile-menu">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li class="menu-item-has-children">
                            <a href="{{ route('services') }}">Services</a>
                        </li>
                  
                       
                    </ul>
                </div>
            </div>
        </div>