@extends('layouts.master')
@section('content')
    <input type="hidden" id="search_api" value="{{ route('image.homeSearch') }}">
    <div id="web">
        <div class="spage">
            <div id="subheader">
                <h1>Search for {{ request()->get('q') }}</h1>
            </div>
        </div>
    </div>
    <div id="content">
        @if (count($images) > 0)
            <div id="popular">
                <div class="imgrow" id="suwp">
                    @foreach ($images as $index => $value)
                        <a @if ($index == count($images) - 1) id="last_item" @endif href="{{ route('home.image', ['slug' => $value['slug']]) }}"
                            title="{{ $value['name'] }}">
                            <img src="{{ asset($value['thumb_link']) }}"
                                onerror="this.src= '{{ asset('img/no-avatar.png') }}'" alt="{{ $value['name'] }}">
                        </a>
                    @endforeach
                    {{ $images->links('vendor.pagination.default') }}
                </div>
            </div>
        @endif
    </div>
@endsection
@push('script')
    <script async type="text/javascript" src="{{ asset('js/search.js') }}"></script>
@endpush
