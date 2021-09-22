@extends('layouts.admin')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ ucfirst(__('chart', ['name' => __('upload', ['name' => __('image')])])) }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="chart">
                <canvas id="barChart" height="420" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
    </div>
    <input type="hidden" value="{{ Auth::user()->api_token }}" name="api_token" id="api_token">
    <input type="hidden" id="chart_api" value="{{ route('admin.uploadImageChart') }}"/>
@endsection
@push('script')
    <script src="{{ asset('bower_components/AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/dataChart.js') }}"></script>
@endpush
