@extends('layouts.app')

@section('main')
<app-layout :user-username='@json(auth()->user()->username)'
    :user-id='@json(auth()->user()->id)'>
</app-layout>
@endsection