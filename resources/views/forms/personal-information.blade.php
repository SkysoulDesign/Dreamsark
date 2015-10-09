{!!
    Form::open()->route('register.update')
        ->bind(auth()->user())
        ->translate()
        ->text('first_name')
        ->text('last_name')
        ->select('gender', ['male' => 'Male', 'female' => 'Female' ])
        ->errorBox('Form Errors')
        ->submit('Save')
        ->close()
!!}

