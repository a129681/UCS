/**
 * Created by fa on 2017/4/3.
 */
/**
 * 添加大学信息
 */
(function(){
    $(function(){      //省市二级联动初始化
    InitCity(dsy.Items[0],$('.univProvince'));
    InitCity(dsy.Items[1],$('.univCity'));
    function InitCity(data,obj)
    {
        for(var i=0;i<data.length;i++)
        {
            var oP=$("<option value='"+data[i]+"'>"+data[i]+"</option>");
            obj.append(oP);
        }
    }
    $('.univProvince').change(function(){
        var oIndex=$('.univProvince option:selected').index();
        $('.univCity').html(' ');
        InitCity(dsy.Items[oIndex+1],$('.univCity'));
    });
})})();

$(function(){
    $('#mySubmit').click(function(){
        var cont=$('.edit').html();
        $('.univCont').val(cont);
        $('#addUnivData').submit();
    });
});