@props(['globalTitle', 'secondTitle'])
<!-- Start Breadcrumb 
============================================= -->
<div class="breadcrumb-area bg-cover shadow dark text-center text-light" >
    <div class="breadcrum-shape">
        <img src="{{asset('/img/shape/50.png')}}" alt="Image Not Found">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1>{{$globalTitle}}</h1>
                <ul class="breadcrumb">
                    <li><a href="{{route('home')}}"><i class="fas fa-home"></i> Home</a></li>
                    <li>{{$secondTitle}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb -->