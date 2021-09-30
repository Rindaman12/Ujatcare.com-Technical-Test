@extends('layouts.app')

{{-- We extend our layout and pass php data as json so we can use it in the vue components --}}


@section('main')
<app-layout :user-username='@json(auth()->user()->username)'
    :user-id='@json(auth()->user()->id)'>
</app-layout>
@endsection