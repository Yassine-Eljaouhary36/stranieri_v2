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
                            <a href="{{App()->communication->instagram ?? ''}}">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{App()->communication->pinterest ?? ''}}">
                                <i class="fab fa-pinterest-square"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{App()->communication->youtube ?? ''}}">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{App()->communication->linkedin ?? ''}}">
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