<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});




Route::get('/dashboard', function () {
    return view('home');
});






Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout');
//Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Auth::routes(['verify' => true]);

//register

Route::post('/verifiId', [App\Http\Controllers\userentryController::class, 'verifiId']);






Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/userentry', function () {
    return view('userentry');
})->middleware('auth');

//Route::post('/adduserentry',[App\Http\Controllers\productsController::class, 'store']);


Route::post('/adduserentry', [App\Http\Controllers\userentryController::class, 'createuser']);

Route::get('/userlistview', function () {
    return view('userlistview');
})->middleware('auth');


//import student id

Route::get('/importstudentid', function () {
    return view('importstudentid');
})->middleware('auth');

Route::post('/import', [App\Http\Controllers\ImportidbyExcelController::class, 'import'])->name('import');
Route::post('/importstudentid', [App\Http\Controllers\ImportidbyExcelController::class, 'importstudentid'])->name('getstudentid');







// display for user all data route
Route::post('/userlistview', [App\Http\Controllers\userentryController::class, 'getuserdata'])->name('usertabledatafetch');
//for user data edit route
Route::post('/editform', [App\Http\Controllers\userentryController::class, 'updateuserdata']);
//for delete data route 
Route::post('/deleteUserRoute', [App\Http\Controllers\userentryController::class, 'userdatadelete']);

Route::get('/hallnameentry', function () {
    return view('hallnameentry');
})->middleware('auth');

Route::post('/hallnameentry', [App\Http\Controllers\hallnameentryConttroller::class, 'createhallname']);
//for view showhall.blade.php


Route::get('/viewhallname', function () {
    return view('viewhallname');
})->middleware('auth');

Route::post('/viewhallname', [App\Http\Controllers\hallnameentryConttroller::class, 'viewhallname'])->name('viewhallname');


//update hallname  table

Route::post('/edithallname', [App\Http\Controllers\hallnameentryConttroller::class, 'hallnameupdate']);

Route::post('/deletehallnameRoute', [App\Http\Controllers\hallnameentryConttroller::class, 'deletehallnametabledata']);




Route::get('/viewhall', function () {
    return view('showhall');
})->middleware('auth');

//for pass data from hallname table to showhall page
Route::get('/viewhall', [App\Http\Controllers\showhallController::class, 'showhallname']);

//for get table data through the route  name(getroomlist)
Route::post('/viewhall', [App\Http\Controllers\showhallController::class, 'hallandroomdata'])->name('getroomlist');
//view for createroom.blade.php
Route::get('/createroom', function () {
    return view('createroom');
})->middleware('auth');
//get data from hallname table
Route::get('/createroom', [App\Http\Controllers\createaandshowController::class, 'getdataformhallnametable']);

Route::post('/roomentry', [App\Http\Controllers\createaandshowController::class, 'createroom']);

Route::get('/viewroom', function () {
    return view('viewroomdetails');
})->middleware('auth');

Route::post('/viewroom', [App\Http\Controllers\createaandshowController::class, 'getroomdata'])->name('getdatafromroom');

//for room table edit 
Route::post('/roomformedit', [App\Http\Controllers\createaandshowController::class, 'editroomform']);
//delete room data
Route::post('/deleteroomnameRoute', [App\Http\Controllers\createaandshowController::class, 'deleteroomform']);


//get data for select values
//Route::get('/viewroom', [App\Http\Controllers\createaandshowController::class, 'getdataforselectvalue']);


Route::post('/gethallnameandid', [App\Http\Controllers\createaandshowController::class, 'getDepartmentList']);

//employeee
Route::get('/addnewemployee', function () {
    return view('addnewemployee');

})->middleware('auth');

//get for selectdata from users table  
Route::get('/addnewemployee', [App\Http\Controllers\EmployeeController::class, 'getuserdataforselecttoemployee']);
//Route::get('/addnewemployee', [App\Http\Controllers\employeeController::class, 'gethallnameforemployee']);

//get data select the username
Route::post('/getofthesnameofuser', [App\Http\Controllers\EmployeeController::class, 'getothesnameofuser']);
Route::post('/employeeentry', [App\Http\Controllers\EmployeeController::class, 'employeeentry']);

Route::get('/Employeelist', function () {
    return view('Employeelist');

})->middleware('auth');

Route::post('/Employeelist', [App\Http\Controllers\EmployeeController::class, 'getemployeelist'])->name('employeelist');

//gethallname for select value
Route::post('/gethallname', [App\Http\Controllers\EmployeeController::class, 'gethallname']);


