@props(['messages'])

@if ($messages)
    <div class="alert alert-danger">
        <ul {{ $attributes->merge(['class' => '']) }}>
            @foreach ((array) $messages as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
