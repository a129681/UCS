<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    static $Category;
    static $Major;
    static $University;
    public function _initialize()
    {
        $Choose=D('Choose');
        self::$Category=$Choose->cate('经济学');
        $temp=self::$Category;
        self::$Major=$Choose->major($temp[0]['id']);
        self::$University=$Choose->union(self::$Major[0]['id']);
        $majorData['name']='经济学';
        $majorData['id']=self::$Major[0]['id'];
        if(!($_COOKIE['subject']))
        {
            cookie('subject','经济学');
            cookie('jsCate','经济学类');
        }

//
//        $this->assign('University',$majorData);
//        cookie('subBtn',1,'/');
//        cookie('cateBtn',0,'/');
//        cookie('nameBtn',0,'/');
    }
    public function index(){
        $this->assign('UserName',Session('loginName'));
        $this->assign('UserId',session('loginId'));
        $this->assign('UserStatus',session('login'));
        $this->display();
    }

    public function discuss(){
        $discuss=D('Article');
        $Page=$discuss->divPage();
        $show=$Page->show();
        $list=$discuss->discuss($Page);
        $num=$discuss->count($list);
        $this->assign('num',$num);

        $this->assign('list',$list);
        $this->assign('length',count($list));
        $this->assign('myPage',$show);
        $this->display();
    }

    public function choose(){
        if(IS_GET)
        {
            $Choose=D('Choose');
            if(I("get.flag2"))
            {
                $cate=$Choose->cate(I("get.flag2"));
                self::$Category=$cate;
                cookie("subject",I("get.flag2"));
                self::$Major=$Choose->major($cate[0]['id']);
                cookie("cate",$cate[0]['id']);
                cookie('jsCate',null);
                cookie('jsMajor',null);

            }
            elseif(I("get.flag3"))
            {
                $subject=$_COOKIE['subject'];
                self::$Category=$Choose->cate($subject);
                cookie("cate",I("get.id"));
                cookie("jsCate",I("get.flag3"));
                self::$Major=$Choose->major(I('get.id'));

                cookie('jsMajor',null);
            }elseif(I("get.flag4"))
            {
                $majorData['name']=I("get.flag4");
                cookie("jsMajor",I("get.flag4"));
                $majorData['id']=I('get.mid');
                $cate=$_COOKIE['cate'];
                $subject=$_COOKIE['subject'];
                self::$Category=$Choose->cate($subject);
                self::$Major=$Choose->major($cate);
                $Page=$Choose->divPage(I('get.mid'));
                $show=$Page['Page']->show();
                $union=$Choose->union(I('get.mid'),$Page['Page']);
                self::$University=$union;
                $this->assign('count',$Page['count']);
                $this->assign('majorData',$majorData);
                $this->assign('myPage',$show);

            }
            $this->assign("subject",self::$Category);
            $this->assign("major",self::$Major);
            $this->assign('University',self::$University);
            $this->display();
        }


    }
    public function chooseUniver()
    {
        if(IS_POST)
        {
            $flag1=I('post.flag1');
            $flag2=I('post.flag2');
            $flag3=I('post.flag3');
            $flag4=I('post.flag4');
            $chooseUniver=D('ChooseUniver');
            $res=$chooseUniver->show($flag1,$flag2,$flag3,$flag4);
            $this->ajaxReturn($res);
        }
        $this->display();
    }

    public function hotSear()
    {

        $this->display();
    }

    public function exper()
    {
        $post=M('Exper');
        $count=$post->count();
        import('ORG.Util.Page');
        $Page=new \Page($count,5);
        $show=$Page->show();
        $list=$post->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);
        $this->assign('myPage',$show);
        $this->display();
    }


}