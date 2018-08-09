<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Form extends Model{
    const SEX_UN = 10;
    const SEX_BOY = 20;
    const SEX_GIRL = 30;
    protected $table = 'form';
    public $timestamps = true;
    protected $fillable = ['name','age','sex'];
    protected function getDateFormat()
    {
        return time();
    }
    protected function asDateTime($value)
    {
        return $value;
    }
    public function sex($index = null){
        $arr = [
            self::SEX_UN => '未知',
            self::SEX_BOY => '男',
            self::SEX_GIRL => '女',
        ];
        if ($index != null){
            return array_key_exists($index,$arr) ? $arr[$index] : $arr[self::SEX_UN];
        }
        return $arr;

    }
}