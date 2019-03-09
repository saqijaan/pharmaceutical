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


Route::group(['prefix' => 'v1-2019'], function() {
	
	Route::get('/users',function(){
		return response()->json(
			\App\EmployeeRegistration::with('answers','answers.quiz')->get()
		);
	});
	Route::get('/quize/list', function (){
		return response()->json(
			\App\Quiz::all()
		);
	});
	Route::get('/quize/answer', function (Request $request){
		$rules = [
			'question' 	=> 'required|integer',
			'answer'	=> 'required|integer',
		];

		
		$validation = Validator::make($request->all(), $rules);

		if($validation->fails()){
			return response()->json([
				'success' => false,
				'message' => $validation->errors()->first()
			]);
		}
		
		return response()->json([
			'success' => true,
			'message' => 'Answer Saved Successfully',
		]);
	});

});


