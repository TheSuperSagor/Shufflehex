@extends('layouts.master')



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

    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/style.less') }}">

    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/list-style.less') }}">

    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/sidebar.less') }}">

    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/add.less') }}">



    <script src="{{ asset('//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js') }}"></script>

@endsection

@section('content')



        <div class="box saved-stories">

            <nav class="navbar navbar-default">

                <div class="profile-sidebar-nav">

                    <div class="navbar-header">

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#add" aria-expanded="false">

                        <span class="sr-only">Toggle navigation</span>

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                    </button>

                    </div>





                    <div class="collapse navbar-collapse tab-bar" id="add">

                        <ul class="nav nav-pills" >

                            <li role="presentation" class="active"><a data-toggle="pill" href="#addLink">Add Link</a></li>

                            <li role="presentation"><a data-toggle="pill" href="#writeArticle">Write Article</a></li>

                            <li role="presentation"><a data-toggle="pill" href="#uploadImage">Upload Image</a></li>

                            <li role="presentation"><a data-toggle="pill" href="#submitVideo">Submit Video</a></li>

                            <li role="presentation"><a data-toggle="pill" href="#createList">Create List</a></li>

                            <li role="presentation"><a data-toggle="pill" href="#createPoll">Create Poll</a></li>

                        </ul>

                    </div>

                </div>

                </nav>



            <div class="tab-content">

                <div id="addLink" class="tab-pane fade in active">

                    <div class="add-link">

                        <form id="addNewStory" class="addLinksForm" action="{{ route('story.store') }}" method="POST" role="form">

                            {{ csrf_field() }}



                            <label for="storyLink">Link</label>

                            <div class="form-group">

                                <input name="link" id="storyLink" class="form-control" placeholder="Link" type="text">

                            </div>

                            <div class="form-group">

                                <label for="storyTitle">Title</label>

                                <input name="title" id="storyTitle" class="form-control" placeholder="Title" type="text">

                            </div>



                            <div class="form-group">

                                <label for="storyCategory">Category</label>

                                <select name="category" id="storyCategory" class="pull-left selectpicker" data-live-search="true"

                                        style="margin-bottom: 15px;">

                                    {{--<option>-------</option>--}}

                                    @foreach($categories as $category)

                                        <option value="{{ $category->category }}" data-tokens="{{ $category->category }}">{{ $category->category }}</option>

                                    @endforeach

                                </select>

                            </div>



                            <div class="form-group">

                                <label for="storyDesc">Description</label>

                                <textarea type="text" name="description" id="storyDesc" rows="5" class="form-control"></textarea>

                            </div>

                            <div class="form-group">

                                <label>Tags</label>

                                <input name="tags" id="tags" class="form-control" placeholder="tag1,tag2,tag3" type="text">

                            </div>

                            {{--<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">--}}

                            <button type="submit" name="storySubmit" id="storySubmit" class="btn-link-submit btn btn-block btn-danger">Submit</button>



                        </form>

                    </div>

                </div>

                <div id="writeArticle" class="tab-pane fade">

                    <div class="add-article">

                        <form id="addNewArticle" class="addLinksForm" action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data" role="form">

                            {{ csrf_field() }}



                            <div class="form-group">

                                <label for="storyTitle">Title</label>

                                <input name="title" id="storyTitle" class="form-control" placeholder="Title" type="text">

                            </div>

                            <div class="form-group">

                                <label for="image">Feature Image</label>

                                <div class="input-group input-file" name="img">

			<span class="input-group-btn">

        		<button class="btn btn-default btn-choose" type="button">Choose</button>

    		</span>

                                    <input type="text" name="img" class="form-control" placeholder='Choose a file...' />

                                    <span class="input-group-btn">

       			 <button class="btn btn-warning btn-reset" type="button">Reset</button>

    		</span>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="storyCategory">Category</label>

                                <select name="category" id="storyCategory" class="pull-left selectpicker" data-live-search="true" style="margin-bottom: 15px;" tabindex="-98">

                                    @foreach($categories as $category)

                                    <option value="{{ $category->category }}" data-tokens="{{ $category->category }}">{{ $category->category }}</option>

                                @endforeach

                                </select>

                            </div>

                            <div class="form-group article-box">

                                <label>Write Article</label>

                                <textarea id="froala-editor" name="description"></textarea>

                                {{--<textarea style="width:70%;height:200px;" name="area5" id="area5">Some Initial Content was in this textarea </textarea>--}}

                            </div>

                            <div class="form-group">

                                <label>Tags</label>

                                <input name="tags" id="tags" class="form-control" placeholder="a,ab,abc" type="text">

                            </div>



                            {{--<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">--}}

                            <button type="submit" name="storySubmit" id="storySubmit" class="btn-link-submit btn btn-block btn-danger">Submit</button>



                        </form>

                    </div>

                </div>

                <div id="uploadImage" class="tab-pane fade">

                    <form id="addImageStory" class="addLinksForm" action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data" role="form">

                        {{ csrf_field() }}

                        <label for="storyTitle">Title</label>

                        <div class="form-group">

                            <input name="title" id="storyTitle" class="form-control" placeholder="Title" type="text">

                        </div>

                        <div class="form-group">

                            <label for="image">Image</label>

                            <div class="input-group input-file" name="img">

			<span class="input-group-btn">

        		<button class="btn btn-default btn-choose" type="button">Choose</button>

    		</span>

                                <input type="text" name="img" class="form-control" placeholder='Choose a file...' />

                                <span class="input-group-btn">

       			 <button class="btn btn-warning btn-reset" type="button">Reset</button>

    		</span>

                            </div>

                        </div>

                        <div class="form-group">

                            <label for="storyCategory">Category</label>

                            <select name="category" id="storyCategory" class="pull-left selectpicker" data-live-search="true" style="margin-bottom: 15px;" tabindex="-98">

                                @foreach($categories as $category)

                                    <option value="{{ $category->category }}" data-tokens="{{ $category->category }}">{{ $category->category }}</option>

                                @endforeach

                            </select>

                        </div>

                        <div class="form-group">

                            <label for="storyDesc">Description</label>

                            <textarea type="text" name="description" id="storyDesc" rows="5" class="form-control"></textarea>

                        </div>

                        <div class="form-group">

                            <label>Tags</label>

                            <input name="tags" id="tags" class="form-control" placeholder="a,ab,abc" type="text">

                        </div>

                        {{--<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">--}}

                        <button type="submit" name="storySubmit" id="storySubmit" class="btn-link-submit btn btn-block btn-danger">Submit</button>



                    </form>

                </div>

                <div id="submitVideo" class="tab-pane fade">

                    <div class="add-video">

                        <form id="addNewVideo" class="addLinksForm" action="{{ route('video.store') }}" method="POST" role="form">

                            {{ csrf_field() }}



                            <label for="storyLink">Link</label>

                            <div class="form-group">

                                <input name="link" id="storyLink" class="form-control" placeholder="Link" type="text">

                            </div>

                            <div class="form-group">

                                <label for="storyTitle">Title</label>

                                <input name="title" id="storyTitle" class="form-control" placeholder="Title" type="text">

                            </div>



                            <div class="form-group">

                                <label for="storyCategory">Category</label>

                                <select name="category" id="storyCategory" class="pull-left selectpicker" data-live-search="true" style="margin-bottom: 15px;" tabindex="-98">

                                    @foreach($categories as $category)

                                    <option value="{{ $category->category }}" data-tokens="{{ $category->category }}">{{ $category->category }}</option>

                                @endforeach

                                </select>

                            </div>



                            <div class="form-group">

                                <label for="storyDesc">Description</label>

                                <textarea type="text" name="description" id="storyDesc" rows="5" class="form-control"></textarea>

                            </div>

                            <div class="form-group">

                                <label>Tags</label>

                                <input name="tags" id="tags" class="form-control" placeholder="tag1,tag2,tag3" type="text">

                            </div>

                            {{--<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">--}}

                            <button type="submit" name="storySubmit" id="storySubmit" class="btn-link-submit btn btn-block btn-danger">Submit</button>



                        </form>

                    </div>

                </div>

                <div id="createList" class="tab-pane fade">

                    <div class="add-list">

                        <div class="createList">

                            <form id="addNewList" class="addLinksForm" action="{{ route('list.store') }}" method="POST" enctype="multipart/form-data" role="form">

                                {{ csrf_field() }}

                                <div class="form-group">

                                    <label for="storyTitle">Title</label>

                                    <input name="title" id="storyTitle" class="form-control" placeholder="Title" type="text">

                                </div>

                                <div class="form-group">

                                    <label for="image">Feature Image</label>

                                    <div class="input-group input-file" name="img">

			<span class="input-group-btn">

        		<button class="btn btn-default btn-choose" type="button">Choose</button>

    		</span>

                                        <input type="text" name="img" class="form-control" placeholder='Choose a file...' />

                                        <span class="input-group-btn">

       			 <button class="btn btn-warning btn-reset" type="button">Reset</button>

    		</span>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="storyCategory">Category</label>

                                    <select name="category" id="storyCategory" class="pull-left selectpicker" data-live-search="true" style="margin-bottom: 15px;" tabindex="-98">

                                        @foreach($categories as $category)

                                            <option value="{{ $category->category }}" data-tokens="{{ $category->category }}">{{ $category->category }}</option>

                                        @endforeach

                                    </select>

                                </div>

                                <div class="form-group">

                                    <label for="storyDesc">Description</label>

                                    <textarea type="text" name="description" id="storyDesc" rows="5" class="form-control"></textarea>

                                </div>

                                <div class="form-group">

                                    <label>Tags</label>

                                    <input name="tags" id="tags" class="form-control" placeholder="tag1,tag2,tag3" type="text">

                                </div>

                                {{--<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">--}}

                                <button type="submit" name="storySubmit" id="storySubmit" class="btn-link-submit btn btn-block btn-danger">Add List</button>

                            </form>

                        </div>



                    </div>

                </div>

                <div id="createPoll" class="tab-pane fade">

                    <div class="add-list">

                        <div class="createList">

                            <form id="addNewList" class="addLinksForm" action="{{ route('poll.store') }}" method="POST" enctype="multipart/form-data" role="form">

                                {{ csrf_field() }}

                                <div class="form-group">

                                    <label for="storyTitle">Title</label>

                                    <input name="title" id="storyTitle" class="form-control" placeholder="Title" type="text">

                                </div>

                                <div class="form-group">

                                    <label for="image">Feature Image</label>

                                    <div class="input-group input-file" name="img">

			<span class="input-group-btn">

        		<button class="btn btn-default btn-choose" type="button">Choose</button>

    		</span>

                                        <input type="text" name="img" class="form-control" placeholder='Choose a file...' />

                                        <span class="input-group-btn">

       			 <button class="btn btn-warning btn-reset" type="button">Reset</button>

    		</span>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="storyCategory">Category</label>

                                    <select name="category" id="storyCategory" class="pull-left selectpicker" data-live-search="true" style="margin-bottom: 15px;" tabindex="-98">

                                        @foreach($categories as $category)

                                            <option value="{{ $category->category }}" data-tokens="{{ $category->category }}">{{ $category->category }}</option>

                                        @endforeach

                                    </select>

                                </div>

                                <div class="form-group">

                                    <label for="storyDesc">Description</label>

                                    <textarea type="text" name="description" id="storyDesc" rows="5" class="form-control"></textarea>

                                </div>

                                <div class="form-group">

                                    <label>Tags</label>

                                    <input name="tags" id="tags" class="form-control" placeholder="tag1,tag2,tag3" type="text">

                                </div>

                                {{--<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">--}}

                                <button type="submit" name="storySubmit" id="storySubmit" class="btn-link-submit btn btn-block btn-danger">Add Poll</button>

                            </form>

                        </div>



                    </div>

                </div>

            </div>

        </div>



@endsection

    {{--<div class="overlay"></div>--}}

{{--</div>--}}



@section('js')

<!-- jQuery CDN -->

<!--         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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

<script>

    function bs_input_file() {

        $(".input-file").before(

            function() {

                if ( ! $(this).prev().hasClass('input-ghost') ) {

                    var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");

                    element.attr("name",$(this).attr("name"));

                    element.change(function(){

                        element.next(element).find('input').val((element.val()).split('\\').pop());

                    });

                    $(this).find("button.btn-choose").click(function(){

                        element.click();

                    });

                    $(this).find("button.btn-reset").click(function(){

                        element.val(null);

                        $(this).parents(".input-file").find('input').val('');

                    });

                    $(this).find('input').css("cursor","pointer");

                    $(this).find('input').mousedown(function() {

                        $(this).parents('.input-file').prev().click();

                        return false;

                    });

                    return element;

                }

            }

        );

    }

    $(function() {

        bs_input_file();

    });

</script>

<!-- Include Editor style. -->



<!-- Include JS file. -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>



<!-- Include Editor JS files. -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js"></script>

<script>

    $(function() {

        $('textarea#froala-editor').froalaEditor()

    });

</script>



@endsection



