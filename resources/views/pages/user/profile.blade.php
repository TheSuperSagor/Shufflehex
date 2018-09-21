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
                <h3>{{ $user->name }}</h3>
                <h3>Elite Points: {{ $user->elite_points }}</h3>
                <p>Email: {{ $user->email }}</p>
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
                <li role="presentation" class="{{ Request::is('user/profile') ? 'active' : ''}}"><a href="{{ url('/user/profile') }}">Home</a></li>
                <li role="presentation" class="{{ Request::is('user/posts') ? 'active' : ''}}"><a href="{{ url('/user/posts') }}">Posts</a></li>
                <li role="presentation" class="{{ Request::is('user/settings') ? 'active' : ''}}"><a href="{{ url('/user/settings') }}">Settings</a></li>
                <li role="presentation" class="{{ Request::is('user/change_password') ? 'active' : ''}}"><a href="{{ url('/user/change_password') }}">Change Passoword</a></li>
                <li role="presentation" class="{{ Request::is('user/social_info') ? 'active' : ''}}"><a href="{{ url('/user/social_info') }}">Social Info</a></li>
          </ul>

        </div>
      </div>
    </nav>

    <div id="profile-content">
        <div class="panel panel-primary">
            <div class="panel-body">
                <table class="table">
                    <tr >
                        <td>Total Post</td>
                        <td>{{ $posts }}</td>
                    </tr>
                    <tr >
                        <td>Upvotes</td>
                        <td>{{ $upvotes }}</td>
                    </tr>
                    <tr >
                        <td>Downvotes</td>
                        <td>{{ $downvotes }}</td>
                    </tr>
                    <tr >
                        <td>Saved Stories</td>
                        <td>{{ $savedStories }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>
 @endsection