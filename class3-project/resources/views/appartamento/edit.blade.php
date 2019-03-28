@extends('layout.main')

@section('content')
    @include('header')
  <div class="container custom-form">
    <div class="row">

      <h3>Form appartamento</h3>
      @if($errors->any())
        <ul class="errors_container">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      @endif
    </div>
    <div class="col-12">

      <form class="form-group row" action="{{$action=='new_apartment'? route('salva.nuovo') : route('salva.modifica', $apartment->id)}}" method="post">
          @csrf
          @if($action=='new_apartment')
              @method('post')
          @else
              @method('put')
          @endif
          <div class="col-7">
            <div class="form-group">

              <label class="form_item" for="title">Nome Appartamento</label>
              @if( old('title') )
                <input class="form-control col-8 form_item{{($errors->has('title')? ' error':NULL)}}" type="text" id="title" name="title" required autofocus value="{{old('title')}}">
              @else
                <input class="form-control col-8 form_item{{($errors->has('title')? ' error':NULL)}}" type="text" id="title" name="title" required autofocus value="{{isset($apartment)?$apartment->title:NULL}}">
              @endif
            </div>
            <div class="form-group">
              <label class="form_item" for="description">Descrizione</label>
              @if( old('description') )
                <textarea class="form-control form_item{{($errors->has('description')? ' error':NULL)}}" id="description" rows="15" cols="80" name="description" required>{{old('description')}}</textarea>
              @else
                <textarea class="form-control form_item{{($errors->has('description')? ' error':NULL)}}" id="description" name="description" rows="15" cols="80"  required>{{isset($apartment)?$apartment->description:NULL}}</textarea>
              @endif
            </div>
          </div>


          <div class="col-2">
            <div class="form-group">

              <label class="form_item" for="square_meters">Di metri quadrati</label>
              @if(old('square_meters'))
                <input class="form-control col-8 form_item{{($errors->has('square_meters')? ' error':NULL)}}" name="square_meters" type="text" id="square_meters" required value="{{old('square_meters')}}">
              @else
                <input class="form-control col-8 form_item{{($errors->has('square_meters')? ' error':NULL)}}" name="square_meters" type="text" id="square_meters" required value="{{isset($apartment)?$apartment->square_meters:NULL}}">
              @endif
            </div>
            <div class="form-group">
              <label class="form_item" for="room_count">Quante stanze?</label>
              @if(old('room_count'))
                <input class="form-control col-8 form_item{{($errors->has('room_count')? ' error':NULL)}}" name="room_count" id="room_count" required value="{{old('room_count')}}">
              @else
                <input class="form-control col-8 form_item{{($errors->has('room_count')? ' error':NULL)}}" name="room_count" id="room_count" required value="{{isset($apartment)?$apartment->room_count:NULL}}">
              @endif
            </div>
            <div class="form-group">
              <label class="form_item" for="bathroom_count">Quanti bagni</label>
              @if(old('bathroom_count'))
                <input class="form-control col-8 form_item{{($errors->has('bathroom_count')? ' error':NULL)}}" name="bathroom_count" id="bathroom_count" required value="{{old('bathroom_count')}}">
              @else
                <input class="form-control col-8 form_item{{($errors->has('bathroom_count')? ' error':NULL)}}" name="bathroom_count" id="bathroom_count" required value="{{isset($apartment)?$apartment->bathroom_count:NULL}}">
              @endif
            </div>
            <div class="form-group">
              <label class="form_item" for="price">Prezzo affitto</label>
              @if(old('price'))
                <input class="form-control col-8 form_item{{($errors->has('price')? ' error':NULL)}}" name="price" id="price" required value="{{old('price')}}">
              @else
                <input class="form-control col-8 form_item{{($errors->has('price')? ' error':NULL)}}" name="price" id="price" required value="{{isset($apartment)?$apartment->price:NULL}}">
              @endif
            </div>
            <div class="form-group">
              <label class="form_item" for="latitude">LAT</label>
              @if(old('latitude'))
                <input class="form-control col-8 form_item{{($errors->has('latitude')? ' error':NULL)}}" name="latitude" id="latitude" required value="{{old('latitude')}}">
              @else
                <input class="form-control col-8 form_item{{($errors->has('latitude')? ' error':NULL)}}" name="latitude" id="latitude" required value="{{isset($apartment)?$apartment->latitude:NULL}}">
              @endif
            </div>
            <div class="form-group">
              <label class="form_item" for="longitude">LON</label>
              @if(old('price'))
                <input class="form-control col-8 form_item{{($errors->has('longitude')? ' error':NULL)}}" name="longitude" id="longitude" required value="{{old('longitude')}}">
              @else
                <input class="form-control col-8 form_item{{($errors->has('longitude')? ' error':NULL)}}" name="longitude" id="longitude" required value="{{isset($apartment)?$apartment->longitude:NULL}}">
              @endif
            </div>
          </div>
          <div class="form-group col-3">
            <h5>Scegli i servizi disponibili</h5>
            @foreach ($servizi_non_selezionati as $service)
              <div class="inpuServizi" id="services">
                {{-- @if(old('services[]')) --}}
                <input type="checkbox" name="services[]" value="{{$service->id}}">
                <label for="{{$service->name}}">{{$service->name}}</label>
              </div>
            @endforeach
            <h5>Servizi già selezionati</h5>
            @foreach ($apartment->services as $service)
              <div class="inpuServizi">
                <input type="checkbox" name="services[]" value="{{$service->id}}" checked>
                <label for="{{$service->name}}">{{$service->name}}</label>
              </div>
            @endforeach
            <h6>Aggiungi servizio mancante</h6>
            <input type="checkbox" id="check" value="crea">
            <div class="inpuServizi" id="insert_new">
              <input id="user_serv" type="text" placeholder="nome servizio">
              <button id="add" class="btn btn-primary" type="button" name="button">Aggiungi</button>
            </div>
          </div>
          <div class="buttons_section">
              <button type="submit" class="btn btn-success">Salva</button>
              <a class="btn btn-primary" href="{{route('dashboard')}}">Torna alla dashboard</a>
          </div>
       </form>
      </div>
    </div>

    <script src="{{asset('js/new_service.js')}}"></script>
@endsection
