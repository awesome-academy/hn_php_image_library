@extends('layouts.master')
@section('content')
    <div id="web">
        <div class="other">
            <div id="subheader">
                <h1>{{ ucfirst(__('delete', ['name' => __('profile')])) }}</h1>
            </div>
            <div id="mform" class="edituser delete-form">
                <form action="{{ route('profile.destroy', [Auth::user()]) }}" method="post" id="accountform"
                    class="text-white">
                    @csrf
                    @method('delete')
                    <p class="delete-content">{{ __('delete_quote') }}</p>
                    <input type="submit" class="delete-submit" value="{{ __('yes') }}">
                </form>
                <br class="clear">
                <br class="clear">
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script async type="text/javascript" src="{{ asset('js/profile.js') }}"></script>
@endpush
