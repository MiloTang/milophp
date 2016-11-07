/**
 * Created by francis and winnie on 2016/11/5.
 */
$(function(){
    $("#getCode").click(function(){
        $(this).attr("src",'http://localhost/index/code/' + Math.random());
    });
});
