<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 2017/4/21
 * Time: 6:20
 */
namespace Home\Controller;
use Think\Controller;
class FuncController extends Controller {
    public function collect()//关注学校
    {
        $univName=I('post.name');
        $func=D('Function');
        $res=$func->collect($univName);
        if($res)
            $this->ajaxReturn(1);
        else
            $this->ajaxReturn('已经关注该学校');

    }

    public function showFocus()
    {
        $func=D('Function');
        $this->ajaxReturn($func->showFocus());
    }

    public function showCollCont()
    {
        $coll=M('Collect');
        $map['user_id']=session('loginId');
        $res=$coll->where($map)->select();
        $exper=M('Exper');
        if($res)
        {
            $len=count($res);
            for($i=0;$i<$len;$i++)
            {
                $data['id']=$res[$i]['collect_exper'];
                $arr[]=$exper->where($data)->select();
            }
            $this->ajaxReturn($arr);
        }else
            ajaxReturn(false);
    }

}