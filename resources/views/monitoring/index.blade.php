@extends('layouts.main')

@section('page_title',$page_title)
@section('css')
<style>
    a {
        color: inherit;
    }

    .card__one {
        transition: transform .5s;


    }

    .card__one::after {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transition: opacity 2s cubic-bezier(.165, .84, .44, 1);
        box-shadow: 0 8px 17px 0 rgba(0, 0, 0, .2), 0 6px 20px 0 rgba(0, 0, 0, .15);
        content: '';
        opacity: 0;
        z-index: -1;
    }

    .card__one:hover,
    .card__one:focus {
        transform: scale3d(1.036, 1.036, 1);
        -webkit-box-shadow: -1px -1px 16px -4px rgba(0, 0, 0, 0.53);
        -moz-box-shadow: -1px -1px 16px -4px rgba(0, 0, 0, 0.53);
        box-shadow: -1px -1px 16px -4px rgba(0, 0, 0, 0.53);


    }



    a:hover {
        color: inherit;
        text-decoration: none;
        cursor: pointer;
    }

    #loader {
        position: relative;
        width: 50px;
        height: 50px;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 50px;
        top: 100px;
        left: 50%;
        margin-left: -25px;
        animation-name: spinner 0.4s linear infinite;
        -webkit-animation: spinner 0.4s linear infinite;
        -moz-animation: spinner 0.4s linear infinite;
    }

    #loader:before {
        position: absolute;
        content: '';
        display: block;
        background-color: rgba(0, 0, 0, 0.2);
        width: 80px;
        height: 80px;
        border-radius: 80px;
        top: -15px;
        left: -15px;
    }

    #loader:after {
        position: absolute;
        content: '';
        width: 50px;
        height: 50px;
        border-radius: 50px;
        border-top: 2px solid white;
        border-bottom: 2px solid white;
        border-left: 2px solid white;
        border-right: 2px solid transparent;
        top: -2px;
        left: -2px;
    }

    @keyframes spinner {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    @-webkit-keyframes spinner {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    @-moz-keyframes spinner {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

</style>
@endsection

@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="index.html">{{config('app.name')}}</a>
            <span class="breadcrumb-item active">{{$page_title}}</span>
        </nav>
    </div><!-- br-pageheader -->
    {{-- <div class="br-pagetitle">
        <i class="icon icon ion-stats-bars"></i>
        <div>
            <h4>{{$page_title}}</h4>
</div>
</div><!-- d-flex --> --}}

<div class="br-pagebody">

    <div class="row row-sm mg-t-20">


        @foreach ($sensors as $sensor)
        <div class="col-md-3 mg-t-20">
            <div class="card bd-0 shadow-base card__one rounded-20 sensor-data" style="cursor: pointer;"
                onclick="showModalTrending('{{$sensor->name}}','{{$sensor->tag_name}}')">
                <div class="card-header tx-medium bd-0 tx-white bg-mantle d-flex justify-content-between align-items-center"
                    style="border-radius: 122px;border-bottom-left-radius: 0px;">
                    <h6 class="card-title tx-uppercase text-white tx-12 mg-b-0">{{$sensor->name}}</h6>
                    <span class="tx-12 tx-uppercase" id="dateTag1"></span>
                </div><!-- card-header -->
                <div class="card-body pd-t-40 pd-b-20 d-xs-flex justify-content-between align-items-center">
                    {{-- <span id="spark1"></span> --}}
                    <h4 class="mg-b-0 tx-inverse tx-lato tx-bold value{{$sensor->tag_name}}"
                        id="value{{$sensor->tag_name}}">-</h4>
                    <p class="mg-b-0 tx-sm"><span class="tx-danger tstamp{{$sensor->tag_name}}"
                            id="tstamp{{$sensor->tag_name}}"> -</span></p>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
        @endforeach

    </div>

    <div class="row row-sm mg-t-20 hilang">
        <div class="col-lg-6 mg-t-20">
            <div class="card bd-0 shadow-base  rounded-20">
                <div class="card-body pd-t-40 pd-b-20 d-xs-flex justify-content-between align-items-center">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Sensor</th>
                                <th>Value</th>
                            </thead>
                            <tbody>
                                @php
                                $no =1;
                                @endphp
                                @foreach ($sensors as $sensor)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$sensor->name}}</td>
                                    <td><span class="value{{$sensor->tag_name}}"></span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div>

</div><!-- br-pagebody -->

<div id="modaldemo1" class="modal fade">
    <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header  pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Trending - <span id="title-trending"></span>
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card bd-0 shadow-base  rounded-20 ">
                    <div class="text-center loader pd-y-20 bg-white ht-200 ht-sm-300 pd-t-50" style="height:-webkit-fill-available;    position: absolute;
                        width: -webkit-fill-available;
                        z-index: 9;">
                        {{-- <img class="img-fluid" src="{{asset('loading.gif')}}" alt="" style="max-height: 150px;"> --}}

                    </div>
                    <div class=" pd-l-20 pd-y-10 pd-r-30">
                        <div id="chartLine2" class="ht-200 ht-sm-300"></div>
                    </div>
                </div><!-- card -->

            </div>
            <div class="modal-footer">
                {{-- <button type="button" onclick="destroyChart()"
                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Save
                    changes</button> --}}
                <button type="button" class="btn btn-sm btn-danger tx-11 tx-uppercase tx-mont tx-medium"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

@include('layouts.partials.footer')
</div><!-- br-mainpanel -->
@endsection


@push('js')

<script>
    // $(document).ready(function () {



    // });



    




    // INITIATE CHART
    /** ***************** LINE CHART 2 ********************/
    var chartdata5 = [{
        name: '-',
        type: 'line',
        smooth: true,
        data: [4, 5, 7, 2]
    }];

    var option8 = {
        // animation: false,
        tooltip: {
            trigger: 'axis',
            position: function (pt) {
                return [pt[0], '10%'];
            }
        },
        toolbox: {
            feature: {
                saveAsImage: {
                    title: 'Save Png',
                }
            }
        },
        legend: {
            show: true
        },
        tooltip: {
            show: true
        },
        grid: {
            top: '6',
            right: '0',
            bottom: '17',
            left: '35',
        },
        xAxis: {
            data: [1, 2, 3, 4],
            axisLine: {
                lineStyle: {
                    color: '#ccc'
                }
            },
            axisLabel: {
                fontSize: 10,
                color: '#666'
            }
        },
        yAxis: {
            splitLine: {
                lineStyle: {
                    color: '#ddd'
                }
            },
            axisLine: {
                lineStyle: {
                    color: '#ccc'
                }
            },
            axisLabel: {
                fontSize: 10,
                color: '#666'
            },
            opposite: false


        },
        series: chartdata5,
        color: ['#0095F8']
    };
    var chart8 = document.getElementById('chartLine2');
    var invTrend = null;
    var lineChart4 = null;

    // ./INITIATE CHART

    function showChart() {

        lineChart2.setOption(option8);
    }

  

    // SHOW MODAL WITH TRENDING
    

    function showModalTrending(name, tagName) {
        $('.loader').show('fast');

        // Trigger Model
        $('#modaldemo1').modal({
            show: true
        });
        // Set Title
        $('#title-trending').text(name);

        $('#modaldemo1').on('shown.bs.modal', function () {
            lineChart4 = echarts.init(chart8);
            lineChart4.setOption(option8);
            getData(name,tagName);
        })
        // Set Interval Trending 
        var interval = 3000;

        invTrend = setInterval(() => {
            getData(name,tagName);
        }, interval)
    }

   


    function getData(name,tagName) {
        $.ajax({
            type: 'POST',
            url: "{{url('api/trending-tag')}}",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "_token": "{{ csrf_token() }}",
                tag_name: tagName
            },
            beforeSend: function () {
                // setting a timeout

            },
            success: function (res) {
                option8.series[0].name = name;
                option8.series[0].data = res.trending.tag.value;
                option8.xAxis.data = res.trending.tstamp;
                lineChart4.setOption(option8, true);
                $('.loader').fadeOut('fast');
            },
            error: function (data) {
                console.log(data);
            }
        });
    }


    $('#modaldemo1').on('hide.bs.modal', function () {
        clearInterval(invTrend);
    })
    $('#stop-interval').on('click', function () {
        clearInterval(invTrend);
        alert('Stopped');
    })


    // ./SHOW MODAL WITH TRENDING


    function destroyChart() {
        lineChart4.destroy();
    }

</script>

@endpush
