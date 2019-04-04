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
		$empId = \Auth::guard('api')->Id();

		return \App\CallSubmission::where('employe_id',$empId)
							->with(['docter'=>function($query){
								$query->select('id','name','x','y');
							}])
							->where('created_at','LIKE',date('Y-m-d%'))
							->get();
	});

	Route::post('/schedule/store',function(Request $request){

		$empId = \Auth::guard('api')->Id();

		$schedule = \App\CallSubmission::find($request->scheduleId);

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
			'product' 		=> $request->brochure,
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
			'x'			=> 'required|numeric',
			'y'	 		=> 'required|numeric',
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
		$empId = \Auth::guard('api')->Id();
		$rules = [
			'work_type'				=> 'required|in:local,outstation',
			'dailyFixedAmount' 		=> 'required_if:work_type,local|numeric',
			'total_km' 				=> 'required_if:work_type,outstation|numeric',
			'night_stay'			=> 'required_if:work_type,outstation|in:0,1',
			'night_stay_allownce' 	=> 'required_if:night_stay,1',
			'night_stay_description'=> 'required_if:night_stay,1',
			// 'image'					=> 'required_if:work_type,outstation|image',
		];

		
		$validation = Validator::make($request->all(), $rules);

		if($validation->fails()){
			return response()->json([
				'success' => false,
				'message' => $validation->errors()->first()
			]);
		}

		$imageName = null;
		if($request->hasFile('image')) {

			$image = $request->file('image');
            $imageName = md5(microtime()).'.'.$image->extension();
            $s_path = 'uploads/employees/vouchers';
            if(!file_exists($s_path))
				mkdir($s_path, 777, true);
			// $image->move('uploads/employees/vouchers',$imageName);
            Image::make($image)->save($s_path.'/'.$imageName);
        }
		if (
			DailySummary::where('employee_id',$empId)->where('created_at','LIKE',date('Y-m-d%'))->first()
			){
				return response()->json([
					'success' => false,
					'message' => 'You already have been saved daily summary for today'
				]);
		}

		DailySummary::Create([
			'employee_id'			=> $empId,
			'work_type'				=> $request->work_type,
			'dailyfixedAmount' 		=> $request->dailyFixedAmount ??0,
			'total_km' 				=> $request->total_km,
			'night_stay'			=> $request->night_stay??false,
			'night_stay_allownce' 	=> $request->night_stay_allownce,
			'night_stay_description'=> $request->night_stay_description,
			'image'					=> $imageName,
		]);

		return response()->json([
			'success' => true,
			'message' => 'Summary Saved'
		]);
	});
});


