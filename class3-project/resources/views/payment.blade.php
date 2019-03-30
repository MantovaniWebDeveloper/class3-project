@extends('layout.main')
@section('content')
    @include('header')

    <div>
        <span id="message"></span>
    </div>

    <div class="wrapper">
        <div class="offset-3 col-6" style="text-align: center">
            <h2>Appartamento sponsorizzato</h2>
            <h3>{{$apartment->title}}</h3>
            <div class="">
                <input type="radio" name="promotion_type" value="0" checked="checked"> Euro 2,99 per 24 ore di sponsorizzazione
            </div>
            <div class="">
                <input type="radio" name="promotion_type" value="1"> Euro 5,99 per 72 ore di sponsorizzazione
            </div>
            <div class="">
                <input type="radio" name="promotion_type" value="2"> Euro 9,99 per 144 ore di sponsorizzazione
            </div>
        </div>
        <div class="">
            <div id="dropin-container" class="offset-4 col-4" data-slug="{{$apartment->slug}}"></div>
        </div>
        <button id="submit-button" class="offset-5 col-2" style="text-align: center" disabled>Invia pagamento</button>
    </div>
    <div class="success offset-3 col-6" style="padding: 10px" hidden>
        <h3>Grazie per aver effettuato l'acquisto</h3>
        <p class="end_message"></p>
        <a href="{{route('dashboard')}}">Torna alla dashoboard</a>
    </div>
    <div class="wanna_promote hide">
        <h2>Ecco altri appartamenti che potresti sponsorizzare</h2>
        <div class="wannabe_wrapper">
            @if(!$wannaPromote->isEmpty())
                @foreach($wannaPromote as $item)
                    <a href="{{route('sponsorizza',$item->slug)}}" class="card" style="display: inline-block; padding: 10px; border: 1px solid black; margin: 10px; text-decoration: none; width: 300px;">
                        <h4>{{$item->title}}</h4>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
    <script src="https://js.braintreegateway.com/web/dropin/1.16.0/js/dropin.min.js"></script>
    <script src="{{asset('js/payment.js')}}"></script>
@endsection