/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-01-15 10:58:31
 * @version $Id$
 */


/*
	choose js
 */
window.onload=function()
{
	var modelA=function()
	 {
	   var obj={};
	   var oBtn=document.querySelector(".select-siderBar");
	   var oBtns=oBtn.querySelectorAll('li');
	   var oDivs=oBtn.querySelectorAll("div");
	   obj.aInput=oBtns;
	   obj.aDiv=oDivs;
	   var oTab=new TabSwitch(obj);
	/*
		选择结果
	 */
	  var oAll=oBtn.querySelectorAll('a');
	  var oList=document.querySelector(".select-list");
	  oBtn.addEventListener("click",function(ev){
	  	var ev = ev || window.event;
	    var target = ev.target || ev.srcElement;
	  	if(target&&target.nodeName.toLowerCase()=='a')
	  	{
	  		var className=target.className;
			var flagResult=oList.getElementsByClassName(className);

			if(flagResult.length==1)
			{
				flagResult[0].innerHTML=target.innerHTML;
			}
			else
			{
				oList.appendChild(target.cloneNode(true));	
			}
	  		
	  	}
	  });

	  var oResh=document.querySelectorAll(".seclect-reflesh");
	  oResh.onclick=function(){
	  	oList.innerHTML="";
	  }
	}
}

