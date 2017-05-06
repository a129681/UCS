/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-01-18 23:00:08
 * @version $Id$
 */
var choose={};
choose.tool={};
choose.module={};
$(function(){
	choose.module.leftBackground();
});
choose.tool.getColor=function(obj,cookie){
	var mycookie=new cookieStorage();
	var subject=mycookie.getItem(cookie);
	for(var i=0;i<obj.length;i++)
	{
		if(obj.eq(i).text()==subject)
		{
			obj.eq(i).css('background','#EE6114');
		}
	}
};
choose.module.leftBackground=function(){
	//var mycookie=new cookieStorage();
	//$('#category a').click(function(){
	//	mycookie.removeItem('jsMajor');
	//});
	//$('#subject a').click(function(){
	//	mycookie.removeItem('jsMajor');
	//	mycookie.removeItem('jsCate');
	//});

	choose.tool.getColor($('#subject a'),'subject');
	choose.tool.getColor($('#category a'),'jsCate');
	choose.tool.getColor($('#major a'),'jsMajor');
};

