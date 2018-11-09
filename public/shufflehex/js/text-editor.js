$(document).ready(function() {

    $('.summernote-basic').summernote({

        height: 300,

        toolbar: [

            // [groupName, [list of button]]

            ['style', ['bold', 'italic', 'underline', 'clear']],

            ['font', ['strikethrough', 'superscript', 'subscript']],

            ['fontsize', ['fontsize']],

            ['color', ['color']],

            ['para', ['ul', 'ol', 'paragraph']],

            ['height', ['height']],

        ],



        // popover: {

        //     image: [

        //         ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],

        //         ['float', ['floatLeft', 'floatRight', 'floatNone']],

        //         ['remove', ['removeMedia']]

        //     ],

        //     link: [

        //         ['link', ['linkDialogShow', 'unlink']]

        //     ],

        //     air: [

        //         ['color', ['color']],

        //         ['font', ['bold', 'underline', 'clear']],

        //         ['para', ['ul', 'paragraph']],

        //         ['table', ['table']],

        //         ['insert', ['link', 'picture']]

        //     ]

        // }





    });



    $('.summernote').summernote({

    });

});