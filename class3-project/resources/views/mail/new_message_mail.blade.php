@component('mail::message')
Hai un nuovo messaggio per il tuo appartamento:

<b>{{$title}}</b>

@component('mail::button', ['url' => $url])
    Accedial sito
@endcomponent

Grazie,<br>
Il team di BoolBnb
@endcomponent