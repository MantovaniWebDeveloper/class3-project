<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
        <title>BoolBnb</title>
    </head>
    <body class="homepage">
      <div class="menu">
         <div class="container">
           <div class="home_logo">
             <i class="fas fa-home"></i>
             <h1>BoolBnb</h1>
           </div>
           <i class="fas fa-bars" id="burgher-menu"></i>

           <div class="primary-menu" id="menu" >
             <nav >
               <ul>
                 <li><a href="#">Accedi</a></li>
                 <li><a href="{{ route('register') }}">Registrati</a></li>
                 <li><a href="#">I migliori appartamenti</a></li>
                 <li><a href="#">Aiuto</a></li>
               </ul>
             </nav>
           </div>
         </div>
     </div>


      <!-- JUMBO-->
      @include('search')
      <div class="jumbo">
        @include('offerta')
      </div>

      <!-- PRENOTAZIONE -->
      <section class="prenotazione">
        <h3 class="title">Prenota il tuo appartamento <br> ovunque vuoi!</h3>
        <div class="box-prenotazioni">
          <input class="prenotare" class="city" type="text" placeholder="Località">
          <input class="prenotare" type="number" placeholder="Ospiti" >
          <input class="flatpickr flatpickr-input active prenotare" id="check-in" type="text" placeholder="Check in" readonly="readonly">
          <input class="flatpickr flatpickr-input active prenotare" id="check-out" type="text" placeholder="Check out" readonly="readonly">
          <input type="submit" class="send" value="cerca">
        </div>
      </section>

        <!-- SEZIONE IN EVIDENZA -->
        {{-- @dd($promoApartments); --}}
        <section class="evidenzia">
          <div class="container-evidenzia">
            <h2>Appartamenti in evidenza</h2>
              <div class="box-card">
                  @foreach($promoApartments as $apartment)
                      <div class="card-appartamento">
                        <div class="img-evidenza">
                          <img src="http://lorempixel.com/200/200/nature" alt="">
                        </div>
                          <small>la promozione termina il : <br>{{$apartment->end_promo}}</small>
                          <h3>Appartamento : {{ str_limit($apartment->title, $limit = 10, $end = '...') }}</h3>
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
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
        </section>
        <!-- SECTION LOCALITA -->
        <section class="località">
          <div class="galleria container-località">
            <h3>Località</h3>
            <div class="box-card">
            @foreach ($mainCities as $city)
              <div class="card-città">
                <div class="img-city" onclick="location.href='appartamenti/ricerca?bed_count=0&city_code={{$city['city_code']}}';">
                  <img src="http://lorempixel.com/250/250/nature" alt="camera">
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
    </body>
    {{-- non sapevo a cosa servisse insieme a questi nello script che mi davano errore integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"  <script src="script.js"></script> --}}

</html>
