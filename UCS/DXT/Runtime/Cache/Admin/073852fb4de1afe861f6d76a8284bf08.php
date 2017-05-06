<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
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
    <style>
        #user table td{
            border:1px solid #d1d1d1;
            text-align: center;
        }

        #page-wrapper div{
            margin-top:60px;
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
                  <a href="#" style="color:#fff;"><?php echo session('loginName'); ?></a>
                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="active">
                        <a href="#" ><i class="fa fa-desktop "></i>用户管理</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-table "></i>添加大学信息</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-edit "></i>分享经验</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-qrcode "></i>待续</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o"></i>待续</a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-edit "></i>待续</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-table "></i>待续</a>
                    </li>
                     <li>
                        <a href="#"><i class="fa fa-edit "></i>待续</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" >

        </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
    </div>
    <div class="footer">
        <div class="row">
            <div class="col-lg-12" >
                <!--&copy;  2014 yourdomain.com | More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a>-->
            </div>
        </div>
    </div>
    <script>
        (function(){
            var oBtn=document.querySelectorAll("#main-menu li");
            var oLi=document.querySelector("#page-wrapper").children;
            var adminTab=new TabSwitch({aInput:oBtn,aDiv:oLi,flag:0});
        })();
    </script>
</body>
</html>