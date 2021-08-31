@extends('layouts.master')
@section('content')
    <div id="web">
        <div id="subheader">
            <h1 id="favsubheader">{{ ucfirst(__('my favorites')) }}</h1>
        </div>
        <div class="collectionc">
            @if (count($images) > 0)
                @foreach ($images as $value)
                    <div class="wp-grid">
                        <a href="{{ route('home.image', ['slug' => $value['slug']]) }}" title="{{ $value['name'] }}"
                            class="wpimg">
                            <img src="{{ asset($value['thumb_link']) }}"
                                onerror="this.src= '{{ asset('img/no-avatar.png') }}'" width="160"></a>
                    </div>
                @endforeach
            @endif
            <br class="clear">
            <br class="clear">
        </div>
        <br><br>
    </div>
@endsection
