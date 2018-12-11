<!DOCTYPE html>
<html>
    <head>
        <title>{{$subject}}</title>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Security-Policy" content="default-src *; style-src 'self' http://* 'unsafe-inline'; script-src 'self' http://* 'unsafe-inline' 'unsafe-eval'" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <style>{{file_get_contents("https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css")}}</style>
    <body>
        {!! $body !!}
    </body>
</html>
