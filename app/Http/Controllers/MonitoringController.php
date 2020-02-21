<?php

namespace App\Http\Controllers;

use App\Sensor as Sensors;

class MonitoringController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('privilege:Monitoring');

    }

    public function index()
    {

        $data['page_title'] = 'Monitoring';
        $data['sensors'] = Sensors::orderBy('name', 'asc')->where('status', '1')->get();
        return view('monitoring.index', $data);
    }
}
