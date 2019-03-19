@extends('layout.main')
@section('content')
@include('header')
<div class="wrapSearch">
  <div class="container">
    @include('search')
    <h4>Filtra per :</h4>
  </div>
</div>
@endsection
