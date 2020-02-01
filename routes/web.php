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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => ['role:administrator','auth']], function () {

  Route::resource('admin/permission', 'Admin\\PermissionController');
  Route::resource('admin/role', 'Admin\\RoleController');
  Route::resource('admin/user', 'Admin\\UserController');
  Route::resource('admin/periode', 'Admin\\PeriodeController');
  Route::post('admin/periode', 'Admin\\PeriodeController@statusPeriode');
  Route::resource('admin/postingan', 'Admin\\PostinganController');
  Route::get('admin/dosen','Admin\\UserController@userdosen');
  Route::resource('admin/topik-bimbinganakademik', 'Admin\\TopikController');
});

Route::group(['middleware'=>['role:mahasiswa','auth']],function(){
  Route::get('krs', 'KrsController@krs');
  Route::get('cetak-krs', 'KrsController@cetakkrs');
  Route::get('cetak-uts', 'KrsController@cetakuts');
  Route::get('cetak-uas', 'KrsController@cetakuas');
  Route::get('proses-krs', 'KrsController@prosesKrs');
  Route::get('input-krs', 'KrsController@inputKrs');
  Route::get('preview-krs', 'KrsController@previewKrs');
  Route::get('khs', 'KrsController@khs');
  Route::get('cetak-khs/{idsemester}', 'KrsController@cetakkhs');
  Route::get('transkrip', 'KrsController@transkrip');
  Route::get('cetak-transkrip', 'KrsController@cetakTranskrip');
  Route::get('infomatkul', 'KrsController@infomatkul');
  Route::get('detilmatkul/{kelasid}', 'KrsController@detilmatkul');
});

Route::group(['middleware'=>['role:dosen','auth']],function(){
  Route::get('bimbingan-akademik', 'BimbinganController@bimbinganmahasiswa');
  Route::get('bimbingan-dokumen/{nim}', 'BimbinganController@bimbingandokumen');
  Route::get('bimbingan-chat/{nim}', 'BimbinganController@cetakChat');
  Route::get('lihat-dokumen/{dokumenId}', 'BimbinganController@lihatdokumen');
  Route::get('print-dokumen/{nim}/{id}', 'BimbinganController@printDokumen');
  Route::get('print-transkrip/{nim}', 'BimbinganController@printTranskrip');
});


Route::group(['middleware'=>['auth']],function(){
  Route::get('/changePassword','ProfileController@showChangePasswordForm');
  Route::post('/changePassword','ProfileController@changePassword')->name('changePassword');
  Route::get('posting/{id}', 'PostinganController@show');
  Route::get('profile', 'ProfileController@profile');
  Route::post('profile', 'ProfileController@update_avatar');
  Route::post('signature', 'ProfileController@updateSignature');

  Route::get('chatting', 'ChattingController@chatting');
  Route::get('grupchat', 'ChattingController@grup');

  Route::get('/messages', 'ChattingController@fetchMessages');
  Route::post('/messages', 'ChattingController@sendMessage');

  Route::get('/contact', 'ChattingController@getDosen');
  Route::get('/topik', 'ChattingController@topikChatting');
  Route::get('/contacts', 'ChattingController@get');
  Route::get('/conversation/{id}', 'ChattingController@getMessagesFor');
  Route::post('/conversation/send/{id?}', 'ChattingController@send');

});

