@extends('layouts.master')
@section('content')
    <div id="content">
        <div id="popular">
            @if (count($follow_users) > 0)
                <h2><span>{{ __('followed users') }}</span></h2>
                @foreach ($follow_users as $i => $value)
                    <a href="{{ route('home.user', ['id' => $value['id']]) }}" class="falbumthumbnail @if ($i % 2==0) even @else odd @endif @if ($i % 3 == 1) middle @endif"
                        title="{{ $value['name'] }}">
                        <div class="faall">
                            <div class="falbumphoto" href="{{ route('home.user', ['id' => $value['id']]) }}"
                                title="{{ $value['name'] }}">
                                <span class="foverlay">{{ $value['images_count'] }}</span>
                                <img alt="{{ $value['name'] }}" src="{{ asset($value['avatar']) }}"
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
                {{ $follow_users->links('vendor.pagination.default') }}
            @endif
            @if (count($images) > 0)
                <div class="imgrow" id="suwp">
                    @foreach ($images as $value)
                        <a href="{{ route('home.image', ['slug' => $value['slug']]) }}" title="{{ $value['name'] }}">
                            <img src="{{ asset($value['thumb_link']) }}"
                                onerror="this.src= '{{ asset('img/no-avatar.png') }}'" alt="{{ $value['name'] }}">
                        </a>
                    @endforeach
                </div>
                {{ $images->links('vendor.pagination.default') }}
            @endif
        </div>
    </div>
@endsection
