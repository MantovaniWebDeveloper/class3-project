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

      <form class="form-group row" action="{{$action=='new_apartment'? route('salva.nuovo') : route('salva.modifica', $apartment->id)}}" method="post" enctype="multipart/form-data">
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

            @if ( $action == 'new_apartment')
              <div class="form-group">
                <label for="address">Inserisci l'indirizzo dell'appartamento</label>
                <input id="user_address" type="text" name="address" placeholder="digita l'indirizzo">
                <button id="search_address" class="btn btn-secondary" type="button" name="button">Cerca indirizzo</button>
              </div>
            @else
              <div class="apartment_map" style="position: relative; display: inline-block">
                <img src="data:image/png;charset=binary;base64,{!! $image !!}">
                <i class="fas fa-map-marker-alt" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);color: red;font-size: 40px"></i>
              </div>
              <p>
                <i class="fas fa-map-marker-alt pr-2 "></i>{{$apartment->address['streetName']}} {{$apartment->address['postal_code']}} {{$apartment->address['municipality']}} - {{$apartment->address['province']}}
              </p>
            @endif

            <div class="form-group">
              <label class="form-inline" for="apartment_img">Carica un'immagine</label>
              <input type="file" name="apartment_img[]" value="scegli.." multiple>
            </div>
            <div class="buttons_section">
                <button type="submit" class="btn btn-success">Salva</button>
                <a class="btn btn-warning" href="{{route('dashboard')}}">Torna alla dashboard</a>
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
              <label class="form_item" for="room_count">Quanti letti?</label>
              @if(old('room_count'))
                <input class="form-control col-8 form_item{{($errors->has('bed_count')? ' error':NULL)}}" name="bed_count" id="bed_count" required value="{{old('bed_count')}}">
              @else
                <input class="form-control col-8 form_item{{($errors->has('bed_count')? ' error':NULL)}}" name="bed_count" id="bed_count" required value="{{isset($apartment)?$apartment->bed_count:NULL}}">
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
            @if ( $action == 'new_apartment')
              @foreach ($services as $service)
                <div class="inpuServizi">
                  <input type="checkbox" name="services[]" value="{{$service->id}}">
                  <label for="{{$service->name}}">{{$service->name}}</label>
                </div>
              @endforeach
            @else
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
            @endif



            <div class="form-group col-10">
              <h5>Vuoi aggiungere un servizio non in lista?</h5>
              <button id="show" class="btn btn-primary" type="button" name="button">Aggiungi</button>
            </div>

            <div class="hidden" id="insert_new">
              <div class="form-group">
                <input id="user_serv" type="text" placeholder="nome servizio">
              </div>
              <button id="add" class="btn btn-primary" type="button" name="button">Aggiungi alla lista</button>
            </div>
          </div>

       </form>
      </div>
    </div>

<script src="{{asset('js/common.js')}}"></script>
 <script src="{{asset('js/search_address.js')}}"></script>
 <script src="{{asset('js/new_service.js')}}"></script>
@endsection
