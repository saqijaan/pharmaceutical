<?php

namespace App\Http\Controllers;

use App\ClinicalRequestForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClinicalRequestFormController extends Controller
{

    public function adminIndex(){
        $forms = ClinicalRequestForm::all();
        return view('dashboard.admin-panel.activityforms.request',compact('forms'));
    }
    public function adminView($id){
        $form = ClinicalRequestForm::find($id);
        if (!$form){
            $form =new ClinicalRequestForm;
        }
        $form = $form->data;
        return view('dashboard.admin-panel.activityforms.viewrequest',compact('form'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employees.requestform.add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ClinicalRequestForm::create([
            'employee_id' => auth('employee')->Id(),
            'data'       => $request->except(['_token']),
        ]);
        session()->flash('Success','Form submitted Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClinicalRequestForm  $clinicalRequestForm
     * @return \Illuminate\Http\Response
     */
    public function show(ClinicalRequestForm $clinicalRequestForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClinicalRequestForm  $clinicalRequestForm
     * @return \Illuminate\Http\Response
     */
    public function edit(ClinicalRequestForm $clinicalRequestForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClinicalRequestForm  $clinicalRequestForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClinicalRequestForm $clinicalRequestForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClinicalRequestForm  $clinicalRequestForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClinicalRequestForm $clinicalRequestForm)
    {
        //
    }
}
