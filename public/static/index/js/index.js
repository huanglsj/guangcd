
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


//百度地图
var map;
var point = new BMap.Point(117.125092,39.141300);


//创建和初始化地图函数：
function initMap() {
    createMap(); //创建地图
    setMapEvent(); //设置地图事件
    addMapControl(); //向地图添加控件
    addMapOverlay(); //向地图添加覆盖物
    setMapStyle();//样式
    createInfoWindow();// 创建窗口


}
function setMapStyle() {
    var mapStyle = {features: ["road", "building", "water", "land"], //隐藏地图上的poi
        style:"dark"  //设置地图风格为高端黑
    }
    map.setMapStyle(mapStyle);

}
//创建InfoWindow
function createInfoWindow(i){
    var opts = {
        width : 200,     // 信息窗口宽度
        height: 50,     // 信息窗口高度
        title : "天津广川科技有限公司" , // 信息窗口标题

    }
    var infoWindow = new BMap.InfoWindow("地址：天津市南开区南泥湾路世贸电商城A座408室", opts);  // 创建信息窗口对象
    map.openInfoWindow(infoWindow,point); //开启信息窗口
}

function createMap() {
    map = new BMap.Map("map");
    map.centerAndZoom(new BMap.Point(117.133692, 39.139500), 17);

}
function setMapEvent() {
    // map.enableScrollWheelZoom();/*启动鼠标滚轮缩放地图*/
    map.enableKeyboard();
    map.enableDragging();
    map.enableDoubleClickZoom()
}
function addClickHandler(target, window) {
    target.addEventListener("click", function () {
        target.openInfoWindow(window);
    });
}

function addMapOverlay() {
    var markers2 = [
        { content: "天津市南开区南泥湾路世贸电商城A座4F", title: "世贸电商城", imageOffset: { width: -46, height: -21 }, position: { lat: 39.141300, lng: 117.125092} }
    ];
    for (var index = 0; index < markers2.length; index++) {
        var point = new BMap.Point(markers2[index].position.lng, markers2[index].position.lat);
        var marker = new BMap.Marker(point, { icon: new BMap.Icon("http://api.map.baidu.com/lbsapi/createmap/images/icon.png", new BMap.Size(20, 25), {
            imageOffset: new BMap.Size(markers2[index].imageOffset.width, markers2[index].imageOffset.height)
        })
        });
        var label = new BMap.Label(markers2[index].title, { offset: new BMap.Size(25, 5) });
        var opts = {
            width: 200,
            title: markers2[index].title,
            enableMessage: false
        };
        var infoWindow = new BMap.InfoWindow(markers2[index].content, opts);
        marker.setLabel(label);
        addClickHandler(marker, infoWindow);
        map.addOverlay(marker);
    };

}

//向地图添加控件
function addMapControl() {
    var scaleControl = new BMap.ScaleControl({ anchor: BMAP_ANCHOR_BOTTOM_LEFT });
    scaleControl.setUnit(BMAP_UNIT_IMPERIAL);
    map.addControl(scaleControl);
    var navControl = new BMap.NavigationControl({ anchor: BMAP_ANCHOR_TOP_LEFT, type: BMAP_NAVIGATION_CONTROL_LARGE });
    map.addControl(navControl);
}
initMap();
