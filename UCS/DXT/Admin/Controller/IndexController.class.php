<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function index(){
        if(IS_POST)
        {
            $data['userName']=I('post.userName');
            $data['userKey']=I('post.userKey');

            $user=D('AdminUser');
//            echo $user;
            if($dataArr=$user->isReliable($data))
            {
                Session('loginName',$dataArr[0]['Name']);
                Session('loginId',$dataArr[0]['id']);
                Session('login','on');
                cookie('login',$dataArr[0]['id']);
                $this->redirect("Admin/Index/userAdmin");
            }
        }
        $this->display();
    }

    public function userAdmin(){
        $Admin=D('AdminUser');
        $Page=$Admin->divPage('User',10);
        $show=$Page->show();
        $userData=$Admin->userList($Page);
        $this->assign('userData',$userData);
        $this->assign('myPage',$show);
	    $this->display();
    }

    public function dropData()  //删除用户信息
    {
        if(IS_GET)
        {
            $id=I('get.userId');
            $user=M('User');
            $res=$user->where("id=$id")->delete();
            if($res)
                $this->success('删除成功');
        }
    }

    public function universityAdmin()
    {
        $Univer=D('AdminUniver');
        $Page=$Univer->divPage('BaseUniversity',10);
        $show=$Page->show();
        $res=$Univer->showData($Page,'BaseUniversity');
        $this->assign('univerData',$res);
        $this->assign('myPage',$show);
        $this->display();
    }

    public function majorAdmin()
    {
        $Univer=D('AdminUniver');
        $Page=$Univer->divPage('Major',10);
        $show=$Page->show();
        $res=$Univer->showData($Page,'Major');
        $this->assign('majorData',$res);
        $this->assign('myPage',$show);
        $this->display();
    }

    public function scoreAdmin()
    {
        $this->display();
    }

    public function shareExper()
    {
        $this->display();
    }

}