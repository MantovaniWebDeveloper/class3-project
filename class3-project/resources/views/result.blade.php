@extends('layout.main')
@section('content')
    @include('header')
    <div class="wrapSearch">
        @include('search')
        <div class="modalLoading text-center">
            <i class="fas fa-circle-notch fa-spin"></i>
        </div>
        <div class="wrapAll">
            <div class="container">
                <div class="wrapAllInterno">
                    <aside>
                        <h3 class="pt-2 pl-2">Filtri per servizi clienti:</h3>

                        <hr>
                        <div class="wrapServizi pt-2 pl-2">
                            @foreach ($services as  $servizio)
                                <div class="inpuServizi">
                                    <input class="servizio largo" type="checkbox" name="services" value="{{$servizio->id}}">
                                    <label for="{{$servizio->name}}">{{$servizio->name}}</label>
                                </div>
                            @endforeach
                        </div>
                        <h3 class="pt-2 pl-2">Ordinamento:</h3>
                        <div class="wrapOrdinamento pt-2 pl-2">
                            <div class="inpuOrdinamento">
                                <input class="ordinamento" type="radio" name="order_type" value="distance" checked>
                                <label for="distanza">distanza</label>
                            </div>
                            <div class="inpuOrdinamento">
                                <input class="ordinamento" type="radio" name="order_type" value="price">
                                <label for="distanza">prezzo</label>
                            </div>
                        </div>
                        <h3 class="pt-2 pl-2">Prezzi :</h3>
                        <div class="wrapOrdinamento pt-2 pl-2">
                            <div class="inpuPrezzo">
                                <input class="tipoPrezzo" type="checkbox" name="price_range" value="1">
                                <label for="tipo_prezzo">0 - 50 </label>
                            </div>
                            <div class="inpuPrezzo">
                                <input class="tipoPrezzo" type="checkbox" name="price_range" value="10">
                                <label for="tipo_prezzo">50 - 100</label>
                            </div>
                            <div class="inpuPrezzo">
                                <input class="tipoPrezzo" type="checkbox" name="price_range" value="100">
                                <label for="tipo_prezzo">100 - 300</label>
                            </div>
                        </div>

                        <div class="range pl-2 pr-2">
                            <label for="formControlRange">Raggio km</label>
                            <input type="range" class="barra custom-range" min="10" max="100" step="1" value="{{$radius}}">
                        </div>
                    </aside>
                    <div class="wrapResult">
                        <h3>Risultati trovati:
                            <span id="result_count"></span>
                        </h3>
                        <div class="wrap_results_content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HANDLEBARS TEMPLATES-->
    <script id="resultAjax-template" type="text/x-handlebars-template">
        @{{#each this}}
        <div class="wrapRisultato">
            <div class="row">
                <div class="col-4 wrap-img">
                    <img class="img-fluid pt-2" src="" alt="">
                </div>
                <div class="col-8">
                    <h3 class="pt-2">@{{title}}</h3>
                    <p>
                        <i class="fas fa-map-marker-alt pr-2 "></i>
                    </p>
                    <h5>numeri letto: @{{bed_count}}</h5>
                    <p>@{{description}}</p>
                    <h3>@{{price}} €</h3>
                    <div class="wrapBtn">
                        <a href="http://127.0.0.1:8000/appartamenti/@{{slug}}">
                            <button class="btn btn-danger text-right" type="button" name="button">Descrizione completa</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @{{/each}}
    </script>
    <script id="resultAjax-promo-template" type="text/x-handlebars-template">
        @{{#each this}}
        <div class="wrapRisultato" style="background-color:lightblue;position:relative">
            <p style="position: absolute;top:0;right: 0;font-size: 7px;padding-right: 5px">Sponsorizzato</p>
            <div class="row">
                <div class="col-4 wrap-img">
                    <img class="img-fluid pt-2" src="" alt="">
                </div>
                <div class="col-8">
                    <h3 class="pt-2">@{{title}}</h3>
                    <p>
                        <i class="fas fa-map-marker-alt pr-2 "></i>
                    </p>
                    <h5>numeri letto: @{{bed_count}}</h5>
                    <p>@{{description}}</p>
                    <h3>@{{price}} €</h3>
                    <div class="wrapBtn">
                        <a href="http://127.0.0.1:8000/appartamenti/@{{slug}}">
                            <button class="btn btn-danger text-right" type="button" name="button">Descrizione completa</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @{{/each}}
    </script>

    <script id="resultLoading-template" type="text/x-handlebars-template">
        <div id="loading-element" class="wrapRisultato">
            <div class="card-style" style="padding: 30px;text-align: center;font-size: 30px">
                <i class="fas fa-spinner fa-spin"></i>
            </div>
        </div>
    </script>

    <script src="{{asset('js/common.js')}}"></script>
    <script src="{{asset('js/ricercaInterna.js')}}"></script>

@endsection
