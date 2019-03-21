<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>BOOLBNB</title>
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
  </head>
  <body>
    {{-- NAVBAR --}}
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">BOOL BNB</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex justify-content-end collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown link
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    {{-- SIMIL JUMBOTRON --}}
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="container">
            <div class="row">
              <div class="col-8">
                <h1>Offerta imperdibile</h1>
              </div>
              <div class="col-4">
                <ul>
                  <li>Accedi</li>
                  <li>Registrati</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- FORM RICERCA --}}
    @include('search')
  {{-- @dd($promoApartments); --}}
     @foreach($promoApartments as $apartment)
      <div class="container">
        <div class="row">
          <div class="col-10">
            APPARTAMENTO IN EVIDENZA
            <small>la promozione termina il : {{$apartment->end_promo}}</small>
            <h3>Nome appartamento : {{ $apartment->title }}</h3>
            {{-- <img src="{{ $apartment->immagine }}"> --}}
            <ul>
              <li>Numero letti : {{ $apartment->bed_count}}</li>
              <li>Gradezza in mq : {{ $apartment->square_meters}}</li>
              {{-- <li>{{$apartment->services->}}</li> --}}
            </ul>
          </div>
        </div>
      </div>
    @endforeach
    <script src="{{ asset('js/chiamataApiCitta.js') }}" defer></script>

  </body>
</html>
