@extends('layout.main')
@section('content')
    @include('header')
    {{-- <img src="{{asset("img/")}}/{{$apartment->images()->first()->path}}" alt=""> --}}
    <div class="container pt-4">
      @if (\Session::has('message'))
        <div class="alert alert-success">{!! \Session::get('message') !!}</div>
      @endif
      <div class="col-12">
        <h2>{{$apartment->title}}</h2>
        <p>Descrizione: {{$apartment->description}}</p>
      </div>
      <div class="d-flex justify-content-around">
        <div class="col-4">
          <h3>Dettagli</h3>
          <ul>
            <li> Stanze: {{$apartment->room_count}}</li>
            <li> Letti: {{$apartment->bed_count}}</li>
            <li> Bagni: {{$apartment->bathroom_count}}</li>
          </ul>
          <h3>Servizi offerti</h3>
          <ul>
          @foreach ($apartment->services as $service)
              <li>{{$service->name}}</li>
          @endforeach
          </ul>
        </div>
        <div class="col-7 d-flex justify-content-center">
          <div>
            <div class="apartment_map">
              <img id="tomtom_map" src="data:image/png;charset=binary;base64,{!! $image !!}">
              <i id="marker" class="fas fa-map-marker-alt"></i>
            </div>
            <p>
              <i id="marker_text_icon" class="fas fa-map-marker-alt pr-2"></i><small>{{$apartment->address['streetName']}} {{$apartment->address['postal_code']}} <br> {{$apartment->address['municipality']}} - {{$apartment->address['province']}}</small>
            </p>
          </div>
        </div>
      </div>

        <div class="row">
          <div class="col-12">
            <div class="owl-carousel owl-theme">
                <div class="item"><h4>1</h4><img src="http://lorempixel.com/200/200/nature" alt=""></div>

                <div class="item"><h4>3</h4><img src="http://lorempixel.com/200/200/nature" alt=""></div>
                <div class="item"><h4>4</h4><img src="http://lorempixel.com/200/200/nature" alt=""></div>
                <div class="item"><h4>5</h4><img src="http://lorempixel.com/200/200/nature" alt=""></div>
                <div class="item"><h4>6</h4><img src="http://lorempixel.com/200/200/nature" alt=""></div>
                <div class="item"><h4>7</h4><img src="http://lorempixel.com/200/200/nature" alt=""></div>
                <div class="item"><h4>8</h4><img src="http://lorempixel.com/200/200/nature" alt=""></div>
                <div class="item"><h4>9</h4><img src="http://lorempixel.com/200/200/nature" alt=""></div>
                <div class="item"><h4>10</h4><img src="http://lorempixel.com/200/200/nature" alt=""></div>
                <div class="item"><h4>11</h4><img src="http://lorempixel.com/200/200/nature" alt=""></div>
                <div class="item"><h4>12</h4><img src="http://lorempixel.com/200/200/nature" alt=""></div>
            </div>
          </div>
        </div>

        <div id="message_block">
          <div class="d-flex justify-content-center">
            <button id="contact" class="btn btn-primary col-sm-10 col-md-10 col-lg-10">Contatta il proprietario per maggiori info</button>
          </div>
        <div id="message" class="col-12 hidden">
          <form class="form-group custom-form col-sm-10" action="{{route('send_message',$apartment->slug)}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="email">La tua email</label>
              <input class="form-control col-sm-4 col-md-6 col-lg-4" type="email" name="email" placeholder="email" required>
            </div>
            <div class="form-group">
              <label for="message">Digita il messaggio</label>
              <textarea class="form-control col-sm-7 col-md-8 col-lg-6" name="message" rows="4" required></textarea>
            </div>
              <button class="btn btn-success" type="submit">Invia</button>
          </form>
        </div>
      </div>

      <script src="{{asset('js/show.js')}}"></script>
    </div>

@endsection
