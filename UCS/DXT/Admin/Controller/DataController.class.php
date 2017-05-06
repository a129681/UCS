<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 2017/4/3
 * Time: 16:45
 */
namespace Admin\Controller;
use Think\Controller;
class DataController extends Controller {
    public function addUniv()
    {
        if(IS_POST)
        {
            $map['name']=I('post.univName');
            $map['provice']=I('post.univProvince');
            $map['city']=I('post.univCity');
            $map['type']=I('post.univType');
            $map['people_number']=I('post.people');
            $map['doctor_station']=I('post.doctor');
            $map['master']=I('post.master_station');
            $map['key_disciplines']=I('post.key_disciplines');
            $map['character']=I('post.univCharacter');
            $map['subjection']=I('post.subjection');
            $map['web']=I('post.web-site');
            $map['summary']=I('post.univCont');
            $Univ=D('AdminUniver');
            $res=$Univ->addUniv($map);
            if($res)
                $this->success('新增大学成功');
        }
    }

    public function alterUserData()
    {
        $map['username']=I('post.user');
        $map['password']=I('post.pass');
        $map['phonenumber']=I('post.phone');
        $map['qq']=I('post.qq');
        $map['email']=I('post.email');
        $map['Name']=I('post.name');
        $map['sex']=I('post.sex');
        $data['id']=I('post.id');
        $res=M('User')->where($data)->save($map);
        if($res)
            $this->success('修改信息成功');

    }

    public function alterUnivData()
    {
        $map['provice']=I('post.province');
        $map['city']=I('post.city');
        $map['type']=I('post.type');
        $map['univer_character']=I('post.character');
        $map['subjection']=I('post.subjection');
        $map['web']=I('post.web');
        $map['doctor_station']=I('post.doctor');
        $map['master_station']=I('post.master');
        $map['tuition']=I('post.tuition');
        $map['key_disciplines']=I('post.key_disciplines');
        $data['id']=I('post.id');
        $res=M('BaseUniversity')->where($data)->save($map);
        if($res)
            $this->success('修改信息成功');
    }
}
