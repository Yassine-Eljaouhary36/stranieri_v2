<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('index')}}">Navbar scroll</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          @auth('client')
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{route('orders')}}">My Orders</a>
            </li>
          @endif
        </ul>
        @auth('client')
          <a class="nav-link mr-2" href="{{route('logout')}}">
            <i class="fa-solid fa-right-to-bracket"></i>
          </a>
        @endauth
        <form class="d-flex" method="post" action="{{route('langs')}}" onchange="langs.submit()" id="langs">
            @csrf
            <select class="form-select" aria-label="Default select example" name="lang">
                <option value="en" {{ app()->getLocale() == 'en' ? "selected" : "" }}>@lang('frontend.languages.en')</option>
                <option value="it" {{ app()->getLocale() == 'it' ? "selected" : "" }}>@lang('frontend.languages.it')</option>
                <option value="al" {{ app()->getLocale() == 'al' ? "selected" : "" }}>@lang('frontend.languages.al')</option>
                <option value="ar" {{ app()->getLocale() == 'ar' ? "selected" : "" }}>@lang('frontend.languages.ar')</option>
              </select>
        </form>
      </div>
    </div>
  </nav>