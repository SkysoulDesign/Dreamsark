<form class="ui form error" action="{{ route('coin.store') }}" method="post">

    {!! csrf_field() !!}

    @include('partials.field', ['name' => 'amount', 'label'=> 'Purchase Amount'])

    @include('partials.select-with-icon',
    [
        'name' => 'payment_method',
        'placeholder' => 'Select the Payment Method',
        'collection' => [
            'alipay' => ['Alipay', 'stripe icon'],
            'wechat' => ['Wechat', 'wechat icon'],
            'qq' => ['QQ', 'qq icon']
        ]
    ])

    @include('partials.errors')

    <button class="ui button" type="submit">Process</button>

</form>