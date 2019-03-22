  <div class="formRicerca container d-flex justify-content-center">
      <div class="row">
        <div class="col-12">
          <form id="formInterno" class="" action="{{ route('ricerca_avanzata')}}" method="get">
            <h2>Inserisci la città ed il numero di ospiti</h2>
            <div class="form-row d-flex justify-content-center">
              <div class="form-group col-6 " >
                <input list="listaCitta" id="listaCitta-input">
                <datalist id="listaCitta">
                   {{--questo sarà riempito da handlebars--}}
                 </datalist>

              </div>
              <div class="form-group col-6">
                <select class="selectPersone form-control" name="bed_count">
                  <option value="0">numero ospiti</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                </select>
              </div>
            </div>
            <input id="inputNascosto" type="hidden" name="city_code" value="">
            <button type="" id="cercaBtn" class="btn btn-primary">Cerca</button>
          </form>

        </div>
      </div>
  </div>

  <!-- ZONA HANDLEBARS!!!-->
  <script id="elencoCitta-template" type="text/x-handlebars-template">
    @{{#each this}}
          <option class="elemento" data-id="@{{code}}" value="@{{name}}"></option>
    @{{/each}}
    </datalist>

  </script>
