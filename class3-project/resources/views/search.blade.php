  <div class="formRicerca container d-flex justify-content-center">
      <div class="row">
        <div class="col-12">
          <form id="formInterno" class="" action="{{ route('test')}}" method="get">
            @csrf
            <h2>Inserisci la città ed il numero di ospiti</h2>
            <div class="form-row d-flex justify-content-center">
              <div class="form-group col-6 " >
                <input list="listaCitta" id="listaCitta-input"name="cities">
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
              <div class="form-group col-3">
                <input type="hidden" name="lat" value="44.91297351">
              </div>
              <div class="form-group col-3">
                <input type="hidden" name="lng" value="8.61540116">
              </div>
            </div>
            <input id="inputNascosto" type="hidden" name="citiesCode" value="">
          </form>
          <button type="submit" id="cercaBtn" class="btn btn-primary">Cerca</button>

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
