<!DOCTYPE html>
<html>
    <head>
        <title>Teste do mozão</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
           <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
