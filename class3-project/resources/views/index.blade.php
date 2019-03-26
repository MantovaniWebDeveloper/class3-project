@extends('layout.main')
@section('content')
@include('header')

<!-- JUMBO-->
  <div class="offerta">
    @include('offerta')
  </div>

    <!-- PRENOTAZIONE -->
    @include('search')


  <!-- SEZIONE IN EVIDENZA -->
  {{-- @dd($promoApartments); --}}
  <section class="evidenzia">
    <div class="container-evidenzia">
      <h3>Appartamenti in evidenza</h3>
        <div class="box-card-app">
            @foreach($promoApartments as $apartment)
                <div class="card-appartamento">
                  <img src="http://lorempixel.com/200/200/nature" alt="">
                  <div class="testo">
                    <small>la promozione termina il : <br>{{$apartment->end_promo}}</small>
                    <p class="descrizione-stanza">{{ str_limit($apartment->title, $limit = 15) }}</p>
                    <div class="recensione">
                      <p class="descrizione-stanza">€ 85 a notte</p>
                      <div class="valutazione">
                        <span class="descrizione">4.5</span>
                        <i class="fas fa-star-half-alt"></i>
                      </div>
                    </div>
                  </div>
                    {{--
                    <div class="dettagli">
                      <ul>
                        <li>
                          <i class="fas fa-bed"></i>
                          <span>Ospiti: {{ $apartment->bed_count}}</span>
                        </li>
                        <li>
                          <i class="fas fa-home"></i>
                          <span>Spazio: {{ $apartment->square_meters}}<small>mq</small></span>
                        </li>
                      </ul>
                    </div> --}}
                </div>
            @endforeach
        </div>
    </div>
  </section>
  <!-- SECTION LOCALITA -->
  <section class="località">
    <div class="galleria container-località">
      <h3>Località</h3>
      <div class="box-card-cit">
      @foreach ($mainCities as $city)
        <div class="card-citta">
          <div class="img-city" onclick="location.href='appartamenti/ricerca?bed_count=0&city_code={{$city['city_code']}}';">
            <img src="http://lorempixel.com/250/250/nature" alt="camera">
          </div>
          <div class="contenuto">
            <h4>{{$city['city_name']}}</h4>
          </div>
        </div>
      @endforeach
      </div>
    </div>
  </section>


  <footer class="footer">
      <div class="container">
          <h6>Copyright &copy; 2019</h6>
      </div>
  </footer>
  <script src="{{asset('js/common.js')}}"></script>
  <script src="{{ asset('js/chiamataApiCitta.js') }}" defer></script>

@endsection
