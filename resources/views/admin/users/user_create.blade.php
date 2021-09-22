@extends('layouts.admin')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ ucfirst(__('create', ['name' => __('user')])) }}</h3>
        </div>
        @if ($errors->any())
            <div class="alert text-red text-bold">
                @foreach ($errors->all() as $error){{ $error }}
                @endforeach
            </div>
        @endif
        <form role="form" enctype="multipart/form-data"
              action="{{ isset($user) ? route('users.update', [$user]) : route('users.store') }}" method="post">
            @csrf
            @isset($user) @method('put') @endisset
            <div class="card-body">
                <div class="form-group">
                    <label for="input1">{{ __('name') }}</label>
                    <input name="name" type="text" class="form-control" id="input1"
                           value="@isset($user){{ $user['name'] }}@endisset" required/>
                </div>
                <div class="form-group">
                    <label for="input1">{{ __('email') }}</label>
                    <input name="email" type="email" class="form-control" id="input1"
                           value="@isset($user){{ $user['email'] }}@endisset" required/>
                </div>

                <div class="form-group">
                    <label for="input1">@isset($user){{ __('new password') }}@else{{ __('password') }}@endif</label>
                    <input name="password" type="password" class="form-control" id="input1" value=""/>
                </div>
                <div class="form-group">
                    <label
                        for="input1">@isset($user){{ __('new_password_confirmation') }}@else{{ __('password_confirmation') }}
                        @endif</label>
                    <input name="password_confirmation" type="password" class="form-control" value=""/>
                </div>
                <div class="form-group">
                    <label for="input2">{{ __('bio') }}</label>
                    <textarea name="bio" class="form-control" id="input2"
                              rows="3">@isset($user){{ $user['bio'] }}@endisset</textarea>
                </div>
                @isset($user['avatar'])
                    <div class="form-group">
                        <label for="input1">{{ __('avatar') }}</label>
                        <div class="widget-user-image">
                            <img class="avt" src="{{ asset($user['avatar']) }}" alt="{{ __('avatar') }}">
                        </div>
                        <br>
                        <input name="filepload" type="file" class="form-control" id="input1"
                               value="@isset($user){{ $user['email'] }}@endisset"/>
                    </div>
                @else
                    <div class="form-group">
                        <label for="input1">{{ __('avatar') }}</label>
                        <input name="filepload" type="file" class="form-control" id="input1"
                               value="@isset($user){{ $user['email'] }}@endisset"/>
                    </div>
                @endisset
                <div class="form-group">
                    <label>{{ __('role') }}</label>
                    <select class="form-control" name="role_id">
                        <option value="0">{{ __('user') }}</option>
                        @if (count($roles) > 0)
                            @foreach ($roles as $value)
                                <option value="{{ $value['id'] }}"
                                        @isset($user) @if ($user['role_id'] == $value['id']) selected @endif
                                    @endisset>{{ $value['name'] }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="customSwitch3" name="is_active"
                               checked="checked">
                        <label class="custom-control-label" for="customSwitch3">{{ __('active') }}</label>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ ucfirst(__('submit')) }}</button>
            </div>
        </form>
    </div>
@endsection
