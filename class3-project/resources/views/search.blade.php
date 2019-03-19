  <div class="formRicerca">
    <form class="" action="{{ route('ricerca')}}" method="post">
      @csrf
      <div class="form-row d-flex justify-content-center">
      <div class="form-group col-3">
        <input type="text" class="form-control"  name="query" placeholder="Localita">
      </div>
      <div class="form-group col-3">
        <select class="selectPersone form-control" name="bed_count">
          <option value="0">numero persone</option>
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
