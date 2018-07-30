<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/28
 * Time: 16:37
 */
namespace App;
use Illuminate\Database\Eloquent\Model;
class Student extends Model{
    protected $table = 'student';
    // 默认不指定primarKey的情况下是id为主键，此处可以省略
    protected $primaryKey = 'id';

    //允许批量赋值的字段(模型的Create方法)
    protected $fillable = ['name','age'];
    //不允许批量赋值的字段
    protected $guarded = [];


    //自动维护时间戳
    public $timestamps = true;

    protected function getDateFormat()
    {
        //自动维护时间戳返回值
        return time();
    }

    //设置create_at、update_at的返回格式为时间戳而不是时间格式Y-m-d H:i:s
//    protected function asDateTime($val){
//        return $val;
//    }
}