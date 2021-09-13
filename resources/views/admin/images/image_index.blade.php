@extends('layouts.admin')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ ucfirst(__('images')) }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ ucfirst(__('home')) }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ ucfirst(__('images')) }}</li>
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
            </div>
            @isset($images)
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('images') }}</h3>
                        <div class="card-tools">
                            <form action="{{ route('images.index') }}" class="input-group input-group-sm w-100">
                                <input type="search" name="search" class="form-control float-right"
                                    value="{{ request()->get('search') }}"
                                    placeholder="{{ __('searchfor', ['name' => __('images')]) }}">
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
                                    <th class="text-truncate">{{ __('name') }}</th>
                                    <th>{{ __('thumbnail') }}</th>
                                    <th>{{ __('author') }}</th>
                                    <th>{{ __('like') }}</th>
                                    <th>{{ __('download') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($images) > 0)
                                    @foreach ($images as $value)
                                        <tr>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i class="fa fa-edit"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#confirmModal{{ $value['id'] }}"
                                                            href="">{{ ucfirst(__('delete', ['name' => ''])) }}</a>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="confirmModal{{ $value['id'] }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <form class="modal-dialog"
                                                        action="{{ route('images.destroy', [$value]) }}" method="POST">
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
                                                                <p> {{ __('confirm', ['action' => __('delete', ['name' => ''])]) }}
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
                                            <td>{{ $value['name'] }}</td>
                                            <td>
                                                <img src="{{ asset($value['thumb_link']) }}"
                                                    onerror="this.src = '{{ asset('img/no-image.png') }}'" class="img-mw"
                                                    alt="{{ $value['name'] }}">
                                            </td>
                                            <td>{{ $value['user']['name'] }}</td>
                                            <td>{{ $value['like'] }}</td>
                                            <td>{{ $value['download'] }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                    {{ $images->links('vendor.pagination.default') }}
                    <div class="ml-2">{{ ($images->currentPage() - 1) * 5 }}
                        to {{ $images->currentPage() * $images->count() }} of {{ $images->lastPage() * $images->count() }}
                    </div>
                </div>
            @endisset
        </div>
    </div>
@endsection
