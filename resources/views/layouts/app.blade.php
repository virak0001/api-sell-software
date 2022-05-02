<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
    <script src="https://js.stripe.com/v3/"></script>

    <title>{{env('APP_NAME')}}</title>
</head>
<body>
<div id="app">
    <div class="fixed w-full z-index: 0">
        <app />
    </div>
    <div>
        @yield('body')
    </div>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
