<?php

namespace App\Http\Controllers;

use App\Log as Logs;
use App\Sensor as Sensors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendingController extends Controller
{
    public function daily(Request $request)
    {
        $data['page_title'] = 'Trending Daily';
        if ($request->input()) {

            $date = date('Y-m-d', strtotime($request->input('date')));
            // $sensors = implode(",", $request->input('sensors'));
            $sensors = $request->input('sensors');

            // dd($sensors);
            $data['date'] = $date;
            $data['selectSensors'] = Sensors::orderBy('name', 'asc')->where('status', '1')->get();
            $data['sensors'] = Sensors::whereIn('tag_name', $sensors)->orderBy('name', 'asc')->get();
        } else {

            $date = date('Y-m-d');
            $data['date'] = $date;
            $data['selectSensors'] = Sensors::orderBy('name', 'asc')->where('status', '1')->get();
            $data['sensors'] = [];
        }

        foreach ($data['sensors'] as $sensor) {
            $data[$sensor->tag_name] = Logs::select(DB::raw('avg(value) as value_avg,tstamp,tag_name'))
                ->where('tstamp', 'LIKE', "%$date%")
                ->where('tag_name', $sensor->tag_name)
                ->orderBy('id', 'asc')
                ->groupBy(DB::raw('MONTH(tstamp),DAY(tstamp),HOUR(tstamp)'))
                ->get();
        }

        return view('trending.daily', $data);
    }

    public function monthly(Request $request)
    {
        $data['page_title'] = 'Trending Monthly';
        if ($request->input()) {

            $date = date('Y-m', strtotime($request->input('date')));
            $sensors = $request->input('sensors');
            $data['date'] = $date;
            $data['selectSensors'] = Sensors::orderBy('name', 'asc')->where('status', '1')->get();
            $data['sensors'] = Sensors::whereIn('tag_name', $sensors)->where('status', '1')->orderBy('name', 'asc')->get();

        } else {

            $date = date('Y-m');
            $data['date'] = $date;
            $data['selectSensors'] = Sensors::orderBy('name', 'asc')->where('status', '1')->get();
            $data['sensors'] = [];

        }

        foreach ($data['sensors'] as $sensor) {
            $data[$sensor->tag_name] = Logs::select(DB::raw('avg(value) as value_avg,tstamp,tag_name'))
                ->where('tstamp', 'LIKE', "%$date%")
                ->where('tag_name', $sensor->tag_name)
                ->orderBy('id', 'asc')
                ->groupBy(DB::raw('MONTH(tstamp),DAY(tstamp)'))
                ->get();
        }

        return view('trending.monthly', $data);
    }
}
