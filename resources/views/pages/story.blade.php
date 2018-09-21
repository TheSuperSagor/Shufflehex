@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/style.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/sidebar.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/view-story.less') }}">
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js"></script>
@endsection
<?php
$embed = EmbedVideo::make($post->link)->parseUrl();
// Will return Embed class if provider is found. Otherwie will return false - not found. No fancy errors for now.
if ($embed) {
// Set width of the embed.
	$embed->setAttribute(['width' => 600]);

// Print html: '<iframe width="600" height="338" src="//www.youtube.com/embed/uifYHNyH-jA" frameborder="0" allowfullscreen></iframe>'.
	// Height will be set automatically based on provider width/height ratio.
	// Height could be set explicitly via setAttr() method.

}
?>

<?php
$upVoteMatched = 0;
$downVoteMatched = 0;
$savedStory = 0;
$votes = 0;
?>
@foreach($post->votes as $key=>$vote)
    <?php
    $votes += $vote->vote;
    ?>
@endforeach
@if(isset(Auth::user()->id) && !empty(Auth::user()->id))
    @foreach($post->votes as $key=>$vote)
        @if($vote->user_id == Auth::user()->id && $vote->vote == 1)
            <?php $upVoteMatched = 1;?>
            @break
        @endif
    @endforeach
    @foreach($post->votes as $key=>$vote)
        @if($vote->user_id == Auth::user()->id && $vote->vote == -1)
            <?php $downVoteMatched = 1;?>
            @break
        @endif
    @endforeach
    @foreach($post->saved_stories as $key=>$saved)
        @if($saved->user_id == Auth::user()->id && $saved->post_id == $post->id)
            <?php $savedStory = 1;?>
            @break
        @endif
    @endforeach
@endif
@section('content')

        <div class="single-story-body">
            <div class="story-heading">
                <h1>{{ $post->title }}</h1>
                <p><span>Submitted by <strong>{{ $post->username }}</strong></span></p>
            </div>
            <div class="feature-img">
                @if($post->is_video==1)
                    <?php
