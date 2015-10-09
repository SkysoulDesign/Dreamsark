@extends('layouts.master')

@section('content')

    <div class="column">

        <div class="ui segment">


            {!!
    Form::open()->route('register.update', auth()->user()->settings->id)
        ->translate('form')
        ->select('gender', ['en' => 'English', 'cn' => 'Chinese' ])
        ->errorBox('Form Errors')
        ->submit('Save')
        ->close()
!!}


        </div>

    </div>

@endsection