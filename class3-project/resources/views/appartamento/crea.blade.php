@extends('layout.main')
<!-- IMPOSTARE MEDIA QUERY PER CAMBIARE LAYOUT SU MOBILE BASTA TOGLIERE LA CLASSE ROW IN FORM-GROUP -->
@section('content')
@include('header')
  <div class="container custom-form">
    <div class="row">
      <h3>Crea nuovo appartamento</h3>
      <div class="col-12">
        <form class="form-group row" action="{{route('salva.nuovo')}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('POST')
          <div class="col-6">
            <div class="form-group">
              <label for="title">Nome appartamento</label>
              <input type="text" name="title" placeholder="Inserire nome appartamento" class="form-control" />
            </div>
            <div class="form-group">
              <label for="description">Descrivi l'appartamento</label>
              <textarea type="text" name="description" rows="10" cols="100" placeholder="Inserire descrizione" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <input class="btn btn-success" type="submit" value="Salva" />
            </div>
          </div>

        <div class="col-2">

          <div class="form-group">
            <label for="square_meters">Di metri quadrati?</label>
            <input type="text" name="square_meters" class="form-control col-3"/>
          </div>
          <div class="form-group">
            <label for="room_count">Quante stanze?</label>
            <input type="text" name="room_count" class="form-control col-3"/>
          </div>
          <div class="form-group">
            <label for="bed_count">Quanti letti?</label>
            <input type="text" name="bed_count" class="form-control col-3"/>
          </div>
          <div class="form-group">
            <label for="bathroom_count">Quanti bagni?</label>
            <input type="text" name="bathroom_count" class="form-control col-3"/>
          </div>
          <div class="form-group">
            <label for="price">Prezzo</label>
            <input type="text" name="price" class="form-control col-3"/>
          </div>
          <div class="form-group">
            <label for="latitude">LAT</label>
            <input type="text" name="latitude" class="form-control col-8"/>
          </div>
          <div class="form-group">
            <label for="longitude">LON</label>
            <input type="text" name="longitude" class="form-control col-8"/>
          </div>

        </div>
        <div class="form-group col-3">
          <h3>Scegli i servizi disponibili</h3>
          @foreach ($services as $service)
            <div class="inpuServizi">
              <input type="checkbox" name="services[]" value="{{$service->id}}">
              <label for="{{$service->name}}">{{$service->name}}</label>
            </div>
          @endforeach
        </div>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      </div>
    </div>
  </div>
@endsection
