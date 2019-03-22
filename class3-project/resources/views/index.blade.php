<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
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
          <div class="primary-menu">
            <i class="fas fa-bars" id="burgher-menu"></i>
            <nav id="menu">
              <ul>
                <li>Prova</li>
                <li>Prova</li>
                <li>Prova</li>
                <li>Prova</li>
              </ul>
            </nav>
          </div>
        </div>
      </div>

      @include('search')
        <!-- HEADER-->
        <header>
          @include('offerta')

        </header>


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
              <div class="card-città">
                <div class="img-city">
                  <img src="http://lorempixel.com/250/250/nature" alt="camera">
                  <h4>Dubai</h4>
                </div>
              </div>
              <div class="card-città">
                <div class="img-city">
                  <img src="http://lorempixel.com/250/250/nature" alt="camera">
                  <h4>Roma</h4>
                </div>
              </div>
              <div class="card-città">
                <div class="img-city">
                  <img src="http://lorempixel.com/250/250/nature" alt="camera">
                  <h4>Venezia</h4>
                </div>
              </div>
              <div class="card-città">
                <div class="img-city">
                  <img src="http://lorempixel.com/250/250/nature" alt="camera">
                </div>
                <div class="contenuto">
                  <h4>new york</h4>
                </div>
              </div>
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