//for employee form edit  
Route::post('/employeeformedit', [App\Http\Controllers\EmployeeController::class, 'employeeformedit']);
//employee delete data 
Route::post('/deleteemployeetabledatasRoute', [App\Http\Controllers\EmployeeController::class, 'deleteemployeetabledatasRoute']);
//view salary.blade.php
Route::get('/salary', function () {
    return view('addsalary');

})->middleware('auth');
//for selectvalue from users table
Route::get('/salary', [App\Http\Controllers\salaryController::class, 'getdataforsalraycarete']);
//get input  data
Route::post('/getinputdataforsalary', [App\Http\Controllers\salaryController::class, 'getinputdataforsalary']);
//get specific name from employee table where exist this hall name
Route::post('/getspecifichallname', [App\Http\Controllers\salaryController::class, 'getspecifichallname']);
//route for salary entry 
Route::post('/salaryentry', [App\Http\Controllers\salaryController::class, 'salaryentry']);

Route::get('/salaryview', function () {
    return view('salaryview');

})->middleware('auth');

//get salary list
Route::post('/salaryview', [App\Http\Controllers\salaryController::class, 'viewsalarylist'])->name('viewsalarylist');

Route::post('/salaryedit', [App\Http\Controllers\salaryController::class, 'salaryedit']);
//delete salary data Route
Route::post('/deletesalarydataRoute', [App\Http\Controllers\salaryController::class, 'deletesalarydata']);

Route::get('/admission', function () {
    return view('studentapplication');

})->middleware('auth');



Route::post('/studetntidnumber', [App\Http\Controllers\StudentApplicationController::class, 'studetntidnumber']);



Route::post('/hallnameid', [App\Http\Controllers\StudentApplicationController::class, 'hallnameid']);










//get sutdent id
Route::get('/admission', [App\Http\Controllers\StudentApplicationController::class, 'getstudentid'])->middleware('auth');

//get input value from user table
Route::post('/getinputdataforstudentapplication', [App\Http\Controllers\StudentApplicationController::class, 'getinputdataforstudentapplication']);


//data insert into appliication  table 
Route::post('/addstudentapplication', [App\Http\Controllers\StudentApplicationController::class, 'addstudentapplication']);



Route::get('/viewstudentlist&request', function () {
    return view('viewstudentlist&request');

})->middleware('auth');


Route::post('/viewstudentlist&request', [App\Http\Controllers\StudentApplicationController::class, 'getstudentlistrequest'])->name('getstudentlist&request');

Route::post('/acceptapplicationRequestRoute', [App\Http\Controllers\StudentApplicationController::class, 'acceptapplicationRequest']);



Route::post('/cancelapplicationRequestRoute', [App\Http\Controllers\StudentApplicationController::class, 'cancelapplicationRequestRequest']);






// get to new post count
Route::post('/getMyNewPostCountRoute', [App\Http\Controllers\StudentApplicationController::class, 'getMyNewPostCount']);

Route::get('/checknotificationview', function () {
    return view('checknotificationview');

})->middleware('auth');

Route::post('/applicationacceptdata', [App\Http\Controllers\StudentApplicationController::class, 'applicationacceptdata']);

// update seen vallue when click on bell button  
Route::post('/updateseen', [App\Http\Controllers\StudentApplicationController::class, 'updateseen']);
//view food list
Route::get('/viewfoodlist', function () {
    return view('viewfoodlist');
})->middleware('auth');


Route::get('/foodlistentry', function () {
    return view('foodlistentry');
})->middleware('auth');

Route::post('/addfoodlistentry', [App\Http\Controllers\FoodlistController::class, 'addfoodlistentry']);

Route::get('/mealentry', function () {
    return view('mealentry');
})->middleware('auth');

//get for select value
Route::get('/mealentry', [App\Http\Controllers\mealController::class, 'getfoodlistdata']);


//just for check Bkash start
Route::get('/bkashpayment', function () {
    return view('bkashpayment');
})->middleware('auth');

Route::post('/token', [App\Http\Controllers\BkashController::class, 'token'])->name('token');

Route::get('/createpayment', [App\Http\Controllers\BkashController::class, 'createpayment'])->name('createpayment');
Route::get('/executepayment', [App\Http\Controllers\BkashController::class, 'executepayment'])->name('executepayment');


Route::get('/pendingrequest', function () {
    return view('pendingrequestlist');
})->middleware('auth');


Route::post('/pendingrequest', [App\Http\Controllers\StudentApplicationController::class, 'getpendingrequestlist'])->name('pendingrequestlist');

Route::post('/showrequestandpendlist', [App\Http\Controllers\StudentApplicationController::class, 'showpendingandrequestlist']);


Route::get('/generatebill', function () {
    return view('generatebill');
})->middleware('auth');



