@extends('layouts.master')
@section('content')
    <div id="album">
        <div id="uwpinfo">
            @if (Auth::check() && $image['user']['id'] == Auth::user()->getAuthIdentifier())
                <a id="editphoto"
                    href="{{ route('image.editImage', $image) }}">{{ __('edit', ['name' => __('image')]) }}</a>
            @endif
        </div>
        <div id="albuminfo">
            <h1>{{ $image['name'] }}</h1>
            <ul id="ainfo">
                <li id="author">
                    <a href="{{ route('home.user', ['id' => $image['user']]) }}">
                        <img src="{{ asset($image['user']['avatar']) }}"
                            onerror="this.src= '{{ asset('img/no-avatar.png') }}'" alt="{{ $image['user']['name'] }}">
                        <span class="text-white">{{ $image['user']['name'] }}</span>
                    </a>
                </li>
                <li id="time"><span>{{ date('d/m/Y', strtotime($image['created_at'])) }}</span></li>
            </ul>
        </div>
        <div id="albumwp">
            <div class="wallpaper" id="{{ $image['id'] }}">
                <div class="wpbuttons onewp">
                    <a class="download" href="{{ route('image.download', ['slug' => $image['slug']]) }}">
                        <img src="{{ asset('img/download.png') }}" width="14" height="17">
                        <p>{{ $image['download'] }}</p>
                    </a>
                    <div class="fav">
                        @if (Auth::check())
                            <a class="addtofavorite" src="{{ route('image.like', ['slug' => $image['slug']]) }}"
                                href="#">
                                <img class="@if ($liked) favorited @endif"
                                    src="    @if (!$liked){{ asset('img/fav.png') }}@else{{ asset('img/fav-hover.png') }}@endif"
                                width="18" height="15">
                                <p>{{ $image['like'] }}</p>
                            </a>
                        @else
                            <a class="addtofavorite no-login" href="#">
                                <img src="{{ asset('img/fav.png') }}" width="18" height="15">
                                <p>{{ $image['like'] }}</p>
                            </a>
                            <p class="loginreq"><a
                                    href="{{ route('login') }}">{{ __('sign in') }}</a>&nbsp;{{ __('or') }}
                                &nbsp;<a
                                    href="{{ route('register') }}">{{ __('sign up') }}</a>&nbsp;{{ __('to like') }}
                            </p>
                        @endif
                    </div>
                </div>
                <img src="{{ asset($image['original_link']) }}" onerror="this.src= '{{ asset('img/no-image.png') }}'"
                    slug="silver-aesthetic-wallpapers" class="wpimg">
            </div>
            <a href="{{ route('image.download', ['slug' => $image['slug']]) }}"
                id="tdownload">{{ __('download images') }}</a>
            <ul id="sharealbum">
                <li id="sharefb"><a rel="nofollow" href="#"
                        title="Share on Facebook"><span></span>{{ __('shareon', ['name' => 'Facebook']) }}</a>
                </li>
                @if (Auth::check())
                    <li id="sharetw">
                        <a rel="nofollow" class="sharetomylist"
                            src="{{ route('image.share', ['slug' => $image['slug']]) }}" href="#" title="Unfavorite">
                        @if ($addtofavorite) {{ ucfirst(__('unfavorite')) }} @else
                                {{ __('add to') . ' ' . __('my favorites') }} @endif
                        </a>
                    </li>
                @else
                    <li id="sharetw"><a
                            href="{{ route('login') }}">{{ __('sign in') . ' ' . __('to add to') . ' ' . __('my favorites') }}</a>
                    </li>
                @endif
            </ul>
            <div id="comments">
                <h2>Leave a comment</h2>
                @if (Auth::check())
                    <form id="commentform">
                        <textarea cols="5" rows="20" id="comment_content"></textarea>
                        <input type="hidden" value="@if (Auth::check()) {{ Auth::user()->api_token }} @endif" name="api_token" id="api_token">
                        <input type="hidden" name="_csrf" id="csrf_token" value="{{ csrf_token() }}" />
                        <input type="hidden" id="image_id" value="{{ $image['id'] }}" />
                        <input type="hidden" id="comment_api"
                            value="{{ route('image.comment', ['slug' => $image['slug']]) }}" />
                        <input type="submit" value="Send" id="btncomment" name="btncomment">
                    </form>
                @else
                    <p id="cantcomment">You need to <a
                            href="{{ route('login') }}">{{ __('sign in') }}</a>&nbsp;{{ __('or') }}
                        &nbsp;<a
                            href="{{ route('register') }}">{{ __('sign up') }}</a>&nbsp;{{ __('to write comments') }}
                    </p>
                @endif
                <h2 id="comment_count">{{ __('comments') }}&nbsp;<span>{{ $comments->count() ?? 0 }}</span></h2>
                @if (count($comments) > 0)
                    @foreach ($comments as $value)
                        <div>
                            <p>{{ $value['content'] }}</p>
                            <p class="meta">
                                <a href="{{ route('home.user', ['id' => $value['user']['id']]) }}"><img
                                        class="avatar-inline" src="{{ asset($value['user']['avatar']) }}"
                                        onerror="this.src= '{{ asset('img/no-avatar.png') }}'" width="22" height="22">
                                    {{ $value['user_name'] }}
                                </a>, {{ date('h:m d/m/Y', strtotime($value['created_at'])) }}
                            </p>
                        </div>
                    @endforeach
                    {{ $comments->links('vendor.pagination.default') }}
                @endif
            </div>
        </div>
        <div id="rwps">
            <h2>{{ ucfirst('related images') }}</h2>
            @if (count($related_images) > 0)
                @foreach ($related_images as $value)
                    <div class="rthumb">
                        <a href="{{ route('home.image', ['slug' => $value['slug']]) }}"><img
                                src="{{ asset($value['thumb_link']) }}" alt="{{ $value['name'] }}"
                                onerror="this.src= '{{ asset('img/no-image.png') }}'"
                                title="{{ $value['name'] }}"></a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
@push('script')
    <script async type="text/javascript" src="{{ asset('js/image.js') }}"></script>
@endpush
