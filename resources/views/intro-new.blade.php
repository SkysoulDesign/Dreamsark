@extends('layouts.master', ['topBar' => false])

@section('content')

    <div id="container"></div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/intro.js') }}"></script>
@endsection