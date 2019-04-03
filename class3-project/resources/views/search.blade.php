<section class="prenotazione">
    <h3 class="title">Prenota il tuo appartamento
        <br> ovunque vuoi!
    </h3>
    <form id="formInterno" action="{{route('ricerca_avanzata')}}" method="get">
      <div class="box-prenotazioni">

        <!--CITTA-->
            @if(isset($cityName))
                <input list="listaCitta" id="listaCitta-input" class="form-control" name="city_name" value="{{$cityName}}">
            @else
                <input list="listaCitta" id="listaCitta-input" class="form-control" name="city_name" placeholder="Località">
            @endif
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
              <select class="prenotare" id="bed_count" name="bed_count">
                  @if(isset($bedCount))
                      <option {{($bedCount==0)?'selected':NULL}} value="0">Numero ospiti</option>
                      <option {{($bedCount==1)?'selected':NULL}} value="1">1</option>
                      <option {{($bedCount==2)?'selected':NULL}} value="2">2</option>
                  @else
                      <option selected value="0">Numero ospiti</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                  @endif
              </select>
            </div>
            <div>
              <input class="flatpickr flatpickr-input" id="check-in" type="text" placeholder="Check in" readonly="readonly">
            </div>
          </div>
          <!--STANZE-->
          <div>
            <div>
              <select class="prenotare" id="room_count" name="room_count">
                  @if(isset($roomCount))
                      <option {{($roomCount==0)?'selected':NULL}} value="0">Numero stanze</option>
                      <option {{($roomCount==1)?'selected':NULL}} value="1">1</option>
                      <option {{($roomCount==2)?'selected':NULL}} value="2">2</option>
                  @else
                      <option selected value="0">Numero stanze</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                  @endif
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
</script>
