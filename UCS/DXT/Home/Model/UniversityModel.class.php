<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 2017/3/20
 * Time: 20:51
 */
namespace Home\Model;
use Think\Model;
class UniversityModel extends Model{

    public function show($id)
    {
        $university=M('BaseUniversity');
        $map['id']=$id;
        $res=$university->where($map)->select();
        if($res)
            return $res;
        else
            return false;
    }

    public function searUniver($data)
    {
        $sear=M('BaseUniversity');
        $map['name']=array('like',"%$data%");
        $res=$sear->where($map)->select();
        return $res;
    }

    public function searMajor($data)
    {
        $sear=M('Major');
        $map['name']=array('like',"%$data%");
        $res=$sear->where($map)->select();
        return $res;
    }

    public function article($data)
    {
        $article=M('Exper');
        $map['title']=array('like',"%$data%");
        $res=$article->where($map)->select();
        return $res;
    }

    public function select($id,$data)
    {
        $order=$data['order'];
        $orgin=$data['orgin'];
        $subject=$data['subject'];
        $map['a.order']=$data['order'];
        $map['a.orgin']=$data['orgin'];
        $map['a.subject']=$data['subject'];
        $map['a.id']=$id;
        $res=M()->table(array('think_admission'=>'a','think_under_score'=>'b'))
            ->field('a.id,a.one_year,b.first_year,a.two_year,b.second_year,a.three_year,b.thid_year')
            ->where('a.order=b.stu_order AND a.orgin=b.stu_orgin AND a.subject=b.stu_subject')->
            where($map)->select();
        return $res;
    }

    public function queryMajor($id)
    {
        $major=M('Major');
        return $major->where("id=$id")->select();
    }

    public function getMajor($uId)
    {
        $union=M('Union');
        $major=M('Major');
        $map['university_id']=$uId;
        $res=$union->where($map)->select();
        for($i=0;$i<count($res);$i++)
        {
            $data['id']=$res[$i]['major_id'];
            $arr[]=$major->where($data)->select();
        }
        return $arr;
    }
}