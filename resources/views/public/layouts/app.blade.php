<!--

    |------------------------------------------------------------
    | Website created by Norman Huth                            |
    |------------------------------------------------------------
    |                                                           |
    | Website Developer: Norman Huth                            |
    | Website Support: Norman Huth                              |
    | Server Hosting: Norman Huth                               |
    |                                                           |
    | For inquiries and requests visit https://huth.it/         |
    |                                                           |
    |------------------------------------------------------------

-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ _asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ _asset('/css/buttons.css') }}" rel="stylesheet">
    <script src="{{ _asset('/js/app.js') }}" defer></script>
    @if(!empty($desc))<meta name="description" content="{{ $desc }}">@endif
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#0071bc">
    <meta name="msapplication-config" content="/favicon/browserconfig.xml">
    <meta name="theme-color" content="#0071bc">
    <script src="https://kit.fontawesome.com/d96ba313b0.js" crossorigin="anonymous"></script>
</head>
<body>
@routes
@inertia
</body>
</html>
