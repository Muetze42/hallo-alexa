<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>@if($pageMeta['title']){{ $pageMeta['title'] }}@else{{ config('app.name') }}@endif</title>
    @include('public.layouts.meta')
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <style>{!! trim(File::get(public_path('css/buttons.css'))) !!}</style>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @include('public.layouts.favicon')
    <script src="https://kit.fontawesome.com/d96ba313b0.js" crossorigin="anonymous"></script>
    @mobile<style>.card{margin-bottom: 3rem;}</style>@endmobile
    @tablet<style>.card{margin-bottom:8rem;}</style>@endtablet
</head>
<body>
@routes
@inertia
</body>
</html>
