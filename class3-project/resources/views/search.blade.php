<section class="prenotazione">
    <h3 class="title">Prenota il tuo appartamento <br> ovunque vuoi!</h3>
    <form id="formInterno" action="{{route('ricerca_avanzata')}}" method="get">
    <div class="box-prenotazioni">

      <!--CITTA-->
      <input list="listaCitta" id="listaCitta-input" class="prenotare city"  name="cities" placeholder="Località">
      <datalist id="listaCitta">
         {{--questo sarà riempito da handlebars--}}
       </datalist>

       <!--POSTI LETTO-->
      <select class="prenotare" name="bed_count">
        <option selected value="0">Numero ospiti</option>
        <option value="1">1</option>
        <option value="2">2</option>
      </select>


      <!--DATE-->
      <input class="flatpickr flatpickr-input active prenotare" id="check-in" type="text" placeholder="Check in" readonly="readonly">
      <input class="flatpickr flatpickr-input active prenotare" id="check-out" type="text" placeholder="Check out" readonly="readonly">

      <input id="inputNascosto" type="hidden" name="city_code" value="">
      <button type="" id="cercaBtn" class="send" value="cerca">Cerca</button>
    </div>
    </form>
</section>

<!-- ZONA HANDLEBARS!!!-->
<script id="elencoCitta-template" type="text/x-handlebars-template">
  @{{#each this}}
        <option class="elemento" data-id="@{{code}}" value="@{{name}}"></option>
  @{{/each}}
  </datalist>

</script>
