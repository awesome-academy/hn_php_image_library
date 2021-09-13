@extends('layouts.master')
@section('content')
    <div id="introc">
        <div id="intro">
            <h1>{{ __('home_welcome') }}</h1>
            <form method="get" action="{{ route('home.search') }}" id="hsearch">
                <input type="text" placeholder="{{ ucfirst(__('searchfor', ['name' => __('images')])) }}..." id="q"
                    name="q">
                <input type="submit" id="hsubmitsearch" value="{{ ucfirst(__('search')) }}">
            </form>
        </div>
    </div>
    <div id="content">
        <h2><span>{{ __('home_trending') }}</span></h2>
        <p id="featuredsearches">
            @if (count($subcategories) > 0)
                @foreach ($subcategories as $value)
                    <a href="{{ route('home.subcategory', ['slug' => $value['parent']['slug']]) }}">{{ $value['name'] }}</a>&nbsp;&nbsp;
                @endforeach
            @endif
        </p>
        @if (count($follow_users) > 0)
            <div id="featured">
                <h2><span>{{ ucfirst(__('followed users')) }}</span></h2>
                @foreach ($follow_users as $i => $value)
                    <a href="{{ route('home.user', ['id' => $value['id']]) }}" class="falbumthumbnail @if ($i % 2==0) even @else odd @endif @if ($i % 3 == 1) middle @endif"
                        title="{{ $value['name'] }}">
                        <div class="faall">
                            <div class="falbumphoto" href="{{ route('home.user', ['id' => $value['id']]) }}"
                                title="{{ $value['name'] }}">
                                <span class="foverlay">{{ $value['images_count'] }}</span>
                                <img alt="Messi Paris Saint-Germain wallpapers" src="{{ asset($value['avatar']) }}"
                                    onerror="this.src= '{{ asset('img/no-avatar.png') }}'" class="fthumbnail" width="100"
                                    height="100">
                            </div>
                            <div class="fpsc">
                                <div class="fps">
                                    <p class="fftitle">{{ $value['name'] }}</p>
                                    <p class="fnumber">{{ $value['images_count'] }}&nbsp;{{ __('images') }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <p class="viewall"><a
                    href="{{ route('home.viewall', ['type' => 'followed-user']) }}">{{ ucfirst(__('viewmore', ['name' => __('followed users')])) }}»</a>
            </p>
        @endif
        <br class="clear">
        @if (count($like_images) > 0)
            <div class="imgrow">
                <h2><span>{{ ucfirst(__('most like')) }}</span></h2>

                @foreach ($like_images as $value)
                    <a href="{{ route('home.image', ['slug' => $value['slug']]) }}" title="{{ $value['name'] }}">
                        <img src="{{ asset($value['thumb_link']) }}"
                            onerror="this.src= '{{ asset('img/no-image.png') }}'" alt="{{ $value['name'] }}">
                    </a>
                @endforeach
            </div>
            <p class="viewall"><a
                    href="{{ route('home.viewall', ['type' => 'most-like']) }}">{{ ucfirst(__('viewmore', ['name' => __('images')])) }}&nbsp;»</a>
            </p>
        @endif
        @if (count($download_images) > 0)
            <div class="imgrow">
                <h2><span>{{ ucfirst(__('most download')) }}</span></h2>

                @foreach ($download_images as $value)
                    <a href="{{ route('home.image', ['slug' => $value['slug']]) }}" title="{{ $value['name'] }}">
                        <img src="{{ asset($value['thumb_link']) }}"
                            onerror="this.src= '{{ asset('img/no-image.png') }}'" alt="{{ $value['name'] }}">
                    </a>
                @endforeach
            </div>
            <p class="viewall"><a
                    href="{{ route('home.viewall', ['type' => 'most-download']) }}">{{ ucfirst(__('viewmore', ['name' => __('images')])) }}&nbsp;»</a>
            </p>
        @endif
        <br class="clear">
        <div id="newsletter">
            <p>{{ __('home_subcribe') }}</p>
            <form action="#" method="post">
                <input type="text" placeholder="Your email..." name="email" id="tlemail">
                <input type="submit" value="{{ strtoupper(__('subcribe')) }}">
            </form>
        </div>
    </div>
@endsection
