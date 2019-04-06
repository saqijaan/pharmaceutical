<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::resource('/top3Cols', 'IndexTopThreeColumnController');
//Route::get('/theme-dashboard', function(){
//    return view('theme-dashboard');
//});

Route::group(['middleware'=> ['auth']], function(){
    
    Route::prefix('dashboard')->group(function(){
        //brand regis
        Route::resource('/brand-registration', 'BrandRegistrationController' );
        Route::get('/brand-registration/view/{id}', 'BrandRegistrationController@view');
        //category regis
        Route::resource('/category-registration', 'CategoryRegistrationController');
        Route::get('/category-registration/view/{id}', 'CategoryRegistrationController@view');
        //city regis
        Route::resource('/city-registration', 'CityRegistrationController');
        //supplier regis
        Route::resource('/supply-registration', 'SupplyRegistrationController' );
        Route::get('/supply-profile/{id}', 'SupplyRegistrationController@profile')->name('supply-profile');
        //customer regis
        Route::resource('/customer-registration', 'CustomerRegistrationController');
        Route::get('/customer-profile/{id}', 'CustomerRegistrationController@profile')->name('customer-profile');
        //employe regis
        Route::resource('/employee-registration','EmployeeRegistrationController');
        Route::get('/employee-profile/{id}', 'EmployeeRegistrationController@profile')->name('employee-profile');
        //distributers regis
        Route::resource('/distributer-registration','DistributerRegistrationController');
        Route::get('/distributers/{id}/login','DistributerRegistrationController@login')->name('admin.distributer.login');
        Route::get('/distributer-profile/{id}', 'DistributerRegistrationController@profile')->name('distributer-profile');
        //product register
        Route::resource('/product-registration', 'ProductRegistrationController');
        Route::get('/product-registration/view/{id}', 'ProductRegistrationController@view');
        Route::get('/product-registration/downloadPDF/{id}','ProductRegistrationController@downloadPDF');
        //account session
        Route::resource('/account-session-registration', 'AccountSessionRegisController');
        //account head
        Route::resource('/account-head', 'AccountHeadController');
        //account sub head
        Route::resource('/account-sub-head', 'AccountSubHeadController');
        //acounts
        Route::resource('/account-regis', 'AccountsController');
        Route::post('/sub-head-id', 'AccountsController@getSubHead')->name('get-sub-head');
        //transactions
        Route::resource('/transaction-registration', 'TransactionTableController');
        //schedules
        Route::resource('/schedules', 'ScheduleController');
        Route::get('/schedules/view/{id}', 'ScheduleController@show')->name('schedules.view');
        Route::get('schedules/downloadPDF/{id}','ScheduleController@downloadPDF')->name('schedules.download');
        //doctor
        Route::resource('/doctor-regis', 'DoctorRegisController');
        //quiz
        Route::resource('/quiz-regis', 'QuizController');
        Route::get('/quiz-regis/view/{id}', 'QuizController@view');
        Route::get('/quiz-regis/downloadPDF/{id}','QuizController@downloadPDF');
        // purchase products
        Route::resource('/purchase-master', 'PurchaseMasterController');
        Route::post('/purchase-master-supplier-product-del', 'PurchaseMasterController@productDel')->name('supplier-product-del');
        Route::get('/purchase-master/view/{id}', 'PurchaseMasterController@view');
        Route::get('/purchase-master/downloadPDF/{id}','PurchaseMasterController@downloadPDF');
        Route::get('/getproductcostprice','PurchaseMasterController@getCost');
        // purchase return
        Route::resource('/purchase-return', 'PurchaseReturnController');
        Route::post('/purchase-product-return-del', 'PurchaseReturnController@productDel')->name('purchase-return-del');
        Route::get('/purchase-return/view/{id}', 'PurchaseReturnController@view');
        Route::get('/purchase-return/downloadPDF/{id}','PurchaseReturnController@downloadPDF');
        //sales
        Route::resource('/sale-master', 'SaleMasterController');
        Route::post('/sale-master-product-del', 'SaleMasterController@productDel')->name('sale-product-del');
        Route::get('/sale-master/view/{id}', 'SaleMasterController@view');
        Route::get('/sale-master/downloadPDF/{id}','SaleMasterController@downloadPDF');
        Route::get('/getproductsaleprice','SaleMasterController@getCost');
        //sales retrun
        Route::resource('/sale-return', 'SaleReturnController');
        Route::post('/sale-return-product-del', 'SaleReturnController@productDel')->name('sale-return-product-del');
        Route::get('/sale-return/view/{id}', 'SaleReturnController@view');
        Route::get('/sale-return/downloadPDF/{id}','SaleReturnController@downloadPDF');
        Route::get('/getproductsalereturnprice/{id}','SaleReturnController@getCost')->name('get-product-cost');
        //product report
        Route::resource('/prduct-report', 'ProductReportController');
        Route::get('/prduct-report/getData/{from}/{to}', 'ProductReportController@getData')->name('report-data');
        //vouchers entries
        Route::resource('/cash-receipt', 'CashReceiptController');
        Route::get('/cash-receipt/view/{id}', 'CashReceiptController@view');
        Route::get('/cash-receipt/downloadPDF/{id}','CashReceiptController@downloadPDF');
        //cash payment
        Route::resource('/cash-payment', 'CashPaymentController');
        Route::get('/cash-payment/view/{id}', 'CashPaymentController@view');
        Route::get('/cash-payment/downloadPDF/{id}','CashPaymentController@downloadPDF');
        //bank receipt
        Route::resource('/bank-receipt', 'BankReceiptController');
        Route::get('/bank-receipt/view/{id}', 'BankReceiptController@view');
        Route::get('/bank-receipt/downloadPDF/{id}','BankReceiptController@downloadPDF');
        //bank payment
        Route::resource('/bank-payment', 'BankPaymentController');
        Route::get('/bank-payment/view/{id}', 'BankPaymentController@view');
        Route::get('/bank-payment/downloadPDF/{id}','BankPaymentController@downloadPDF');
        //journal receipt & payment
//        Route::resource('/journal-vouchers', 'GeneralReceiptPaymentController');
//        Route::get('/journal-vouchers/view/{id}', 'GeneralReceiptPaymentController@view');
//        Route::get('/journal-vouchers/downloadPDF/{id}','GeneralReceiptPaymentController@downloadPDF');
        //journal receipt & payment
        Route::resource('/journal-vouchers', 'JournalVouchersController');
        Route::get('/journal-vouchers/view/{id}', 'JournalVouchersController@view');
        Route::get('/journal-vouchers/downloadPDF/{id}','JournalVouchersController@downloadPDF');
        //bank register
        Route::resource('/bank-register', 'BankRegisterController');
        //product report
        Route::get('/ledger-report', 'LedgerReportController@index');
        Route::get('/ledger-report/getData/', 'LedgerReportController@getData')->name('lgr-rprt-data');

        Route::get('/distributer/orders', 'DistributerOrderBookController@adminindex')->name('admin.orders.all');
        Route::get('/distributer/orders/view/{id?}', 'DistributerOrderBookController@view')->name('admin.orders.view');
        Route::get('/distributer/orders/download/{id}', 'DistributerOrderBookController@downloadPDF')->name('admin.orders.download');
        Route::get('/distributer/orders/deliver/{id}', 'DistributerOrderBookController@deliverOrder')->name('admin.orders.deliver');

        Route::get('/distributer/deposits', 'DistributerDepositAmountController@adminindex')->name('admin.distributers.deposits');
        Route::get('/distributer/deposits/{id}/approve', 'DistributerDepositAmountController@approveAmount')->name('admin.distributers.deposits.approve');
    });

});



