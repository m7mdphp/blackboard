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


Route::get('blogs', function () {
    return view('welcome');
});
*/
 // role
	Route::group(['prefix'=>'student'],function(){
	Config::set('auth.definse', 'student'); 
	Route::get('login', 'Student@login');
	Route::post('login', 'Student@dologin')->name('student.login');
	Route::get('password/email', 'Student@passwordEmailForm')->name('student.password.email');
	Route::post('password/email', 'Student@passwordEmail');
	Route::get('password/reset/{token?}', 'Student@passwordResetForm')->name('student.password.reset');
	Route::post('password/reset', 'Student@passwordReset');

	Route::group(['middleware'=>'student:student'],function(){
	Route::get('/', function(){return view('student.index');})->name('student.index');
	Route::get('index', function(){return view('student.index');})->name('student.home');
	Route::get('logout', 'Student@logout')->name('student.logout');
	Route::get('profile', 'Student@profileForm')->name('student.profile');
    Route::patch('profile', 'Student@profile');
	Route::get('password/change', 'Student@passwordChangeForm')->name('student.password.change');
    Route::patch('password/change', 'Student@passwordChange');
	});

	Route::group(['prefix'=>'messages'],function(){
	Config::set('auth.definse', 'student'); 
	Route::group(['middleware'=>'student:student'],function(){
	Route::get('/', 'MessageController@index_student')->name('messages_student');
    Route::get('datatable', 'MessageController@indexDatatableStudent')->name('messages.datatable.student');
    Route::get('/send', 'MessageController@sendStudent')->name('send_messages_student');
    Route::get('send_datatable', 'MessageController@sendDatatableStudent')->name('send.datatable.student');
	});
	});
	Route::group(['prefix'=>'researches'],function(){
	Config::set('auth.definse', 'student'); 
	Route::group(['middleware'=>'student:student'],function(){
	Route::get('/', 'ResearchController@index')->name('researches_student');
    Route::get('datatable', 'ResearchController@indexDatatable')->name('researches.datatable');
    Route::get('add', 'ResearchController@addModal')->name('researches.add');
    Route::post('add', 'ResearchController@add');
    Route::get('edit/{id}', 'ResearchController@editModal')->name('researches.edit');
    Route::patch('edit/{id}', 'ResearchController@edit');
    Route::get('delete/{id}', 'ResearchController@deleteModal')->name('researches.delete');
    Route::delete('delete/{id}', 'ResearchController@delete');
	});
	});
	Route::group(['prefix'=>'phds'],function(){
	Config::set('auth.definse', 'student'); 
	Route::group(['middleware'=>'student:student'],function(){
	Route::get('/', 'PhdController@index')->name('phds_student');
    Route::get('datatable', 'PhdController@indexDatatable')->name('phds.datatable');
    Route::get('add', 'PhdController@addModal')->name('phds.add');
    Route::post('add', 'PhdController@add');
    Route::get('edit/{id}', 'PhdController@editModal')->name('phds.edit');
    Route::patch('edit/{id}', 'PhdController@edit');
    Route::get('delete/{id}', 'PhdController@deleteModal')->name('phds.delete');
    Route::delete('delete/{id}', 'PhdController@delete');
	});
	});
	Route::group(['prefix'=>'orders'],function(){
	Config::set('auth.definse', 'student'); 
	Route::group(['middleware'=>'student:student'],function(){
	Route::get('/', 'OrderController@index')->name('orders');
    Route::get('datatable', 'OrderController@indexDatatable')->name('orders.datatable');
    Route::get('add', 'OrderController@addModal')->name('orders.add');
    Route::post('add', 'OrderController@add');
    Route::get('edit/{id}', 'OrderController@editModal')->name('orders.edit');
    Route::patch('edit/{id}', 'OrderController@edit');
    Route::get('delete/{id}', 'OrderController@deleteModal')->name('orders.delete');
    Route::delete('delete/{id}', 'OrderController@delete');
    Route::post('ajax-select', 'OrderController@selectAjax');
    Route::get('ajax-select', 'OrderController@selectAjax')->name('orders.ajax-select');
    Route::post('ajax-select2', 'OrderController@selectAjax2');
    Route::get('ajax-select2', 'OrderController@selectAjax2')->name('orders.ajax-select2');
	});
	});

	});
	Route::group(['prefix'=>'teacher'],function(){
	Config::set('auth.definse', 'teacher'); 
	Route::get('login', 'Teacher@login');
	Route::post('login', 'Teacher@dologin')->name('teacher.login');
	Route::get('password/email', 'Teacher@passwordEmailForm')->name('teacher.password.email');
	Route::post('password/email', 'Teacher@passwordEmail');
	Route::get('password/reset/{token?}', 'Teacher@passwordResetForm')->name('teacher.password.reset');
	Route::post('password/reset', 'Teacher@passwordReset');
	Route::group(['middleware'=>'teacher:teacher'],function(){
	Route::get('/', function(){return view('teacher.index');})->name('teacher.index');
	Route::get('index', function(){return view('teacher.index');})->name('teacher.home');
	Route::get('logout', 'Teacher@logout')->name('teacher.logout');
	Route::get('profile', 'Teacher@profileForm')->name('teacher.profile');
    Route::patch('profile', 'Teacher@profile');
	Route::get('password/change', 'Teacher@passwordChangeForm')->name('teacher.password.change');
    Route::patch('password/change', 'Teacher@passwordChange');
	});
	});
	
	
	Route::group(['prefix'=>'center'],function(){
	Config::set('auth.definse', 'center'); 
	Route::get('login', 'Center@login');
	Route::post('login', 'Center@dologin')->name('center.login');
	Route::get('password/email', 'Center@passwordEmailForm')->name('center.password.email');
	Route::post('password/email', 'Center@passwordEmail');
	Route::get('password/reset/{token?}', 'Center@passwordResetForm')->name('center.password.reset');
	Route::post('password/reset', 'Center@passwordReset');
	Route::group(['middleware'=>'center:center'],function(){
	Route::get('/', function(){return view('center.index');})->name('center.index');
	Route::get('index', function(){return view('center.index');})->name('center.home');
	Route::get('logout', 'Center@logout')->name('center.logout');
	Route::get('profile', 'Center@profileForm')->name('center.profile');
    Route::patch('profile', 'Center@profile');
	Route::get('password/change', 'Center@passwordChangeForm')->name('center.password.change');
    Route::patch('password/change', 'Center@passwordChange');
	});
	});
	
	
	Route::group(['prefix'=>'documents'],function(){
	Config::set('auth.definse', 'center'); 
	Route::group(['middleware'=>'center:center'],function(){
	Route::get('/', 'Document@index')->name('documents');
    Route::get('datatable', 'Document@indexDatatable')->name('documents.datatable');
    Route::get('add', 'Document@addModal')->name('documents.add');
    Route::post('add', 'Document@add');
    Route::get('edit/{id}', 'Document@editModal')->name('documents.edit');
    Route::patch('edit/{id}', 'Document@edit');
    Route::get('delete/{id}', 'Document@deleteModal')->name('documents.delete');
    Route::delete('delete/{id}', 'Document@delete');
	});
	});

		Route::group(['prefix'=>'messages'],function(){
	Config::set('auth.definse', 'center'); 
	Route::group(['middleware'=>'center:center'],function(){
	Route::get('/', 'MessageController@index')->name('messages');
    Route::get('datatable', 'MessageController@indexDatatable')->name('messages.datatable');
    Route::get('/send', 'MessageController@send')->name('send_messages');
    Route::get('send_datatable', 'MessageController@sendDatatable')->name('send.datatable');
	});
	});


		Route::group(['middleware' => 'web'], function () {


    Route::get('admins/messages', 'MessageController@admin')->name('messages_admins');
    Route::get('admins/datatable', 'MessageController@adminDatatable')->name('messages.datatable.admin');
    Route::get('admins/send', 'MessageController@sendadmin')->name('send_messages.admin');
    Route::get('admins/send_datatable', 'MessageController@sendDatatableadmin')->name('send.datatable.admin');

    Route::get('admins/nation', 'NationController@index')->name('nations');
    Route::get('admins/datatablenation', 'NationController@indexDatatable')->name('nations.datatable');
    Route::get('admins/addnations', 'NationController@addModal')->name('nations.add');
    Route::post('admins/addnations', 'NationController@add');
    Route::get('admins/editnations/{id}', 'NationController@editModal')->name('nations.edit');
    Route::patch('admins/editnations/{id}', 'NationController@edit');
    Route::get('admins/deletenations/{id}', 'NationController@deleteModal')->name('nations.delete');
    Route::delete('admins/deletenations/{id}', 'NationController@delete');

    Route::get('admins/universty', 'UniverstyController@index')->name('universty');
    Route::get('admins/datatableuniversty', 'UniverstyController@indexDatatable')->name('universty.datatable');
    Route::get('admins/adduniversty', 'UniverstyController@addModal')->name('universty.add');
    Route::post('admins/adduniversty', 'UniverstyController@add');
    Route::get('admins/edituniversty/{id}', 'UniverstyController@editModal')->name('universty.edit');
    Route::patch('admins/edituniversty/{id}', 'UniverstyController@edit');
    Route::get('admins/deleteuniversty/{id}', 'UniverstyController@deleteModal')->name('universty.delete');
    Route::delete('admins/deleteuniversty/{id}', 'UniverstyController@delete');

    Route::get('admins/colleges', 'CollegeController@index')->name('colleges');
    Route::get('admins/datatablecolleges', 'CollegeController@indexDatatable')->name('colleges.datatable');
    Route::get('admins/addcolleges', 'CollegeController@addModal')->name('colleges.add');
    Route::post('admins/addcolleges', 'CollegeController@add');
    Route::get('admins/editcolleges/{id}', 'CollegeController@editModal')->name('colleges.edit');
    Route::patch('admins/editcolleges/{id}', 'CollegeController@edit');
    Route::get('admins/deletecolleges/{id}', 'CollegeController@deleteModal')->name('colleges.delete');
    Route::delete('admins/deletecolleges/{id}', 'CollegeController@delete');
    Route::post('admins/colleges/ajax-select', 'CollegeController@selectAjax');
    Route::get('admins/colleges/ajax-select', 'CollegeController@selectAjax')->name('colleges.ajax-select');

    Route::get('admins/lessons', 'LessonController@index')->name('lessons');
    Route::get('admins/datatablelessons', 'LessonController@indexDatatable')->name('lessons.datatable');
    Route::get('admins/addlessons', 'LessonController@addModal')->name('lessons.add');
    Route::post('admins/addlessons', 'LessonController@add');
    Route::get('admins/editlessons/{id}', 'LessonController@editModal')->name('lessons.edit');
    Route::patch('admins/editlessons/{id}', 'LessonController@edit');
    Route::get('admins/deletelessons/{id}', 'LessonController@deleteModal')->name('lessons.delete');
    Route::delete('admins/deletelessons/{id}', 'LessonController@delete');
});
		    Route::get('/',function() {
    return view('welcome');
});