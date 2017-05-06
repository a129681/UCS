/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2017-01-15 10:59:36
 * @version $Id$
 */
/**
 * [TabSwitch description]
 * @param {[object]} obj [description]
 * aInput:button
 * aDiv:
 * flag:
 */
var TabSwitch=function(obj){
    this.aInput=obj.aInput;
    this.aDiv=obj.aDiv;
    this.flag=obj.flag;
    var _this=this;
for(var i=0;i<this.aInput.length;i++)	
{
	this.aInput[i].index=i;
	this.aInput[i].onclick=function(){
		_this.tab(this);
	}
}
};
TabSwitch.prototype.tab=function(oBtn){
		if(this.aDiv[oBtn.index].style.display=="block"&&this.flag==1)
		{
			this.aDiv[oBtn.index].style.display="none";
		}
		else
		{
				for(var i=0;i<this.aInput.length;i++)
				{
					this.aInput[i].className="";
					this.aDiv[i].style.display="none";
				}

					oBtn.className="active";
					this.aDiv[oBtn.index].style.display="block";
					
	   }
		
};


/**
 *
 */
var popup=function(content,btnUrl){
	if(!btnUrl)
	{
		btnUrl='javascript:void(0);';
	}
	var oDiv=document.createElement('div');
	var oFilder=document.createElement('div');
	var oCancel=document.createElement('div');
	var clickCan=document.createElement('span');
	var oCont=document.createElement('p');
	var sA=document.createElement('a');
	clickCan.className='clickCan';
	oCont.className='popCont';
	oCont.innerHTML=content||'';
	sA.href=btnUrl;
	sA.innerHTML='确定';
	oCancel.className='oCancle';
	oCancel.innerHTML='提示框';
	oCancel.appendChild(clickCan);
	oDiv.id='pop-Body';
	oFilder.id='filder';
	document.body.appendChild(oDiv);
	document.body.appendChild(oFilder);
	oDiv.appendChild(oCancel);
	oDiv.appendChild(oCont);
	oDiv.appendChild(sA);

	this.myCan(sA,oDiv,clickCan,oFilder);

};

popup.prototype.myCan=function(obj0,obj1,obj2,obj3){
	function remove(){
		document.body.removeChild(obj1);
		document.body.removeChild(obj3);
	}
	obj2.onclick=remove;
	obj0.onclick=function(){
		if(obj0.href=='javascript:void(0);')
		{
			remove();
			return false;
		}else{
			return true;
		}
	}

};




/*
	
 */

var verfiy=function(obj){
	this.oRes=[0,0,0];
	this.user=obj.user;
	this.password=obj.password;
	this.verfiy_UP(obj);

};
verfiy.prototype.verfiy_UP=function(obj)
{
	var _this=this;
	obj.submit.onclick=function()
	{

		if(!(_this.oRes[0]==1&&_this.oRes[1]==1))
		{
			new popup("请完善信息");
			if(_this.oRes[2]==1)
			{
				new popup('请确认两次输入密码一致');
			}
			return false;
		}
	};
	 obj.user.onkeyup=function(){
	 	 var userRes=check(obj.user,"账号");
	 	 if(userRes=="可以使用")
	 	 {
	 	 	_this.oRes[0]=1;
	 	 }
	 	 else
	 	 {
	 	 	_this.oRes[0]=0;
	 	 }
	 	 obj.userDfn.innerHTML=userRes;
	 };
	obj.password.onkeyup=function(){
	   var passRes=check(obj.password,"密码");
	   if(passRes=="可以使用")
	   		_this.oRes[1]=1;
	   else
	   {
	   		_this.oRes[1]=0;
	   }
	   obj.passDfn.innerHTML=passRes;
	};
	if(obj.again)
	{
		obj.again.onkeyup=function(){
			var p1=obj.password.value;
			var p2=obj.again.value;
			if(p1==p2)
			{
				_this.oRes[2]=0;
				obj.againDfn.innerHTML='两次输入密码一致';
			}else
			{
				obj.againDfn.innerHTML='两次输入密码不一致';
				_this.oRes[2]=1;
			}
		};
	}


	function check(obj,str)
	{
		if(obj.value)
		{
		   var oNewString=obj.value.replace(/^\s*|\s$/g,'');
		   if(oNewString.length<=20&&oNewString.length>=8)
		   {
		   		var oReg=/[0-9a-zA-Z]/g;
		   		if(oReg.test(oNewString))
		   			return "可以使用";
		   		else
		   			return str+"只能由数字，字母和下划线组成";
		   }
		   else
		   	return str+"长度在8-20个字符之间";
		}
		else
		   return str+"不能为空";
	}
};
/**
 *
 * @param name
 * @returns {*}
 */

var getCookie=function (name)
{
	var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
	if(arr=document.cookie.match(reg))
	{
		return decodeURI(arr[2]);
	}
	else
		return null;
};

var setCookie=function(name,value,iDay){     //(名字，属性值，几天后过期)
	var oDate=new Date();
	oDate.setDate(oDate.getDate()+iDay);
	var str=name+"="+value;+"expires="+oDate+";path=/";
	document.cookie=decodeURI(str);
};
var removeCookie=function(name)
{
	var exp = new Date();
	exp.setTime(exp.getTime() - 1);
	var cval=getCookie(name);
	alert(cval);
	if(cval!=null)
		document.cookie= name + "="+cval+";expires="+exp.toGMTString();
};

var maxWord=function (obj,Num){
	var limNum=Num;
	obj.on('input',function(){
		var curLength=$(this).val().length;
		if(curLength>limNum){
			$(this).val(jQuery.trim($(this).val()));
			$(this).val($(this).val().substr(0,limNum));
			$(this).next('dfn').html("超过"+limNum+"字数限制，超出部分将被截断");
		}
		else
		{
			$(this).next('dfn').html("剩余"+(limNum-curLength)+"个字");
		}

	});
};


function cookieStorage(maxage,path)
{
	var cookie=(function(){
		var cookie={};
		var all=document.cookie;
		if(all==='')
			return cookie;
		var list=all.split("; ");
		for(var i=0;i<list.length;i++)
		{
			var temp=list[i];
			var p=temp.indexOf("=");
			var name=temp.substring(0,p);
			var value=temp.substring(p+1);
			value=decodeURIComponent(value);
			cookie[name]=value;
		}
		return cookie;
	}());
	var keys=[];
	for(var key in cookie) {
		keys.push(cookie[key]);
	}
	this.length=keys.length;
	this.key=function (n)
	{
		if(n<0||n>=keys.length) return null;
		return keys[n];
	};

	this.getItem=function(name){
		return cookie[name]||null;
	};

	this.setItem=function(key,value) {
		if (!(key in cookie)) {
			keys.push(cookie[key]);
			this.length++;

		}

		cookie[key] = value;

		var myCookie = key + "=" + encodeURIComponent(value);
		if (maxage) myCookie += ";max-age=" + maxage;
		if (path)myCookie += ";path= " + path;
		document.cookie=myCookie;
	};
	this.removeItem=function(key){
	if(!key in cookie) return;

	delete cookie[key];

		for(var i=0;i<keys.length;i++)
		{
			if(keys[i]===key)
			{
				keys.splice(i,1);
				break;
			}
		}
		this.length--;
	}
}
