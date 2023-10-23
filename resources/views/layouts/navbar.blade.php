    <!-- Header 
    ============================================= -->
    <header>
      <!-- Start Navigation -->
      <nav class="navbar mobile-sidenav navbar-common navbar-sticky navbar-default validnavs">


          <div class="container d-flex justify-content-between align-items-center">            

              <!-- Start Header Navigation -->
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                      <i class="fa fa-bars"></i>
                  </button>
                  <a class="navbar-brand" href="{{route('home')}}">
                    @if (setting('site.logo') && file_exists('storage/' . setting('site.logo')))
                      <img src="{{ asset('storage/' . setting('site.logo')) }}" class="logo" alt="Logo">
                    @endif
                  </a>
              </div>
              <!-- End Header Navigation -->

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="navbar-menu">
                @if (setting('site.logo') && file_exists('storage/' . setting('site.logo')))
                  <img src="{{ asset('storage/' . setting('site.logo')) }}" alt="Logo">
                @endif
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                      <i class="fa fa-times"></i>
                  </button>
                  
                  <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                    {{ menu('navbar','layouts.nav') }}
                    @auth('client')
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-user"></i>
                          </a>
                          <ul class="dropdown-menu">
                              <li> <a class="breadcrumb-item active text-primary" href="{{ route('orders') }}"><i
                                          class="mr-2 fa-solid fa-boxes-stacked"></i>My orders </a></li>
                              <li>
                                  <a class="breadcrumb-item active text-primary" href="{{ route('logout') }}">
                                      <i class="mr-2 fa-solid fa-right-to-bracket"></i>logout
                                  </a>
                              </li>
                          </ul>
                      </li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <i class="fas fa-user"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('showLoginForm') }}">Login</a></li>
                                <li><a href="{{ route('showRegistrationForm') }}">Register</a></li>
                            </ul>
                        </li>
                    @endauth
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="fas fa-globe"></i>
                        </a>
                        <ul class="dropdown-menu">
                          <form class="d-flex" method="post" action="{{route('langs')}}" onchange="langs.submit()" id="langs">
                            @csrf
                            <select aria-label="Default select example" name="lang">
                              <li>           
                                <option value="en" {{ app()->getLocale() == 'en' ? "selected" : "" }}>@lang('frontend.languages.en')</option>
                              </li>
                              <li>           
                                <option value="it" {{ app()->getLocale() == 'it' ? "selected" : "" }}>@lang('frontend.languages.it')</option>
                              </li>
                              <li>           
                                <option value="al" {{ app()->getLocale() == 'al' ? "selected" : "" }}>@lang('frontend.languages.al')</option>
                              </li>
                              <li>           
                                <option value="ar" {{ app()->getLocale() == 'ar' ? "selected" : "" }}>@lang('frontend.languages.ar')</option>
                              </li>
                            </select>
                          </form>
                        </ul>
                    </li>
                  </ul>
              </div><!-- /.navbar-collapse -->

              <div class="attr-right">
                  <!-- Start Atribute Navigation -->
                  <div class="attr-nav">
                      <ul>
                          <li class="button"><a href="{{route('index')}}">Get consultant</a></li>
                      </ul>
                  </div>
                  <!-- End Atribute Navigation -->
              </div>

              <!-- Main Nav -->
          </div>   
          <!-- Overlay screen for menu -->
          <div class="overlay-screen"></div>
          <!-- End Overlay screen for menu -->
      </nav>
      <!-- End Navigation -->
      @include('components.searchBar')
  </header>
  <!-- End Header -->