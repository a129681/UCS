<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 2017/3/11
 * Time: 10:34
 */
namespace Admin\Model;
use Think\Model;
class AdminUniverModel extends Model{

        public function  divPage($table,$num)
        {
            $post=M($table);
            $count=$post->count();
            import('ORG.Util.Page');
            $Page=new \Page($count,$num);
            return $Page;
        }

        public function showData($Page,$table)
        {
            $user=M($table);
            $list=$user->limit($Page->firstRow.','.$Page->listRows)->select();
            return $list;
        }

        public function addUniv($map)
        {
            $Univ=M('BaseUniversity');
            $res=$Univ->data($map)->add();
            if($res)
            {
                return true;
            }

        }
}