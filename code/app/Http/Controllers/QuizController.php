<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\QuizAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{


    public function view($id){
        $quizs = Quiz::where('id', $id)->first();

        $ans = DB::table('quiz_answers')
            ->leftJoin('employee_registrations', 'quiz_answers.employe_id', '=', 'employee_registrations.id')
            ->select('quiz_answers.*', 'employee_registrations.name as employeName')
            ->get();
        return view( 'dashboard.admin-panel.quizRegis.view', [ 'quizs'=>$quizs, 'ans'=>$ans ] );
    }


    public function downloadPDF($id){

        $quizs = Quiz::where('id', $id)->first();
        $ans = DB::table('quiz_answers')
            ->leftJoin('employee_registrations', 'quiz_answers.employe_id', '=', 'employee_registrations.id')
            ->select('quiz_answers.*', 'employee_registrations.name as employeName')
            ->get();
        $pdf = PDF::loadView('dashboard.admin-panel.quizRegis.pdf', compact('quizs','ans'));
        return $pdf->stream('invoice.pdf');

    }


    public function index()
    {
        //
        $quizs = Quiz::get();
        return view( 'dashboard.admin-panel.quizRegis.index', ['quizs'=>$quizs] );
    }

    public function apiQuizList(){

        $quiz = Quiz::get();
        return response()->json(['code'=>'1', 'message'=>'success', 'data'=>$quiz]);

    }

    public function apiQuizAnswerList(){

        $quizs = Quiz::get();
        $data = array();
        foreach ($quizs as $key=>$quiz){
            $answers = QuizAnswer::where('quiz_id', $quiz->id)->get();
            $data[$key] = $quiz;
            $data[$key]['answers'] = $answers;
        }

        return response()->json(['code'=>'1', 'message'=>'success', 'data'=>$data]);

    }

    public function apiQuizAnswerCreate(Request $request)
    {
        //
        $inputs = $request->all();
        $schedules = new QuizAnswer();
        $data = $schedules->saveData($inputs);

        QuizAnswer::create($data);

        return response()->json(['code'=>'1', 'message'=>'Answer Successfully submitted!.']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $quizs = Quiz::get();
        return view( 'dashboard.admin-panel.quizRegis.new', ['quizs'=>$quizs] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //
        $rules = [
            'question'  =>  'required|max:70',
            'date'  =>  'required|max:25',
            'start_time'  =>  'required|max:99',
            'end_time'  =>  'required|max:150',

        ];

        $messages = [
            'question.required' =>  "Question must be required",
            'date.required' =>  "Date must be selected",
            'start_time.required'  =>  "Start time must be required",
            'end_time.required'   =>  "End time must be required",

        ];

        $this->validate($request, $rules, $messages);

        $data = $request->all();
        $data['options'] = $request->answer;
        Quiz::create($data);

        Session::flash("Success", "Quiz has been successfully created");
        return redirect('/dashboard/quiz-regis');

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
        //
        $quizs = Quiz::find($id);
        return view( 'dashboard.admin-panel.quizRegis.edit', ['quizs'=>$quizs] );
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
        //
        $rules = [
            'question'  =>  'required|max:70',
            'date'  =>  'required|max:25',
            'start_time'  =>  'required|max:99',
            'end_time'  =>  'required|max:150',

        ];

        $messages = [
            'question.required' =>  "Question must be required",
            'date.required' =>  "Date must be selected",
            'start_time.required'  =>  "Start time must be required",
            'end_time.required'   =>  "End time must be required",

        ];

        $this->validate($request, $rules, $messages);

        $data = $request->all();
        $data['options'] = $request->answer;

        Quiz::where('id', $id)->first()->update($data);

        Session::flash("Success", "Quiz has been successfully updated");
        return redirect('/dashboard/quiz-regis');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $quizs = Quiz::find($id);
        $quizs->delete();

        Session::flash("Success", "Quiz has been successfully deleted");
        return redirect('/dashboard/quiz-regis');
    }
}
