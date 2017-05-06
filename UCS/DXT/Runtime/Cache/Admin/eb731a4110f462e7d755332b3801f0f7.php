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
            min-height:460px;
            background:#e1e1e1;
        }

        #univerList td{
            border:1px solid #a1a1a1;
            text-align: center;
        }

        .edit{
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
                    <a href="<?php echo U('Admin/Index/universityAdmin');?>" class="active"><i class="fa fa-table "></i>大学信息管理</a>
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
        
    <div id="">
        <div id="univerList">
            <h3>大学列表</h3>
            <table style="margin-left:60px;">
                <tr><td>编号</td>
                    <td>名称</td>
                    <td>省份</td>
                    <td>城市</td>
                    <td>类型</td>
                    <td>性质</td>
                    <td>隶属</td>
                    <td>重点学科</td>
                    <td>博士点</td>
                    <td>硕士点</td>
                    <td>人数</td>
                    <td>学费</td>
                    <td>官网</td>
                    <td>功能</td>
                </tr>
                <?php if(is_array($univerData)): $i = 0; $__LIST__ = $univerData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($data["id"]); ?></td>
                        <td><?php echo ($data["name"]); ?></td>
                        <td><?php echo ($data["provice"]); ?></td>
                        <td><?php echo ($data["city"]); ?></td>
                        <td><?php echo ($data["type"]); ?></td>
                        <td><?php echo ($data["univer_character"]); ?></td>
                        <td><?php echo ($data["subjection"]); ?></td>
                        <td><?php echo ($data["key_disciplines"]); ?></td>
                        <td><?php echo ($data["doctor_station"]); ?></td>
                        <td><?php echo ($data["master_station"]); ?></td>
                        <td><?php echo ($data["people_number"]); ?></td>
                        <td><?php echo ($data["tuition"]); ?></td>
                        <td><?php echo ($data["web"]); ?></td>
                        <td><a href="">删除</a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
            <div style="margin-left:60px;">
                <?php echo ($myPage); ?>
            </div>
            <div style="border-top:1px solid #999;padding-top:10px;margin-left:60px;" id="seaUniv">
                搜索大学:<input type="text" value="" class="addText"/><input type="button" value="搜索大学">


                <div id="seaUnivRes" class="clearfix">
                    <form action="<?php echo U('Admin/Data/alterUnivData');?>" method="post"  >
                        <div class="clearfix" >
                            <div style="float:left;">
                                编号：<span name="id"></span><br/>
                                <input type="hidden" value="" name="id">
                                名称：<span name="name"></span><br/>
                                省份：<input type="text" name="province"><br/>
                                城市：<input type="text" name="city"><br/>
                                隶属：<input type="text" name="subjection"><br/>
                                性质：<input type="text" name="character"><br/>
                                类型：<input type="text" name="type"><br/>
                            </div>
                            <div style="float:left;margin-left:100px;">
                                重点学科：<input type="text" name="key_disciplines"><br/>
                                博&nbsp;&nbsp;士&nbsp;&nbsp;点：<input type="text" name="doctor"><br/>
                                硕&nbsp;&nbsp;士&nbsp;&nbsp;点：<input type="text" name="master"><br/>
                                学&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：<input type="text" name="tuition"><br/>
                                官&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;网：<input type="text" name="web"><br/>
                                人&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;数：<input type="text" name="population"><br/>
                            </div>
                        </div>
                        <div style="text-align: center;"><input type="submit" value="修改大学信息"></div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $('#seaUniv input[type=button]').on('click',function(){
                $.ajax({
                    url:"<?php echo U('Admin/Ajax/seaUniv');?>",
                    type:'post',
                    data:{data:$('.addText').val()},
                    success:function(msg){
                        if(msg) {
                            $('#seaUnivRes input[name=id]').val(msg[0]['id']);
                            $('#seaUnivRes input[name=key_disciplines]').val(msg[0]['key_disciplines']);
                            $('#seaUnivRes input[name=province]').val(msg[0]['provice']);
                            $('#seaUnivRes input[name=city]').val(msg[0]['city']);
                            $('#seaUnivRes input[name=subjection]').val(msg[0]['subjection']);
                            $('#seaUnivRes input[name=type]').val(msg[0]['type']);
                            $('#seaUnivRes input[name=character]').val(msg[0]['univer_character']);
                            $('#seaUnivRes input[name=doctor]').val(msg[0]['doctor_station']);
                            $('#seaUnivRes input[name=master]').val(msg[0]['master_station']);
                            $('#seaUnivRes input[name=tuition]').val(msg[0]['tuition']);
                            $('#seaUnivRes input[name=web]').val(msg[0]['web']);
                            $('#seaUnivRes input[name=population]').val(msg[0]['people_number']);
                            $('#seaUnivRes span[name=id]').text(msg[0]['id']);
                            $('#seaUnivRes span[name=name]').text(msg[0]['name']);
                        }else
                           alert('查询的大学不存在');
                    }
                });
            })
        </script>
        <div id="addUniver">
            <h3>添加大学</h3>
            <form action="<?php echo U('Admin/Data/addUniv');?>" method="post" id="addUnivData" style="margin-left:60px;">
                名称：<input type="text" class="univName" name="univName">
                隶属：<input type="text" name="subjection">
                博士点：<input type="text" name="doctor">
                硕士点：<input type="text" name="master">
                重点学科：<input type="text" name="key_disciplines">
                <br/>
                人数：<input type="text" name="people">
                官网：<input type="text" name="web-site">

                <br/>
                省份：<select class="univProvince" name="univProvince"></select>
                城市： <select name="univCity" class="univCity"></select>
                类型：<select name="univCharacter" class="univCharacter">
                <option value="公办">公办</option>
                <option value="民办">民办</option>
                <option value="中外合作大学">中外合作大学</option>
            </select>
                性质：<select name="univType" class="univType">
                <option value="综合类">综合类</option>
                <option value="工科类">工科类 </option>
                <option value="师范类">师范类</option>
                <option value="财经类">财经类</option>
                <option value="政法类">政法类</option>
                <option value="语言类">语言类</option>
                <option value="医药类">医药类</option>
                <option value="农林类">农林类</option>
                <option value="民族类">民族类</option>
                <option value="艺术类">艺术类</option>
                <option value="体育类">体育类</option>
                <option value="军事类">军事类</option>
                <option value="商学院">商学院</option>
            </select>
                <br/>
                简介：<div class="edit" contenteditable="true"></div>
                     <input type="hidden" value="" name="univCont" class="univCont">
                <input type="button" value="提交" id="mySubmit"/>
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