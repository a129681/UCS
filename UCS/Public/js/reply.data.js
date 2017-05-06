/**
 * Created by fa on 2017/3/2.
 */

var oAttr1 = $('.attr1');
var oAttr2 = $('.attr2');



$(function(){
    replay.module.listStyle();

    replay.module.replayShow();

    replay.module.getData();

    replay.module.editor();
});
var replay={};
    replay.tool={};
    replay.module={};

    replay.module.listStyle=function(){
        var oA=$('.ques-respon a');
        var oList=$('.ques-respon-list');
        var oLeft=$('.ques-left');
        var oRight=$('.ques-right');
        oA.on("click",
            function(){
                var myIndex = oA.index(this);
                oList.eq(myIndex).toggle(100,function(){
                });
            });
    };

/**
 *回复显示
 */
    replay.tool.ajax=function(postData,func){
        $.ajax({
            url: "/UCS/index.php/Home/Ajax/ajax.html",
            type: 'POST',
            data: postData,
            success: func
        });
    };



    replay.module.replayShow=function(){
        var oUl = $('.ques-respon-list ul');
        var oRep_a = $('.ques-respon a');
        oRep_a.on('click',function () {
            var myIndex = oRep_a.index(this);
            var oNums=$('.flooer_nums').eq(myIndex).html();//获取当前楼层数
            var post_id = oAttr2.eq(myIndex).val();
            var curA=oRep_a.eq(myIndex);
            var postData={num: oNums, postId: post_id, flag: 'get'};
            function success(data){
                var oL = data.length;
                for (var i = 0; i < oL; i++) {
                    var oLi = $('<li><strong></strong><span></span><a href="javascript:void(0);"style="float: right;">回复</a></li>');
                    var oStrong = oLi.find('strong');
                    var oSpan = oLi.find('span');
                    oStrong.text(data[i].Name + ':');
                    oSpan.text(data[i].cont);
                    oUl.eq(myIndex).append(oLi);
                }
            }
            if(!curA.attr('getData'))
            {
                oRep_a.eq(myIndex).attr('getData','on');
                replay.tool.ajax(postData,success);
            }
        });
    };

    replay.tool.ajaxGet=function(postData,func){
            $.ajax({
                url:"/UCS/index.php/Home/Ajax/ajax.html",
                type:'POST',
                data:postData,
                success:func
            });
    };


    replay.module.getData=function(){
        var oTxt=$('.ques-respon-list input[type=text]');
        var oSubmit=$('.ques-respon-list input[type=button]');
        var oUl = $('.ques-respon-list ul');
        oSubmit.click(function(){
            var myIndex = oSubmit.index(this); //获取当前索引
            var oNums=$('.flooer_nums').eq(myIndex).html();//获取当前楼层数
            var layerId = oAttr1.eq(myIndex).val();//获取当前层主ID
            var post_id = oAttr2.eq(myIndex).val();//获取帖子ID
            var uerId=getCookie('login');  //获取用户名，用来判断是否登陆
            var name=getCookie('loginName');
            var postData={flag:'add', cont:oTxt.val(), layerId:layerId,//需要ajax传输的数据
                postId:post_id, num:oNums, userId:uerId
            };

            function success(msg){
                alert(msg);
                if(msg=='成功')
                {
                    var aLi=$('<li><strong></strong><span></span><a class="reply-rely" href="javascript:void(0);">回复</a></li>');
                    var aStrong=aLi.find('strong');
                    var aSpan=aLi.find('span');
                    aStrong.text(name+':');
                    aSpan.text(oTxt.eq(myIndex).val());
                    oUl.eq(myIndex).append(aLi);
                    oTxt.eq(myIndex).val('')
                }else
                    alert(msg);
            }

        });




    };


//回复帖子
replay.tool.replayAjax=function(ajaxData){
    $.ajax({
        url:"/UCS/index.php/Home/Ajax/ajax.html",
        type:"post",
        data:{
            flag:'reply',
            cont:ajaxData.oCont.html(),
            postId:ajaxData.oAttr2.val(),
            userId:ajaxData.oLoginId
        },
        success:function(msg)
        {
            if(msg)
            {
                window.location.reload();
            }else
            {
                alert('页面刷新失败');
            }
        }
    });
};

replay.module.editor=function(){
    var oCont=$("#replyPost .editor");
    var oLoginId=getCookie('login');
    var oAttr1 = $('.attr1');
    var oAttr2 = $('.attr2');
    var ajaxData={oCont:oCont,oLoginId:oLoginId,oAttr2:oAttr2};
    $('#replySub').click(function(){//判断是否登陆
        if(oLoginId)
        {
            if(oCont)
                replay.tool.replayAjax(ajaxData);
            else
                new popup('请输入回复内容');
        }else
            new popup("回复之前请登录",'/UCS/index.php/Home/User/login.html');
    });
};