echo $embed->getHtml();
?>
                @else
                <img class="img-responsive" src="{{ $post->featured_image }}">
                @endif
                <div class="link-source">
                    <span class="pull-left">source: <a href="#">{{ $post->domain }}</a></span>
                </div>
            </div>

            <div class="story-content">
                <p>
                    {!! $post->description !!}
                </p>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @if($post->is_link==1)
                        <a class="btn btn-sm btn-danger dis-blk" href="{{ url('post/'.$post->id.'/story/view') }}">Read Full Story</a>
                    @endif
                </div>
            </div>
            <div class="row vote">
                <div class="col-md-4 col-sm-6 col-xs-6 up-btn">
                    @if($upVoteMatched == 1)
                        <a class="btn btn-xs" onclick="upVote({{
                        $post->id
                        }})"><span  id="btn_upVote_{{ $post->id }}" class="thumb-up glyphicon glyphicon-triangle-top" style="color: green"></span></a>
                        <span class="vote-counter text-center">Upvote</span>
                        <span class="vote-counter text-center" id="vote_count_{{ $post->id }}">{{ $votes }}</span>
                    @else
                        <a class="" onclick="upVote({{
                        $post->id
                        }})"><span id="btn_upVote_{{ $post->id }}" class="thumb glyphicon glyphicon-triangle-top" ></span></a>
                        <span class="vote-counter text-center">Upvote</span>
                        <span class="vote-counter text-center" id="vote_count_{{ $post->id }}">{{ $votes }}</span>
                    @endif

                </div>
                <div class="col-md-4 col-sm-6 col-xs-6 col-md-offset-4 col-sm-offset-4">
                    <div class="col-md-2 col-sm-2 col-xs-2 p-0 down-btn">
                        @if($downVoteMatched == 1)
                            <a class="pull-right" onclick="downVote({{
                            $post->id
                            }})"><span id="btn_downVote_{{ $post->id }}" class="thumb-down glyphicon glyphicon-triangle-bottom" style="color: red"></span> </a>
                        @else
                            <a class="pull-right" onclick="downVote({{
                            $post->id
                            }})"><span id="btn_downVote_{{ $post->id }}" class="thumb glyphicon glyphicon-triangle-bottom"></span></a>
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 p-0 comment-btn text-center">
                            <a class=""><span ><span class="vote-counter text-center" id="vote_count_{{ $post->id }}"></span></span><i class="fa fa-comment"></i>{{ $totalComments }}</a>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 p-0 saved-btn">
                        @if($downVoteMatched == 1)
                            <a class="pull-right"><span><span class="vote-counter text-center" id="vote_count_{{ $post->id }}"></span></span><i class="fa fa-bookmark saved"></i></a>
                        @else
                            <a class="pull-right"><span></span><span class="vote-counter text-center" id="vote_count_{{ $post->id }}"></span><i class="fa fa-bookmark"></i></a>
                        @endif
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 p-0 saved-btn">
                        <a class="pull-right" onclick="downVote({{ $post->id }})">
                            <span class="glyphicon glyphicon-option-horizontal" ></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="box recent-stories vote">
            <div class="box-header">Related Stories</div>
            <div class="row stories-item">
                <div class="col-md-1 col-sm-2 col-xs-2 pl-0">
                    <a href="#">
                        <img class="img-responsive" src="{{ asset('img/profile-header-orginal.jpg') }}" alt="user profile">
                    </a>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-9 pl-0">
                    <a href="#"><p>{{ $post->title }}</p></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-1 pt-5 p-0 pr-0">
                    @if(False)
                        <a class="pull-right li-1" >
                            <span  class="thumb-up glyphicon glyphicon-triangle-top"></span>
                            <span class="vote-counter text-center dis-n" >Upvote</span>
                            <span class="vote-counter text-center" >10</span>
                        </a>
                    @else
                        <a class="pull-right li-1">
                            <span class="thumb glyphicon glyphicon-triangle-top" ></span>
                            <span class="vote-counter text-center dis-n" >Upvote</span>
                            <span class="vote-counter text-center" >10</span>
                        </a>
                    @endif
                </div>
            </div>
            <div class="row stories-item">
                <div class="col-md-1 col-sm-2 col-xs-2 pl-0">
                    <a href="#">
                        <img class="img-responsive" src="{{ asset('img/profile-header-orginal.jpg') }}" alt="user profile">
                    </a>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-9 pl-0">
                    <a href="#"><p>{{ $post->title }}</p></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-1 pt-5 p-0 pr-0">
                    @if(False)
                        <a class="pull-right li-1" >
                            <span  class="thumb-up glyphicon glyphicon-triangle-top"></span>
                            <span class="vote-counter text-center dis-n" >Upvote</span>
                            <span class="vote-counter text-center" >10</span>
                        </a>
                    @else
                        <a class="pull-right li-1">
                            <span class="thumb glyphicon glyphicon-triangle-top" ></span>
                            <span class="vote-counter text-center dis-n" >Upvote</span>
                            <span class="vote-counter text-center" >10</span>
                        </a>
                    @endif
                </div>
            </div>
            <div class="row stories-item">
                <div class="col-md-1 col-sm-2 col-xs-2 pl-0">
                    <a href="#">
                        <img class="img-responsive" src="{{ asset('img/profile-header-orginal.jpg') }}" alt="user profile">
                    </a>
                </div>
                <div class="col-md-9 col-sm-8 col-xs-9 pl-0">
                    <a href="#"><p>{{ $post->title }}</p></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-1 pt-5 p-0 pr-0">
                    @if(False)
                        <a class="pull-right li-1" >
                            <span  class="thumb-up glyphicon glyphicon-triangle-top"></span>
                            <span class="vote-counter text-center dis-n" >Upvote</span>
                            <span class="vote-counter text-center" >10</span>
                        </a>
                    @else
                        <a class="pull-right li-1">
                            <span class="thumb glyphicon glyphicon-triangle-top" ></span>
                            <span class="vote-counter text-center dis-n" >Upvote</span>
                            <span class="vote-counter text-center" >10</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>


        <div class="comment-section">
            <div class="row comment-box">
                <form id="addNewStory" action="{{ route('comment.store') }}" method="POST" role="form">
                    {{ csrf_field() }}
                    <div class="col-md-10 col-sm-10 col-xs-10 form-group  pl-0">
                        <input type="text" name="reply" placeholder="Comment..." id="storyDesc"  class="form-control">
                    </div>
                    {{--<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">--}}
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="col-md-2 col-sm-2 col-xs-2 dis-n pr-0">
                        <button type="submit" name="storySubmit" id="storySubmit" class="btn btn-danger pull-right">Comment</button>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 dis-show pr-0">
                        <button type="submit" name="storySubmit" id="storySubmit" class="btn btn-danger pull-right">
                            <span class="thumb glyphicon glyphicon-send"></span>
                        </button>
                    </div>
                </form>
            </div>


            <div class="comment">
                @foreach($post->comments as $comment)
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-1 col-md-1">
                                    <a href="#">
                                        <img class="img-circle" src="{{ asset('img/profile-header-orginal.jpg') }}" alt="user profile">
                                    </a>
                                </div>
                                <div class="col-md-11 col-xs-11 pl-0">
                                    <span class="comment-user text-primary"><strong>{{ $comment->username }}</strong>&nbsp;
                                        <span class="small text-muted commentTime postTime">
                                            {{ $comment->created_at }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="comment-body">
                                <p>{{ $comment->comment }}</p>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    @if(False)
                                        <a ><span   class="thumb-up glyphicon glyphicon-triangle-top"></span>Upvote
                                        <span class="vote-counter text-center" id="vote_count_{{ $post->id }}">{{ $votes }}</span></a>
                                    @else
                                        <a ><span  class="thumb glyphicon glyphicon-triangle-top" ></span>Upvote
                                        <span class="vote-counter text-center" id="vote_count_{{ $post->id }}">{{ $votes }}</span></a>
                                    @endif
                                </div>
                            </div>
                            <div class="reply">
                                @foreach($post->replies as $reply)
                                    @if($comment->id == $reply->comment_id)
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-1 col-md-1">
                                                    <a href="#">
                                                        <img class="img-circle" src="{{ asset('img/profile-header-orginal.jpg') }}" alt="user profile">
                                                    </a>
                                                </div>
                                                <div class="col-md-11 col-xs-11 pl-0">
                                                    <span class="reply-user text-primary"><strong>{{ $reply->username }}</strong>&nbsp;
                                                        <span class="small text-muted commentTime postTime">
                                                            {{ $reply->created_at }}
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="comment-body" style="max-width: 100%">
                                                <p>{{ $reply->reply }}</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    @if(False)

                                                        <a ><span   class="thumb-up glyphicon glyphicon-triangle-top" ></span>Upvote
                                                        <span class="vote-counter text-center" id="vote_count_{{ $post->id }}">{{ $votes }}</span> </a>
                                                    @else
                                                        <a ><span  class="thumb glyphicon glyphicon-triangle-top" ></span>Upvote
                                                            <span class="vote-counter text-center" id="vote_count_{{ $post->id }}">{{ $votes }}</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach

                                <div class="row reply-box">
                                    <form id="addNewStory" action="{{ route('reply.store') }}" method="POST" role="form">
                                        {{ csrf_field() }}
                                        <div class="col-md-10 col-sm-10 col-xs-10 form-group">
                                            <input type="text" name="reply" placeholder="Reply..." id="storyDesc"  class="form-control">
                                        </div>
                                        {{--<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">--}}
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <div class="col-md-2 col-sm-2 col-xs-2 dis-n pr-0">
                        <button type="submit" name="storySubmit" id="storySubmit" class="btn btn-danger pull-right">Reply</button>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 dis-show pr-0">
                        <button type="submit" name="storySubmit" id="storySubmit" class="btn btn-danger pull-right">
                            <span class="thumb glyphicon glyphicon-send"></span>
                        </button>
                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

@endsection




@section('js')
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- jQuery Nicescroll CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>
    <script src="js/home.js"></script>

    <script>
        $( document ).ready(function() {
            $("#latest_stories").attr("href", "{{ url('/post/latest/all') }}");
            $("#top_stories").attr("href", "{{ url('/post/top/all') }}");
            $("#popular_stories").attr("href", "{{ url('/post/popular/all') }}");
            $("#trending_stories").attr("href", "{{ url('/post/trending/all') }}");
        });
        function upVote(post_id){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var property = 'btn_upVote_'+post_id;
            console.log(post_id);
            $.ajax({
                type:'post',
                url: '{{url("vote")}}',
                data: {_token: CSRF_TOKEN , post_id: post_id},
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    if(data.status == 'upvoted'){
                        var property = document.getElementById('btn_downVote_'+post_id);
                        property.style.removeProperty('color');
                        var property = document.getElementById('btn_upVote_'+post_id);
                        property.style.color = "green"
                        $('#vote_count_'+post_id).text(data.voteNumber);
                    } else{
                        var property = document.getElementById('btn_upVote_'+post_id);
                        property.style.removeProperty('color');
                        $('#vote_count_'+post_id).text(data.voteNumber);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    if(xhr.status==401) {
                        alert('Please login to vote!!!');
                    }
                }
            });
        };

        function downVote(post_id){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var property = 'btn_downVote_'+post_id;
            console.log(property);
            $.ajax({
                type:'post',
                url: '{{url("vote/downVote")}}',
                data: {_token: CSRF_TOKEN , post_id: post_id},
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    if(data.status == 'downvoted'){
                        var property = document.getElementById('btn_upVote_'+post_id);
                        property.style.removeProperty('color');
                        var property = document.getElementById('btn_downVote_'+post_id);
                        property.style.color = "orangered"
                        $('#vote_count_'+post_id).text(data.voteNumber);
                    } else{
                        var property = document.getElementById('btn_downVote_'+post_id);
                        property.style.removeProperty('color');
                        $('#vote_count_'+post_id).text(data.voteNumber);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    if(xhr.status==401) {
                        alert('Please login to vote!!!');
                    }
                }
            });
        };

        function saveStory(post_id){
            var user_id = $('#save_story_user_id').val();
            $('#save_story_post_id').val(post_id);
            console.log(user_id);
            if(user_id==''){
                alert('You are not logged in!');
            }else {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                console.log(post_id);
                $.ajax({
                    type:'post',
                    url: '{{url("saveStory")}}',
                    data: {_token: CSRF_TOKEN , post_id: post_id, user_id: user_id},
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data);
                        if(data.status == 'showModal'){
                            $('#saveStoryModal').modal('show');
                        } else{
                            var property = document.getElementById('btn_saveStory_'+post_id);
                            property.style.removeProperty('background');
                        }
                    }
                });

            }
        };

        function saveStoryData(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var user_id = $('#save_story_user_id').val();
            var post_id = $('#save_story_post_id').val();
            var folder_id = $('#save_story_folder_id option:selected').val();
            console.log(folder_id);
            $.ajax({
                type:'post',
                url: '{{url("saveStory")}}',
                data: {_token: CSRF_TOKEN , post_id: post_id, user_id: user_id, folder_id: folder_id},
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    if(data.status == 'saved'){
                        var property = document.getElementById('btn_saveStory_'+post_id);
                        property.style.background = "yellowgreen";
                        $('#saveStoryModal').modal('hide');
                    } else{
                        var property = document.getElementById('btn_saveStory_'+post_id);
                        property.style.removeProperty('background');
                    }
                }
            });
        };

    </script>
@endsection