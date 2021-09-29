@extends('layouts.welcome_layout')

@section('main')
    <welcome-layout 
        session="{{json_encode(Auth::user())}}" 
    />
@endsection