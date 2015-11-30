@extends('layouts.master')

@section('header')
    @include('layouts.huge-header')
@endsection

@section('content')

    @include('layouts.content-header')
    @include('layouts.content-grid')
    @include('layouts.content-2')

@endsection

@section('footer')

    @include('layouts.footer-large')

@endsection

@section('scripts')
    <script src="{{ asset('js/particle.js') }}"></script>
@endsection