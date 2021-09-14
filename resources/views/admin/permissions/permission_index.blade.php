@extends('layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ ucfirst(__('permissions')) }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ ucfirst(__('home')) }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ ucfirst(__('permissions')) }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex flex-row mb-3"></div>
            @isset($permissions)
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-title">{{ ucfirst(__('permissions')) }}</h3>
                        </div>
                        <div class="card-tools">
                            <form action="{{ route('permissions.index') }}" method="get"
                                class="input-group input-group-sm w-100">
                                <input type="text" name="search" class="form-control"
                                    value="@isset($_GET['search']){{ $_GET['search'] }}@endisset"
                                        placeholder="{{ __('searchfor', ['name' => __('permission')]) }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if (count($permissions) > 0)
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ ucfirst(__('name')) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-truncate">
                                        @foreach ($permissions as $value)
                                            <tr>
                                                <td>{{ $value['id'] }}</td>
                                                <td class="text-truncate">{{ $value['name'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $permissions->links('vendor.pagination.default') }}
                        @endif
                        <div class="ml-2">
                            {{ ($permissions->currentPage() - 1) * config('project.pagecount') + $permissions->count() }}
                            {{ __('of') }}&nbsp;{{ $permissions->total() }}</div>
                    </div>
                @endisset
            </div>
        </div>
    @endsection
