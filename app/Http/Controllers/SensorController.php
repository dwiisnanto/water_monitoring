<?php

namespace App\Http\Controllers;

use App\Log as Logs;
use App\Sensor as Sensors;
use DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class SensorController extends Controller
{
    //

    public function index()
    {
        $data['page_title'] = 'Management Sensors';
        $data['sensors'] = Sensors::orderBy('id', 'desc')->get();
        return view('sensors.index', $data);
    }

    public function groupSensor()
    {
        $sensors = Logs::orderBy('tag_name', 'asc')
            ->groupBy(DB::raw('tag_name'))->get();

        $listSensors = [];
        foreach ($sensors as $sensor) {

            $data = [
                'name' => $sensor->tag_name,
                'tag_name' => $sensor->tag_name,
                'remark' => 'Exist',
                'status' => '1',
            ];

            $cek = Sensors::where('tag_name', $sensor->tag_name)->get()->count();
            if ($cek == 0) {
                array_push($listSensors, $data);
            }

        }
        // print_r($listSensors);
        // die();

        $count = count($listSensors);

        Sensors::insert($listSensors);

        if ($count > 1) {
            $msg = $count . ' sensors found !';
        } else {
            $msg = $count . ' sensor found !';
        }
        return redirect('sensors')->with(['create' => $msg]);

    }

    public function edit($id)
    {
        $data['page_title'] = 'Edit Sensors';
        $data['sensor'] = Sensors::findOrFail($id);
        // dd($departement);
        return view('sensors.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $data['name'] = $request->input('name');

        $request->validate([
            'name' => 'required|min:2',
        ]);
        $sensor = Sensors::where('id', $id)->update($data);
        return redirect('sensors')->with(['update' => 'Data updated successfully!']);

    }

    public function destroy($id)
    {
        $sensor = Sensors::where('id', $id)->delete();

        // redirect('departements')->with(['delete' => 'Data deleted successfully!']);
        Session::flash('delete', 'Data deleted successfully!');
        return response()->json(['status' => '200']);

    }

    public function activate($id)
    {
        Sensors::where('id', $id)->update(['status' => 1]);
        return redirect('sensors')->with(['create' => 'Sensor activated successfully!']);

    }

    public function deactivate($id)
    {
        Sensors::where('id', $id)->update(['status' => 0]);
        return redirect('sensors')->with(['delete' => 'Sensor deactivated successfully!']);

    }
}
