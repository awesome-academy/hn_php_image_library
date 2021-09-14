@extends('layouts.master')
@section('content')
    <div id="web">
        <link rel="stylesheet" href="{{ asset('bower_components/dropzone/index.css') }}">
        <link rel="stylesheet" href="{{ asset('css/upload.css') }}">
        <div class="other">
            <div id="subheader">
                <h1>{{ ucfirst(__('upload', ['name' => __('images')])) }}</h1>
            </div>
            <div id="mform">
                <form action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <p>{{ __('upload_thankfor') }}</p>
                    <p>{{ ucfirst(__('remember')) }}:</p>
                    <ul>
                        <li>{{ __('upload_rule1') }}</li>
                        <li>{{ __('upload_rule2') }}</li>
                        <li>{{ __('upload_rule3') }}</li>
                    </ul>
                    <input type="file" id="filepload" name="filepload" accept="image/*" class="hidden">
                    @if ($errors->any())
                        <div class="alert text-red text-bold">
                            @foreach ($errors->all() as $error){{ $error }}
                            @endforeach
                        </div>
                    @endif
                    <div id="dropzone" class="dropzone hidden">
                        <div class="dz-preview">
                            <div>
                                <img id="uploadimg" class="no-avatar">
                            </div>
                            <div id="extradata">
                                <p>&nbsp;</p>
                                <input type="text" name="name" placeholder="{{ ucfirst(__('name')) }}" required>
                                <textarea placeholder="{{ ucfirst(__('description')) }}" name="description"></textarea>
                                <select class="dz-select" id="category_select">
                                    <option>{{ ucfirst(__('category')) }}</option>
                                    @if (count($categories) > 0)
                                        @foreach ($categories as $value)
                                            <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <select name="category_id" class="dz-select hidden" id="subcategory_select" required>
                                </select>
                            </div>
                            <a class="dz-remove" id="dz_remove">{{ ucfirst(__('remove', ['name' => __('image')])) }}</a>
                        </div>
                    </div>
                    <br class="clear">
                    <span id="addimgbtn"
                        class="dz-clickable">{{ ucfirst(__('select', ['name' => __('images')])) }}</span>
                    <input id="done_btn" class="hidden" type="submit" value="{{ __('done') }}" />
                </form>
                <br class="clear">
                <input id="api_subcategory" type="hidden" value="{{ route('subcategory') }}">
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script async type="text/javascript" src="{{ asset('js/upload.js') }}"></script>
@endpush
