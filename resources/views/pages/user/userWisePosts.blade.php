@extends('layouts.profileMaster')


@section('css')
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}">


    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Include Editor style. -->
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_editor.pkgd.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1/css/froala_style.min.css') }}" rel="stylesheet" type="text/css" />


    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('ChangedDesign/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('ChangedDesign/css/profile.css') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/style.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/profile.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/list-style.less') }}">

    <script src="{{ asset('//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js') }}"></script>
@endsection
@section('content')

    <div class="profile">
        <div class="box">
            <div class="profile-info">
                <div class="profile-header text-center">
                    <div class="profile-img">
                        <img class="img-responsive" src="{{ $user->profile_picture_link }}">
                    </div>
                    <h1 style="margin-bottom: 2%">{{ $user->name }}</h1>
                    <h3>Elite Points: {{ $user->elite_points }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="box">
        <nav class="navbar navbar-default">
            <div class="profile-sidebar-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#profile" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>


                <div class="collapse navbar-collapse tab-bar" id="profile">
                    <ul class="nav nav-pills">
                        <li role="presentation" class="active"><strong><u><h3>Posts</h3></u></strong></li>
                    </ul>

                </div>
            </div>
        </nav>

        <div id="profile-content">
            @foreach($posts as $post)


                <?php
                $title = preg_replace('/\s+/', '-', $post->title);
                $title = preg_replace('/[^A-Za-z0-9\-]/', '', $title);
                $title = $title.'-'.$post->id;

                ?>

                <div class="story-item">
                    <div class="row">
                        <div class="col-md-3 col-sm-9 col-xs-3">
                            <div class="story-img">
                                <a href="{{ url('story/'.$title) }}"><img class="" src="{{ url($post->story_list_image) }}"></a>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-9">

                            <h4 class="story-title"><a href="{{ url('story/'.$title) }}"> {{ $post->title }}</a></h4>
                            <?php
                            $description = substr($post->description, 0, 120)

                            ?>
                            <p>{{ $description }}</p>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <div class="overlay"></div>
@endsection