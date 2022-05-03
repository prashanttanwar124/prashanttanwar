<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/website/app.css') }}">
    <!-- Load Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,100,300italic,300,100italic,400italic,500,500italic,700,700italic&amp;subset=latin,cyrillic" rel="stylesheet" />
    {{ seo()->render() }}
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicons/favicon-16x16.png">
</head>
<body>
    <div id="app">
        <index></index>
    </div>
    <script src="{{ asset('/js/website/website.js') }}" defer></script>
</body>
</html>
