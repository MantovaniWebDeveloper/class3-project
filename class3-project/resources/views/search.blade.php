<section class="prenotazione">
    <h3 class="title">Prenota il tuo appartamento <br> ovunque vuoi!</h3>
    <form id="formInterno" action="{{route('ricerca_avanzata')}}" method="get">
      <div class="box-prenotazioni">

        <!--CITTA-->
        <input list="listaCitta" id="listaCitta-input" class="form-control"  name="cities" placeholder="Località">
        <datalist id="listaCitta">
           {{--questo sarà riempito da handlebars--}}
         </datalist>

      </div>
      <div class="box-prenotazioni">

        <!--POSTI LETTO-->
        <div id="wrap_form" class="d-flex flex-row justify-content-around">
          <div>
            {{-- <label class="col-form-label" for="bed_count">N° ospiti</label> --}}
            <div>
              <select class="prenotare" name="bed_count">
                <option selected value="0">Numero ospiti</option>
                <option value="1">1 Ospite</option>
                <option value="2">2 Ospiti</option>
              </select>
            </div>
            <div>
              <input class="flatpickr flatpickr-input" id="check-in" type="text" placeholder="Check in" readonly="readonly">
            </div>
          </div>
          <!--STANZE-->
          <div>
            <div>
              <select class="prenotare" name="room_count">
                <option value="0">Numero stanze</option>
                <option value="1">Stanza singola</option>
                <option value="2">Stanza doppia</option>
              </select>
            </div>
            <div>
              <input class="flatpickr flatpickr-input" id="check-out" type="text" placeholder="Check out" readonly="readonly">
            </div>
          </div>
        </div>
      </div>
      <div class="box-prenotazioni background-t d-flex justify-content-center">
        <input id="inputNascosto" type="hidden" name="city_code" value="">
        <button type="" id="cercaBtn" class="send" value="cerca">Cerca</button>
      </div>
    </form>

    <!--HAMBURGER MENU -->
    <div class="primary-menu" id="menu" >
      <nav >
        <ul>
        @auth
         <li><a href="{{ route('dashboard') }}">I miei appartamenti</a></li>
         <li class="log_item">
           <form action="{{ route('logout') }}" method="POST">
               @csrf
               <input class="button nav_button" type="submit" value="Logout">
           </form>
         </li>
        @endauth

        @guest
         <li><a href="{{route('login')}}">Accedi</a></li>
         <li><a href="{{route('register')}}">Registrati</a></li>
         <li><a href="#">Aiuto</a></li>
       @endguest
        </ul>
      </nav>
    </div>
</section>

<!-- ZONA HANDLEBARS!!!-->
<script id="elencoCitta-template" type="text/x-handlebars-template">
  @{{#each this}}
        <option class="elemento" data-id="@{{code}}" value="@{{name}}"></option>
  @{{/each}}
  </datalist>

</script>
