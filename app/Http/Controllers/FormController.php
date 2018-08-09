<?php
namespace App\Http\Controllers;
use App\Form;

use App\Student;
use Illuminate\Http\Request;
use Validator;

class FormController extends Controller{
    public function index(){
        $student = Form::paginate(10);
        return view('form/index',[
            'students'=>$student
        ]);
    }
    public function create(Request $request){
        $student = new Form();
    	if ($request->isMethod('post')) {
    		$data = $request->input('Student');
//    		$this->validate($request,[
//                'Student.name'=>'required|min:2|max:20',
//                'Student.age'=>'required|integer',
//                'Student.sex'=>'required|integer',
//            ],[
//                'required'=>':attribute 为必填项',
//                'min'=>':attribute 长度不符合要求',
//                'integer'=>':attribute 必须为整型'
//            ],[
//                'Student.name'=> '姓名',
//                'Student.sex'=> '性别',
//                'Student.age'=> '年龄',
//            ]);
            $validator = Validator::make($request->input(),[
                'Student.name'=>'required|min:2|max:20',
                'Student.age'=>'required|integer',
                'Student.sex'=>'required|integer',
            ],[
                'required'=>':attribute 为必填项',
                'min'=>':attribute 长度不符合要求',
                'integer'=>':attribute 必须为整型'
            ],[
                'Student.name'=> '姓名',
                'Student.sex'=> '性别',
                'Student.age'=> '年龄',
            ]);
            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
    		if (Form::create($data)){
                return redirect('form/index')->with('success','添加成功过');
            }else{
                return redirect()->back();
            }
    	}
        return view('form/create',[
            'student'=>$student
        ]);
    }

    public function save(Request $request){
    	$data = $request->input('Student');
    	$form = new Form();
    	$form->name = $data['name'];
    	$form->sex = $data['sex'];
    	$form->age = $data['age'];
    	if ($form->save()) {
    		return redirect('form/index');
    	}else{
    		return redirect()->back();
    	}
    }

    public function update(Request $request,$id){
        $student = Student::find($id);
        return view('form/update',[
            'student'=>$student
        ]);
    }
}