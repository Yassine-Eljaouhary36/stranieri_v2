<!-- Start Header Top 
============================================= -->
<div class="top-bar-area top-bar-style-one bg-dark text-light">
    <div class="container">
        <div class="row align-center">
            <div class="col-xl-6 col-lg-8 offset-xl-3 pl-30 pl-md-15 pl-xs-15">
                <ul class="item-flex">
                    <li>
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:{{ App()->communication->email }}">
                            {{ App()->communication->email }}
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-phone-alt"></i>
                        <a href="tel:{{ App()->communication->phone }}"> {{ App()->communication->phone }}</a>
                    </li>
                    <li>
                        <i type="button" class="fas fa-search" data-bs-toggle="modal" data-bs-target="#searchBox"></i>
                    </li>
                </ul>
            </div>
            <div class="col-xl-3 col-lg-4 text-end">
                <div class="social">
                    <ul>
                        <li>
                            <a href="{{ route('show-Details') }}" style="display: flex; align-items: center">
                                <i class="fa fa-shopping-cart " style="margin-right:5px " aria-hidden="true"></i>
                                {{__('frontend.cart')}}
                                <span
                                    class="badge bg-danger" style="margin-left:7px ">{{count((array) request()->cookie('cart'))}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{App()->communication->instagram ?? ''}}">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{App()->communication->pinterest ?? ''}}">
                                <i class="fab fa-pinterest-square"></i>
                            </a>
                        </li>
                      
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Header Top -->

<div class="top-bar-area-mobile bg-dark text-light d-md-none">
    <div class="container d-flex justify-content-center"">
        <div class="row align-center justify-content-center">
            <div class="col">
                <ul class="item-flex" style="font-size: 12px;">
                    <li>
                        <i class="fas fa-envelope" style="font-size: 15px;"></i>
                        <a href="mailto:{{ App()->communication->email }}">
                            {{ App()->communication->email }}
                        </a>
                    </li>
                    <li>
                        <i class="fas fa-phone-alt" style="font-size: 15px;"></i>
                        <a href="tel:{{ App()->communication->phone }}"> {{ App()->communication->phone }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>