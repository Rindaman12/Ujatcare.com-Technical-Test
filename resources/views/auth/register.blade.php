@extends('layouts.welcome_layout')

{{-- See home.blade.php for a full explanation --}}


@section('main')
    <welcome-layout 
        session="{{json_encode(Auth::user())}}" 
    />
@endsection