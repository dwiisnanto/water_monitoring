<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('page_title') - Water Monitoring</title>

    <!-- vendor css -->
    <link href="{{ asset('backend/') }}/lib/rickshaw/rickshaw.min.css" rel="stylesheet">
    <link href="{{ asset('backend/') }}/lib/select2/css/select2.min.css" rel="stylesheet">

    <link href="{{ asset('backend/') }}/lib/highlightjs/styles/github.css" rel="stylesheet">
    <link href="{{ asset('backend/') }}/lib/select2/css/select2.min.css" rel="stylesheet">

    <link href="{{ asset('backend/') }}/lib/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('backend/') }}/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css"
        rel="stylesheet">
    <link href="{{ asset('backend/') }}/lib/highlightjs/styles/github.css" rel="stylesheet">


    <link href="{{ asset('backend/') }}/lib/spectrum-colorpicker/spectrum.css" rel="stylesheet">
    <link href="{{ asset('backend/') }}/lib/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="{{ asset('backend/') }}/lib/jquery-confirm/css/jquery-confirm.css" rel="stylesheet">
    <link href="{{ asset('backend/') }}/css/toastr.min.css" rel="stylesheet">

    <!-- Base CSS -->
    <link rel="stylesheet" href="{{ asset('icons/ionicons-2.0.1/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('icons/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/') }}/css/bracket.css">
    <link rel="stylesheet" href="{{ asset('backend/') }}/css/marquee.css">
    <style>
        #style-1::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            background-color: #F5F5F5;
        }

        #style-1::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        #style-1::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            background-color: #555;
        }

        /*
       *  STYLE 2
       */

        #style-2::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            background-color: #F5F5F5;
        }

        #style-2::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        #style-2::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            background-color: #D62929;
        }

        /*
       *  STYLE 3
       */

        #style-3::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        #style-3::-webkit-scrollbar {
            width: 6px;
            background-color: #F5F5F5;
        }

        #style-3::-webkit-scrollbar-thumb {
            background-color: #1BAD9D;
        }

        /*
       *  STYLE 4
       */

        #style-4::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        #style-4::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        #style-4::-webkit-scrollbar-thumb {
            background-color: #000000;
            border: 2px solid #555555;
        }


        /*
       *  STYLE 5
       */

        #style-5::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        #style-5::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        #style-5::-webkit-scrollbar-thumb {
            background-color: #0ae;

            background-image: -webkit-gradient(linear, 0 0, 0 100%,
                    color-stop(.5, rgba(255, 255, 255, .2)),
                    color-stop(.5, transparent), to(transparent));
        }


        /*
       *  STYLE 6
       */

        #style-6::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        #style-6::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        #style-6::-webkit-scrollbar-thumb {
            background-color: #F90;
            background-image: -webkit-linear-gradient(45deg,
                    rgba(255, 255, 255, .2) 25%,
                    transparent 25%,
                    transparent 50%,
                    rgba(255, 255, 255, .2) 50%,
                    rgba(255, 255, 255, .2) 75%,
                    transparent 75%,
                    transparent)
        }


        /*
       *  STYLE 7
       */

        #style-7::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
            border-radius: 10px;
        }

        #style-7::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        #style-7::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background-image: -webkit-gradient(linear,
                    left bottom,
                    left top,
                    color-stop(0.44, rgb(122, 153, 217)),
                    color-stop(0.72, rgb(73, 125, 189)),
                    color-stop(0.86, rgb(28, 58, 148)));
        }

        /*
       *  STYLE 8
       */

        #style-8::-webkit-scrollbar-track {
            border: 1px solid black;
            background-color: #F5F5F5;
        }

        #style-8::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        #style-8::-webkit-scrollbar-thumb {
            background-color: #000000;
        }


        /*
       *  STYLE 9
       */

        #style-9::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        #style-9::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        #style-9::-webkit-scrollbar-thumb {
            background-color: #F90;
            background-image: -webkit-linear-gradient(90deg,
                    rgba(255, 255, 255, .2) 25%,
                    transparent 25%,
                    transparent 50%,
                    rgba(255, 255, 255, .2) 50%,
                    rgba(255, 255, 255, .2) 75%,
                    transparent 75%,
                    transparent)
        }


        /*
       *  STYLE 10
       */

        #style-10::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
            border-radius: 10px;
        }

        #style-10::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        #style-10::-webkit-scrollbar-thumb {
            background-color: #AAA;
            border-radius: 10px;
            background-image: -webkit-linear-gradient(90deg,
                    rgba(0, 0, 0, .2) 25%,
                    transparent 25%,
                    transparent 50%,
                    rgba(0, 0, 0, .2) 50%,
                    rgba(0, 0, 0, .2) 75%,
                    transparent 75%,
                    transparent)
        }


        /*
       *  STYLE 11
       */

        #style-11::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
            border-radius: 10px;
        }

        #style-11::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        #style-11::-webkit-scrollbar-thumb {
            background-color: #3366FF;
            border-radius: 10px;
            background-image: -webkit-linear-gradient(0deg,
                    rgba(255, 255, 255, 0.5) 25%,
                    transparent 25%,
                    transparent 50%,
                    rgba(255, 255, 255, 0.5) 50%,
                    rgba(255, 255, 255, 0.5) 75%,
                    transparent 75%,
                    transparent)
        }

        /*
       *  STYLE 12
       */

        #style-12::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.9);
            border-radius: 10px;
            background-color: #444444;
        }

        #style-12::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        #style-12::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background-color: #D62929;
            background-image: -webkit-linear-gradient(90deg,
                    transparent,
                    rgba(0, 0, 0, 0.4) 50%,
                    transparent,
                    transparent)
        }

        /*
       *  STYLE 13
       */

        #style-13::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.9);
            border-radius: 10px;
            background-color: #CCCCCC;
        }

        #style-13::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        #style-13::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background-color: #D62929;
            background-image: -webkit-linear-gradient(90deg,
                    transparent,
                    rgba(0, 0, 0, 0.4) 50%,
                    transparent,
                    transparent)
        }

        /*
       *  STYLE 14
       */

        #style-14::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.6);
            background-color: #CCCCCC;
        }

        #style-14::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        #style-14::-webkit-scrollbar-thumb {
            background-color: #FFF;
            background-image: -webkit-linear-gradient(90deg,
                    rgba(0, 0, 0, 1) 0%,
                    rgba(0, 0, 0, 1) 25%,
                    transparent 100%,
                    rgba(0, 0, 0, 1) 75%,
                    transparent)
        }

        /*
       *  STYLE 15
       */

        #style-15::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #F5F5F5;
            border-radius: 10px;
        }

        #style-15::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        #style-15::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background-color: #FFF;
            background-image: -webkit-gradient(linear,
                    40% 0%,
                    75% 84%,
                    from(#4D9C41),
                    to(#19911D),
                    color-stop(.6, #54DE5D))
        }

        /*
       *  STYLE 16
       */

        #style-16::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #F5F5F5;
            border-radius: 10px;
        }

        #style-16::-webkit-scrollbar {
            width: 10px;
            background-color: #F5F5F5;
        }

        #style-16::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background-color: #FFF;
            background-image: -webkit-linear-gradient(top,
                    #e4f5fc 0%,
                    #bfe8f9 50%,
                    #9fd8ef 51%,
                    #2ab0ed 100%);
        }

        .hilang {
            display: none !important;
        }

    </style>
    @yield('css')
</head>

<body id="style-3">

    <!-- ########## START: LEFT PANEL ########## -->
    @include('layouts.partials.left_panel')
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    @include('layouts.partials.head_panel')
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    @include('layouts.partials.right_panel')
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    @yield('content')
    <!-- ########## END: MAIN PANEL ########## -->
    <audio id="myAudio">
        <source src="{{asset('sound/1.mp3')}}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <script src="{{ asset('backend/') }}/lib/jquery/jquery.min.js"></script>
    <script src="{{ asset('backend/') }}/lib/jquery-ui/ui/widgets/datepicker.js"></script>
    <script src="{{ asset('backend/') }}/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('backend/') }}/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('backend/') }}/lib/moment/min/moment.min.js"></script>
    <script src="{{ asset('backend/') }}/lib/peity/jquery.peity.min.js"></script>

    {{-- <script src="{{ asset('backend/') }}/lib/rickshaw/vendor/d3.min.js"></script> --}}
    {{-- <script src="{{ asset('backend/') }}/lib/rickshaw/vendor/d3.layout.min.js"></script> --}}
    {{-- <script src="{{ asset('backend/') }}/lib/rickshaw/rickshaw.min.js"></script> --}}
    {{-- <script src="{{ asset('backend/') }}/lib/jquery.flot/jquery.flot.js"></script> --}}
    {{-- <script src="{{ asset('backend/') }}/lib/jquery.flot/jquery.flot.resize.js"></script> --}}
    {{-- <script src="{{ asset('backend/') }}/lib/flot-spline/js/jquery.flot.spline.min.js"></script> --}}
    <script src="{{ asset('backend/') }}/lib/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="{{ asset('backend/') }}/lib/echarts/echarts.min.js"></script>
    <script src="{{ asset('backend/') }}/lib/chart.js/Chart.min.js"></script>
    <script src="{{ asset('backend/') }}/lib/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('backend/') }}/lib/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend/') }}/lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="{{ asset('backend/') }}/lib/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend/') }}/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script>
    <script src="{{ asset('backend/') }}/lib/jquery.maskedinput/jquery.maskedinput.js"></script>
    <script src="{{ asset('backend/') }}/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="{{ asset('backend/') }}/lib/jquery-confirm/js/jquery-confirm.js"></script>
    <script src="{{ asset('backend/') }}/js/notify.min.js"></script>
    <script src="{{ asset('backend/') }}/js/toastr.min.js"></script>
    <script src="{{ asset('backend/') }}/js/socket.io.js"></script>

    <script src="{{ asset('backend/') }}/js/bracket.js"></script>
    <script src="{{ asset('backend/') }}/js/marquee.js"></script>
    {{-- <script src="{{ asset('backend/') }}/js/map.shiftworker.js"></script> --}}
    <script src="{{ asset('backend/') }}/js/ResizeSensor.js"></script>
    <script src="{{ asset('backend/') }}/lib/highlightjs/highlight.pack.min.js"></script>

    {{-- <script src="{{ asset('backend/') }}/js/dashboard.js"></script> --}}
    <script>
        var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $('ul a').each(function () {
            if (this.href === path) {
                $(this).addClass('active');
                $(this).parent().parent().parent().closest('li').find('.with-sub').addClass('show-sub active');
                // $(this).parent().parent().css('display','block');
                // $(this).parent().parent().parent().finda(.addClass('active');
            }
        });

    </script>
    @stack('js')
    {{-- <script src="https://js.pusher.com/4.1/pusher.min.js"></script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script> --}}
    <script>
        var x = document.getElementById("myAudio");

        function playAudio() {
            x.play();
        }

        function stopAudio() {
            x.pause();
            x.currentTime = 0;
        }
        window.socketio = io.connect('http://localhost:1234'); // koneksi ke nodejsnya
        window.socketio.on('updatedata', function (data) {
            console.log(data);
            toastr.error(data.tstamp + '<br>' + data.tag_name + ' : ' + data.text, data.tag_name + ':' + data
                .value);
                playAudio();

                setTimeout(()=> {
                    stopAudio();
                }, 1000);
        });

        // PUSHER
        // var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
        //     cluster: '{{env("PUSHER_APP_CLUSTER")}}',
        //     encrypted: true
        // });
        // var channel = pusher.subscribe('notify-channel');
        // channel.bind('App\\Events\\Notify', function (data) {
        //     // $.notify(data.tag_name+' : '+data.text, "error");
        //     // toastr.options.toastClass = 'toastr';
        //     toastr.options.timeOut = 10000;
        //     // toastr.options.onclick = function() {         
        //     //     $.notify('Acknowledge Success', "success");

        //     // }
        //     toastr.error(data.tstamp + '<br>' + data.tag_name + ' : ' + data.text, data.tag_name + ':' + data
        //         .value)
        // });
        // PUSHER

    </script>
    <script>
        // INITIATE INTERVAL REALTIME
        realtime();
        setInterval(() => {
            realtime();
        }, 2000);
        // ./INITIATE INTERVAL REALTIME
        // REALTIME DATA
        function realtime() {
            $.ajax({
                type: 'GET',
                url: "{{url('api/realtime')}}",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function (data) {

                    $.each(data, function (k, v) {
                        $('.value' + v.tag.tag_name).text(v.tag.value);
                        $('.tstamp' + v.tag.tag_name).text(v.tag.tstamp);
                    });
                },
                error: function (data) {
                    // console.log(data);

                }
            });
        }
        // ./REALTIME DATA

    </script>
    <script>
        $(function () {
            'use strict';

            $('#datatable1').DataTable({
                responsive: true,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                }
            });

            $('.datatable2').DataTable({
                bLengthChange: false,
                searching: false,
                responsive: true
            });

            // Select2
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });

        });

    </script>

    <script>
        $(document).ready(function () {
            $(".img-profile").each(function () {
                var img = $(this);
                var image = new Image();
                image.src = $(img).attr("src");
                var no_image =
                    "https://www.ommel.fi/content/uploads/2019/03/dummy-profile-image-male.jpg";
                if (image.naturalWidth == 0 || image.readyState == 'uninitialized') {
                    $(img).unbind("error").attr("src", no_image).css({
                        height: $(img).css("height"),
                        width: $(img).css("width"),
                    });
                }
            });
        });

        function deleteData(id) {
            $.confirm({
                theme: 'material',
                title: 'Confirm!',
                content: 'Are you sure you want to delete data ?',
                buttons: {
                    confirm: function () {
                        $.ajax({
                            type: 'DELETE',
                            url: route_url + '/' + id,
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function (data) {
                                location.reload();
                            },
                            error: function (data) {
                                $.alert('Failed!');
                                console.log(data);

                            }
                        });
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    },
                    // somethingElse: {
                    //     text: 'Something else',
                    //     btnClass: 'btn-blue',
                    //     keys: ['enter', 'shift'],
                    //     action: function () {
                    //         $.alert('Something else?');
                    //     }
                    // }
                }
            });
        }

    </script>

    @if (session()->has('privilege'))
    <script>
        $.alert("{{session()->get('privilege')}}");

    </script>
    @endif
</body>

</html>
