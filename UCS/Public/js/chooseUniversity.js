/**
 * Created by fa on 2017/4/9.
 */

var lock='off';
$(function(){
    chooseUniversity.module.ProCity();//获取省市信息
    chooseUniversity.tool.ajax();//获取初始数据
    chooseUniversity.module.getData();

    chooseUniversity.module.compare();

    chooseUniversity.module.collect();
});

var chooseUniversity={}

;
chooseUniversity.tool={};

chooseUniversity.module={};



//
chooseUniversity.tool.show=function(dataArr,obj,bool)//获取各个省市的数据
{
    var str=" ";
    obj.html('');
    if(bool)
    {
        bool=1;
        str=oA="<a href='#' class='select-action'>"+dataArr[0]+"</a>";
    }else
    {
        bool=0;
    }
    for(var i=bool;i<dataArr.length-1-bool;i++)
    {
        var oA="<a href='#'>"+dataArr[i]+"</a>";
        str=str+oA;
    }
    obj.append(str);
};
chooseUniversity.module.ProCity=function()
{
    var temp=chooseUniversity.tool.show;
        temp(dsy.Items[0],$('#select-pro'),1);
        temp(dsy.Items[1],$('#select-city'),0);
    $('#select-pro').on('click','a',function(ev){
        var target=$(ev.target);
        var pro=target.html();
        var oIndex=$.inArray(pro,dsy.Items[0]);
        temp(dsy.Items[oIndex+1],$('#select-city'),0);
    });
};

chooseUniversity.tool.ajax=function()
{
    $.ajax({
        url:"/UCS/index.php/Home/Index/chooseUniver.html",
        type:"POST",
        contentType:"application/x-www-form-urlencoded",
        data:{
            flag1:$('#select-pro .select-action').html(),
            flag2:$('#select-city .select-action').html(),
            flag3:$('#select-type .select-action').html(),
            flag4:$('#select-character .select-action').html()
        },
        success:function(msg){
            $('.select-selecUniver ul').html('');
            for(var t=0;t<msg.length;t++)
            {
                var data=msg[t];
                var tempData=data['id'];
                var url="/UCS/index.php/Home/Cn/univerDesc/uniID/"+tempData;
                var obj="<li><div><a href="+url+"></a><strong class='select-addCompare'>加入对比</strong><span class='select-collect'>收藏+</span></div></li>";
                var oLi=$(obj);
                var oP=$('.select-selecUniver ul');
                var oA=oLi.find('a');
                oA.html(data['name']);
                oP.append(oLi);
            }
           chooseUniversity.module.compare();//dom完全插入成功后开始调用对比模块
            chooseUniversity.module.collect();
        },
        beforeSend:function(){
           var oImg= $("<img src='' alt='waiting'/>");
            oImg.attr('src','/UCS/Public/img/icon/1.gif');
            oImg.attr('class','gif');
            oImg.css('width',80);
            oImg.css('height',80);
            var oUl=$('.select-selecUniver ul');
            oUl.append(oImg);
        }
    });
};

chooseUniversity.tool.btn=function(list, target){
    for (var i = 0; i < list.length; i++) {
        list.eq(i).removeClass();
    }
    target.addClass("select-action");
};

chooseUniversity.module.getData=function(){
    var btn=chooseUniversity.tool.btn;
    $('.select-university').on('click','a',function(ev) {
        var target = $(ev.target);
        switch (target.parent().attr('id')) {
            case 'select-pro':
                btn($('#select-pro a'), target);
                break;
            case 'select-city':
                btn($('#select-city a'), target);
                break;
            case 'select-type':
                btn($('#select-type a'), target);
                break;
            case 'select-character':
                btn($('#select-character a'), target);
                break;
        }
        chooseUniversity.tool.ajax();
    });
};


chooseUniversity.module.compare=function()
{


    if($.type(list)=='undefined')
        var list=Array();
    $('.select-addCompare').on('click',function(){
         if(lock=='off')
         {
            var popUp = $("<div id='notPopup'><div id='notPop_cont'></div><a href='/UCS/index.php/Home/Cn/compare' id='linkToDesc'></a></div>");
            document.body.appendChild(popUp.get(0));
            lock='on';//开启弹窗
         }
         var preText=$(this).prev().text();//获取大学名称
        if(!(preText in list))
        {
            list[preText]=preText;
            $("#notPop_cont").append("<span>"+list[preText]+'</span><br/>');
            $('#linkToDesc').get(0).href+='/'+$('#notPop_cont span').length+'/'+preText;

            if($('#notPop_cont span').length>=2)
            {
                $('#linkToDesc').text('查看对比详情');
            }
        }else
            alert(preText+'已经被选中了');
        if($('#notPop_cont span').length>3)
        {
            //alert();
            new popup('最多只可以同时比较四所院校');
            $('.select-addCompare').off();
        }
    })

};

chooseUniversity.module.collect=function(){


    $('.select-collect').on('click',function(){
        if(!getCookie('login')) {
            new popup('收藏之前请登录','/UCS/index.php/Home/User/login.html');
            return false;
        }
        var preText=$(this).prev().prev().text();
        $.ajax({
            url:'/UCS/index.php/Home/Func/collect.html',
            type:'post',
            data:{name:preText},
            success:function(data){

            }
        });
    });
};