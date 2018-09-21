
<!DOCTYPE html>
<html class=''>
<head>
    <meta charset='UTF-8'>
    <meta name="robots" content="noindex">
    <link href="{{ asset('ChangedDesign/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <link href="{{ asset('ChangedDesign/lessFiles/less/story-view.less') }}" rel="stylesheet/less">
    <script src="{{ asset('ChangedDesign/js/less.min.js') }}"></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="{{ asset('ChangedDesign/js/bootstrap.min.js') }}"></script>

<!--    <script src='js/console_runner.js'></script>-->
<!--    <script src='js/events_runner.js'></script>-->
<!--    <script src='js/css-live-reload.js'></script>-->
</head>
<body>
<div class="site-wrapper">
    <section class="topbar">
        <a class="navbar-brand" href="#"><img src="{{ asset('ChangedDesign/img/logo/shufflehex.png') }}"></a>
        <ul class="nav navbar-nav">
            <li><a><i class="fa fa-thumbs-up"></i></a></li>
            <li><a><i class="fa fa-thumbs-down"></i></a></li>
            <li><a><i class="fa fa-bookmark"></i></a></li>
        </ul>
        <div class="navbar-right">
            <article>
                <ul class="device-chooser">
                    <li class="device-size"></li>
                </ul>
            </article>
            <article>
                <button class="btn-maximize"><i class="material-icons">crop_free</i></button>
<!--                <button class="btn-fullscreen"><i class="material-icons">open_with</i></button>-->
<!--                <button class="btn-3d">3D</button>-->
<!--                <button class="btn-close"><i class="material-icons">close</i></button>-->
            </article>
        </div>
    </section>

    <section class="content">
        <article>
            <div class="device-wrapper">
                <iframe src="{{ $post->link }}"></iframe>
            </div>
        </article>
    </section>

    <footer class="bottombar">
        Copyright &copy; ShuffleHex 2017
    </footer>

</div>

<!--<script src="js/story-view.js"></script>-->
<script src='{{ asset('ChangedDesign/js/stopExecutionTimeOut.js') }}'></script>
<script>
    (function($, window, document) {

        var breakpoints = {
            "xxs":  {"width": 320, "height": 320, "icon" : "watch"},
            "xs":   {"width": 480, "height": 640, "icon" : "phone_iphone"},
            "s":    {"width": 768, "height": 1024, "icon" : "tablet_mac"},
            "m":    {"width": 1024, "height": 768, "icon" : "laptop_mac"},
            "l":    {"width": 1200, "height": 1024, "icon" : "desktop_windows"},
            "xl":   {"width": 1600, "height": 1200, "icon" : "tv"}
        };
        $(function() {
            // The DOM is ready!

            // Membas

            var deviceCurrent;

            // DOM cache
            var $deviceChooser = $('.device-chooser'),
                $deviceSize = $('.device-size'),
                // $device = $('.device-wrapper'),
                $content = $('.content'),
                $iframe = $('iframe'),
                $urlBar = $('.url-bar input'),
                $btnMaximize = $('.btn-maximize');

            // URL

            $urlBar.on('change', function() {
                $iframe.attr("src", $urlBar.val());
            })

            $iframe.on('change', function() { // TODO
                console.log('foo');
                $urlBar.val(this.attr('src'));
            })

            // DEVICES

            $btnMaximize.on('click', function() {
                $content.toggleClass('content--maximized')
            });

            for(key in breakpoints){if (window.CP.shouldStopExecution(1)){break;}

                var btn = $(
                    '<li><button><i class="material-icons">' +
                    breakpoints[key]["icon"] +
                    '</i></button></li>');

                btn.on('click', changeDevice(key, breakpoints[key]["width"], breakpoints[key]["height"]));
                $deviceChooser.append(btn);

                //console.log(breakpoints[key]);
            }
            window.CP.exitedLoop(1);



            function changeDevice(key, w, h) {
                return function() {
                    $iframe.css('width', w + 'px').css('height', h + 'px');
                    deviceCurrent = key;

                    $deviceSize.text(w + 'x' + h + 'px');
                };
            }

            var initDeviceType = "l";
            var initDevice = changeDevice(initDeviceType, breakpoints[initDeviceType]["width"], breakpoints[initDeviceType]["height"]);
            initDevice();

        });

    }(window.jQuery, window, document));

    //# sourceURL=pen.js
</script>
</body>
</html>