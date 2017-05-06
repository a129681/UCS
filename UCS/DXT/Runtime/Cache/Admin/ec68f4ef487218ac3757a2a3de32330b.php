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
    
    <script src="/UCS/Public/js/proCity.data.js"></script>
    <script src="/UCS/Public/admin/js/univData.js"></script>

   

    <style>
        #univerList,#addUniver,#addMajor{
            width:100%;
            min-height:400px;
            background:#e1e1e1;

        }

        #univerList td{
            border:1px solid #a1a1a1;
            text-align: center;
            min-width:100px;
        }

        #edit{
            width:1000px;height:200px;
            border:1px solid #7c7c7c;
            overflow-y:auto
        }

        h3{
            background:#444444;
            color:#fff;
            padding-left:20px;
            height:40px;line-height: 40px;
            border-top-left-radius:9px;
        }

        .edit{
            width:1000px;height:200px;
            border:1px solid #7c7c7c;
            overflow-y:auto
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
                    <a href="<?php echo U('Admin/Index/majorAdmin');?>" class="active"><i class="fa fa-table "></i>专业信息管理</a>
                </li>
                <li>
                    <a href="<?php echo U('Admin/Index/shareExper');?>" class=""><i class="fa fa-edit "></i>分享经验</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" >
        
    <div id="">
        <div id="univerList">
            <h3>专业列表</h3>
            <table style="margin:0 auto;">
                <tr><td>编号</td>
                    <td>名称</td>
                    <td>类别</td>
                    <td>科属</td>
                    <td>就业薪水</td>
                </tr>
                <?php if(is_array($majorData)): $i = 0; $__LIST__ = $majorData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($data["id"]); ?></td>
                        <td><?php echo ($data["name"]); ?></td>
                        <td><?php echo ($data["class"]); ?></td>
                        <td><?php echo ($data["subject"]); ?></td>
                        <td><?php echo ($data["salary"]); ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>

            </table>
            <div style="text-align: center">
                <?php echo ($myPage); ?>
            </div>
        </div>
        <div id="addMajor">
            <h3>添加专业</h3>
            <form action="">
                名称：<input type="text">
                学科：<select name="">
                <option value="哲学">哲学</option>
                <option value="经济学">经济学</option>
                <option value="法学">法学</option>
                <option value="教育学">教育学</option>
                <option value="工学">工学</option>
                <option value="文学">文学</option>
                <option value="历史学">历史学</option>
                <option value="理学">理学</option>
                <option value="农学">农学</option>
                <option value="管理学">管理学</option>
                <option value="艺术学">艺术学</option>
            </select>
                专业类别： <select name="">
                <option value="轻工类">轻工类</option>
                <option value="交通运输类">交通运输类</option>
                <option value="经济学类">经济学类</option>
                <option value="财政学类">财政学类</option>
                <option value="金融学类">金融学类</option>
            </select>
                <br/>
                简介：<div class="edit" contenteditable="true"></div>
                <input type="hidden" value=""/>
                <br/>
                就业方向：<div class="edit" contenteditable="true"></div>
                <input type="hidden" value=""/>
                <br/>
                薪资：<div class="edit" contenteditable="true"></div>
                <input type="hidden" value=""/>
                <div><input type="button" value="添加新专业"></div>
            </form>
        </div>
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