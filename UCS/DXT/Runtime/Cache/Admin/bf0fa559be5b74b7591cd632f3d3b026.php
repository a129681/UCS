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
        #experCont,#tips{
            background:#d1d1d1;
        }

        #experEdit{
            margin-top:10px;
            border:1px solid #888;
            width:600px;height:400px;
            min-height:500px;
        }
        #experCont input{
            width:600px;
        }
        #experCont h3,#tips h3{
            background:#444444;
            color:#fff;
            padding-left:20px;
            height:40px;line-height: 40px;
            border-top-left-radius:9px;

        }

        #adEdit{
            width:600px;
            height:300px;
            border:1px solid #888;
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
                    <a href="<?php echo U('Admin/Index/userAdmin');?>" class=""><i class="fa fa-desktop "></i>用户管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Admin/Index/universityAdmin');?>" class=""><i class="fa fa-table "></i>大学信息管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Admin/Index/majorAdmin');?>" class=""><i class="fa fa-table "></i>专业信息管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Admin/Index/shareExper');?>" class="active"><i class="fa fa-edit "></i>发布信息</a>
                </li>
                <li>
                    <a href="<?php echo U('Admin/Index/majorAdmin');?>" class=""><i class="fa fa-table "></i>管理员设置</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" >
        
    <div id="experCont">
        <h3>发布文章</h3>
        <form action="" class="discuss-search" method="post" style="margin-left:60px;">
            <div><input type="text" placeholder="文章标题"></div>
            <div id="experEdit" name="experCont" contenteditable="true"></div>
        </form>
    </div>
    <div id="tips">
        <h3>发布广告</h3>
        <form action="" class="discuss-search" method="post" style="margin-left:60px;">
            选择广告位：<select name="" id="">
                        <option value="">广告位1</option>
                        <option value="">广告位2</option>
                        <option value="">广告位3</option>
                         <option value="">图片广告</option>
                    </select><br/>
            广告信息：<div id="adEdit" contenteditable="true">

            </div>
        </form>
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