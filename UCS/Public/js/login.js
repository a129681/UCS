/**
 * Created by fa on 2017/4/21.
 */
var verify_key='off';
$('.verify_pic input').keyup(function(){
    $.ajax({
        url:"/UCS/index.php/Home/User/verify_check.html",
        type:'post',
        data:{
            code:$('.verify_pic input').val()
        },
        success:function(msg){
            if(msg)
            {
                $('.verify_pic span').text('正确');
                $('.verify_pic span').css('color','#22ac38');
                verify_key='on';
            }else
            {
                $('.verify_pic span').text('错误');
                $('.verify_pic span').css('color','#b33528');
                verify_key='off';
            }
        }
    });
});


    $('.subBtn input').on('click',function(){

        if(verify_key=='off')
            return false;
    });


function fleshVerify(){
    //重载验证码
    var time = new Date().getTime();
    $('.verify_pic img').attr('src','/UCS/index.php/Home/User/verify_pic.html?'+time);
}