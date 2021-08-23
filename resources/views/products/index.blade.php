@extends('layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Products') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Products') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex flex-row mb-3">
                <div class="p-2" style="width: 50%">
                    @if (session('success'))
                        <div class="alert text-green text-bold">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="p-2" style="width: 50%">
                    <a role="button" class="btn btn-primary float-right"
                        href="{{ route('products.create') }}">{{ __('Create',['name'=>__('Product')]) }}</a>
                </div>
            </div>
            @isset($products)
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-title">{{ __('Products') }}</h3>
                        </div>
                        <div class="card-tools">
                            <form action="{{ route('products.index') }}" method="get" class="input-group input-group-sm w-100">
                                <input type="text" name="search" class="form-control"
                                    value="@isset($_GET['search']){{ $_GET['search'] }}@endisset"
                                       placeholder="{{ __('Search for',['name'=>__('Product')]) }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Category') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Price') }}&nbsp;($)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($products) > 0)
                                        @foreach ($products as $value)
                                            <tr>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="fa fa-edit"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item"
                                                                href="{{ route('products.edit', [$value]) }}">{{ __('Edit') }}</a>
                                                            <a class="dropdown-item" data-toggle="modal"
                                                                data-target="#confirmModal{{ $value['id'] }}"
                                                                href="">{{ __('Delete') }}</a>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="confirmModal{{ $value['id'] }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <form class="modal-dialog"
                                                            action="{{ route('products.destroy', [$value]) }}" method="POST">
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
                                                                    <p> {{ __('Confirm',['action'=>__('Delete')]) }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">
                                                                        {{ __('No') }}
                                                                    </button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">{{ __('Yes') }}</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>{{ $value['id'] }}</td>
                                                <td>{{ $value['name'] }}</td>
                                                <td>{{ $value['category']['name'] }}</td>
                                                <td>{{ $value['description'] }}</td>
                                                <td>{{ $value['price'] }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $products->links('vendor.pagination.custom') }}
                        <div class="ml-2">
                            {{ ($products->currentPage() - 1) * config('project.pagecount') + $products->count() }}
                            {{__('of')}}&nbsp;{{ $products->total() }}</div>

                    </div>
                @endisset
            </div>
        </div>
    @endsection
