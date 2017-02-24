/**
 * Created by gujiajin on 2015/12/9.
 *
 *
 */

var imageUpload=function(prams){
    var self=this;
    self.checkIsNull=function(value,error){
        if (value == undefined || value == null || value == "" || value.length == 0) {
            if(error){
                alert(error)
            }
        }
        return value;
    }
    self.prams = {
        upBtn: self.checkIsNull(prams.upBtn,'请设置upBtn'),
        divShow: self.checkIsNull(prams.divShow,'请设置divShow'),
        imgShow: self.checkIsNull(prams.imgShow,''),
        width: self.checkIsNull(prams.width,''),
        height: self.checkIsNull(prams.height,''),
        imgType: ["gif", "jpeg", "jpg", "bmp", "png"],
        errMsg: "选择文件错误,图片类型必须是(gif,jpeg,jpg,bmp,png)中的一种",
        uploadUrl:self.checkIsNull(prams.uploadUrl,'请设置上传的URL'),
        fileSize:self.checkIsNull(prams.fileSize,10*1024*1024),
        init:prams.init,
        callBack: prams.callBack
    };
    self.getObjectURL = function(file) {
        var url = null;
        if (window.createObjectURL != undefined) {
            url = window.createObjectURL(file);
        }
        else if (window.URL != undefined) {
            url = window.URL.createObjectURL(file);
        }
        else if (window.webkitURL != undefined) {
            url = window.webkitURL.createObjectURL(file);
        }
        return url;
    }
    self.showImg=function(file){
        /*IE浏览器中*/
        if (navigator.userAgent.indexOf("MSIE") > -1) {
            try {
                if(self.prams.imgShow) {
                    document.getElementById(self.prams.imgShow).src = self.getObjectURL(file);
                }
            } catch (e) {
                var div = document.getElementById(self.prams.divShow);
                this.select();
                top.parent.document.body.focus();
                var src = document.selection.createRange().text;
                document.selection.empty();
                if(self.prams.imgShow) {
                    document.getElementById(self.prams.imgShow).style.display = "none";
                }
                div.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                div.style.width = self.prams.width + "px";
                div.style.height = self.prams.height + "px";
                div.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = src;
            }
        }
        else {
            if (self.prams.imgShow) {
                document.getElementById(self.prams.imgShow).src = self.getObjectURL(file);
            }
        }
    }
    self.Bind = function(init,callBack) {
        document.getElementById(self.prams.upBtn).onchange = function() {
            /*判断文件是否存在*/
            if (!this.value) {
                return;
            }
            /*判断文件类型*/
            if (!RegExp("\.(" + self.prams.imgType.join("|") + ")$", "i").test(this.value.toLowerCase())) {
                //alert(self.prams.errMsg);
                this.value = "";
                callBack(false,'图片类型必须是(gif,jpeg,jpg,bmp,png)中的一种');
                return false;
                }
            /*判断文件大小*/
            var obj=this.files[0];
            if(obj.size>self.prams.fileSize){
                callBack(false,'上传的图片不能超过'+self.prams.fileSize/(1024*1024)+'M');
                return;
                }
            /*加载初始化逻辑*/
            init();
            /*文件上传*/
            self.upload(this.files,callBack);
        }
    }
    self.upload=function(files,fn){
        if(!files){
            fn(false,'文件上传失败，请刷新重试');
            return;
        }
        var fd=new FormData();
        fd.append('image',files[0]);
        $.ajax({
            url: self.prams.uploadUrl,
            type: 'POST',
            dataType:'JSON',
            data: fd,
            contentType: false,
            processData: false,
            success: function (data, textStatus) {
                if(data.status=='_0001'){
                    alert(data.message);
                    fn(false,data.message);
                    return;
                }
                if(data.message) {
                    self.showImg(files[0]);
                    if(self.prams.imgShow){
                        var img = " <img id='"+self.prams.imgShow+"' src='" + data.message + "' class='file-img' />";
                        $("#" + self.prams.imgShow).attr('src', data.message);
                        $(".add").hide();
                    }
                    fn(true,data.message);
                    return;
                }
                fn(false,'上传失败，请刷新重试');
                return;
            },
            error: function (error) {
                var img = "图片上传失败！";
                if(self.prams.imgShow){
                    $("#" + self.prams.imgShow).append(img);
                }
                var msg = "服务器出错，错误内容：" + error.responseText;
                fn(false,msg);
            }
        });
    }
    /*调用*/
    self.Bind(self.prams.init,self.prams.callBack);
}