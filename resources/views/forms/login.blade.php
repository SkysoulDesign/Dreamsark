{!!
    Form::open()->route('login.store')
        ->translate()
        ->email('email')
        ->password('password')
        ->errorBox('Hello world')
        ->submit('login')
        ->close()
!!}

