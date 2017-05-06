<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 2017/3/12
 * Time: 13:08
 */
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {

    public function login(){
        if(IS_POST)
        {
            $data['userName']=I('post.userName');
            $data['userKey']=I('post.userKey');
            if(empty($data['userName']))
            {
                $this->assign("error",'用户名不能为空') ;
                if(empty($data['userKey']))
                    $this->assign("error",'密码名不能为空') ;
            }
            $user=D('User');
           if($dataArr=$user->isReliable($data))
           {
               Session('loginName',$dataArr[0]['Name']);
               Session('loginId',$dataArr[0]['id']);
               Session('login','on');
               cookie('login',$dataArr[0]['id']);
               cookie('loginName',$dataArr[0]['Name']);
               $this->redirect("Home/Index/index");
           }else
               $this->assign("error",'用户不存在或密码错误') ;
        }
        $this->display();
    }


    public function regist()
    {

        $this->display();
    }


    public function verify_pic()
    {
        $Verify = new \Think\Verify();
        $Verify->codeSet = '0123456789';
        $Verify->entry();
    }

    public function verify_check($code, $id='')
    {
//        $verify = new \Think\Verify();
//        $code=I('post.code');
//        $res= $verify->check($code,'');
//        $this->ajaxReturn($res);
       $verify = new \Think\Verify();
       $res = $verify->check($code, $id);
        $this->ajaxReturn($res, 'json');

    }


    public function myPage(){
        $user=D('User');
        $id=session('loginId');
        if($id)
        {
            $res=$user->getData($id);
            $this->assign('myData',$res);
        }else
        {
            exit('非法访问');
        }
        $post_res=$user->replyPost($id);
        $this->assign('reply',$post_res);
        $this->display();
    }

    public function alterData()
    {
        if(IS_POST)
        {
            $user=D('User');
            $map['Name']=I('post.yourName');
            $map['email']=I('post.yourEmail');
            $map['sex']=I('post.sex');
            $map['headface']=I('post.yourPic');
            $upload=$user->Upload();
            if(is_array ($upload))
            {
                $pic=$upload[0]['photo1'];
                $map['headface']='/UCS/Uploads/'.$pic['savename'];
                $res=$user->alterData($map,session('loginId'));
                $this->success($map['headface'],0);
            }
            else
                $this->error($upload);
        }
    }

    public function layout()
    {
        session_destroy();
        $this->success('退出成功');
    }

}