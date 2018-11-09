@extends('layouts.master')
@section('css')
    <!-- Bootstrap CSS CDN -->
    <title>404</title>
    <link rel="stylesheet" href="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css') }}">

    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Include Editor style. -->
    <!-- Our Custom CSS -->
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/style.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/list-style.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/sidebar.less') }}">

    <script src="{{ asset('//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js') }}"></script>


@endsection


@section('content')

<div class="page-404">
    <h1>404</h1>
    <p class="paragraph">page not found</p>
    <a class="btn btn-xs btn-default" href="{{ url('/story') }}">
        <span>HOMEPAGE</span>
    </a>
</div>

@endsection
@section('js')
    <!-- Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <!-- jQuery Nicescroll CDN -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>

    <script src="js/home.js"></script>


@endsection