<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 2017/3/13
 * Time: 14:28
 */
namespace Home\Model;
use Think\Model;
class ArticleModel extends Model{
    public function common($table,$condition,$filed)
    {
        $common=M($table);
        $res=$common->field($filed)->where($condition)->select();
        return $res;
    }

    public function  divPage()
    {
        $post=M('Post');
        $count=$post->count();
        import('ORG.Util.Page');
        $Page=new \Page($count,5);
        return $Page;
    }

    public function count($list)
    {
        $layer=M('Layer');
        for($i=0;$i<count($list);$i++)
        {
            $postId=$list[$i]['id'];
            $res=$layer->where("post_id=$postId")->select();
            $num[]=count($res);
        }
        return $num;
    }

    public function discuss($Page)
    {
        $post=M('Post');
        $list=$post->order('post_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        return $list;
    }

   public function post($num)
   {
        $post=M('Post');
       $count=$post->count();
   }
    public function cont($id)
    {

        $result = M()->table(array('think_layer'=>'t1','think_user'=>'t2'))->
        field('t2.Name,t1.*')->
        where("t1.layer_id=t2.id AND t1.post_id=$id")->select();
        return $result;
    }

    public function reply($post,$storey)
    {
        $res = M()->table(array('think_reply'=>'t1','think_user'=>'t2'))->
        field('t2.Name,t1.*')->
        where("t1.layer_id=t2.id AND t1.post_id=$post AND t1.storey=$storey")->select();
        return $res;
    }

    public function reply_num($post,$storey)
    {
        $reply=M('Reply');
        $map['post_id']=$post;
        $map['storey']=$storey;
        $res=$reply->where($map)->select();
        return count($res);
    }

    public function add($cont,$name,$layerId,$postId,$storey)
    {
        $add=M('Reply');
        $auto=M('Layer');
        $data['layer_id']=$layerId;
        $data['cont']=$cont;
        $data['storey']=$storey;
        $data['replyer_id']=$name;
        $data['post_id']=$postId;
        $res=$add->data($data)->add();
        $auto->where("post_id=$postId AND storey=$storey")->setInc('count',1);
        return $res;
    }

    public function textCont($textCont,$title,$author,$time)
    {
        $text=M('Post');
        $layer=M('Layer');
        $data['cont']=$textCont;
        $data['title']=$title;
        $data['author']=$author;
        $data['post_time']=$time;
        $res=$text->data($data)->add();
        if($res){
            $arr['post_id']=$res;
            $arr['layer_id']=$author;
            $arr['cont']=$textCont;
            $arr['time']=$time;
            $arr['storey']=1;
            $layer->data($arr)->add();
        }
        return $res;
    }
    public function reply_floor($cont,$postId,$userId)
    {
        $layer=M('Layer');
        $post['post_id']=$postId;
        $storey=$layer->where($post)->max('storey');
        $data['storey']=$storey+1;
        $data['layer_id']=$userId;
        $data['post_id']=$postId;
        $data['cont']=$cont;
        $data['time']=date("Y-m-d H:i:s", time());
        $res=$layer->data($data)->add();
        if($res)
        {
            return 1;
        }else{
            return 0;
        }

    }

    /**
     * 以上为讨论模块api
     * 以下位文章
     */

    public function ExperCont($experId)
    {
//        $exper=M('Exper');
//        $map['id']=$experId;
        $result = M()->table(array('think_exper'=>'t1','think_user'=>'t2'))->
        field('t2.Name,t1.*')->where("t1.id=$experId AND t1.author=t2.id")->select();
        return $result;
//            $exper->where($map)->select();
    }

    public function addLike($userId,$experId)
    {
        $like=M('Like');
        $exper=M('Exper');
        $temp['id']=$experId;
        $exper->where($temp)->setInc('good',1);//点赞数加1
        $map['user_id']=$userId;
        $map['exper_id']=$experId;
        $map['like']='exper-good';
        $res=$like->data($map)->add();
        if($res)
            return true;

    }

    public function queryLike($experId,$userId)
    {
        $like=M('Like');
        $map['userId']=$userId;
        $map['experId']=$experId;
        $res=$like->where($map)->select();
        if($res)
            return 'exper-good';
        else
            return 0;
    }
}