Route::group(['middleware'=>['auth:distributer']], function(){
    Route::prefix('dashboard')->group(function(){

        Route::resource('/distributer-order-book', 'DistributerOrderBookController');
        Route::post('/distributer-order-book-item-del', 'DistributerOrderBookController@productDel')->name('dis-odr-del');
        Route::resource('/distributer-sale-orders', 'DistributerSalesOrderController');
        Route::get('/distributer-sale-orders/view/{id?}', 'DistributerSalesOrderController@show')->name('distributer-sale-orders.view');
        Route::post('/distributer-sale-orders-item-del', 'DistributerSalesOrderController@productDel')->name('dis-salesodr-del');                       
        Route::resource('/distributer-deposit-amount', 'DistributerDepositAmountController');

    });

});


Route::group(['prefix' => 'employee', 'middleware'=>['auth:employee']], function() {
    Route::get('/home', 'EmployeeController@index')->name('employee.home');
    Route::resource('/clinical-activity-form', 'ClinicalActivityFormController');
    Route::resource('/clinical-request-form', 'ClinicalRequestFormController');
});


Route::prefix('distributer')->group(function() {
    Route::get('/login', 'Auth\DistributerLoginController@showLoginForm')->name('distributer.login');
    Route::post('/login', 'Auth\DistributerLoginController@login')->name('distributer.login.submit');
    Route::get('/home', 'DistributerController@index')->name('distributer.home');
});
Route::prefix('employee')->group(function() {
    Route::get('/login', 'Auth\EmployeeLoginController@showLoginForm')->name('employee.login');
    Route::post('/login', 'Auth\EmployeeLoginController@login')->name('employee.login.submit');
});



Route::get('/user-management',function(){
    return view('dashboard.new');
})->middleware('auth');

Route::get('/sales-summery',function(){
    return view('dashboard.new');
})->middleware('auth');

Route::get('/staff-summary',function(){
    return view('dashboard.new');
})->middleware('auth');

Route::get('/purchase-summery',function(){
    return view('dashboard.new');
})->middleware('auth');

Route::get('/gift-issurance-to-doctor',function(){
    return view('dashboard.new');
})->middleware('auth');

Route::get('/sales-targets-management',function(){
    return view('dashboard.new');
})->middleware('auth');

Route::get('/po-generation',function(){
    return view('dashboard.new');
})->middleware('auth');

Route::get('/sales-entries',function(){
    return view('dashboard.new');
})->middleware('auth');

Route::get('/stock-summery',function(){
    return view('dashboard.new');
})->middleware('auth');

Route::get('/accounts-summery',function(){
    return view('dashboard.new');
})->middleware('auth');

Route::get('/new',function(){
    return view('dashboard.new');
})->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/seed',function(){
    \App\User::create([
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'password' => bcrypt('12345678')
    ]);


});

Route::get('/migrate',function (){
    Artisan::call('migrate');
    echo "<pre>";
    echo Artisan::Output();
    exit;
});;
Route::get('/migrate:rollback',function (){
    Artisan::call('migrate:rollback');
    echo "<pre>";
    echo Artisan::Output();
    exit;
});;
Route::get('/migrate:fresh',function (){
    Artisan::call('migrate:fresh');
    echo "<pre>";
    echo Artisan::Output();
    exit;
});;

Route::get('log/{cmd?}',function($cmd=null){
	$file = storage_path ('logs/laravel-'.date('Y-m-d').'.log');
	switch($cmd){
		case 'd':
			if(file_exists($file))
				file_put_contents($file,'');
			else
				return "Log File not Found";
		default:
            if (!file_exists($file)){
                return "Log file not found";
            }
		break;
	}
	echo "<pre>";
	echo file_get_contents($file);
});

Route::get('/schedule:make', function(){
    Artisan::call('schedule:make');
    echo "<pre>";
    echo Artisan::Output();
});