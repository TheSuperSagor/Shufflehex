@extends('layouts.master')
@section('css')
    <title>Add Product</title>
    <!-- Include Editor style. -->
    <!-- Our Custom CSS -->
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/style.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/list-style.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/sidebar.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/add.less') }}">
    <link rel="stylesheet/less" href="{{ asset('ChangedDesign/lessFiles/less/product.less') }}">
    <script src="{{ asset('//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js') }}"></script>
       <!-- Bootstrap CSS CDN -->

    <link rel="stylesheet" href="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css') }}">

    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- include summernote css/js -->
    <link rel="stylesheet/less" href="{{ asset('summernote/dist/summernote.css') }}">
{{--    <link href="{{ asset('summernote/dist/summernote.css' }}" rel="stylesheet">--}}


@endsection
@section('content')
    <div class="box">

        <div class="box-header">
            <h3>Add Project</h3>
        </div>

        <div class="add-product">
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Project's Name">
                </div>
                <div class="form-group">
                    <input type="url" name="link" class="form-control" placeholder="Link">
                </div>

                <div class="form-group">
                    <textarea id="short-desc" name="tag_line" class="form-control" placeholder="Tagline"></textarea>
                </div>
                <div class="form-group">
                    <textarea id="features" name="description" class="summernote"></textarea>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="input-group-btn">
                        <span class="btn btn-primary">
                            Logo&hellip; <input type="file" name="logo" style="display: none;">
                        </span>
                        </label>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <p class="help-text"><small>500px X 500px logo.</small></p>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <label class="input-group-btn">
                        <span class="btn btn-primary">
                            Screenshots&hellip; <input type="file" name="images[]" style="display: none;" multiple>
                        </span>
                        </label>
                        <input type="text" class="form-control" readonly>
                    </div>
                </div>
                <!--<div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control">
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="url" class="form-control" placeholder="Product ID">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="button" style="float:right; margin-top: 5px" class="btn btn-sm btn-default"><i class="fa fa-plus"></i>&nbsp;Add More</button>
                        </div>
                    </div>
                </div>-->
                <div class="form-group">
                    <select class="form-control" name="category">
                        <option>Category</option>
                        <option>A</option>
                        <option>B</option>
                        <option>C</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="tags" class="form-control" placeholder="Tags">
                </div>
                <div class="form-group mr-0">
                    <input type="submit" class="btn btn-danger btn-block" value="Submit">
                </div>
            </form>

        </div>

    </div>
@endsection
{{--
<div class="overlay"></div>
--}}
{{--</div>--}}
@section('js')
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}

    <!-- Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
    <!-- jQuery Nicescroll CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('summernote/dist/summernote.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height:150
            });
        });
    </script>
    <script>
        $(function() {

            // We can attach the `fileselect` event to all file inputs on the page
            $(document).on('change', ':file', function() {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });

            // We can watch for our custom `fileselect` event like this
            $(document).ready( function() {
                $(':file').on('fileselect', function(event, numFiles, label) {

                    var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;

                    if( input.length ) {
                        input.val(log);
                    } else {
                        if( log ) alert(log);
                    }

                });
            });

        });


    </script>
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
    <!-- Include Editor JS files. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js"></script>
    <script>
        $(function() {

            $('textarea#froala-editor').froalaEditor()

        });

    </script>
@endsection