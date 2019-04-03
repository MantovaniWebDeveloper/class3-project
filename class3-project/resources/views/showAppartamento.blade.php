@extends('layout.main')
@section('content')
    @include('header')
    <div class="container">
      <div class="row">
        <div class="col">
          
        </div>
      </div>
    </div>
    <img src="{{asset("img/")}}/{{$apartment->images()->first()->path}}" alt="">
    <h3>{{$apartment->title}}</h3>
    <p>numeri letti: {{$apartment->bed_count}}</p>
    <p>{{$apartment->description}}</p>
    <div class="apartment_map" style="position: relative; display: inline-block">
        <img src="data:image/png;charset=binary;base64,{!! $image !!}">
        <i class="fas fa-map-marker-alt" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);color: red;font-size: 40px"></i>
    </div>
    <p>
        <i class="fas fa-map-marker-alt pr-2 "></i>{{$apartment->address['streetName']}} {{$apartment->address['postal_code']}} {{$apartment->address['municipality']}} - {{$apartment->address['province']}}
    </p>
    @if (\Session::has('message'))
        <div class="alert alert-success">{!! \Session::get('message') !!}</div>
    @endif
    <form action="{{route('send_message',$apartment->slug)}}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="email" required>
        <input type="submit" value="INVIA MESSAGGIO">
        <textarea name="message" id="" cols="30" rows="10" placeholder="Scrivi il tuo messaggio qui" required></textarea>
    </form>

    <script src="{{asset('js/common.js')}}"></script>
@endsection
