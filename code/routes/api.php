<?php

use Illuminate\Http\Request;
use App\DailySummary;

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

	Route::get('/docters',function(){
		return response()->json(
			\App\DoctorRegis::whereNull('x')->orWhereNull('y')->get()
		);
	});

	Route::post('/docter/location/lock',function(Request $request){
		$rules = [
			'x'		=> 'required|numeric',
			'y'	 	=> 'required|numeric',
			'docter_id' => 'required|integer'
		];

		
		$validation = Validator::make($request->all(), $rules);

		if($validation->fails()){
			return response()->json([
				'success' => false,
				'message' => $validation->errors()->first()
			]);
		}

		$docter = \App\DoctorRegis::find($request->docter_id);

		if (!$docter){
			return response()->json([
				'success' => false,
				'message' => 'Invalid Docter Id'
			]);
		}

		$docter->update([
			'x' => $request->x,
			'y' => $request->y
		]);

		return response()->json([
			'success' => true,
			'message' => 'Location Locked'
		]);

	});

	Route::post('/summary/daily/store',function(Request $request){
		$rules = [
			'employee_id' => 'required|integer'
		];

		
		$validation = Validator::make($request->all(), $rules);

		if($validation->fails()){
			return response()->json([
				'success' => false,
				'message' => $validation->errors()->first()
			]);
		}
		$result = DailySummary::create([
			'name' => 'Flight 10'
		]);

		return response()->json([
			'success' => true,
			'message' => 'Summary Saved'
		]);
	});
});


