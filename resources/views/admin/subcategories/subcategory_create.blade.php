@extends('layouts.admin')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ ucfirst(__('create', ['name' => __('subcategory')])) }}</h3>
        </div>
        @if ($errors->any())
            <div class="alert text-red text-bold">
                @foreach ($errors->all() as $error){{ $error }}
                @endforeach
            </div>
        @endif
        <form role="form" enctype="multipart/form-data"
              action="{{ isset($subcategory) ? route('subcategories.update', [$subcategory]) : route('subcategories.store') }}"
              method="post">
            {{ csrf_field() }}
            @isset($subcategory) @method('put') @endisset
            <div class="card-body">
                <div class="form-group">
                    <label for="input1">{{ __('name') }}</label>
                    <input name="name" type="text" class="form-control" id="input1"
                           value="@isset($subcategory){{ $subcategory['name'] }}@endisset" required/>
                </div>
                <div class="form-group">
                    <label>{{ __('parent') }}</label>
                    <select class="form-control js-example-basic-single" name="parent_id">
                        <option value="0">None</option>
                        @if (count($parents) > 0)
                            @foreach ($parents as $value)
                                <option value="{{ $value['id'] }}"
                                        @isset($subcategory) @if ($subcategory['parent']['id'] == $value['id']) selected @endif @endisset>{{ $value['name'] }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="input2">{{ __('description') }}</label>
                    <textarea name="description" class="form-control" id="input2"
                              rows="3">@isset($subcategory){{ $subcategory['description'] }}@endisset</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ ucfirst(__('submit')) }}</button>
            </div>
        </form>
    </div>
@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
@endpush
