  <div class="formRicerca container d-flex justify-content-center">
      <div class="row">
        <div class="col-12">
          <form class="" action="{{ route('ricerca')}}" method="post">
            @csrf
            <h2>Inserisci la città ed il numero di ospiti</h2>
            <div class="form-row d-flex justify-content-center">
              <div class="form-group col-6 " >
                <input list="listaCitta" name="cities">
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
            <button type="submit" class="btn btn-primary">Cerca</button>
          </form>
        </div>
      </div>
  </div>
  <!-- ZONA HANDLEBARS!!!-->
  <script id="elencoCitta-template" type="text/x-handlebars-template">
    @{{#each this}}
          <option data-value="@{{code}}">@{{name}}</option>
    @{{/each}}
    </datalist>

  </script>
