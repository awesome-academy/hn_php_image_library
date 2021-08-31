@extends('layouts.master')
@section('content')
    <div id="web">
        <div class="other">
            <div id="subheader">
                <h1>{{ ucfirst(__('edit', ['name' => __('profile')])) }}</h1>
            </div>
            <div id="mform" class="edituser">
                <div id="coverupload">
                    <img id="coverimg" src="{{ asset('img/userheader.jpg') }}" class="userheader">
                </div>
                <div id="avatarupload">
                    <img id="avatarimg" src="{{ asset(Auth::user()->avatar) }}"
                        onerror="this.src= '{{ asset('img/no-avatar.png') }}'" class="no-avatar">
                    <span id="avatarfile">+</span>
                </div>
                <form action="{{ route('profile.update', [Auth::user()]) }}" method="post" id="accountform"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <h2>{{ ucfirst(__('account')) }}</h2>
                    <input type="file" id="filepload" name="filepload" accept="image/*" class="hidden">
                    <label class="label-title" for="email">{{ ucfirst(__('email')) }}</label>
                    <input type="text" id="email" value="{{ Auth::user()->email }}" disabled>
                    <h2>{{ ucfirst(__('profile')) }}</h2>
                    <label class="label-title" for="name">{{ ucfirst(__('name')) }}</label>
                    <input type="text" id="name" name="name" value="{{ Auth::user()->name }}">
                    <label class="label-title" for="bio">{{ ucfirst(__('bio')) }} (255 {{ __('characters') }})</label>
                    <textarea rows="20" cols="5" name="bio" id="bio">{{ Auth::user()->bio }}</textarea>
                    <br class="clear">
                    <input type="submit" value="{{ ucfirst(__('save', ['name' => __('profile')])) }}">
                </form>
                <br class="clear">
            </div>
            <br><br>
            <p class="text-align-center">
                <a href="{{ route('profile.delete') }}" type="submit"
                    class="text-red text-center">{{ ucfirst(__('delete', ['name' => __('account')])) }}</a>
            </p>
        </div>
    </div>
@endsection
@push('script')
    <script async type="text/javascript" src="{{ asset('js/profile.js') }}"></script>
@endpush
