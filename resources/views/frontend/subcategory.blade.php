@extends('layouts.master')
@section('content')
    <div id="web">
        <div id="subheader">
            <h1>{{ $category['name'] }}</h1>
        </div>
        <div id="content">
            <p id="featuredsearches">
                @if (count($subcategories) > 0)
                    @foreach ($subcategories as $value)
                        <a href="#{{ $value['id'] }}">{{ $value['name'] }}</a>&nbsp;&nbsp;
                    @endforeach
                @endif
            </p>
            <div id="popular" class="imgrow">
                @if (count($subcategories) > 0)
                    @foreach ($subcategories as $sub)
                        <h2 id="{{ $sub['id'] }}">{{ $sub['name'] }}</h2>
                        @if (count($sub['images']) > 0)
                            @foreach ($sub['images'] as $image)
                                <a href="{{ route('home.image', ['slug' => $image['slug']]) }}"
                                    title="{{ $image['name'] }}">
                                    <img src="{{ asset($image['thumb_link']) }}"
                                        onerror="this.src= '{{ asset('img/no-image.png') }}'"
                                        alt="{{ $image['name'] }}">
                                </a>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
