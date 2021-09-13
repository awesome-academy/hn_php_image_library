@extends('layouts.master')
@section('content')
    <div id="web">
        <div id="userheaderc" class="userheaderc">
            <div id="userheader">
                <div id="umain">
                    <img id="uavatar" src="{{ asset($user['avatar']) }}"
                        onerror="this.src= '{{ asset('img/no-avatar.png') }}'" alt="{{ $user['name'] }}">
                    <h1>{{ $user['name'] }}</h1>
                    <ul id="usocial">
                    </ul>
                    @if (Auth::check())
                        @if (Auth::user()->getAuthIdentifier() == $user['id'])
                            <a id="editprofile"
                                href="{{ route('profile.edit') }}">{{ ucfirst(__('edit', ['name' => __('profile')])) }}
                            </a>
                        @else
                            <a id="followprofile" class="@if ($followed) followedprofile @else followprofile @endif" href="#"
                                src="{{ route('profile.follow', ['id' => $user['id']]) }}" title="Unfollow">
                            @if ($followed) {{ ucfirst(__('unfollow')) }} @else
                                    {{ ucfirst(__('follow')) }} @endif
                            </a>
                        @endif
                    @endif
                </div>
                <ul id="uinfo">
                    <li id="udate">{{ __('joined in') }}&nbsp;{{ date('d/m/Y', strtotime($user['created_at'])) }}</li>
                </ul>
                <p id="ubio">{{ $user['bio'] }}</p>
            </div>
        </div>
        <div id="utabsc">
            <div id="utabs">
                <ul id="ustats">
                    <li id="uwallpapers">
                        <span></span>
                        <p>{{ count($user['images']) }}&nbsp;{{ __('images') }}</span></p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="collectionc">
            <div class="wp-grid">
                @if (Auth::check() && Auth::user()->getAuthIdentifier() == $user['id'])
                    <div class="uploaded bg-upload">
                        <a href="{{ route('profile.upload') }}">+<br><span>{{ ucfirst(__('upload', ['name' => ''])) }}</span>
                        </a>
                    </div>
                @endif
                @if (count($images) > 0)
                    @foreach ($images as $value)
                        <div class="uploaded">
                            <a href="{{ route('home.image', ['slug' => $value['slug']]) }}"
                                title="{{ $value['name'] }}">
                                <img src="{{ asset($value['thumb_link']) }}"
                                    onerror="this.src= '{{ asset('img/no-avatar.png') }}'" width="160" height="160"
                                    alt="{{ $value['name'] }}">
                            </a>
                            <span class="stats">
                                <span class="views">{{ $value['like'] }}</span>
                                <span class="downloads">{{ $value['download'] }}</span>
                            </span>
                        </div>
                    @endforeach
                @endif
            </div>
            <br class="clear">
            <br class="clear">
        </div>
        {{ $images->links('vendor.pagination.default') }}
    </div>
    <input type="hidden" value="@if (Auth::check()) {{ Auth::user()->api_token }} @endif" name="api_token" id="api_token">
@endsection
@push('script')
    <script async type="text/javascript" src="{{ asset('js/user.js') }}"></script>
@endpush
