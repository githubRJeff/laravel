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
    return view('welcome');
});

//基础路由

//相应get请求
// Route::get('/hello',function(){
// 	return 'Hello,this is test';
// });
//相应post请求
// Route::post('/hello2',function(){
// 	return 'Hello,this is test';
// });


//多请求路由

//相应指定请求
// Route::match(['get','post'],'multi',function(){
// 	return 'This is multi request';
// });
// 相应所有请求
// Route::any('any',function(){
// 	return 'This is any request';
// });

//路由参数
// Route::get('user/{id}',function($id){
// 	return 'The id is '.$id;
// });
//?表示可为空
// Route::get('user/{name?}',function($name=null){
// 	return 'The username is '.$name;
// });
//正则匹配
// Route::get('user/{name?}',function($name=null){
// 	return 'The username is '.$name;
// })->where('name','[A-Za-z]+');
//多个参数多个匹配规则
// Route::get('user/{id}/{name?}',function($id,$name=null){
// 	return 'The id is' . $id . ' The username is '.$name;
// })->where(['id'=>'[0-9]+','name'=>'[A-Za-z]+']);
//路由别名
// Route::get('user/center',['as'=>'centers',function(){
// 	return route('centers');
// }]);
// Route::prefix('member')->group(function(){
// 	Route::get('user/center',['as'=>'centers',function(){
// 		return 'member center';
// 	}]);
// 	Route::any('any',function(){
// 		return 'This is member 	any request';
// 	});
// });
// Route::get('member/info','MemberController@info');
// Route::any('member/info',['uses'=>'MemberController@info']);
Route::any('member/info',[
	'uses' => 'MemberController@info',
	'as' => 'memberinfo'
]);
Route::get('member/{id}',[
	'uses' => 'MemberController@getId',
])->where('id','[0-9]+');
Route::any('member/memberInfo',[
	'uses' => 'MemberController@memberInfo',
	'as' => 'memberinfo'
]);
Route::any('member/bladeInfo',[
	'uses' => 'MemberController@bladeInfo',
	'as' => 'bladeinfo'
]);
Route::any('test1','StudentController@test1');
Route::any('insert1','StudentController@insert1');
Route::any('query1','StudentController@query1');
Route::any('update1','StudentController@update1');
Route::any('delete1','StudentController@delete1');
Route::any('group1','StudentController@group1');
Route::any('orm1','StudentController@orm1');
Route::any('ormInsert','StudentController@ormInsert');
Route::any('ormUpdate','StudentController@ormUpdate');
Route::any('ormDelete','StudentController@ormDelete');
Route::any('section1',['uses'=>'StudentController@section1']);
Route::any('student/request1','StudentController@request1');
Route::group(['middleware'=>['web']],function (){
    Route::any('session1','StudentController@session1');
    Route::any('session2',[
        'as' =>'session2',
        'uses'=>'StudentController@session2',
    ]);
});
Route::any('response','StudentController@response');
Route::any('activity0','StudentController@activity0');
Route::group(['middleware'=>['activity']],function(){
	Route::any('activity1','StudentController@activity1');
	Route::any('activity2','StudentController@activity2');

});
