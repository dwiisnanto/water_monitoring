<?php

namespace App\Http\Controllers;

use App\Alarm as Alarms;
use App\AlarmSetting as AlarmSettings;
use App\Log as Logs;
use App\Sensor as Sensors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class LogController extends Controller
{
    //

    public function __construct()
    {
        // $this->middleware('auth');

        // $this->middleware('privilege:Dashboard');
        // $this->middleware('auth');

        // $this->middleware('privilege:Monitoring');
    }

    public function index()
    {

        // $result['tag1'] = Logs::where('tag_name', 'tag1')->orderBy('id', 'desc')->first();
        // $result['tag2'] = Logs::where('tag_name', 'tag2')->orderBy('id', 'desc')->first();
        // $result['tag3'] = Logs::where('tag_name', 'tag3')->orderBy('id', 'desc')->first();
        // $result['tag4'] = Logs::where('tag_name', 'tag4')->orderBy('id', 'desc')->first();

        // $tag1 = Logs::where('tag_name', 'tag1')->orderBy('id', 'desc')->first();
        // $tag2 = Logs::where('tag_name', 'tag2')->orderBy('id', 'desc')->first();
        // $tag3 = Logs::where('tag_name', 'tag3')->orderBy('id', 'desc')->first();
        // $tag4 = Logs::where('tag_name', 'tag4')->orderBy('id', 'desc')->first();

        // $result['realtime']['tag1'] = ['date' => date('d F Y', strtotime($tag1->tstamp)), 'time' => date('H:i:s', strtotime($tag1->tstamp)), 'value' => $tag1->value];
        // $result['realtime']['tag2'] = ['date' => date('d F Y', strtotime($tag2->tstamp)), 'time' => date('H:i:s', strtotime($tag2->tstamp)), 'value' => $tag2->value];
        // $result['realtime']['tag3'] = ['date' => date('d F Y', strtotime($tag3->tstamp)), 'time' => date('H:i:s', strtotime($tag3->tstamp)), 'value' => $tag3->value];
        // $result['realtime']['tag4'] = ['date' => date('d F Y', strtotime($tag4->tstamp)), 'time' => date('H:i:s', strtotime($tag4->tstamp)), 'value' => $tag4->value];

        // $result['smallTrend']['tag1'] = Logs::where('tag_name', 'tag1')->orderBy('id', 'desc')->take(10)->get();
        // $result['smallTrend']['tag2'] = Logs::where('tag_name', 'tag2')->orderBy('id', 'desc')->take(10)->get();
        // $result['smallTrend']['tag3'] = Logs::where('tag_name', 'tag3')->orderBy('id', 'desc')->take(10)->get();
        // $result['smallTrend']['tag4'] = Logs::where('tag_name', 'tag4')->orderBy('id', 'desc')->take(10)->get();
        $sensors = Sensors::orderBy('tag_name', 'asc')->where('status', '1')->get();
        $result = [];
        foreach ($sensors as $sensor) {

            $data = Logs::where('tag_name', $sensor->tag_name)->orderBy('id', 'desc')->take(1)->first();

            if ($data) {
                $this->alarm_check($data->value, $sensor->tag_name);

                $data_push = [
                    'tag' => $data,
                ];
                array_push($result, $data_push);
            }

        }
        // print_r($result);
        return json_encode($result);
    }

    public function alarm_check($param1, $tag_name)
    {
        // ALARM PH
        $tstamp = date('Y-m-d H:i:s');
        $alarm_setting = AlarmSettings::where('tag_name', $tag_name)->where('status', 1)->get();
        foreach ($alarm_setting as $assett) {

            switch ($assett->formula) {

                case ">":
                    if ($param1 > $assett->sp) {
                        $this->alarm_log($tstamp, $tag_name, $param1, $assett->formula, $assett->sp, $assett->text);
                    }
                    break;
                case ">=":
                    if ($param1 >= $assett->sp) {
                        $this->alarm_log($tstamp, $tag_name, $param1, $assett->formula, $assett->sp, $assett->text);
                    }
                    break;

                case "<":
                    if ($param1 < $assett->sp) {
                        $this->alarm_log($tstamp, $tag_name, $param1, $assett->formula, $assett->sp, $assett->text);
                    }
                    break;
                case "<=":
                    if ($param1 <= $assett->sp) {
                        $this->alarm_log($tstamp, $tag_name, $param1, $assett->formula, $assett->sp, $assett->text);
                    }
                    break;
                default:
                    if ($param1 == $assett->sp) {
                        $this->alarm_log($tstamp, $tag_name, $param1, $assett->formula, $assett->sp, $assett->text);
                    }
                    break;
            }

        }
        // ./ ALARM PH
    }

    public function SendNotifSocket($data_pusher)
    {

        $curl = curl_init();
        $param = json_encode($data_pusher);
        $content_length = strlen($param);
        curl_setopt_array($curl, array(
            CURLOPT_PORT => "1234",
            CURLOPT_URL => "http://localhost:1234/update",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            // CURLOPT_POSTFIELDS => "{\n\"test\":1\n}",
            CURLOPT_POSTFIELDS => $param,
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Length: $content_length",
                "Content-Type: application/json",
                "Host: localhost:1234",
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // } else {
        //     echo $response;
        // }
    }

    public function alarm_log($tstamp, $tag_name, $value, $formula, $sp, $text)
    {
        $data['tstamp'] = $tstamp;
        $data['tag_name'] = $tag_name;
        $data['value'] = $value;
        $data['formula'] = $formula;
        $data['sp'] = $sp;
        $data['text'] = $text;

        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true,
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $data_pusher['tstamp'] = $tstamp;
        $data_pusher['tag_name'] = $tag_name;
        $data_pusher['text'] = $text;
        $data_pusher['value'] = $value;
        $pusher->trigger('notify-channel', 'App\\Events\\Notify', $data_pusher);
        // $this->SendNotifSocket($data_pusher);
        Alarms::create($data);
    }

    public function trending()
    {

        $last_date = Logs::orderBy('id', 'desc')->take(1)->first()->tstamp;
        $last_date = date('Y-m-d', strtotime($last_date));
        $last_date = date('Y-m-d');
        // dd($last_date);
        $tag1 = Logs::select(DB::raw('avg(value) as value_avg,tstamp'))->where('tag_name', 'tag1')->where('tstamp', 'LIKE', "%$last_date%")->orderBy('id', 'desc')->groupBy(DB::raw('MONTH(tstamp),DAY(tstamp),HOUR(tstamp),UNIX_TIMESTAMP(tstamp) DIV 10'))->take(60)->get();
        $tag2 = Logs::select(DB::raw('avg(value) as value_avg,tstamp'))->where('tag_name', 'tag2')->where('tstamp', 'LIKE', "%$last_date%")->orderBy('id', 'desc')->groupBy(DB::raw('MONTH(tstamp),DAY(tstamp),HOUR(tstamp),UNIX_TIMESTAMP(tstamp) DIV 10'))->take(60)->get();
        $tag3 = Logs::select(DB::raw('avg(value) as value_avg,tstamp'))->where('tag_name', 'tag3')->where('tstamp', 'LIKE', "%$last_date%")->orderBy('id', 'desc')->groupBy(DB::raw('MONTH(tstamp),DAY(tstamp),HOUR(tstamp),UNIX_TIMESTAMP(tstamp) DIV 10'))->take(60)->get();
        $tag4 = Logs::select(DB::raw('avg(value) as value_avg,tstamp'))->where('tag_name', 'tag4')->where('tstamp', 'LIKE', "%$last_date%")->orderBy('id', 'desc')->groupBy(DB::raw('MONTH(tstamp),DAY(tstamp),HOUR(tstamp),UNIX_TIMESTAMP(tstamp) DIV 10'))->take(60)->get();
        // dd($tag1);
        $tstamp = [];

        $dataTags1 = [];
        $dataTags2 = [];
        $dataTags3 = [];
        $dataTags4 = [];

        // PUSH
        foreach ($tag1 as $dt1) {
            array_push($tstamp, date('H:i', strtotime($dt1->tstamp)));
            array_push($dataTags1, number_format($dt1->value_avg, 2, '.', ','));
        }

        foreach ($tag2 as $dt2) {
            array_push($dataTags2, number_format($dt2->value_avg, 2, '.', ','));
        }

        foreach ($tag3 as $dt3) {
            array_push($dataTags3, number_format($dt3->value_avg, 2, '.', ','));
        }
        foreach ($tag4 as $dt4) {
            array_push($dataTags4, number_format($dt4->value_avg, 2, '.', ','));
        }

        $result['trending']['tstamp'] = $tstamp;
        $result['trending']['tag1']['value'] = $dataTags1;
        $result['trending']['tag2']['value'] = $dataTags2;
        $result['trending']['tag3']['value'] = $dataTags3;
        $result['trending']['tag4']['value'] = $dataTags4;

        return $result;
    }

    public function trendingTag(Request $request)
    {
        $tagName = $request->input('tag_name');
        $trendingData = Logs::select(DB::raw(' value  as value_avg,tstamp'))->where('tag_name', $tagName)->orderBy('id', 'desc')->take(30)->get();

        $tstamp = [];
        $dataTag = [];
        foreach ($trendingData as $value) {
            array_push($tstamp, date('H:i:s', strtotime($value->tstamp)));
            array_push($dataTag, $value->value_avg);
            // array_push($dataTag, number_format($value->value_avg, 0, ',', ''));
        }

        $result['trending']['tstamp'] = array_reverse($tstamp);
        $result['trending']['tag']['value'] = array_reverse($dataTag);

        return json_encode($result);

    }
}
