@extends('layouts.app')
@section('content')
    <meetings-manager :days="{{ $daysWithHours->toJson() }}" :meetings="{{ $meetings->toJson() }}"></meetings-manager>
@endsection