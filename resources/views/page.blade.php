@extends('layouts.app')
@section('content')
<x-breadcrumb globalTitle="{{$page->title}}" secondTitle="{{$page->title}}" />
<div class="container-fluid bg-white py-5">
    <div class="container">
        <div class="row"> 
            <div class="col" style="{{ app()->getLocale() == 'ar' ? "direction: rtl;" : "" }}">
                @if (is_file(public_path().'/storage/'.$page->image))
                <div class="text-center pb-5">
                    <img src="{{ Voyager::image($page->image) }}" class="rounded img-fluid" alt="No picture" title="{{ $page->title }}"
                    style="width: 90% ; max-height: 500px">
                </div>
                @endif
                <h3 class="card-title font-weight-bold service-text">{{ $page->title }} </h3>
                <div class="service-text overflow-auto">
                    {!! $page->body !!}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection