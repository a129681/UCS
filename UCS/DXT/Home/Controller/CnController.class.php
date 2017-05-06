<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 2017/3/10
 * Time: 14:30
 */
namespace Home\Controller;
use Think\Controller;
class CnController extends Controller {
    public function disCont(){ //显示帖子信息
        $id=I('get.postId');
        $cont=D('Article');
        $data=$cont->cont($id);
        $title=$cont->common('Post',"id=$id",'title');

        $this->assign('title',$title[0]['title']);
        $this->assign('layerArr',$data);
        $this->display();
    }

    public function addPost() //发布新帖子
    {
        if(IS_POST)
        {
            $textCont = I('post.textCont');
            $author = cookie('login');
            $time = date("Y-m-d H:i:s", time());
            $title = I('post.title');
            $addPost = D('Article');
            $res = $addPost->textCont($textCont, $title, $author, $time);
            if ($res) {
                //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
                $this->success('新增成功', '');
                //$this->redirect("Home/Index/discuss");
            } else {
                //错误页面的默认跳转页面是返回前一页，通常不需要设置
                $this->error('新增失败');
            }
        }
    }

    public function searDesc()
    {
        $uni = D('University');
        if (IS_POST)
        {
            $data=I('post.web-searTxt');
            if($data)
            {
                $University=$uni->searUniver($data);
                $major=$uni->searMajor($data);
                $article=$uni->article($data);
            }
        }
        $this->assign('article',$article);
        $this->assign('University',$University);
        $this->assign('Major',$major);
        $this->display();
    }

    public function myPage()
    {
        $this->display();
    }

    public function univerDesc()
    {
        $University=D('University');
        if(IS_GET)
        {
            $uniId=I('get.uniID');
            $this->assign('uniId',$uniId);
            $res=$University->show($uniId);
            $major=$University->getMajor($uniId);
            $arr=[];

            for($j=0;$j<count($major);$j++)
            {
                if(!in_array($major[$j][0]['class'],$arr))
                {
                    $arr[]=$major[$j][0]['class'];
                }
            }
            for($i=0;$i<count($arr);$i++)
            {
                $t=$arr[$i];
                for($s=0;$s<count($major);$s++)
                {
                    if($major[$s][0]['class']===$t)
                    {
                        $list[$t][]=$major[$s][0]['name'].'|'.$major[$s][0]['id'];
                    }
                }
            }
            $this->assign('class',$list);
            $this->assign('getMajor',$major);
        }
        if(IS_POST)
        {
            $uniId=I('post.uniId');
            $data['order']=I('post.stuOrd');
            $data['orgin']=I('post.stuOrg');
            $data['subject']=I('post.stdSubjec');
            $res=$University->select($uniId,$data);
            $this->ajaxReturn($res);

        }

        $this->assign('uniData',$res);
        $this->display();
    }
    public function experCont()
    {
        $experId=I('get.experId');
        $experCont=D('Article');
        $res=$experCont->ExperCont($experId);

        /************/
        if(session('loginId'))
        {
            $sess=$experCont->queryLike($experId,session('loginId'));
            $this->assign('addClass',$sess);
        }
        /******/
        if(IS_POST)
        {
            $userId=I('post.userId');
            $experId=I('post.experId');
            $reg=$experCont->addLike($userId,$experId);
            if($reg)
            {
               $this->ajaxReturn(1);
            }
        }

        $coll=M("Collect");
        $map['user_id']=session('loginId');
        $map['collect_exper']=$experId;
        $selecRes=$coll->where($map)->select();
        if($selecRes)
        {
            $isColl='已收藏';
        }else
        {
            $isColl='收藏';
        }
        $this->assign('coll',$isColl);
        $this->assign('exper',$res);
        $this->display();

    }

    public function majorDesc()
    {
        if(IS_GET)
        {
            $majorId=I('get.id');
            $univer=D('University');
            $res=$univer->queryMajor($majorId);
            $this->assign('majorData',$res);
        }else
        {
            exit('访问页面不存在');
        }
        $this->display();
    }

    public function compare()
    {
        $university=D('ChooseUniver');
        if($_GET[0])
        {
            $map=I('get.0');
            $res=$university-> compare($map);
//            print_r($res);
            $this->assign('list',$res);
        }else
        {
            exit('非法访问');
        }

        $this->display();
    }

    public function testDesc()
    {
        $this->display();
    }
    public function testResult()
    {
        $this->display();
    }
}