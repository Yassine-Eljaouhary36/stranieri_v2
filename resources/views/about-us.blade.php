@extends('layouts.app')
@section('content')
    <x-breadcrumb globalTitle="{{__('frontend.about_us')}}" secondTitle="{{__('frontend.about_us')}}" />
    <x-about-us/>
    <x-partners/>
    <x-team/>
    <x-testimonails/>
@endsection