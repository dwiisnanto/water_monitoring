<?php

namespace App\Http\Controllers;

use App\ApiSetting as ApiSettings;
use App\Log as Logs;
use App\Sensor as Sensors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiPageController extends Controller
{
    public function index(Request $request)
    {
        $data['page_title'] = 'Api Page';
        $date = date('Y-m-d');
        $data['date'] = $date;
        $data['api_setting'] = ApiSettings::orderBy('id', 'desc')->first();
        $data['connectivity'] = $request->input('connectivity');
        if ($request->input()) {
            $date = date('Y-m-d', strtotime($request->input('date')));
            $hour = $request->input('hour');
            $date = $date . ' ' . $hour;
            // dd($hour);
            $data['date'] = $date;
            $data['hour'] = $hour;
            // dd($data['date']);
            $sensors = $request->input('sensors');
            $data['selectSensors'] = Sensors::orderBy('name', 'asc')->where('status', '1')->get();
            // $data['sensors'] = Sensors::whereIn('tag_name', $sensors)->orderBy('name', 'asc')->get();
            $data['sensors'] = Logs::select(DB::raw('avg(value) as value_avg,tstamp,tag_name'))
                ->where('tstamp', 'LIKE', "%$date%")
                ->whereIn('tag_name', $sensors)
                ->orderBy('tag_name', 'asc')
                ->groupBy(DB::raw('MONTH(tstamp),DAY(tstamp),HOUR(tstamp),tag_name'))
                ->get();

            // print_r($data['sensors']);
            // die();
            $data['date_default'] = date('Y-m-d', strtotime($request->input('date')));
            $data['get'] = 1;

        } else {
            $data['hour'] = '';
            $data['selectSensors'] = Sensors::orderBy('name', 'asc')->where('status', '1')->get();
            $data['sensors'] = [];
            $data['date_default'] = date('Y-m-d', strtotime($date));
            $data['get'] = 0;
        }

        return view('api.index', $data);
    }

    public function klhk(Request $request)
    {
        // $data = "{
        //     'data': {
        //         'IDStasiun': 'STASIUN-ENDRESS-HAUSER',
        //         'Tanggal': '2019-11-14 10:00',
        //         'Jam': '10:00',
        //         'BOD': 47.29,
        //         'COD': 50.05,
        //         'Debit': 1.429.45,
        //         'DHL': 52.33,
        //         'DO': 51.18,
        //         'Kedalaman': 54.38,
        //         'NH3N': 49.87,
        //         'Nitrat': 48.55,
        //         'Nitrit': 54.44,
        //         'ORP': 47.53,
        //         'PH': 6.07,
        //         'Salinitas': 53.29,
        //         'Suhu': 59.93,
        //         'SwSG': 48.29,
        //         'TDS': 42.75,
        //         'TSS': 51.60,
        //         'Turbidity': 51.49,
        //     },
        //     'apikey': '[apikey]',
        //     'apisecret': '[apisecret]'
        // } ";

        $data = $request->input('data_json');
        $connectivity = $request->input('connectivity');
        if ($connectivity == 'ONLIMO') {
            $url = "https://ppkl.menlhk.go.id/onlimo/uji/connect/uji_data_onlimo";
        } else {
            $url = "https://ppkl.menlhk.go.id/onlimo/uji/connect/uji_data_sparing";
        }

        $params = json_encode($data);

        $curl = curl_init();
        $contentLength = strlen($params);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $params,
            // CURLOPT_POSTFIELDS => "{\r\n    \"data\": {\r\n        IDStasiun: 'STASIUN-ENDRESS-HAUSER',\r\n        Tanggal: '2019-11-14 10:00',\r\n        Jam: \"10:00\",\r\n        BOD: 47.29,\r\n        COD: 50.05,\r\n        Debit: 1.429.45,\r\n        DHL: 52.33,\r\n        DO: 51.18,\r\n        Kedalaman: 54.38,\r\n        NH3N: 49.87,\r\n        Nitrat: 48.55,\r\n        Nitrit: 54.44,\r\n        ORP: 47.53,\r\n        PH: 6.07,\r\n        Salinitas: 53.29,\r\n        Suhu: 59.93,\r\n        SwSG: 48.29,\r\n        TDS: 42.75,\r\n        TSS: 51.60,\r\n        Turbidity: 51.49,\r\n    },\r\n    apikey: \"[apikey]\",\r\n    apisecret: \"[apisecret]\"\r\n} ",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Length: $contentLength",
                "Content-Type: application/json",
                "Cookie: PHPSESSID=89s0og2nkbpthq84gp7it2k9t4",
                "Host: ppkl.menlhk.go.id",
                "Postman-Token: 31518ed6-45fe-4647-b895-d7b6304716b0,7dbf66cb-b236-41a7-a660-faeca00beb97",
                "User-Agent: PostmanRuntime/7.18.0",
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function setting(Request $request)
    {
        $data['page_title'] = 'Api Setting';
        $date = date('Y-m-d');
        $data['date'] = $date;
        $data['connectivity'] = $request->input('connectivity');
        if ($request->input()) {
            $date = date('Y-m-d', strtotime($request->input('date')));
            $hour = $request->input('hour');
            $date = $date . ' ' . $hour;
            // dd($hour);
            $data['date'] = $date;
            $data['hour'] = $hour;
            // dd($data['date']);
            $sensors = $request->input('sensors');
            $data['selectSensors'] = Sensors::orderBy('name', 'asc')->where('status', '1')->get();
            // $data['sensors'] = Sensors::whereIn('tag_name', $sensors)->orderBy('name', 'asc')->get();
            $data['sensors'] = Logs::select(DB::raw('avg(value) as value_avg,tstamp,tag_name'))
                ->where('tstamp', 'LIKE', "%$date%")
                ->whereIn('tag_name', $sensors)
                ->orderBy('tag_name', 'asc')
                ->groupBy(DB::raw('MONTH(tstamp),DAY(tstamp),HOUR(tstamp),tag_name'))
                ->get();

            // print_r($data['sensors']);
            // die();
            $data['date_default'] = date('Y-m-d', strtotime($request->input('date')));
            $data['get'] = 1;

        } else {
            $data['hour'] = '';
            $data['selectSensors'] = Sensors::orderBy('name', 'asc')->where('status', '1')->get();
            $data['sensors'] = [];
            $data['date_default'] = date('Y-m-d', strtotime($date));
            $data['get'] = 0;
        }
        $data['api_setting'] = ApiSettings::orderBy('id', 'desc')->first();

        return view('api.setting', $data);
    }

    public function save(Request $request)
    {
        $data['idstasiun'] = $request->input('idstasiun');
        $data['apikey'] = $request->input('apikey');
        $data['apisecret'] = $request->input('apisecret');

        // dd($data);

        $apiSetting = new ApiSettings;
        $apiSetting->idstasiun = $data['idstasiun'];
        $apiSetting->apikey = $data['apikey'];
        $apiSetting->apisecret = $data['apisecret'];
        $apiSetting->save();
        return redirect('api-page/setting')->with(['update' => 'Data updated successfully!']);

    }
}
