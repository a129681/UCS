<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 2017/4/21
 * Time: 6:34
 */
namespace Home\Model;
use Think\Model;
class FunctionModel extends Model{

    public function collect($name)
    {
        $univ=M('CollectUniv');
        $id=session('loginId');
        $map['id']=$id;
        $map['univ_name']=$name;
        $test=$univ->where($map)->select();
        if(!$test)
        {
            $res=$univ->data($map)->add();
            return 1;
        }else
            return 0;

    }

    public function showFocus()
    {
        $focus=M('CollectUniv');
        $univ=M('BaseUniversity');
        $map['user_id']=session('loginId');
        $res=$focus->where($map)->select();
        if($res)
        {
            $len=count($res);
            for($i=0;$i<$len;$i++)
            {
                $data['name']=$res[$i]['univ_name'];
                $result=$univ->where($data)->select();
                $arr[]=$result;
            }
            return $arr;
        }
}
}