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

    .select2-results__option[aria-selected=true] {
        display: none;
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
        <div class="col-md-12 mg-t-20">
            <div class="card bd-0 shadow-base  rounded-20">
                <div class="card-header tx-medium bd-0 tx-white bg-mantle d-flex justify-content-between align-items-center"
                    style="border-radius: 122px;border-bottom-left-radius: 0px;">
                    <h6 class="card-title tx-uppercase text-white tx-12 mg-b-0">{{$page_title}}</h6>
                    <span class="tx-12 tx-uppercase" id=""></span>
                </div><!-- card-header -->
                <div class="card-body  d-xs-flex justify-content-between align-items-center">
                    <div class="d-md-flex pd-y-20 pd-md-y-0">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Select Sensor :</label>
                                        <small>Select All</small>

                                        <input type="checkbox" id="checkbox">
                                        <select name="sensors[]" required class="form-control select2" style="width:100%" id="e1" multiple>
                                            @foreach ($selectSensors as $selectSensor)
                                        <option value="{{$selectSensor->tag_name}}">{{$selectSensor->name}}</option>
                                            @endforeach
                                             
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="">Select Date :</label>
                                    <div class="input-group">

                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="icon ion-calendar tx-16 lh-0 op-6"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control fc-datepicker" value="{{$date}}"
                                            placeholder="{{$date}}" autocomplete="off" name="date">
                                        <button href="#" class="btn btn-primary btn-icon  mg-md-l-10 mg-t-10 mg-md-t-0">
                                            <div><i class="fa fa-paper-plane"></i></div>
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </form>

                    </div>

                </div><!-- card-body -->
            </div><!-- card -->
        </div>
    </div>


    <div class="row row-sm mg-t-20">

        {{-- <div class="col-md-3 mg-t-20">
            <div class="card bd-0 shadow-base card__one rounded-20">
                <div class="card-header tx-medium bd-0 tx-white bg-mantle d-flex justify-content-between align-items-center"
                    style="border-radius: 122px;border-bottom-left-radius: 0px;">
                    <h6 class="card-title tx-uppercase text-white tx-12 mg-b-0">Realtime : Value 1</h6>
                    <span class="tx-12 tx-uppercase" id="dateTag1"></span>
                </div><!-- card-header -->
                <div class="card-body pd-t-40 pd-b-20 d-xs-flex justify-content-between align-items-center">
                    <h4 class="mg-b-0 tx-inverse tx-lato tx-bold" id="valueTag1">-</h4>
                    <p class="mg-b-0 tx-sm"><span class="tx-danger" id="tstampTag1"> -</span></p>
                </div><!-- card-body -->
            </div><!-- card -->


        </div> --}}

        @foreach ($sensors as $sensor)
        <div class="col-md-12 mg-t-20">


            <div class="card bd-0 shadow-base  rounded-20">
                <div class="card-header tx-medium bd-0 tx-white bg-mantle d-flex justify-content-between align-items-center"
                    style="border-radius: 122px;border-bottom-left-radius: 0px;">
                    <h6 class="card-title tx-uppercase text-white tx-12 mg-b-0">{{$sensor->name}}</h6>

                    @php
                    $sensorData = $sensor->tag_name;
                    $sensorDetail = ${$sensor->tag_name};
                    @endphp
                    {{-- <span class="tx-12 tx-uppercase" id="">
              
            </span> --}}
                </div><!-- card-header -->
                <div class="card-body  ">
                    <div class=" ">
                        <div id="chart{{$sensor->tag_name}}" class="ht-200 ht-sm-400"></div>
                    </div>
                    <div class="table-wrapper">
                        <table class="table responsive datatableG" id=" ">
                            <thead>
                                <td>NO</td>
                                <td>Tag Name</td>
                                <td>Tstamp</td>
                                <td>Value</td>
                            </thead>
                            <tbody>
                                @php
                                $no=1;
                                $tstamp = [];
                                $tag1chart = [];
                                @endphp
                                @foreach ($sensorDetail as $sd)
                                {{-- @php
                                array_push($tag1chart,number_format($rt1->value_avg, 2, '.', ','));
                                array_push($tstamp,date('H:i',strtotime($rt1->tstamp)));
                                @endphp --}}
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$sd->tag_name}}</td>
                                    <td>{{$sd->tstamp}}</td>
                                    <td>{{number_format($sd->value_avg, 2, '.', ',') }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div><!-- card-body -->
            </div><!-- card -->


        </div>
        @endforeach






    </div>









</div><!-- br-pagebody -->

@include('layouts.partials.footer')
</div><!-- br-mainpanel -->
@endsection


@push('js')
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="{{url('/backend')}}/lib/jquery-ui/ui/widgets/datepicker.js"></script>
<script>
    // TRENDING INTERVAL

    $("#e1").select2();
    $("#checkbox").click(function () {
        if ($("#checkbox").is(':checked')) {
            $("#e1 > option").prop("selected", "selected");
            $("#e1").trigger("change");
        } else {
            $("#e1 > option").removeAttr("selected");
            $("#e1").val("");
            $("#e1").trigger("change");
        }
    });

    $("#button").click(function () {
        alert($("#e1").val());
    });

    $("select").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        var $element = $(element);
        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });

    $("#e1").val([
        @foreach ($sensors as $sensor)
            {!! "'".$sensor->tag_name."'".',' !!}             
        @endforeach 
    ]);


    
    // INITIATE CHART
    /** ***************** LINE CHART 2 ********************/
    var chartdata5 = [{
        name: '-',
        type: 'bar',
        smooth: true,
        data: [4, 5, 7, 2,4,5,6,2,6,2]
    }];

    

    @foreach ($sensors as $sensor)
        @php
            $sensorData = $sensor->tag_name;
            $sensorDetail = ${$sensor->tag_name};
        @endphp

        var chartdata{{$sensor->id}} = [{
            name: '{{$sensor->name}}',
            type: 'bar',
            smooth: true,
            opacity : 0.5,
            itemStyle:{
                barBorderColor: '#0095F8',
                barBorderWidth:3,
                // barBorderRadius: 5,
                opacity:0.5,
            },
            // barWidth:150,
            data: [
                @foreach ($sensorDetail as $sd)
                    {!! "'".$sd->value_avg."'".',' !!}             
                @endforeach 
            ]
        }];

        var option{!!$sensor->id!!} = {
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
                  x: 40,
                  y: 20,
                  x2: 40,
                  y2: 80
                },
            dataZoom: [{
                  type: 'inside',
                  start: 0,
                  // end: 10
                }, {
                  start: 0,
                  end: 10,
                  handleSize: '100%',
                  handleStyle: {
                    color: '#fff',
                    shadowBlur: 10,
                    shadowColor: 'rgba(0, 0, 0, 0.6)',
                    shadowOffsetX: 2,
                    shadowOffsetY: 2
                  }
                }],
            xAxis: {
                data: [
                    @foreach ($sensorDetail as $sd)
                        {!! "'".$sd->tstamp."'".',' !!}             
                    @endforeach 
                ],
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
            series: chartdata{{$sensor->id}},
            color: ['#004F86']
        };
    
        echarts.init(document.getElementById('chart{{$sensor->tag_name}}')).setOption(option{{$sensor->id}});        
    @endforeach 
    


    $('.datatableG').dataTable({
        "searching": false,
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });


    // Datepicker
    $('.fc-datepicker').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        changeYear: true
    });

    $('#datepickerNoOfMonths').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        numberOfMonths: 2
    });

    

</script>
@endpush
