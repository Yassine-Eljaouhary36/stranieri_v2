@push('styles')
<style>
    .select-lang .selected {
        border-radius: 3px;
        border: 1px dashed #5d4190;
       color: #5d4190;
    }
    .nice-select.open .list {
        padding: 5px;
    }
</style>
@endpush
<header>
  <nav
      class="navbar mobile-sidenav navbar-style-one navbar-sticky navbar-default validnavs white navbar-fixed no-background">
      <div class="container-fluid">
          <div class="row align-center">
              <div class="col">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                          <i class="fa fa-bars"></i>
                      </button>
                      <a class="navbar-brand" href="/">
                          <img  src="{{ asset('storage/' . setting('site.logo')) }}" alt="logo">
                      </a>
                      <i type="button" class="fas fa-search search-btn float-end d-md-none" data-bs-toggle="modal"
                          data-bs-target="#searchBox"></i>
                  </div>
              </div>
              <div class="col-xl-7 offset-xl-1 col-lg-7 col-md-4 col-sm-4 col-0">
                  <div class="collapse navbar-collapse" id="navbar-menu">
                      <img src="{{ asset('storage/' . setting('site.logo')) }}" alt="Logo">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                          <i class="fa fa-times"></i>
                      </button>
                      <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                          {{ menu('navbar', 'layouts.nav') }}
                            <li class="text-left d-lg-none">
                                <a class="button"
                                href="{{route('show-contact')}}">{{__('frontend.contact_us')}}</a>
                            </li>
                          @auth('client')
                              <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                          class="fas fa-user"></i></a>
                                  <ul class="dropdown-menu">
                                      <li> <a class="breadcrumb-item active text-primary" href="{{ route('orders') }}"><i
                                                  class="mr-2 fa-solid fa-boxes-stacked"></i>{{__('meeting_order.orders')}} </a></li>
                                      <li>
                                          <a class="breadcrumb-item active text-primary" href="{{ route('logout') }}">
                                              <i class="mr-2 fa-solid fa-right-to-bracket"></i>{{__('register_login.Logout')}}
                                          </a>
                                      </li>
                                  </ul>
                              </li>
                          @else
                              <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                          class="fas fa-user"></i></a>
                                  <ul class="dropdown-menu">
                                      <li><a href="{{ route('showLoginForm') }}">{{__('register_login.Login')}}</a></li>
                                      <li><a href="{{ route('showRegistrationForm') }}">{{__('register_login.register')}}</a></li>
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
                          <select aria-label="Default select example" name="lang" class="select-lang">
                            <li>           
                              <option style="padding: 5px" value="en" {{ app()->getLocale() == 'en' ? "selected" : "" }}>@lang('frontend.languages.en')</option>
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
                  </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-6 col-sm-7 col-7">
                  <div class="attr-right">
                      <div class="attr-nav">
                          <ul>
                            <li class="button">
                              <a
                                href="{{route('show-contact')}}">{{__('frontend.contact_us')}}</a>
                            </li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
          <div class="overlay-screen"></div>
      </div>
  </nav>
  @include('components.searchBar')
</header>

@if (request()->cookie('cart') && count((array) request()->cookie('cart')) > 0 && !in_array(Route::currentRouteName(), ['showRegistrationForm', 'showLoginForm','show-Details']) )
    <a class="cart-btn d-lg-none d-block" href="{{ route('show-Details') }}" style="display: flex; align-items: center">
        <i class="fa fa-shopping-cart mr-1" aria-hidden="true"></i>
        Cart
        <span class="badge bg-danger">{{count((array) request()->cookie('cart'))}}</span>
    </a>
    @push('styles')
        <style>
            .cart-btn {
                position: fixed;
                bottom: 10px;
                right: 15px;
                z-index: 999;
                padding: 10px 20px;
                background: #fff;
                border-radius: 5px;
                border: 1px solid #ddd;
                box-shadow: 0 0 5px #ddd;
            }
        </style>
    @endpush
@else
    @if (!in_array(Route::currentRouteName(), ['showRegistrationForm', 'showLoginForm','index', 'services','show-Details','order']))
        <a class="bookNow-btn" href="{{ route('index') }}" style="display: flex; align-items: center">
            <i class="fas fa-calendar" style="margin-right: 5px"></i> {{__('frontend.book_an_appointment')}}
        </a>
        @push('styles')
            <style>
                .bookNow-btn {
                    position: fixed;
                    bottom: 10px;
                    right: 15px;
                    z-index: 999;
                    padding: 10px 20px;
                    border-radius: 5px;
                    box-shadow: 0 1px 0 0 #fff6af !important;
                    background: linear-gradient(180deg,#ffec64 5%,#ffab23) !important;
                    background-color: #ffec64 !important;
                    border: 1px solid #fa2 !important;
                    color: #333 !important;
                }
            </style>
        @endpush
    @endif
@endif