<?php

namespace App\Http\Controllers;

use App\DoctorRegis;
use App\QuizAnswer;
use App\SchedleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class SchedleController extends Controller
{


    public function view($id){
        $scheduls = SchedleModel::where('id', $id)->first();
        return view( 'dashboard.admin-panel.scheduleRegis.view', [ 'scheduls'=>$scheduls, ] );
    }


    public function downloadPDF($id){
        $scheduls = SchedleModel::where('id', $id)->first();

        $pdf = PDF::loadView('dashboard.admin-panel.scheduleRegis.pdf', compact('scheduls'));
        return $pdf->stream('invoice.pdf');

    }

    public function apiScheduleList(){

        $schedules = SchedleModel::where('date', Carbon::now())->get();
        return response()->json($schedules);

    }

    public function apiScheduleListDate(Request $request){

        $schedules = SchedleModel::whereBetween('date', [$request->from, $request->to])->get();
        return response()->json($schedules);

    }

    public function apiSche(Request $request)
    {
        //
        $schedules = new SchedleModel();

        if($request->has('doctor')) {
            if ($request->has('date')) {
                $schedules->date = date('Y-m-d', strtotime($request->date));
            }
            if ($request->has('time')) {
                $schedules->time = Carbon::createFromFormat('H:i', $request->time)->format('H:i');
            }
            if ($request->has('doctor')) {
                $schedules->doctor = $request->doctor;
            }
            if ($request->has('address')) {
                $schedules->address = $request->address;
            }
            $schedules->status = 0;
            $schedules->save();
            return response()->json(['code'=>'1', 'message'=>'Schedule has been successfully created']);
        }
        else{
            return response()->json(['code'=>'0', 'message'=>'Some thing went wrong.']);
        }


    }

    public function apiScheVstd(Request $request)
    {
        //
        $schedules = SchedleModel::find($request->id);

        if($request->has('detail')) {
            if ($request->has('detail')) {
                $schedules->detail = $request->detail;
            }
            if ($request->has('gift')) {
                $schedules->gift = $request->gift;
            }
            if ($request->has('sample')) {
                $schedules->sample = $request->sample;
            }
            if ($request->has('brochure')) {
                $schedules->brochure = $request->brochure;
            }
            if ($request->has('city')) {
                $schedules->city = $request->city;
            }
            if ($request->has('x')) {
                $schedules->x = $request->x;
            }
            if ($request->has('y')) {
                $schedules->y = $request->y;
            }
            $schedules->status = 1;
            $schedules->update();
            return response()->json(['code'=>'1', 'message'=>'Schedule has been successfully visited']);
        }
        else{
            return response()->json(['code'=>'0', 'message'=>'Some thing went wrong.']);
        }


    }

    public function index()
    {

        $schedules = DB::table('schedle_models')->get();

        return view('dashboard.admin-panel.scheduleRegis.index', ['schedules'=>$schedules] );
    }

    public function create()
    {
        //
        $schedules = DB::table('schedle_models')->get();
        return view('dashboard.admin-panel.scheduleRegis.new', [ 'schedules'=>$schedules] );

    }

    public function store(Request $request)
    {
        //
        $rules = [
            'doctor'  =>  'required|max:70',
            'date'  =>  'required|max:25',
            'address'  =>  'required|max:99',
            'detail'  =>  'max:150',
            'gift'  =>  'max:30',
            'sample'  =>  'max:30',
            'brochure'  =>  'max:30',
            'city'  =>  'max:30',
        ];

        $messages = [
            'doctor.required' =>  "Doctor Name must be required",
            'date.required' =>  "Date must be selected",
            'address.required'  =>  "Address section must be required",
            'detail.required'   =>  "Detail section must be required",

        ];

        $this->validate($request, $rules, $messages);

        $data = $request->all();

        $data['date'] = date('Y-m-d',strtotime($request->date)).' '.$request->time;

        SchedleModel::create($data);


        Session::flash("Success", "Schedule has been successfully created");
        return redirect('/dashboard/schedule-regis');


    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $schedules = SchedleModel::find($id);
        return view('dashboard.admin-panel.scheduleRegis.edit', ['schedules'=>$schedules] );
    }

    public function update(Request $request, $id)
    {
        //
        $rules = [
            'doctor'  =>  'required|max:70',
            'date'  =>  'required|max:25',
            'address'  =>  'max:99',
        ];

        $messages = [
            'doctor.required' =>  "Doctor Name must be required",
            'date.required' =>  "Date must be selected",
            'address.required'  =>  "Address section must be required",

        ];

        $this->validate($request, $rules, $messages);

        
        $data = $request->all();

        $data['date'] = date('Y-m-d',strtotime($request->date)).' '.$request->time;
        
        $schedules = SchedleModel::find($id);
        $schedules->update($data);

        Session::flash("Success", $id." Schedule has been successfully updated");
        return redirect('/dashboard/schedule-regis');
    }

    public function destroy($id)
    {
        //
        $schedules = SchedleModel::find($id);
        $schedules->delete();

        Session::flash("Success", $id." Schedule has been successfully deleted");
        return redirect('/dashboard/schedule-regis');

    }
}
