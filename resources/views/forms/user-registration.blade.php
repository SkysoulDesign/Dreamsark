{!!
    Form::open()->route('register.store')
        ->translate()
        ->text('first_name')
        ->text('last_name')
        ->select('gender', ['male' => 'Male', 'female' => 'Female' ])
        ->email('email')
        ->password('password')
        ->password('password_confirmation')
        ->errorBox('Form Errors')
        ->submit('register')
        ->close()
!!}