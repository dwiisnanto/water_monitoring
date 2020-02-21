<?php

namespace App\Http\Controllers;

use App\Charts\ChartExample;
use App\Log as Logs;
use App\Sensor as Sensors;

class ChartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('privilege:Monitoring');

    }

    public function index()
    {

        $data['page_title'] = 'Chart';
        $data['sensors'] = Sensors::orderBy('name', 'asc')->get();

        $logs = Logs::orderBy('id', 'desc')->where('tag_name', 'Amonia')->take(30)->get();

        $tstamp = [];
        $value = [];
        foreach ($logs as $log) {
            array_push($tstamp, date('H:i:s', strtotime($log->tstamp)));
            array_push($value, $log->value);
        }

        // ECHART 1
        $echart = new ChartExample;

        $echart->labels($tstamp);
        $echart->dataset('My dataset', 'line', $value);
        $data['echart'] = $echart;
        // ECHART 1 END

        // ECHART 2
        $echart2 = new ChartExample;
        $echart2->options([
            'tooltip' => [
                'show' => true, // or false, depending on what you want.
            ],
            'toolbox' => [
                'feature' => [
                    'saveAsImage' => [
                        'title' => [
                            'Save Png',
                        ],
                    ],
                ],
            ],
            'animation' => false,

        ]);

        // $echart2->loader(false);
        // $echart2->labels($tstamp);
        // $echart2->dataset('My dataset', 'line', $value);
        $api = url('/chart/api');
        $echart2->labels($tstamp)
            ->load($api);
        // dd($echart);
        $data['echart2'] = $echart2;

        return view('chart.index', $data);
    }

    public function echart2()
    {
        // $chart = new ChartExample;

        // $api = url('/test_data');

        // $chart->labels(['test1', 'test2', 'test3'])
        //     ->load($api);

        $logs = Logs::orderBy('id', 'desc')->where('tag_name', 'Amonia')->take(30)->get();

        $tstamp = [];
        $value = [];
        foreach ($logs as $log) {
            array_push($tstamp, date('H:i:s', strtotime($log->tstamp)));
            array_push($value, $log->value);
        }

        $chart = new ChartExample;
        $chart->dataset('Sample Test', 'line', $value);
        $chart->dataset('Sample Test2', 'line', $value);

        return $chart->api();
    }
}
