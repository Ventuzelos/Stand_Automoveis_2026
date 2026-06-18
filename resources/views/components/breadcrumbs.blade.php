@props([
    'items' => []
])

@if (count($items))
    <nav aria-label="breadcrumb" class="app-breadcrumb-wrapper">
        <ol class="breadcrumb app-breadcrumb mb-0">
            @foreach ($items as $item)
                @if (!$loop->last && isset($item['url']))
                    <li class="breadcrumb-item">
                        <a href="{{ $item['url'] }}">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $item['label'] }}
                    </li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif
