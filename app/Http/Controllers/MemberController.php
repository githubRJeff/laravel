<?php
namespace App\Http\Controllers;
use App\Member;
class MemberController extends Controller{
	public function info(){
		echo "This is info<br/>";
		return route('memberinfo');
	}
	public function getId($id){
		return 'The id is ' . $id;
	}
	public function memberInfo(){
		return view('member-info');
	}

	//注意如果有变量，则模板名应该是member/info.blade.php
	public function bladeInfo(){
	    echo Member::getMember();
		return view('member/info',[
			'name' => 'blackrun',
			'age' => 22,
		]);
	}
}