Route::post('/billgenerate', [App\Http\Controllers\paymentController::class, 'billgenerate']);


Route::get('/roompayment', function () {
    return view('roompaymentlist');
})->middleware('auth');

Route::get('/roompayment', [App\Http\Controllers\paymentController::class, 'getpaymentlist']);


Route::get('/view/{id}', [App\Http\Controllers\paymentController::class, 'viewpayment']);

Route::post('/stu_id', [App\Http\Controllers\paymentController::class, 'studentid']);



Route::get('/studentbill', function () {
    return view('studentbill');
})->middleware('auth');



Route::post('/studentbill', [App\Http\Controllers\studentbillController::class, 'studentbill'])->name('studentbill');


Route::get('/paidbill', function () {
    return view('paidbill');
})->middleware('auth');



Route::post('/paidbill', [App\Http\Controllers\studentbillController::class, 'paidbill'])->name('studentbill');


Route::get('/currentmonthbill', function () {
    return view('currentmonthbill');
})->middleware('auth');



Route::post('/currentmonthbill', [App\Http\Controllers\studentbillController::class, 'currentmonthdbill'])->name('studentbill');


Route::get('/unpaidbill', function () {
    return view('unpaidbill');
})->middleware('auth');


Route::post('/unpaidbill', [App\Http\Controllers\studentbillController::class, 'unpaidbill'])->name('unpaidbill');


Route::post('/editstudentbill', [App\Http\Controllers\studentbillController::class, 'editstudentbill']);

Route::post('/deletestudentbillRoute', [App\Http\Controllers\studentbillController::class, 'deletestudentbillRoute']);



Route::get('/admissionformpaymentfail', function () {
    return view('admissionformpaymentfail');
})->middleware('auth');




Route::post('/admissionformpaymentfail', [App\Http\Controllers\StudentApplicationController::class, 'admissionformpaymentfail'])->name('admissionformpaymentfail');

Route::post('/deleteaddmisionpaymentfail', [App\Http\Controllers\StudentApplicationController::class, 'deleteaddmisionpaymentfail']);

Route::get('/studentdeposit', function () {
    return view('studentdeposit');
})->middleware('auth');

Route::post('/studentdeposit', [App\Http\Controllers\studentbillController::class, 'studentdeposit'])->name('studentdeposit');


//highchart
Route::post('/highchart', [App\Http\Controllers\DashboardController::class, 'highchart']);

Route::get('/leaveroom', function () {
    return view('leaveroom');
})->middleware('auth');


Route::post('/leaveroom', [App\Http\Controllers\StudentApplicationController::class, 'leaveroomforstudent'])->name('leaveroomforstudent');


Route::post('/inactiveeditforstudent', [App\Http\Controllers\StudentApplicationController::class, 'inactiveeditforstudent']);

Route::post('/dashborard', [App\Http\Controllers\DashboardController::class, 'dashborard']);


Route::get('/costentry', function () {
    return view('costentry');
})->middleware('auth');



Route::post('/costentry', [App\Http\Controllers\costController::class, 'costentry']);


Route::get('/costentry', [App\Http\Controllers\costController::class, 'gethallname'])->middleware('auth');




Route::get('/costview', function () {
    return view('costview');
})->middleware('auth');

Route::post('/costview', [App\Http\Controllers\costController::class, 'getcostlistdata'])->name('getcostlistdata');


Route::post('/gethallnameandidfromhallnametable', [App\Http\Controllers\costController::class, 'gethallnameandidfromhallnametable']);

Route::post('/costedit', [App\Http\Controllers\costController::class, 'costedit']);

Route::post('/deletecostrowRoute', [App\Http\Controllers\costController::class, 'deletecostrow']);


Route::get('/addattendance', function () {
    return view('addatendance');
})->middleware('auth');


Route::post('/attendance', [App\Http\Controllers\addattendanceController::class, 'addattendance']);


Route::post('/addattendance', [App\Http\Controllers\addattendanceController::class, 'getdatafromattendance'])->name('getdatafromattendance');


Route::post('/updateAttendanceStatusRoute', [App\Http\Controllers\addattendanceController::class, 'updateattendance']);



Route::post('/getdatetochangedate', [App\Http\Controllers\addattendanceController::class, 'getdatetochangedate']);


Route::post('/changedateform', [App\Http\Controllers\addattendanceController::class, 'changedate']);



Route::get('/addattendancereport', function () {
    return view('addattendancereport');
})->middleware('auth');




Route::post('/addattendancereport', [App\Http\Controllers\addattendanceController::class, 'addattendancereport'])->name('getdatafromattendance');



Route::get('/addattendancereportstudents', function () {
    return view('addattendancereportstudents');
})->middleware('auth');


