<div class="field @if($errors->has($name)) error @endif">
    <input type="{{ $type or 'text' }}" name="{{ $name }}"
           placeholder="{{ $placeholder or ucwords(str_replace('_', ' ', $name)) }}" value="{{ (auth()->check() ? auth()->user()->{$name} : old($name)) }}">
</div>