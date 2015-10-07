@extends('layouts.master')

@section('content')

    <div class="column">

        <div class="ui segment">


            {!!


            Form::open()->action(route('register.store'))
                ->text('first_name')->appendWrapperClass('blue')
                ->submit('Send')
                ->close()

             !!}


        </div>

    </div>

@endsection