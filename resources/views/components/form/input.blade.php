@props([
    'name' , 'type' , 'value' => "" , 'id'
])

<input
    type="{{ $type }}"
    id="{{ $id }}"
    name="{{ $name }}"
    value="{{ old( $name , $value) }}"
    @class([
        'form-control',
        'is-invalid' => $errors->has($name)
    ])
>
@error($name)
    <div class="text-danger">{{ $message }}</div>
@enderror
