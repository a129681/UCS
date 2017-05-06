<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 2017/3/20
 * Time: 20:54
 */
namespace Home\Controller;
use Think\Controller;
class AjaxController extends Controller {
    public function ajax()
    {
        $reply=D('Article');
        if(IS_POST)
        {
            if(I('post.flag')=='get')//显示每个层主信息
            {
                $nums=I('post.num');
                $postId=I('post.postId');
                $ret=$reply->reply($postId,$nums);
                $this->ajaxReturn($ret);
            }
            if(I('post.flag')=='add')//回复层主
            {
                $cont=I('post.cont');
                $name=I('post.userId');
                $layerId=I('post.layerId');
                $storey=I('post.num');
                $postId=I('post.postId');
                $res=$reply->add($cont,$name,$layerId,$postId,$storey);
                if($res)
                {
                    $this->ajaxReturn('成功');
                }
            }
            if(I('post.flag')=='reply')
            {
                $cont=I('post.cont');
                $postId=I('post.postId');
                $userId=I('post.userId');
                $res=$reply->reply_floor($cont,$postId,$userId);
                if($res)
                    $this->ajaxReturn(1) ;
                else
                    $this->ajaxReturn(0);
            }
        }
    }

    public function collect()//收藏文章
    {
       if(IS_POST)
       {
           $user_id=I('post.user_id');
           $exper_id=I('post.exper_id');
           $collect=M('Collect');
           $map['user_id']=$user_id;
           $map['collect_exper']=$exper_id;
           $res=$collect->data($map)->add();
           if($res)
               $this->ajaxReturn(1);
           else
               $this->ajaxReturn($map);
       }

    }



}