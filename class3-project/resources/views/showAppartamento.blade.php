@extends('layout.main')
@section('content')
@include('header')
  <img src="data:image/png;charset=binary;base64,{!! $image !!}">
  <h3>{{$apartment['title']}}</h3>
  <h3>{{$apartment['price']}}</h3>
  <p>numeri letti: {{$apartment['bed_count']}}</p>
  <p>{{$apartment['description']}}</p>

@endsection
