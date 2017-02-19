//网站设置验证
$('#siteSet').bootstrapValidator({
    message: '不能为空！',
    feedbackIcons: {/*输入框不同状态，显示图片的样式*/
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {/*验证*/
        name: {/*键名username和input name值对应*/
            message: '公司名称不能为空',
            validators: {
                notEmpty: {/*非空提示*/
                    message: '公司名称不能为空'
                }
            }
        },
        address: {
            message: '公司地址不能为空',
            validators: {
                notEmpty: {
                    message: '公司地址不能为空'
                }
            }
        },
        acronym: {
            message: '公司简称不能为空',
            validators: {
                notEmpty: {
                    message: '公司简称不能为空'
                }
            }
        },
        icp: {
            message: '公司ICP不能为空',
            validators: {
                notEmpty: {
                    message: '公司ICP不能为空'
                }
            }
        },
        tel: {
            message: '公司电话不能为空',
            validators: {
                notEmpty: {
                    message: '公司电话不能为空'
                },
                regexp: {
                    regexp: /^(\(\d{3,4}\)|\d{3,4}-|\s)?\d{7,14}$/,
                    message: '请输入正确的公司电话'
                }
            }
        },
        time: {
            message: '服务时间不能为空',
            validators: {
                notEmpty: {
                    message: '服务时间不能为空'
                }
            }
        },
        description: {
            message: '网站简介不能为空',
            validators: {
                notEmpty: {
                    message: '网站简介不能为空'
                }
            }
        },
        keywords: {
            message: '关键词不能为空',
            validators: {
                notEmpty: {
                    message: '关键词不能为空'
                }
            }
        }
    }
}).on('success.form.bv', function(e) {
    e.preventDefault();
    var $form = $(e.target);
    $.post($form.attr('action'), $form.serialize(), function(data) {
            if(data.status=='0008'){
                layer.msg(data.message, {icon: 1});
                return;
            }
            if(data.status=='0000'){
                layer.msg(data.message, {icon: 2});
                return;
            }
    },'json');
});


