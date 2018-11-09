@extends('layouts.master')
@section('css')
    <!-- Bootstrap CSS CDN -->
    <title>Product</title>
    <link rel="stylesheet" href="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css') }}">

    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Include Editor style. -->
    <!-- Our Custom CSS -->
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/style.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/list-style.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/sidebar.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/add.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/product.less') }}">

    <script src="{{ asset('//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('xzoom/dist/xzoom.css') }}">



@endsection


<?php

$product = new stdClass();

$product->name = "Look what I caught my contractor doing!!!";
$product->category = "Entertanment";
$product->price = "28.99";
$product->username = "Developer";

$upVoteMatched = 0;
$downVoteMatched = 0;
$savedStory = 0;
$votes = 0;
$totalComments = 10;

?>

@section('content')
    <div class="box product">
        <div class="product-box">
            <div class="product-name">
                <h1>{{ $product->name }}</h1>
            </div>

            <div class="row">
                <div class="col-md-7 product-media">
                    <img class="xzoom original" src="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/01_b_car.jpg" style="width:400px;" xoriginal="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/01_b_car.jpg"
                />
                </div>
                <div class="col-md-5 product-review">
                    <div class="category">
                        <h2>{{ $product->category }}</h2>
                    </div>
                    <div class="username">
                        <p>Submitted by {{ $product->username }}</p>
                    </div>
                    <div class="product-price"><h3>$<span>{{ $product->price }}</span></h3></div>
                    <div class="star-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>

                    <div class="xzoom-thumbs">
                        <a href="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/01_b_car.jpg">
                            <img class="xzoom-gallery" src="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/01_b_car.jpg" xpreview="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/01_b_car.jpg">
                        </a>
                        <a href="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/02_o_car.jpg">
                            <img class="xzoom-gallery" src="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/02_o_car.jpg">
                        </a>
                        <a href="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/03_r_car.jpg">
                            <img class="xzoom-gallery" src="https://www.jqueryscript.net/demo/Feature-rich-Product-Gallery-With-Image-Zoom-xZoom/images/gallery/original/03_r_car.jpg">
                        </a>

                    </div>
                    <div class="product-action">
                        <a href="#" class="btn btn-danger">GO SHOPPING</a>
                    </div>
                </div>
            </div>



            <div class="product-description col-md-12 col-xs-12">
                <p>Where can I get some?
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
            </div>

            <div class="promo">
                <p><strong>Promo Code</strong> promo code not available</p>
                <p><strong>Online Shop</strong> Amazon </p>
            </div>


            <div class="row vote">
                <div class="col-md-4 col-sm-6 col-xs-6 up-btn">
                    @if($upVoteMatched == 1)
                        <a class="btn btn-xs" onclick="upVote({{
                        1
                        }})"><span  id="btn_upVote_1" class="thumb-up glyphicon glyphicon-triangle-top" style="color: green"></span></a>
                        <span id="btn_upVote_text_1" class="vote-counter text-center" style="color: green;">Upvote</span>
                        <span class="vote-counter text-center" id="vote_count_1">{{ $votes }}</span>
                    @else
                        <a class="" onclick="upVote({{
                        1
                        }})"><span id="btn_upVote_1" class="thumb glyphicon glyphicon-triangle-top" ></span></a>
                        <span id="btn_upVote_text_1" class="vote-counter text-center">Upvote</span>
                        <span class="vote-counter text-center" id="vote_count_1">{{ $votes }}</span>
                    @endif

                </div>
                <div class="col-md-4 col-sm-6 col-xs-6 col-md-offset-4 col-sm-offset-4">
                    <div class="col-md-2 col-sm-2 col-xs-2 p-0 down-btn">
                        @if($downVoteMatched == 1)
                            <a class="pull-right" onclick="downVote({{
                            1
                            }})"><span id="btn_downVote_1" class="thumb-down glyphicon glyphicon-triangle-bottom" style="color: red"></span> </a>
                        @else
                            <a class="pull-right" onclick="downVote({{
                            1
                            }})"><span id="btn_downVote_1" class="thumb glyphicon glyphicon-triangle-bottom"></span></a>
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 p-0 comment-btn text-center">
                            <a class=""><span ><span class="vote-counter text-center" id="vote_count_1"></span></span><i class="fa fa-comment"></i>{{ $totalComments }}</a>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 p-0 saved-btn">
                        @if($savedStory == 1)
                            <a class="pull-right" onclick="saveStory({{
                        1
                        }})"><span><span class="vote-counter text-center"></span></span><i class="fa fa-bookmark saved" id="btn_saveStory_1" style="color: green"></i></a>
                        @else
                            <a class="pull-right" onclick="saveStory({{
                        1
                        }})"><span></span><span class="vote-counter text-center" ></span><i class="fa fa-bookmark" id="btn_saveStory_1"></i></a>
                        @endif
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2 p-0 saved-btn">
                        <a class="pull-right" onclick="downVote(1)">
                            <span class="glyphicon glyphicon-option-horizontal" ></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--first Comment section -->

        <div class="comment-section">
            <div class="row comment-box">
                <form id="addNewStory" action="{{ route('comment.store') }}" method="POST" role="form">
                    {{ csrf_field() }}
                    <div class="col-md-10 col-sm-10 col-xs-10 form-group  pl-0">
                        <textarea name="reply" placeholder="Comment..." id="storyDesc"  class="form-control"></textarea>
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
                                    <?php $commentVotes = 0;?>
                                    @foreach($post->comment_votes as $key=>$vote)
                                        @if($vote->comment_id == $comment->id)
                                        <?php
