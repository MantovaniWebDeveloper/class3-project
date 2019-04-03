<section class="prenotazione">
    <h3 class="title">Prenota il tuo appartamento
        <br> ovunque vuoi!
    </h3>
    <form id="formInterno" action="{{route('ricerca_avanzata')}}" method="get">
        <div class="box-prenotazioni">

            <!--CITTA-->
            @if(isset($cityName))
                <input list="listaCitta" id="listaCitta-input" class="prenotare city" name="city_name" value="{{$cityName}}">
            @else
                <input list="listaCitta" id="listaCitta-input" class="prenotare city" name="city_name" placeholder="Località">
            @endif
            <datalist id="listaCitta">
                {{--questo sarà riempito da handlebars--}}
            </datalist>

            <!--POSTI LETTO-->
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
</script>
