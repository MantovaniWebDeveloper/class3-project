@extends('layout.main')
@section('content')
    @include('header')
    @if(isset($errorMessage))
        <div class="">
            <span>{{$errorMessage}}</span>
        </div>
    @endif
    <form method="POST" action="{{route('create_customer')}}">
        @csrf
        <div class="">
            <label for="first_name">Nome</label>
            <input type="text" id="first_name" name="firstName" required>
        </div>
        <div class="">
            <label for="last_name">Cognome</label>
            <input type="text" id="last_name" name="lastName" required>
        </div>
        <div class="">
            <label for="address">Indirizzo</label>
            <input type="text" id="address" name="streetAddress" required>
        </div>
        <div class="">
            <label for="address_line">Indirizzo</label>
            <input type="text" id="address_line" name="extendedAddress">
        </div>
        <div class="">
            <label for="locality">Località</label>
            <input type="text" id="locality" name="locality" required>
        </div>
        <div class="">
            <label for="postal_code">CAP</label>
            <input type="text" id="postal_code" name="postalCode" required>
        </div>
        <input type="submit" value="INVIA">
    </form>
@endsection