$commentVotes += $vote->vote;
?>
                                            @endif
                                    @endforeach
                                        <?php $upVoteCommentMatched = 0;?>
                                    @if(isset(Auth::user()->id) && !empty(Auth::user()->id))
                                        @foreach($post->comment_votes as $key=>$vote)
                                            @if($vote->user_id == Auth::user()->id && $vote->vote == 1 && $vote->comment_id == $comment->id)
                                                <?php $upVoteCommentMatched = 1;?>
                                                @break
                                            @endif
                                        @endforeach
                                    @endif

                                    @if($upVoteCommentMatched == 1)
                                        <a onclick="upVoteComment({{ $post->id.','.$comment->id }})" id="btn_upVote_comment_{{ $comment->id }}"  style="color: green"><span class="thumb-up glyphicon glyphicon-triangle-top"></span>Upvote
                                        <span class="vote-counter text-center" id="vote_count_comment_{{ $comment->id }}">{{ $commentVotes }}</span></a>
                                    @else
                                        <a onclick="upVoteComment({{ $post->id.','.$comment->id }})" id="btn_upVote_comment_{{ $comment->id }}"><span class="thumb glyphicon glyphicon-triangle-top" ></span>Upvote
                                        <span class="vote-counter text-center" id="vote_count_comment_{{ $comment->id }}">{{ $commentVotes }}</span></a>
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
                                                    <?php $commentReplyVotes = 0;?>
                                                    @foreach($post->comment_reply_votes as $key=>$vote)
                                                        @if($vote->comment_id == $comment->id && $vote->reply_id == $reply->id)
                                                            <?php
$commentReplyVotes += $vote->vote;
?>
                                                        @endif
                                                    @endforeach
                                                    <?php $upVoteCommentReplyMatched = 0;?>
                                                    @if(isset(Auth::user()->id) && !empty(Auth::user()->id))
                                                        @foreach($post->comment_reply_votes as $key=>$vote)
                                                            @if($vote->user_id == Auth::user()->id && $vote->vote == 1 && $vote->comment_id == $comment->id && $vote->reply_id == $reply->id)
                                                                <?php $upVoteCommentReplyMatched = 1;?>
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                    @if($upVoteCommentReplyMatched == 1)
                                                        <a onclick="upVoteCommentReply({{ $post->id.','.$comment->id.','.$reply->id }})" id="btn_upVote_comment_reply_{{ $reply->id }}"  style="color: green"><span class="thumb-up glyphicon glyphicon-triangle-top"></span>Upvote
                                                            <span class="vote-counter text-center" id="vote_count_comment_reply_{{ $reply->id }}">{{ $commentReplyVotes }}</span></a>
                                                    @else
                                                        <a onclick="upVoteCommentReply({{ $post->id.','.$comment->id.','.$reply->id }})" id="btn_upVote_comment_reply_{{ $reply->id }}"><span class="thumb glyphicon glyphicon-triangle-top" ></span>Upvote
                                                            <span class="vote-counter text-center" id="vote_count_comment_reply_{{ $reply->id }}">{{ $commentReplyVotes }}</span></a>
                                                    @endif


                                                    {{--@if(False)--}}

                                                        {{--<a ><span   class="thumb-up glyphicon glyphicon-triangle-top" ></span>Upvote--}}
                                                        {{--<span class="vote-counter text-center" id="vote_count_{{ $post->id }}">{{ $votes }}</span> </a>--}}
                                                    {{--@else--}}
                                                        {{--<a ><span  class="thumb glyphicon glyphicon-triangle-top" ></span>Upvote--}}
                                                            {{--<span class="vote-counter text-center" id="vote_count_{{ $post->id }}">{{ $votes }}</span>--}}
                                                        {{--</a>--}}
                                                    {{--@endif--}}
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
                                            <textarea name="reply" placeholder="Reply..." id="storyDesc"  class="form-control" rows="1"></textarea>
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

<!--end comment section -->



@endsection
{{--
<div class="overlay"></div>
--}}
{{--</div>--}}
@section('js')
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
    <script src="{{ asset('xzoom/dist/xzoom.min.js') }}"></script>
    <script>
        $('.xzoom, .xzoom-gallery').xzoom({position: 'right', lensShape: 'square', bg:true, sourceClass: 'xzoom-hidden'});
    </script>
    <!-- Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <!-- jQuery Nicescroll CDN -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>

    <script>

        $(document).ready(function(){

            $('[data-toggle="tooltip"]').tooltip();

        });

    </script>
    <script>
        $('.selectpicker').selectpicker();

    </script>
    <script src="js/home.js"></script>


@endsection