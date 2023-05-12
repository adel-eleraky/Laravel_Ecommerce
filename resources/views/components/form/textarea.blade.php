@props([
    'id', 'name' , 'value' => ''
])


<textarea
    id="{{ $id }}"
    name="{{ $name }}"
    @class([
        'form-control',
        'is-invalid' => $errors->has($name)
    ])
>
{{ old($name , $value) }}
</textarea>

@error($name)
    <div class="text-danger">{{ $message }}</div>
@enderror