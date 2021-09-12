@foreach ($images as $index => $value)
    <a @if ($index == count($images) - 1) id="last_item" @endif"
        href="{{ route('home.image', ['slug' => $value['slug']]) }}" title="{{ $value['name'] }}">
        <img src="{{ asset($value['thumb_link']) }}" onerror="this.src= '{{ asset('img/no-avatar.png') }}'"
            alt="{{ $value['name'] }}">
    </a>
@endforeach
{{ $images->links('vendor.pagination.default') }}
