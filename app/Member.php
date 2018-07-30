<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/28
 * Time: 14:16
 */
namespace App;
use Illuminate\Database\Eloquent\Model;
class Member extends Model{
    public static function getMember(){
        return 'This is Member';
    }
}