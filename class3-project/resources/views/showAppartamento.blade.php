@extends('layout.main')
@section('content')
@include('header')
  <img src="data:image/png;charset=binary;base64,{!! $image !!}">
  <p><i class="fas fa-map-marker-alt pr-2 "></i>{{$apartment['address']['streetName']}} {{$apartment['address']['postal_code']}} {{$apartment['address']['municipality']}} - {{$apartment['address']['province']}}</p>
  <img src="{{asset("img/")}}/{{$apartment->images()->first()->path}}" alt="">
  <h3>{{$apartment['title']}}</h3>
  <h3>{{$apartment['price']}}</h3>
  <p>numeri letti: {{$apartment['bed_count']}}</p>
  <p>{{$apartment['description']}}</p>
@endsection
