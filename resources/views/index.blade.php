@extends('layouts.master')

@section('header')
    @include('layouts.huge-header')
@endsection

@section('content')

    @include('layouts.content-grid')

@endsection

@section('scripts')
    <script src="{{ asset('js/particle.js') }}"></script>
@endsection