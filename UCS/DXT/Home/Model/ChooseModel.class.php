<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 2017/3/15
 * Time: 23:10
 */
namespace Home\Model;
use Think\Model;
class ChooseModel extends Model{

    public function  divPage($data)
    {

        import('ORG.Util.Page');
        $Union=M("Union");
        $University=M('BaseUniversity');
        $map['major_id']=$data;
        $count=$Union->where($map)->count();
        $Page=new \Page($count,20);
        $arr['Page']=$Page;
        $arr['count']=$count;
        return $arr;
    }

    public function cate($data)
    {
        $Cate=M('Category');
            $map['subject']=$data;
            $res=$Cate->where($map)->select();
        return $res;
    }
    public function major($data)
    {
        $Major=M('Major');
        $map['category_id']=$data;
        return $Major->where($map)->select();
    }
    public function union($data,$Page)
    {
        $Union=M("Union");
        $University=M('BaseUniversity');
        $map['major_id']=$data;
        $sql=$Union->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();//获取大学id
        for($i=0;$i<count($sql);$i++)
        {
            $arr['id']=$sql[$i]['university_id'];
            $lenArr[$i]=$University->where($arr)->select();
        }

        return $lenArr;
    }
}