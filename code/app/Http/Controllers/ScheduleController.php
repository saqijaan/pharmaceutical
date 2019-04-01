<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use App\DoctorRegis;
use App\EmployeeRegistration;
use App\CityRegistration;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::all();
        return view('dashboard.admin-panel.scheduleRegis.index',compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docters = DoctorRegis::all();
        $employees = EmployeeRegistration::all();
        $cities = CityRegistration::all();

        return view('dashboard.admin-panel.scheduleRegis.new',compact('docters','employees','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'employee'   => 'required',
            'city'       => 'required',
            'doctors'    => 'required|array',
            'day'        => 'required',
        ];

        $this->validate($request,$rules);

        Schedule::create([
            'employee_id'   => $request->employee,
            'city_id'       => $request->city,
            'docters'       => $request->doctors,
            'day'           => $request->day,
            'detail'        => $request->detail
        ]);
        session()->flash('success','Schedule Saved');
        return redirect()->route('schedules.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $docters = DoctorRegis::all();
        $employees = EmployeeRegistration::all();
        $cities = CityRegistration::all();

        return view('dashboard.admin-panel.scheduleRegis.edit',compact('schedule','docters','employees','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $rules = [
            'employee'   => 'required',
            'city'       => 'required',
            'doctors'    => 'required|array',
            'day'        => 'required',
        ];

        $this->validate($request,$rules);

        $schedule->update([
            'employee_id'   => $request->employee,
            'city_id'       => $request->city,
            'docters'       => $request->doctors,
            'day'           => $request->day,
            'detail'        => $request->detail
        ]);
        session()->flash('success','Schedule updated');
        return redirect()->route('schedules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        session()->flash('success','Schedule Deleted');
        return redirect()->route('schedules.index');
    }
}
