<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Shufflehex</title>

    <link rel="stylesheet" href="{{ asset('ChangedDesign/css/main.css') }}">

	<link rel="stylesheet" href="{{ asset('shufflehex/plugins/summernote-0.8.9/summernote.css') }}">


    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">



@yield('css')



</head>

<body>

<div id="wrapper">
	@if( !(Request::is('page404')) )

        @include('partials.top-bar')

	@endif

<div class="container">

	<div class="row">



		<div class="col-md-2 pl-0">

			@if( !(Request::is('login') || Request::is('pages/register') || Request::is('page404'))  )

			    @include('partials.list-left-sidebar')

			@endif

		</div>

		<div class="col-md-8 col-sm-12 plr-2">

			@yield('content')

		</div>

		<div class="col-md-2">

			@if( !(Request::is('login') || Request::is('pages/register') || Request::is('page404')) )

			    @include('partials.list-left-sidebar')

			@endif

    </div>

    <div class="overlay"></div>

</div>

@yield('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('shufflehex/js/text-editor.js') }}"></script>
<script src="{{ asset('shufflehex/plugins/summernote-0.8.9/summernote.js') }}"></script>




</body>

</html>