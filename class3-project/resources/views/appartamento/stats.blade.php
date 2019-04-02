@extends('layout.main')

@section('content')
  @include('header')
  <h2 class="check" data-slug="{{$apartment->slug}}">{{$apartment->title}}</h2>
  <div class="container">
    <div class="row">
      <div class="col-6">

        <canvas id="myChartview"></canvas>
      </div>
      <div class="col-6">
        <canvas id="myChartmess"></canvas>
      </div>
    </div>
  </div>

    <script src="{{asset('js/common.js')}}"></script>
    <script src="{{asset('js/stats.js')}}"></script>
@endsection
