<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});192.168.100.6
//192.168.8.100
    
Route::prefix('dashboard')->group(function(){

	//==================== users url's =========================

	Route::post('/login', 'UserController@login');
	Route::post('/signup', ['uses' => 'UserController@signUp']);
	Route::post('/editprofile', ['uses' => 'UserController@editProfile']);
	Route::post('/logout', ['uses' => 'UserController@logout']);
	Route::post('/deleteuser', ['uses' => 'UserController@deleteUser']);
	Route::post('/forgot', ['uses' => 'UserController@forgot']);

	//============================ schedule api start =========================

	Route::get('/schedule/list', 'SchedleController@apiScheduleList');
	Route::get('/schedule/datewise/list', 'SchedleController@apiScheduleListDate');
	Route::get('/schedule/create', 'SchedleController@apiSche');
	Route::get('/schedule/visited', 'SchedleController@apiScheVstd');

	//============================ schedule api end =========================
	//============================ quiz api end =========================

	Route::get('/quiz/list', 'QuizController@apiQuizList');
	Route::get('/quiz-answer/list', 'QuizController@apiQuizAnswerList');
	Route::post('/quiz/create', 'QuizController@apiQuizAnswerCreate');

	//============================ quiz api start =========================
	
}); 	


Route::post('v1-2019/login', function(Request $request) {
	$email 		= $request->email;
	$password 	= $request->password;
	if (\Auth::guard('employeesApi')->attempt(['email' => $email, 'password' => $password])){
		$data = \Auth::guard('employeesApi')->user();
		\Auth::logout();
		return response()->json([
			'success' 	=> true,
			'data'		=> $data
		]);
	}else{
		return response()->json([
			'success'	=> false,
			'data'		=> 'Invalid Email or Password'
		]);
	}
});


Route::group(['prefix' => 'v1-2019','middleware'=>'auth:api'], function() {

	Route::get('/users',function(){
		return response()->json(
			\App\EmployeeRegistration::with('answers','answers.quiz')->get()
		);
	});

	/**
	 * Get All Quizes
	 */
	Route::get('/quize/list', function (Request $request){
		$employe_id = \Auth::guard('api')->Id();
		/**
		 * Get already Answered Questions
		 */
		$answers = \App\QuizAnswer::where('employe_id',$employe_id)->get()->pluck('quiz_id')->toArray();
		
		/**
		 * Prepare Response Excluding Already Answered Questions
		 */
		return response()->json(
			\App\Quiz::whereNotIn('id',$answers)->get()
		);
	});

	/**
	 * Save User Answer
	 */
	Route::post('/quize/answer', function (Request $request){
		$rules = [
			'question' 	 => 'required|integer',
			'answer'	 => 'string',
		];

		
		$validation = Validator::make($request->all(), $rules);

		if($validation->fails()){
			return response()->json([
				'success' => false,
				'message' => $validation->errors()->first()
			]);
		}
		
		$answer = new \App\QuizAnswer;
		$answer->employe_id = \Auth::guard('api')->Id();
		$answer->quiz_id 	= $request->question;
		$answer->answer 	= $request->answer;
		$answer->save();

		return response()->json([
			'success' => true,
			'message' => 'Answer Saved Successfully',
		]);
	});

	/**
	 * Get user Schedules
	 */
	Route::get('/schedule', function(Request $request){
		$start_date = $request->has('start_date') 	? $request->start_date.' 00:00:00' : date('Y-m-d 00:00:00');
		$end_date   = $request->has('end_date') 	? $request->end_date.' 00:59:59'   : date('Y-m-d 23:59:59');

		$empId = \Auth::guard('api')->Id();

		return \App\SchedleModel::
								where('employee_id',$empId)
								->with(['Doctor'=>function($query){
									$query->select('id','name','x','y');
								}])
								->whereBetween('created_at',[$start_date,$end_date])
								->get();
	});

	Route::post('/schedule/store',function(Request $request){

		$empId = \Auth::guard('api')->Id();

		$schedule = \App\SchedleModel::find($request->scheduleId);

		if(!$schedule){
			return response()->json([
				'success' => false,
				'message' => 'Invalid Schedule'
			]);
		}
		$result = $schedule->update([
			'detail' 		=> $request->detail,
			'gift'   		=> $request->gift,
			'sample'  		=> $request->sample,
			'brochure' 		=> $request->brochure,
			'x' 			=> $request->x,
			'y' 			=> $request->y,
			'visited' 		=> 1
		]);

		if($result){
			return response()->json([
				'success' => true,
				'message' => 'Call Submitted'
			]);
		}
		return response()->json([
			'success' => false,
			'message' => 'Call Submission Error'
		]);
	});
});


