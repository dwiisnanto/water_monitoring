<?php

namespace App\Http\Controllers;

use App\Alarm as Alarms;
use App\AlarmSetting as AlarmSettings;
use App\Sensor as Sensors;
use Auth;
use Illuminate\Http\Request;
use Session;

class AlarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['page_title'] = 'Alarm List';
        $data['alarm_lists'] = Alarms::orderBy('id', 'desc')->paginate(10);
        return view('alarm.index', $data);
    }

    public function setting()
    {
        //
        $data['page_title'] = 'Alarm Setting';
        $data['alarm_settings'] = AlarmSettings::orderBy('id', 'desc')->get();
        return view('alarm.setting', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Create Alarm Setting';
        $data['sensors'] = Sensors::orderBy('name', 'asc')->where('status', '1')->get();

        return view('alarm.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['tag_name'] = $request->input('sensor');
        $data['formula'] = $request->input('formula');
        $data['sp'] = $request->input('sp');
        $data['text'] = $request->input('text');

        $request->validate([
            'sensor' => ['required', 'max:255'],
            'formula' => ['required'],
            'sp' => ['required'],
            'text' => ['required'],
        ]);
        AlarmSettings::create($data);
        return redirect('alarm/setting')->with(['create' => 'Data saved successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Alarm Setting';
        $data['sensors'] = Sensors::orderBy('name', 'asc')->where('status', '1')->get();
        $data['alarm'] = AlarmSettings::find($id);

        return view('alarm.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data['tag_name'] = $request->input('sensor');
        $data['formula'] = $request->input('formula');
        $data['sp'] = $request->input('sp');
        $data['text'] = $request->input('text');

        $request->validate([
            'sensor' => ['required', 'max:255'],
            'formula' => ['required'],
            'sp' => ['required'],
            'text' => ['required'],
        ]);
        AlarmSettings::where('id', $id)->update($data);
        return redirect('alarm/setting')->with(['update' => 'Data updated successfully!']);

    }

    public function activate($id)
    {
        AlarmSettings::where('id', $id)->update(['status' => 1]);
        return redirect('alarm/setting')->with(['create' => 'Alarm activated successfully!']);

    }

    public function deactivate($id)
    {
        AlarmSettings::where('id', $id)->update(['status' => 0]);
        return redirect('alarm/setting')->with(['delete' => 'Alarm deactivated successfully!']);

    }

    public function acknowledge($id)
    {
        Alarms::where('id', $id)->update(['status' => 1, 'created_by' => Auth::user()->id]);
        return redirect('alarm')->with(['create' => 'Alarm acknowledge successfully!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        AlarmSettings::where('id', $id)->delete();

        // redirect('departements')->with(['delete' => 'Data deleted successfully!']);
        Session::flash('delete', 'Data deleted successfully!');
        return response()->json(['status' => '200']);
    }
}
