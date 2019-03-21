@extends('layout.main')
@section('content')
@include('header')
<div class="wrapSearch">
  <div class="container">
    @include('searchInterno')
    <div class="wrapAll">
      <aside>

      </aside>
      <div class="wrapResult">
        @foreach ($apartments as  $appartamento)
          <div class="row ">
            <div class="col-4">

            </div>
            <div class="col-6">
              <h3>{{$appartamento->title}}</h3>
            </div>
          </div>
        @endforeach
  </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/ricercaInterna.js') }}" defer></script>

@endsection
