@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'mt-2 space-y-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="text-sm font-medium text-red-600">
                {{ $message }}
            </li>
        @endforeach
    </ul>
@endif
