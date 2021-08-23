@extends('layouts.admin')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('Create',['name'=>__('Category')]) }}</h3>
        </div>
        @if ($errors->any())
            <div class="alert text-red text-bold">
                @foreach ($errors->all() as $error){{ $error }}
                @endforeach
            </div>
        @endif
        <form role="form" enctype="multipart/form-data"
              action="{{ isset ($category) ? route('categories.update', [$category]) : route('categories.store') }}"
              method="post">
            {{ csrf_field() }}
            @isset ($category) @method('put') @endisset
            <div class="card-body">
                <div class="form-group">
                    <label for="input1">{{ __('name',['name'=>__('Category')]) }}</label>
                    <input name="name" type="text" class="form-control" id="input1"
                           value="@isset ($category['name']){{ $category['name'] }}@endisset" required/>
                </div>
                <div class="form-group">
                    <label for="input2">{{ __('Description') }}</label>
                    <textarea name="description" class="form-control" id="input2"
                              rows="3">@isset ($category['description']){{ $category['description'] }}@endisset
                        </textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
            </div>
        </form>
    </div>
@endsection
