<div class="field @if($errors->has($name)) error @endif">
    <label>{{ $label or ucwords(str_replace('_', ' ', $name)) }}</label>

    <div class="ui fluid search selection dropdown">
        <input type="hidden" name="{{ $name }}" value="{{ (auth()->check() ? auth()->user()->{$name} : old($name)) }}">
        <i class="dropdown icon"></i>

        <div class="default text">{{ $placeholder or ucwords(str_replace('_', ' ', $name)) }}</div>
        <div class="menu">
            @foreach($collection as $key => $value)
                <div class="item" data-value="{{ $key }}"><i class="{{ $value[1] }}"></i>{{ $value[0] }}</div>
            @endforeach
        </div>
    </div>
</div>