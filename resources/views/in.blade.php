@extends('layouts.basic')

@section('content')

    <section class="start">

        <div class="body">

            <div class="logo">
                <svg class="svg-dreamsark" viewBox="0 0 612 792">
                    <path d="M526.4,308.9c-18.6,0-33.7-15.1-33.7-33.7c0-6.6,1.9-12.7,5.1-17.9L327.7,151.4c-4.7,7.6-13.2,12.7-22.8,12.7
	c-9.6,0-18-5-22.8-12.6L113.1,257.3c3.3,5.2,5.1,11.3,5.1,17.9c0,18.6-15.1,33.7-33.7,33.7l0,201.1c14.8,0,26.9,12,26.9,26.9
	c0,4.7-1.2,9-3.3,12.8l167.2,91c5.7-10.5,16.8-17.6,29.6-17.6c12.8,0,23.9,7.1,29.7,17.6l168.2-91.1c-2.1-3.8-3.2-8.2-3.2-12.8
	c0-14.8,12-26.9,26.9-26.9L526.4,308.9C526.4,308.9,526.4,308.9,526.4,308.9z"/>
                </svg>
            </div>

            <button class="white round medium">Start Journey</button>
            <button class="white round medium">Skip</button>

        </div>

    </section>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/start.js') }}"></script>
@endsection