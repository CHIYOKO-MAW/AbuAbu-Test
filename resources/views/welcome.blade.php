@extends('layouts.app')

@section('title', config('abuabu.brand.name'))
@section('description', config('abuabu.brand.description'))

@section('content')
    @include('home.index')
@endsection
