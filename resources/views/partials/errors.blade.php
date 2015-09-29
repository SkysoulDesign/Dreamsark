@if($errors->any())

    <div class="ui error message">
        <div class="header">{{ $header or 'Errors' }}</div>
        <ul class="list">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif