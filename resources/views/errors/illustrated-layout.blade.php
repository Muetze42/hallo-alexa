<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        @php $pageMeta['og_title'] = $__env->yieldContent('code').' - '.$__env->yieldContent('title') @endphp
        <title>@yield('title')</title>@include('public.layouts.meta', $pageMeta)
{{--        <link href="{{ mix('/css/error-pages.css') }}" rel="stylesheet">--}}
{{-- Todo: Remove --}}
        <style>
            @font-face{font-display:swap;font-family:Nunito;font-style:normal;font-weight:400;src:url(/webfonts/nunito/nunito-v16-latin-regular.eot);src:local(""),url(/webfonts/nunito/nunito-v16-latin-regular.eot?#iefix) format("embedded-opentype"),url(/webfonts/nunito/nunito-v16-latin-regular.woff2) format("woff2"),url(/webfonts/nunito/nunito-v16-latin-regular.woff) format("woff"),url(/webfonts/nunito/nunito-v16-latin-regular.ttf) format("truetype"),url(/webfonts/nunito/nunito-v16-latin-regular.svg#Nunito) format("svg")}html{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;line-height:1.15}body{margin:0}figcaption,header,main,nav,section{display:block}a{-webkit-text-decoration-skip:objects;background-color:transparent}strong{font-weight:inherit;font-weight:bolder}code{font-family:monospace,monospace;font-size:1em}dfn{font-style:italic}svg:not(:root){overflow:hidden}button,input{font-family:sans-serif;font-size:100%;line-height:1.15;margin:0;overflow:visible}button{text-transform:none}[type=reset],[type=submit],button,html [type=button]{-webkit-appearance:button}[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner,button::-moz-focus-inner{border-style:none;padding:0}[type=button]:-moz-focusring,[type=reset]:-moz-focusring,[type=submit]:-moz-focusring,button:-moz-focusring{outline:1px dotted ButtonText}legend{color:inherit;display:table;max-width:100%;white-space:normal}[type=checkbox],[type=radio],legend{box-sizing:border-box;padding:0}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}[type=search]::-webkit-search-cancel-button,[type=search]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}menu{display:block}canvas{display:inline-block}[hidden],template{display:none}html{box-sizing:border-box;font-family:sans-serif}*,:after,:before{box-sizing:inherit}p{margin:0}button{background:transparent;padding:0}button:focus{outline:1px dotted;outline:5px auto -webkit-focus-ring-color}*,:after,:before{border:0 solid #dae1e7}[type=button],[type=reset],[type=submit],button{border-radius:0}button,input{font-family:inherit}input:-ms-input-placeholder{color:inherit;opacity:.5}input::-moz-placeholder{color:inherit;opacity:.5}input::placeholder{color:inherit;opacity:.5}[role=button],button{cursor:pointer}.bg-transparent{background-color:transparent}.bg-white{background-color:#fff}.bg-teal-light{background-color:#64d5ca}.bg-blue-dark{background-color:#2779bd}.bg-indigo-light{background-color:#7886d7}.bg-purple-light{background-color:#a779e9}.bg-no-repeat{background-repeat:no-repeat}.bg-cover{background-size:cover}.border-grey-light{border-color:#dae1e7}.hover\:border-grey:hover{border-color:#b8c2cc}.rounded-lg{border-radius:.5rem}.border-2{border-width:2px}.hidden{display:none}.flex{display:flex}.items-center{align-items:center}.justify-center{justify-content:center}.font-sans{font-family:Nunito,sans-serif}.font-light{font-weight:300}.font-bold{font-weight:700}.font-black{font-weight:900}.h-1{height:.25rem}.leading-normal{line-height:1.5}.m-8{margin:2rem}.my-3{margin-bottom:.75rem;margin-top:.75rem}.mb-8{margin-bottom:2rem}.max-w-sm{max-width:30rem}.min-h-screen{min-height:100vh}.py-3{padding-bottom:.75rem;padding-top:.75rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pb-full{padding-bottom:100%}.absolute{position:absolute}.relative{position:relative}.pin{bottom:0;left:0;right:0;top:0}.text-black{color:#22292f}.text-grey-darkest{color:#3d4852}.text-grey-darker{color:#606f7b}.text-2xl{font-size:1.5rem}.text-5xl{font-size:3rem}.uppercase{text-transform:uppercase}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.tracking-wide{letter-spacing:.05em}.w-16{width:4rem}.w-full{width:100%}@media (min-width:768px){.md\:bg-left{background-position:0}.md\:bg-right{background-position:100%}.md\:flex{display:flex}.md\:my-6{margin-bottom:1.5rem;margin-top:1.5rem}.md\:min-h-screen{min-height:100vh}.md\:pb-0{padding-bottom:0}.md\:text-3xl{font-size:1.875rem}.md\:text-15xl{font-size:9rem}.md\:w-1\/2{width:50%}}@media (min-width:992px){.lg\:bg-center{background-position:50%}}
        </style>
    </head>
    <body class="antialiased font-sans">
        <div class="md:flex min-h-screen">
            <div class="w-full md:w-1/2 bg-white flex items-center justify-center">
                <div class="max-w-sm m-8">
                    <div class="text-black text-5xl md:text-15xl font-black">
                        @yield('code', __('Oh no'))
                    </div>

                    <div class="w-16 h-1 bg-purple-light my-3 md:my-6"></div>

                    <p class="text-grey-darker text-2xl md:text-3xl font-light mb-8 leading-normal">
                        {!! nl2br($__env->yieldContent('message')) !!}
                    </p>
                    @if($__env->yieldContent('code') != 503)
                        <a href="{{ app('router')->has('home') ? route('home') : url('/') }}">
                            <button class="bg-transparent text-grey-darkest font-bold uppercase tracking-wide py-3 px-6 border-2 border-grey-light hover:border-grey rounded-lg">
                                {{ __('Go Home') }}
                            </button>
                        </a>
                    @endif
                </div>
            </div>
            <div class="relative pb-full md:flex md:pb-0 md:min-h-screen w-full md:w-1/2">
                <div style="background-image: url({{ asset('img/'.errorImage($__env->yieldContent('code'))) }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center"></div>
            </div>
        </div>
    </body>
</html>
