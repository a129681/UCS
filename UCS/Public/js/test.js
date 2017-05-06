// JavaScript Document
//查找遗漏的选项
function find(){
	var i;
	var b = document.getElementsByTagName("input"); 
	for(i=1;i<=48*2;i=i+2){
		if(!(b[i].checked)&& !(b[i+1].checked)){
			alert("您的第"+(i+1)/2+"项漏填！请前去填写完整。");
			}
		}
}

//判断各类型分数 
	/*A 艺术型 ( 2、4、14、17、21、32、39、43 )计 分
　　C 传统型 ( 1、3、 7、13、29、33、38、44 )计 分
　　E 管理型 ( 5、9、11、25、28、35 、37、45)计 分
　　I 研究型 ( 6、16、18、20、30、31、40、47)计 分
　　R 现实型 (10、12、22、26、34、36、41、48)计 分
　　S 社会型 (8、15、19、23、24、27 、42、46)计 分*/
	
//各类型总分数安排进数组并且对数组排序
function getGradeArray(){
	
	var max;
	var b = [countGrade(2,4,14,17,21,32,39,43),countGrade(1,3,7,13,29,33,38,44),countGrade(5,9,11,25,28,35,37,45),countGrade(6,16,18,20,30,31,40,47),countGrade(10,12,22,26,34,36,41,48),countGrade(8,15,19,23,24,27,42,46)];
	b.sort();
	max = b[5];
	var a = [countGrade(2,4,14,17,21,32,39,43),countGrade(1,3,7,13,29,33,38,44),countGrade(5,9,11,25,28,35,37,45),countGrade(6,16,18,20,30,31,40,47),countGrade(10,12,22,26,34,36,41,48),countGrade(8,15,19,23,24,27,42,46)];
	//alert(b.length);
	for(var i=0;i<6;i++){
		if(max == a[i]){
			alert("您属于第"+(i+1)+"类型，快去看您对应的特点吧！(●'◡'●)");
			break;
			}
		};
}
function countGrade(a,b,c,d,e,f,g,h){
	var count=0;
	var oP = document.getElementsByClassName("1");
	//获取所有的input，判断值如果为是则count++
		if(oP[a-1].checked)count++;
		if(oP[b-1].checked)count++;
		if(oP[c-1].checked)count++;
		if(oP[d-1].checked)count++;
		if(oP[e-1].checked)count++;
		if(oP[f-1].checked)count++;
		if(oP[g-1].checked)count++;
		if(oP[h-1].checked)count++;	
		return count;	
}



