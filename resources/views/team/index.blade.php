@extends('layouts.app')
@section('content')
    <x-breadcrumb globalTitle="{{__('frontend.team_members')}}" secondTitle="{{__('frontend.team_members')}}" />
    <x-team/>
@endsection