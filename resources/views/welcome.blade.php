@extends('layouts.app')
@extends('layouts.navbar')

@section('title')
  Dashboard
@endsection
@section('content')
  <div class="flex_style_between" style="margin-bottom: 100px">
    <div style="width: 30%; height: 200px;">
    <h4 class="text-center">The Most Used Package</h4>

    </div>
    <div style="width: 30%; height: 200px;">
    <h4 class="text-center">Question numbers for each Category</h4>

    </div>
    <div style="width: 30%; height: 200px;">
    <h4 class="text-center">Promo Codes Used</h4>

    </div>
  </div>
  <div class="flex_style_evenly ">
    <div style="width: 40%; height: 300px;">

    </div>
    <div style="width: 40%; height: 300px;">

    </div>
  </div>

  <!-- Add these at the bottom of your view -->

@endsection
{{-- @section('content')
<!-- Main content -->
<div class="container">
  <div class="chart-cont d-flex justify-content-between">
    <div class="chart-container w-50 me-3">
      {!! $chart1->container() !!}
    </div>
    <div class="chart-container w-50 ms-3">
      {!! $chart2->container() !!}
    </div>
  </div>

  <script src="{{ $chart1->cdn() }}"></script>
  <script src="{{ $chart2->cdn() }}"></script>
  {{ $chart1->script() }}
  {{ $chart2->script() }}
</div>
@endsection --}}

{{-- <style>
  /* Custom width and height for each chart */
  .chart-container {
    min-width: 400px;
    /* Adjust this as needed for your layout */
  }

  #users_per_month,
  #orders_per_month {
    height: 268px !important;
  }

  @media (max-width: 1200px) {

    /* Adjust this as needed for your layout */
    .chart-cont {
      min-width: 100%;
      height: 200px;
      margin-bottom: 10px;
      margin-top: 10px;
      padding: 0;
      border: none;
      flex-direction: column;
    }
  }
</style> --}}
