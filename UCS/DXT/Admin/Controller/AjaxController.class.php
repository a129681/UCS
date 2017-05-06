<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 2017/4/16
 * Time: 15:25
 */
namespace Admin\Controller;
use Think\Controller;
class AjaxController extends Controller {
        public function seaUser()
        {
            if (IS_POST)
            {
                $getData=I('post.data');
                if(is_numeric($getData))
                    $map['id']=$getData;
                else {
                    $map['Name'] = $getData;
                }
                $user=M('User');
                $res=$user->where($map)->select();
                $this->ajaxReturn($res);
            }else
                $this->ajaxReturn(0);
        }
    public function seaUniv()
    {
        if (IS_POST)
        {
            $getData=I('post.data');
            if(is_numeric($getData))
                $map['id']=$getData;
            else {
                $map['name'] = $getData;
            }
            $user=M('BaseUniversity');
            $res=$user->where($map)->select();
            $this->ajaxReturn($res);
        }else
            $this->ajaxReturn(0);
    }
}