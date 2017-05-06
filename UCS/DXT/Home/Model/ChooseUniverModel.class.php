<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 2017/3/22
 * Time: 22:05
 */
namespace Home\Model;
use Think\Model;
class ChooseUniverModel extends Model{
    public function show($flag1,$flag2,$flag3,$flag4)
    {
        $university=M('BaseUniversity');

        if($flag1)
        {
            $map['provice']=$flag1;
            if($flag2)
                $map['city']=$flag2;
            if($flag3)
                $map['univer_character']=$flag3;
            if($flag4)
            {
                $map['type']=$flag4;
            }
            return $university->where($map)->select();
        }else
        {
            return false;
        }
    }

    public function compare($map)
    {
        $university=M('BaseUniversity');
        for($i=0;$i<count($map);$i++)
        {
            $data['name']=$map[$i];
            $list[]=$university->where($data)->select();
        }
        return $list;
    }
}