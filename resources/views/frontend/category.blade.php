@extends('layouts.master')
@section('content')
    <div id="web">
        <div id="subheader">
            <h1>{{ ucfirst(__('categories')) }}</h1>
        </div>
        <div id="content">
            <ul id="catsinbox">
                @if (count($categories) > 0)
                    @foreach ($categories as $i => $value)
                        <li class="@if ($i % 2==0) odd @else even @endif">
                            <a
                                href="{{ route('home.subcategory', ['slug' => $value['slug']]) }}">{{ $value['name'] }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div id="popular">
            </div>
        </div>
    </div>
@endsection
