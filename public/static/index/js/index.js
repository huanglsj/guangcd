
$(function () {
    fatherNav();
})
//一级菜单背景改变开始
function fatherNav(){
    var li=$("#header > li").not(".slider");
    var liWidth = $("#header > li").width();
    var initialIndex =  $("#header > li.active").index();
    var slider=$("#headerSlider");
    slider.css("left",liWidth*initialIndex);
    li.mouseenter(function(){
        li.children("a").css("color","#000");
        slider.stop();
        slider.animate({'left':liWidth*$(this).index()},100);
        $(this).children("a").css("color","#fff");
        $(this).children(".children-nav").slideDown();
    });

    li.mouseleave(function(){
        slider.stop();
        li.children("a").css("color","#000");
        $(this).children(".children-nav").slideUp(100);
        for(var i=0;i<li.length;i++)
        {
            if(li.eq(i).hasClass('active'))
            {
                slider.animate({'left':liWidth*li.eq(i).index()},100);
                li.eq(i).children("a").css("color","#fff");
            }
        }
    });
}
//一级菜单背景改变结束

//图片轮播
$('.carousel').carousel();
