<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>管理系统</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="/UCS/Public/admin/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="/UCS/Public/admin/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="/UCS/Public/admin/css/custom.css" rel="stylesheet" />
    <script src="/UCS/Public/js/common.js"></script>
    <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />-->
    <script src="/UCS/Public/plugins/assets/jquery.min.js"></script>
    

    
   
    <style>
        #user table td{
            border:1px solid #666;
            min-width:100px;
            text-align: center;
        }

        h3{
            background:#444444;
            color:#fff;
            padding-left:20px;
            height:40px;line-height: 40px;
            border-top-left-radius:9px;
        }
        #user,#user-manger {
            background: #d1d1d1;
            border-top-left-radius: 9px;
        }
    </style>

    <style>
        #page-wrapper{
            margin-top:80px;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="adjust-nav">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="/UCS/Public/admin/img/logo.png" />
                </a>
            </div>
                <span class="logout-spn" >
                  <a href="#" ><?php echo session('loginName'); ?></a>
                </span>
        </div>
    </div>
    <!-- /. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
                <li>
                    <a href="<?php echo U('Admin/Index/userAdmin');?>" class="active"><i class="fa fa-desktop "></i>用户管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Admin/Index/universityAdmin');?>" class=""><i class="fa fa-table "></i>大学信息管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Admin/Index/majorAdmin');?>" class=""><i class="fa fa-table "></i>专业信息管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Admin/Index/shareExper');?>" class=""><i class="fa fa-edit "></i>分享经验</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" >
        
    <div id="user">
        <h3>用户列表</h3>
        <table style="margin-left:100px;">
            <tr>
                <td>编号</td>
                <td>昵称</td>
                <td>账号</td>
                <td>密码</td>
                <td>手机号</td>
                <td>性别</td>
                <td>qq</td>
                <td>邮箱</td>
                <td>注册时间</td>
                <td>功能</td>
            </tr>
            <?php if(is_array($userData)): $i = 0; $__LIST__ = $userData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($data["id"]); ?></td>
                    <td><?php echo ($data["Name"]); ?></td>
                    <td><?php echo ($data["username"]); ?></td>
                    <td><?php echo ($data["password"]); ?></td>
                    <td><?php echo ($data["phonenumber"]); ?></td>
                    <td><?php echo ($data["sex"]); ?></td>
                    <td><?php echo ($data["qq"]); ?></td>
                    <td><?php echo ($data["email"]); ?></td>
                    <td><?php echo ($data["regtime"]); ?></td>
                    <td><a href="<?php echo U('Admin/Index/dropData',array('userId'=>$data['id']));?>">删除</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <div style="margin-left:100px;"><?php echo ($myPage); ?></div>
    </div>
    <div id="user-manger">
        <h3>用户管理</h3>
        <div>
            用户搜索：
            <input type="text" value="" id="getData"><input type="button" value="搜索用户" id="submitData"/><dnf>输入用户名称或id</dnf>
            <div class="search-res " style="display: none;">
                <form action="<?php echo U('Admin/Data/alterUserData');?>" method="post">
                    <div class="clearfix">
                        <div style="float:left;">
                            用户编号：<span name="userId"></span><br/>
                            <input type="hidden" value="" name="id">
                            用户账号：<input type="text" name="user"><br/>
                            用户密码：<input type="text" name="pass"><br/>
                            用户昵称：<input type="text" name="name"><br/>
                            手机号码：<input type="text" name="phone">
                        </div>
                        <div style="float:left;margin-left:200px;">
                            用户性别：<input type="text" name="sex"><br/>
                            用户 qq：&nbsp<input type="text" name="qq"><br/>
                            用户邮箱：<input type="text" name="email"><br/>
                            注册时间：<span name="regTime"></span><br/>
                        </div>
                    </div>
                    <div style="text-align: center"><input type="submit" value="修改信息"></div>
                </form>

            </div>
        </div>
        <script>

            $('#submitData').on('click',function(){
                $.ajax({
                    url:"<?php echo U('Admin/Ajax/seaUser');?>",
                    type:'post',
                    data:{data:$('#getData').val()},
                    success:function(msg){
                        $('.search-res input[type=text]').val('');
                        $('.search-res span').text('');
                        if(msg)
                        {
                            $('.search-res input[name=id]').val(msg[0]['id']);
                            $('.search-res input[name=user]').val(msg[0]['username']);
                            $('.search-res input[name=pass]').val(msg[0]['password']);
                            $('.search-res input[name=name]').val(msg[0]['username']);
                            $('.search-res input[name=phone]').val(msg[0]['Name']);
                            $('.search-res input[name=sex]').val(msg[0]['sex']);
                            $('.search-res input[name=qq]').val(msg[0]['qq']);
                            $('.search-res input[name=email]').val(msg[0]['email']);
                            $('.search-res span[name=userId]').text(5209266+msg[0]['id']);
                            $('.search-res span[name=regTime]').text(msg[0]['regtime']);
                            $('.search-res').show(1500);
                        }else
                        {
                            alert('不存在该用户');
                        }

                    }
                });
            });
        </script>
    </div>

    </div>
</div>
</div>
<div class="footer">
    <div class="row">
        <div class="col-lg-12" >
        </div>
    </div>
</div>
</body>
</html>