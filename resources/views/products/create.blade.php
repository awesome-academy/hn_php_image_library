@extends('layouts.admin')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('Create', ['name' => __('Product')]) }}</h3>
        </div>
        @if ($errors->any())
            <div class="alert text-red text-bold">
                @foreach ($errors->all() as $error){{ $error }}
                @endforeach
            </div>
        @endif
        <form role="form" enctype="multipart/form-data"
              action="{{ isset ($product) ? route('products.update', [$product]) : route('products.store') }}"
              method="POST">
            {{ csrf_field() }}
            @isset ($product) @method('put') @endisset
            <div class="card-body">
                <div class="form-group">
                    <label for="input1">{{ __('name', ['name' => __('Product')]) }}</label>
                    <input name="name" type="text" class="form-control" id="input1"
                           value="@isset ($product['name']){{ $product['name'] }}@endisset" required/>
                </div>
                <div class="form-group">
                    <label for="select1">{{ __('Choose', ['name' => __('Category')]) }}</label>
                    <select id="select1" class="browser-default select2-search custom-select" name="category_id">
                        @foreach ($categories as $value)
                            <option value="{{ $value['id'] }}"
                                    @isset ($product['category_id']) @if ($value['id'] == $product['category_id']) selected @endif
                                    @endisset>{{ $value['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="input2">{{ __('Description') }}</label>
                    <textarea name="description" class="form-control" id="input2"
                              rows="3">@isset ($product['description']){{ $product['description'] }}@endisset</textarea>
                    <div class="form-group">
                        <label for="input3">{{ __('Price') }}</label>
                        <input name="price" class="form-control" id="input3" type="number"
                               value="@isset ($product['price']){{ $product['price'] }}@endisset" required/>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
            </div>
        </form>
    </div>
@endsection