Route::post('/addattendancereportstudents', [App\Http\Controllers\addattendanceController::class, 'studentaddattendancereport'])->name('getdatafromattendance');


Route::get('/foodlistentry', function () {
    return view('foodlistentry');
})->middleware('auth');


Route::post('/foodlistentry', [App\Http\Controllers\FoodlistController::class, 'foodlistentry']);




Route::get('/maketodayfoodlist', function () {
    return view('maketodayfoodlist');
})->middleware('auth');

Route::post('/getfoodlist', [App\Http\Controllers\FoodlistController::class, 'getfoodlist']);


Route::post('/foodlistentryperday', [App\Http\Controllers\FoodlistController::class, 'foodlistentryperday']);




Route::post('/maketodayfoodlist', [App\Http\Controllers\FoodlistController::class, 'getfooditesam'])->name('getfooditesam');


Route::post('/updatefoodstatusRoute', [App\Http\Controllers\FoodlistController::class, 'updatefoodstatusRoute']);


Route::post('/deletetodaymenulistRoute', [App\Http\Controllers\FoodlistController::class, 'deletetodaymenulistRoute']);



Route::get('/viewtodayfoodlist', function () {
    return view('viewtodayfoodlist');
})->middleware('auth');


Route::post('/viewtodayfoodlist', [App\Http\Controllers\FoodlistController::class, 'getfoodilisttime'])->name('getfoodilisttime');


Route::get('/takebill', function () {
    return view('takebill');
})->middleware('auth');


Route::post('/getfoodlistperday', [App\Http\Controllers\FoodlistController::class, 'getfoodlistperday']);

Route::post('/getuserid', [App\Http\Controllers\FoodlistController::class, 'getuserid']);


Route::post('/foodmenutentryperday', [App\Http\Controllers\FoodlistController::class, 'foodmenutentryperday']);

Route::post('/getprice', [App\Http\Controllers\FoodlistController::class, 'getprice']);

Route::post('/takebill', [App\Http\Controllers\FoodlistController::class, 'getbilllist'])->name('getbilllist');
Route::post('/getfoodlistasperuser', [App\Http\Controllers\FoodlistController::class, 'getfoodlistasperuser']);

Route::post('/foodlistentrytableinsert', [App\Http\Controllers\FoodlistController::class, 'foodlistentry']);


//Route::get('/takebill', [App\Http\Controllers\FoodlistController::class, 'getfoodlistasperuser']);

Route::post('/deletemakebill', [App\Http\Controllers\FoodlistController::class, 'deletemakebill']);



Route::post('/foodlistentry', [App\Http\Controllers\FoodlistController::class, 'getfoodlistentry'])->name('getfoodlistentry');


Route::post('/foodlistdelete', [App\Http\Controllers\FoodlistController::class, 'foodlistdelete']);

Route::post('/getfpricer', [App\Http\Controllers\FoodlistController::class, 'getfpricer']);


Route::post('/foodlistedit', [App\Http\Controllers\FoodlistController::class, 'foodlistedit']);




Route::get('/profile', function () {
    return view('profile');
   })->middleware('auth');
   
   



   Route::post('/getprofiledata', [App\Http\Controllers\profileController::class, 'getprofiledata']);


   
   Route::post('/updateprofile', [App\Http\Controllers\profileController::class, 'updateprofile']);


   
   Route::post('/studentpayment', [App\Http\Controllers\postmanPaymentController::class, 'getpaymentdata'])->name('getpaymentdata');


   Route::post('/gethallnameanddid', [App\Http\Controllers\postmanPaymentController::class, 'gethallnameanddid']);
   

   
   Route::post('/updateimportinformation', [App\Http\Controllers\ImportidbyExcelController::class, 'updateimportinformation']);


   Route::post('/deletestudentinformationnameRoute', [App\Http\Controllers\ImportidbyExcelController::class, 'deletestudentinformationnameRoute']);


   Route::post('/importidsingle', [App\Http\Controllers\ImportidbyExcelController::class, 'importidsingle']);

   


Route::get('/contract', function () {
    return view('contract');
});
  




Route::get('/importsingleid', function () {
  return view('importsingleid');
})->middleware('auth');



Route::get('/studentpayment', function () {
    return view('postmanpayment');
  })->middleware('auth');
  
  


Route::post('/pay', [App\Http\Controllers\postmanPaymentController::class, 'payment']);


Route::get('/paymentsuccess/{id}', [App\Http\Controllers\postmanPaymentController::class, 'successpayment']);

Route::get('/paymentfail/{id}', [App\Http\Controllers\postmanPaymentController::class, 'paymentfail']);





