@extends('layouts.app')
@section('content')
    <meetings-manager :currentdateserver ='@json($currentDateServer)' :local='@json($local)' :days="{{ $daysWithHours->toJson() }}" :meetings="{{ $meetings->toJson() }}"></meetings-manager>
@endsection