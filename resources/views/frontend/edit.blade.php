@extends('layouts.master')
@section('content')
    <div id="web">
        <link rel="stylesheet" href="{{ asset('bower_components/dropzone/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/upload.css') }}">
        <div class="other">
            <div id="subheader">
                <h1>{{ ucfirst(__('edit', ['name' => __('image')])) }}</h1>
            </div>
            <div id="mform">
                <form action="{{ route('image.updateImage', $image) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    @if ($errors->any())
                        <div class="alert text-red text-bold">
                            @foreach ($errors->all() as $error){{ $error }}
                            @endforeach
                        </div>
                    @endif
                    <div id="dropzone" class="dropzone">
                        <div class="dz-preview">
                            <div>
                                <img id="uploadimg" class="no-avatar" src="{{ asset($image['thumb_link']) }}">
                            </div>
                            <div id="extradata">
                                <p>&nbsp;</p>
                                <input type="text" name="name" placeholder="{{ ucfirst(__('name')) }}"
                                    value="{{ $image['name'] }}" required>
                                <textarea placeholder="{{ ucfirst(__('description')) }}"
                                    name="description">{{ $image['description'] }}</textarea>
                                <select class="dz-select" id="category_select">
                                    <option>{{ ucfirst(__('category')) }}</option>
                                    @if (count($categories) > 0)
                                        @foreach ($categories as $value)
                                            <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <select name="category_id" class="dz-select" id="subcategory_select" required>
                                    @if (count($subcategories) > 0)
                                        @foreach ($subcategories as $value)
                                            <option value="{{ $value['id'] }}" @if ($value['id'] == $image['category_id']) selected @endif>{{ $value['name'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <br class="clear">
                    <a id="delete_btn" class="float-left text-red" href="#">{{ __('delete', ['name' => __('image')]) }}</a>
                    <input id="done_btn" type="submit" value="{{ __('done') }}">
                </form>
                <br class="clear">
            </div>
        </div>
    </div>
    <div id="id01" class="modal">
        <span class="close" title="Close Modal">×</span>
        <form class="modal-content" action="{{ route('image.deleteImage', $image) }}" method="post">
            @csrf
            @method('delete')
            <div class="container">
                <h1>{{ __('confirm', ['action' => __('delete', ['name' => __('image')])]) }}</h1>
                <p>{{ __('delete_quote') }}</p>
                <div class="clearfix">
                    <button type="button" class="cancelbtn">{{ ucfirst(__('cancel')) }}</button>
                    <button type="submit" class="deletebtn">{{ ucfirst(__('delete', ['name' => ''])) }}</button>
                </div>
            </div>
        </form>
    </div>
    <input id="api_subcategory" type="hidden" value="{{ route('subcategory') }}">
@endsection
@push('script')
    <script async type="text/javascript" src="{{ asset('js/edit.js') }}"></script>
    <script async type="text/javascript" src="{{ asset('js/modal.js') }}"></script>
@endpush
