/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-01-18 22:57:44
 * @version $Id$
 */
var personal={};
personal.module={};
personal.tool={};
$(function(){
	personal.module.tabSwitch();
	personal.module.focus();
	personal.module.showColl();
});

personal.module.tabSwitch=function(){
	var oBtn=document.querySelectorAll('.myPage-leftsidebar li');
	var oRightCont=document.querySelector('.myPage-rightCont');
	var oDiv=oRightCont.children;
	var oEditData=document.querySelector(".edit-data");
	var oData=document.querySelector(".myPage-orgin-data");
	var oAlterData=document.querySelector(".myPage-alter-data");
	var oTab_page=new TabSwitch({aInput:oBtn,aDiv:oDiv,flag:0});
	var oQuit=document.getElementById('myPage-data-quit');
	oEditData.onclick=function(){
		oData.style.display="none";
		oAlterData.style.display="block";
	};
	oQuit.onclick=function(){
		oData.style.display="block";
		oAlterData.style.display="none";
	}
};
personal.module.focus=function(){
	$.ajax({
		url:'/UCS/index.php/Home/Func/showFocus.html',
		type:'post',
		data:{},
		success:function(msg){
			var len=msg.length;
			var temp='';

			for(var i=0;i<len;i++)
			{
				 temp+="<li><a href='/UCS/index.php/Home/Cn/univerDesc/uniID/"+msg[i][0]['id']+"'>"+msg[i][0]['name']+"</a>" +
						 " <span>院校性质："+msg[i][0]['univer_character']+"</span> " +
						 "<span>隶属单位："+msg[i][0]['subjection']+"</span> " +
						 "<span>院校类型："+msg[i][0]['type']+"</span></li>";
			}
			$('.myPage-Collection ul').append(temp);
		}
	});
};

personal.module.showColl=function()
{
	$.ajax({
		url:'/UCS/index.php/Home/Func/showCollCont.html',
		type:'post',
		data:{},
		success:function(msg){
			if(msg)
			{
				var len=msg.length;
				var temp='';
				for(var i=0;i<len;i++)
				{
					var t=i+1;
					temp+="<li><a href='/UCS/index.php/Home/Cn/experCont/experId/"+t+msg[i]['id']+"'>"+msg[i][0]['title']+"</a></li>";
				}
				$('.myPage-search ul').append(temp);
			}else
			{
				$('.myPage-search ul').append('暂未收藏任何文章');
			}

		}
	});
};