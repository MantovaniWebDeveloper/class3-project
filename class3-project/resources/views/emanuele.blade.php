<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title></title>
    </head>
    <body>
        <form action="/bho.php" method="get">
            <input list="cities" name="cities">
            <datalist id="cities">
                {{--questo sarà riempito da handlebars--}}
            </datalist>
            <input type="submit" value="CERCA">
        </form>
        <script id="city-template" type="text/x-handlebars-template">
            @{{#each this}}
            <option data-value="@{{code}}">@{{name}}</option>
            @{{/each}}
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/emanuele.js') }}"></script>
    </body>
</html>