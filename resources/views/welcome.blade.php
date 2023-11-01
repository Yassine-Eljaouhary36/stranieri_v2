@extends('layouts.app')
@section('content')
    <x-breadcrumb globalTitle="{{__('meeting_order.Make_Appointment')}}" secondTitle="{{__('meeting_order.Make_Appointment')}}" />
    <div id="app">
        <meetings-manager :currentdateserver ='@json($currentDateServer)' :local='@json($local)' :days="{{ $daysWithHours->toJson() }}" :meetings="{{ $meetings->toJson() }}"></meetings-manager>
    </div>
@endsection