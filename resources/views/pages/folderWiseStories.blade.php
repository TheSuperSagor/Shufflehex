<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Saved List</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/style.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/list-style.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/sidebar.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/saved-list.less') }}">

    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js"></script>
</head>
<body>

<div id="wrapper">
    @include('partials.top-bar')
    <div id="body-content">
        <div id="left-sidebar" class="col-md-2 plr-0">
            <div id="list-left-sidebar">
                <div class="sibebar-panel">
                    <div class="sidebar-link-list">
                        <ul class="list-unstyled">
                            <li><a href="{{ url('/post/latest') }}">Latest Stories</a></li>
                            <li><a href="{{ url('/post/top') }}">Top Stories</a></li>
                            <li><a href="{{ url('/post/popular') }}">Popular Stories</a></li>
                            <li><a href="{{ url('/post/trending') }}">Trending Stories</a></li>
                        </ul>
                    </div>
                </div>
                <div class="sidebar-panel-divider"></div>
                <div class="sibebar-panel">
                    <div class="sidebar-link-list">
                        <ul class="list-unstyled">
                            <li><a href="{{ url('/post') }}">All</a></li>
                            <li><a href="{{ url('/post/web') }}">Web</a></li>
                            <li><a href="{{ url('/post/images') }}">Images</a></li>
                            <li><a href="{{ url('/post/videos') }}">Videos</a></li>
                            <li><a href="{{ url('/post/articles') }}">Articles</a></li>
                            <li><a href="{{ url('/post/lists') }}">Lists</a></li>
                            <li><a href="{{ url('/post/polls') }}">Polls</a></li>
                        </ul>
                    </div>
                </div>
                <div class="sidebar-panel-divider"></div>
                <div class="sibebar-panel">
                    <div class="sidebar-link-list">
                        <ul class="list-unstyled">
                            @if (Auth::guest())
                                <li><a href="{{ url('/login') }}">Login</a></li>
                                <li><a href="{{ url('pages/register') }}">Register</a></li>

                            @else
                                <li><a href="{{ url('/user/profile') }}">My Profile</a></li>
                                <li><a href="{{ url('/saved') }}">Saved Stories</a></li>
                                <li><a href="{{ url('/folders') }}">Folders</a></li>
                                <li><a href="{{ url('/post/create') }}">Add Story</a></li>
                                <li><a href="settings.php">Settings</a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-content col-md-7 col-sm-12">


            <div id="" class="row">
                <div class="container-fluid">
                    <h3>Folder Name : {{ $folderStories[0]->folder_name }}</h3>
                </div>

                <div class="container-fluid">
                    <div class="saved-stories">
                        @foreach($folderStories as $folderStory)
                            <?php
$title = preg_replace('/\s+/', '-', $folderStory->title);
$title = preg_replace('/[^A-Za-z0-9\-]/', '', $title);

?>
                            <div class="saved-story-item">
                                <div class="saved-img pull-left">
                                    <a href="{{ url('post/'.$folderStory->post_id.'/'.$title) }}" target="_blank"><img class="" src="{{ $folderStory->featured_image }}"></a>
                                </div>
                                <div>
                                    <h4 class="story-title"><a href="{{ url('post/'.$folderStory->post_id.'/'.$title) }}" target="_blank"> {{ $folderStory->title }}</a></h4>
                                    <div class="row">
                                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                        <div class="addthis_inline_share_toolbox saved_items_share_buttons col-md-10" style="margin-left: 13%;width: 70%;"></div>
                                        <div class="col-md-2">
                                            <a href="#" class="pull-right">
                                                {!! Form::open(array('method'=>'DELETE', 'route'=>array('folderStory.destroy',$folderStory->saved_id)))!!}
                                                {!! Form::submit('Delete', array('class'=>'btn btn-xs btn-danger','onclick' => 'return confirm("Are you sure want to Delete?");'))!!}
                                                {!! Form::close()!!}
                                            </a>
                                        </div>
                                    </div>
                                    {{--<button class="btn btn-xs btn-default"><i class="fa fa-facebook"></i></button>--}}
                                    {{--<button class="btn btn-xs btn-default"><i class="fa fa-twitter"></i></button>--}}
                                    {{--<button class="btn btn-xs btn-default"><i class="fa fa-google-plus"></i></button>--}}

                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        <div id="right-sidebar" class="col-md-3">
            <div id="list-right-sidebar">
                <div class="sidebar-add-image">
                    <img src="http://via.placeholder.com/350x250">
                </div>
            </div>
        </div>
    </div>

    <div class="overlay"></div>
</div>





<!-- jQuery CDN -->
<!--         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap Js CDN -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<!-- jQuery Nicescroll CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

<script src="js/home.js"></script>
<script>
    $(document).ready(function () {
        $('.btn-rename').on('click', function () {
            $.confirm({
                title: '',
                content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>Enter New Name</label>' +
                '<input type="text" placeholder="Folder Name" class="name form-control" required />' +
                '</div>' +
                '</form>',
                buttons: {
                    formSubmit: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function () {
                            var name = this.$content.find('.name').val();
                            if (!name) {
                                $.alert('provide a valid name');
                                return false;
                            }
                            $.alert('Your name is ' + name);
                        }
                    },
                    cancel: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // you can bind to the form
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) { // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        });

        $('.btn-delete').on('click', function () {
            $.confirm({
                title: '',
                content: '<h4 class="text-center">Are you sure?</h4>',
                buttons: {
                    confirm: function () {
                        $.alert('Confirmed!');
                    },
                    cancel: function () {

                    }
                }
            });
        });

        $('.btn-deleteStory').on('click', function () {
            $.confirm({
                title: '',
                content: '<h4 class="text-center">Are you sure?</h4>',
                buttons: {
                    confirm: function () {
                        $.alert('Confirmed!');
                    },
                    cancel: function () {

                    }
                }
            });
        });
    });
    function deleteSavedStory(post_id,user_id){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var property = 'btn_deleteSaveStory_'+post_id;
        console.log(post_id);
        console.log(user_id);
        $.ajax({
            type:'post',
            url: 'saveStory/'.post_id,
            data: {_token: CSRF_TOKEN , post_id: post_id, user_id: user_id},
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                if(data.status == 'saved'){
                    var property = document.getElementById('btn_saveStory_'+post_id);
                    property.style.background = "yellowgreen";
                } else{
                    var property = document.getElementById('btn_saveStory_'+post_id);
                    property.style.removeProperty('background');
                }
            }
        });
    };
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a64cb7833dd1d0d"></script>
</body>
</html>
