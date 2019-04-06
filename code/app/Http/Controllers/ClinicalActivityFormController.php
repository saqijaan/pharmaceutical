<?php

namespace App\Http\Controllers;

use App\ClinicalActivityForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Employees\ClinicalActivityController;

class ClinicalActivityFormController extends Controller
{

    public function adminIndex(){
        $forms = ClinicalActivityForm::all();
        return view('dashboard.admin-panel.activityforms.monthlyactivity',compact('forms'));
    }
    public function adminView($id){
        $form = ClinicalActivityForm::find($id);
        if (!$form){
            $form =new ClinicalActivityForm;
        }
        return view('dashboard.admin-panel.activityforms.viewmonthly',compact('form'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = ClinicalActivityForm::where('level_id',auth('employee')->Id())->get();
        return view('employees.acitivityform.index',compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.acitivityform.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (ClinicalActivityForm::where('created_at','Like',date('Y-m-').'%')->first()){
            session()->flash('Danger','You already submitted form for this month');
            return redirect()->route('clinical-activity-form.index');
        }
        ClinicalActivityForm::create([
            'employee_id'   => auth('employee')->Id(),
            'data'          => $request->form,
            'level_id'      => auth('employee')->user()->reports_to,
        ]);
        session()->flash('Success','Form Submitted Successfully');
        return redirect()->route('clinical-activity-form.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClinicalActivityForm  $clinicalActivityForm
     * @return \Illuminate\Http\Response
     */
    public function show(ClinicalActivityForm $clinicalActivityForm)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClinicalActivityForm  $clinicalActivityForm
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form = ClinicalActivityForm::find($id);
        return view('employees.acitivityform.edit',compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClinicalActivityForm  $clinicalActivityForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClinicalActivityForm $clinicalActivityForm)
    {
        $clinicalActivityForm->update([
            'data'          => $request->form,
            'level_id'      => auth('employee')->user()->reports_to ?? -1,
        ]);
        session()->flash('Success','Form Submitted Successfully');
        return redirect()->route('clinical-activity-form.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClinicalActivityForm  $clinicalActivityForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClinicalActivityForm $clinicalActivityForm)
    {
        //
    }
}
