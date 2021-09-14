@extends('layouts.admin')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ ucfirst(__('create', ['name' => __('role')])) }}</h3>
        </div>
        @if ($errors->any())
            <div class="alert text-red text-bold">
                @foreach ($errors->all() as $error){{ $error }}
                @endforeach
            </div>
        @endif
        <form role="form" enctype="multipart/form-data"
              action="{{ isset($role) ? route('roles.update', [$role]) : route('roles.store') }}" method="post">
            {{ csrf_field() }}
            @isset($role) @method('put') @endisset
            <div class="card-body">
                <div class="form-group">
                    <label for="input1">{{ __('name') }}</label>
                    <input name="name" type="text" class="form-control" id="input1"
                           value="@isset($role){{ $role['name'] }}@endisset" required/>
                </div>
                <div class="form-group">
                    <label class="form-check-label"><b>{{ __('permission') }}</b></label>
                    <br class="clear">
                    @if (count($permissions) > 0)
                        @php $i=0; @endphp
                        @foreach ($permissions as $value)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $value['id'] }}"
                                       name="permission_id[]"
                                       @if (isset($role) && count($role_permissions) > 0 && in_array($value['id'], $role_permissions)) checked="checked" @endif>
                                <label class="form-check-label">{{ $value['name'] }}</label>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ ucfirst(__('submit')) }}</button>
            </div>
        </form>
    </div>
@endsection
