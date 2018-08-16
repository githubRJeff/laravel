<?php
namespace App\Http\Controllers;
use App\Form;

use App\Jobs\SendEmail;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
    	if ($request->isMethod('POST')) {
    		$data = $request->input('Student');

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


    public function update(Request $request,$id){

        $student = Form::find($id);
        if ($request->isMethod('POST')){
            $this->validate($request,[
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
            $data = $request->input('Student');
            $student->name = $data['name'];
            $student->age = $data['age'];
            $student->sex = $data['sex'];
            if ($student->save()){
                return redirect('form/index')->with('success','修改成功--'.$id);
            }
        }
        return view('form/update',[
            'student'=>$student
        ]);
    }

    public function detail($id){
        $student = Form::find($id);
        return view('form/detail',[
            'student' => $student
        ]);
    }

    public function delete($id){
        $student =Form::find($id);
        if ($student->delete()){
            return redirect('form/index')->with('success','删除成功-'.$id);
        }else{
            return redirect('form/index')->with('error','删除失败-'.$id);
        }
    }
    public function uploads(Request $request){
        if ($request->isMethod('POST')){
            $file = $request->file('source');
            if ($file->isValid()){
                $file_type = $file->getClientMimeType();
                $originalName = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                $real_path = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                $bool = Storage::disk('uploads')->put($filename,file_get_contents($real_path));
                if($bool){
                    echo '上传成功';
                    exit();
                }else{
                    echo '上传失败';
                    exit();
                }

            }

        }
        return view('student.uploads');
    }
    public function mail(){
        $content = '测试测试内容2';
//        Mail::raw($content,function ($message){
//            $message->from('602842617@qq.com','黑润哥哥');
//            $message->subject('邮件主题测试2');
//            $message->to('1260012188@qq.com');
//        });
        $student = Student::all();
        Mail::send('student.mail',['students' => $student],function ($message){
            $message->from('602842617@qq.com','黑润哥哥');
            $message->subject('邮件主题测试 aaaa');
            $message->to('1260012188@qq.com');
        });

    }

    public function cache1(){
        Cache::put('key1','val1',10);
    }
    public function cache2(){
//        $val = Cache::get('key1');
        $val = Cache::pull('key1');

        var_dump($val);
    }
    public function error(){
        Log::warning('测试错误日志',['name'=>'jeff']);
    }
    public function queue(){
        $this->dispatch(new SendEmail());
    }
}
