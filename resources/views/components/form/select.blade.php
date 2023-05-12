@props([
    'name' , 'id' , 'options' , 'notFound'
])

<select name="{{ $name }}" id="{{ $id }}" @class([
    'form-control',
    'is-invalid' => $errors->has($name)
])>
    @forelse ($options as $option)
        <option value="{{ $option->id }}">{{ $option->name }}</option>
    @empty
        <option value="">no {{ $notFound }} found</option>
    @endforelse
</select>
@error($name)
    <div class="text-danger">{{ $message }}</div>
@enderror