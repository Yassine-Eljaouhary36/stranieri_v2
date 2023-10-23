@extends('layouts.app')
@section('content')
    <div id="app">
        <meetings-manager :currentdateserver ='@json($currentDateServer)' :local='@json($local)' :days="{{ $daysWithHours->toJson() }}" :meetings="{{ $meetings->toJson() }}"></meetings-manager>
    </div>
@endsection