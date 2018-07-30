<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{                                                                                                                                                                                                                     
    public function test1(){
        //增加
    	$student = DB::insert('Insert into student(name,age) values(?,?)',
            ['cool',11]
            );
    	var_dump($student);
        //修改
        $num = DB::update('update student set age = ? where name = ?',
            [33,'cool']);
        var_dump($num);
        //查询
        $student = DB::select('select * from student where id > ? ',[1]);
        dd($student);
        //删除
        $num = DB::delete('delete from student where id = ?',[2]);
        var_dump($num);

    }

    //构造器新增操作
    public function insert1(){
        //获取插入id
       // $num = DB::table('student')->insertGetId([
       //     'name'=>'name1','age'=>11
       // ]);
        //批量插入数据
        $bool = DB::table('student')->insert([
            ['name'=>'name1','age'=>11],
            ['name'=>'name2','age'=>22],
        ]);
        var_dump($bool);
    }
    //构造器更新操作
    public function update1(){
        //更新
//        $num = DB::table('student')->where('name','name1')->update(
//            ['age'=>44]
//        );

        //自增自减increment/decrement
//        $num = DB::table('student')->where('name','name1')->increment('age',3);
        //增减的同时修改其它字段
        $num = DB::table('student')->where('name','name1')->increment('age',3,['sex'=>1]);
        var_dump($num);
    }

    //构造器删除操作
    public function delete1(){
        $num = DB::table('student')->where([['id','>',4],['name','like','name2']])->delete();
        var_dump($num);
        //清空表
        //DB::table('student')->truncate();
    }

    //构造器查询操作
    public function query1(){
        $student = DB::table('student')->get();
        $first = DB::table('student')->orderBy('id','desc')->first();
        $student = DB::table('student')->whereRaw('id >= ? and age >=?',[4,33])->get();

        //pluck,将指定字段输出成一个数组，只带一个参数的时候用默认的数字键名，两个参数的时候以第二个参数作为键名，第一个参数为键值
        //lists也是一样的用法
        $pl = DB::table('student')->pluck('age','name');

        //select 只输出指定字段
//        $student = DB::table('student')->select('name','age')->get();

        echo '<pre>';
        //chunk 每次只查询一定条数,orderby必带
        $student = DB::table('student')->orderBy('id')->chunk(2,function($students){
            var_dump($students);

        });

//        dd($student);
    }

    //聚合函数
    public function group1(){
        $num = DB::table('student')->count();
        $min = DB::table('student')->min('age');
        $max = DB::table('student')->max('age');
        $avg = DB::table('student')->avg('age');
        $sum = DB::table('student')->sum('age');
        var_dump($avg);
    }

    //orm模型
    public function orm1(){
        $students = Student::all();
        $students = Student::get();
        $student = Student::find(4);
        $student = Student::where('id','>',4)->orderBy('age','desc')->get();
        $count = Student::count();
//        dd($student);
        echo '<pre>';
         Student :: chunk(2,function($students){
            var_dump($students);
        });

    }

    //增加数据
    public function ormInsert(){
        //使用模型新增数据
//        $student = new Student();
//        $student->name = 'ormName';
//        $student->age = 55;
//        $bool= $student->save();
//         $student = Student::find(19);
//         $create_time = $student->created_at;

        //使用模型的Create方法新增数据
//        $student = Student::Create(['name'=>'jeff','age'=>22]);
        // 如果满足条件则插入，不满足则不插入
        $student = Student::firstOrCreate(['name'=>'jeff1']);
        //满足条件之后执行save即可插入
        $student = Student::firstOrNew(['name'=>'jeff1']);
        $bool = $student->save();

        var_dump($student);
    }

    //修改数据
    public function ormUpdate(){
        //使用模型修改数据
//        $student = Student::find(20);
//        $student->name = 'new jeff';
//        $bool = $student->save();
        //批量修改
        $num = Student :: where('id','>',19)->update(['name'=>'old jeff']);
        var_dump($num);
    }

    //删除数据
    public function ormDelete(){
        //使用模型删除数据
//        $student = Student::find(9);
//        $num = $student->delete();

        //使用主键删除
//        $num = Student::destroy([16,17]);

        //使用条件删除
        $num = Student::where('id','<',4)->delete();
        var_dump($num);
    }
    public function section1(){
        $students = Student::get();
        $students = array();
        $name='test';
        $arr = array('jeff1','test');
        return view('student.section1',[
            'name' => $name,
            'arr' => $arr,
            'students'=>$students
        ]);
    }

    //控制器request
    public function request1(Request $request){
        //获取请求参数，如果有填第二个参数则在请求参数为空的时候默认使用第二个参数的值
        echo $request->input('name');
        echo $request->get('name1','未知');

        //判断某个参数是否有
        if ($request->has('name')){
            echo $request->get('name');
        }else{
            echo '无参数';
        }
        //请求类型
        echo $request->method();
        //判断是否是指定的请求类型
        if ($request->isMethod('GET')){
            echo 'YES';
        }else{
            echo 'NO';  
        }
        //判断请求的url路由规则是否符合
        var_dump($request->is('student/*'));
        //获取请求的url
        echo $request->url();
        dd($request->all());

    }
    public function session1(Request $request){
        //1.HTTP request Session
        //$request->session()->put('key1','value1');
        //echo $request->session()->get('key1');
        //2.session()
        //session()->put('key2','value2');
        //echo session()->get('key2');
        //3.Session
//        Session::put('key3','value3');
//        echo Session::get('key3');
        // 不存在key4则取默认值default
//        echo Session::get('key4','default');
        //数据存成session数组
//        Session::push('student','name1');
//        Session::push('student','name2');
        //取出并删除，不删除用get
//        $res = Session::pull('student','default');
//        var_dump($res);
        //取出所有session
//        $res = Session::all();
//        dd($res);
        //判断是否存在某个session
//        if (Session::has('key1')){
//            echo 'good';
//        }
        //删除指定session
//        Session::forget('key1');
        //清空所有session
//        Session::flush();
        //只允许获取一次
//        Session::flash('key-flash','key-val');
        return Session::get('message','暂无');
    }
    public function session2(Request $request){
        return Session::get('message','暂无');
        echo Session::get('key-flash');
        return 'session 2';
    }
    public function response(){
//        $data = [
//            'errCode'=>'Error',
//            'errMsg' =>'sad'
//        ];
//        return response()->json($data);
//        return redirect('session2');
        //重定向带参
//        return redirect('session2')->with('message','我是session2');
//        return redirect()->action('StudentController@session2')->with('message','我是Session2');
        return redirect()->route('session2')->with('message','我是Session2');
        //返回上一个页面
//        return redirect()->back();
    }
    public function activity0(){
        return '这是准备页面';
    }
     public function activity1(){
        return '这是活动页面1';
    }
     public function activity2(){
        return '这是活动页面2';
    }
}
