<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 2017/3/11
 * Time: 10:34
 */
namespace Admin\Model;
use Think\Model;
class AdminUserModel extends Model{
    public function isReliable($data)
    {
        $map['username']=$data['userName'];
        $map['password']=$data['userKey'];
        $user=M('AdminUser')->where($map)->select();
       return $user;
    }

    public function userList($Page)
    {
        $user=M('User');
        $list=$user->order('regtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        return $list;
    }

    public function  divPage($table,$num)
    {
        $post=M($table);
        $count=$post->count();
        import('ORG.Util.Page');
        $Page=new \Page($count,$num);
        return $Page;
    }
}
