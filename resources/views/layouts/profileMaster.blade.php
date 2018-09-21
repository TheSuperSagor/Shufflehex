<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Shufflehex</title>


@yield('css')
<body>
@include('partials.list-small-window-sidebar')
<div id="wrapper">
@include('partials.top-bar')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @yield('content')

<!-- jQuery CDN -->
    <!--         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- jQuery Nicescroll CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script src="../js/home.js"></script>
                <script>
                    $(document).ready(function(){

                        document.getElementById("profile_picture_select").onchange = function() {
                            document.getElementById("profile_picture_upload_form").submit();
                        };
                    });
                </script>


</body>
</html>


</body>
</html>