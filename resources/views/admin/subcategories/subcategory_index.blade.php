@extends('layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ ucfirst(__('subcategories')) }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ ucfirst(__('home')) }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ ucfirst(__('subcategories')) }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex flex-row mb-3">
                <div class="p-2 w-50">
                    @if (session('success'))
                        <div class="alert text-green text-bold">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="p-2 w-50">
                    <a role="button" class="btn btn-primary float-right"
                       href="{{ route('subcategories.create') }}">{{ __('create', ['name' => __('subcategory')]) }}</a>
                </div>
            </div>
            @isset($categories)
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-title">{{ __('subcategories') }}</h3>
                        </div>
                        <div class="card-tools">
                            <form action="{{ route('subcategories.index') }}" method="get"
                                  class="input-group input-group-sm w-100">
                                <input type="text" name="search" class="form-control"
                                       value="@isset($_GET['search']){{ $_GET['search'] }}@endisset"
                                       placeholder="{{ __('searchfor', ['name' => __('category')]) }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if (count($categories) > 0)
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ ucfirst(__('name')) }}</th>
                                    <th>{{ ucfirst(__('parent')) }}</th>
                                    <th>{{ ucfirst(__('description')) }}</th>
                                </tr>
                                </thead>
                                <tbody class="text-truncate">
                                @foreach ($categories as $value)
                                    <tr>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"><i class="fa fa-edit"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                       href="{{ route('subcategories.edit', [$value]) }}">{{ __('edit', ['name' => '']) }}</a>
                                                    <a class="dropdown-item" data-toggle="modal"
                                                       data-target="#confirmModal{{ $value['id'] }}"
                                                       href="">{{ __('delete', ['name' => '']) }}</a>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="confirmModal{{ $value['id'] }}" tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <form class="modal-dialog"
                                                      action="{{ route('subcategories.destroy', [$value]) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> {{ __('confirm', ['action' => __('delete', ['name' => __('subcategory')])]) }}
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                {{ __('no') }}
                                                            </button>
                                                            <button type="submit"
                                                                    class="btn btn-primary">{{ __('yes') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="text-truncate">{{ $value['name'] }}</td>
                                        <td class="text-truncate">{{ $value['parent']['name'] }}</td>
                                        <td class="text-truncate">{{ $value['description'] }}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{ $categories->links('vendor.pagination.default') }}
                    @endif
                    <div class="ml-2">
                        {{ ($categories->currentPage() - 1) * config('project.pagecount') + $categories->count() }}
                        {{ __('of') }}&nbsp;{{ $categories->total() }}
                    </div>
                </div>
            @endisset
        </div>
    </div>
@endsection
