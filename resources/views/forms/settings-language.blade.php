{!!
    Form::open()->route('settings.update', auth()->user()->settings->id)
        ->translate()
        ->select('language', ['en' => 'English', 'cn' => 'Chinese' ])
        ->errorBox('Form Errors')
        ->submit('Save')
        ->close()
!!}
