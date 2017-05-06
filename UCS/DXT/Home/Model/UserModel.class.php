<?php
/**
 * Created by PhpStorm.
 * User: fa
 * Date: 2017/3/11
 * Time: 10:34
 */
namespace Home\Model;
use Think\Model;
class UserModel extends Model{
    public function isReliable($data)
    {
        $map['username']=$data['userName'];
        $map['password']=$data['userKey'];
        $user=M('User')->where($map)->select();
       if($user)
           return $user;
        else
            return false;
    }

    public function getData($id)
    {
       $user=M('User');
        $map['id']=$id;
       return $user->where($map)->select();
    }

    public function alterData($map,$id)
    {
        $user=M('user');
        $res=$user->where("id=$id")->save($map);
        if($res)
            return true;
    }

    public function replyPost($id)
    {
        $post=M('Post');
        $layer=M('Layer');
        $arr=$post->where("author=$id")->select();
        for($i=0;$i<count($arr);$i++)
        {
//            $post_id=$arr[$i]['id'];
            $map['post_id']=$arr[$i]['id'];
            $map['layer_id']=array('NEQ',$id);
            $res[]=$layer->where($map)->select();
//            return $layer->where("post_id=$post_id AND layer_id<>$id")->select();
        }
        return $res;
    }

    public function Upload() //上传图片
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->replace = 'true';
        $upload->autoSub=false;
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            return $upload->getError();
        }else{// 上传成功
            $img='/UCS/Uploads/'.$info['photo1']['savename'];
            $image = new \Think\Image();
            $image->open('./Uploads/'.$info['photo1']['savename']);    //打开上传图片
            $image->thumb(150, 150,\Think\Image::IMAGE_THUMB_CENTER)->save('./Uploads/'.$info['photo1']['savename']);
            $arr[0]=$info;
            return $arr;
        }
    }

    public function collUniv()//收藏大学
    {
        
    }

}
