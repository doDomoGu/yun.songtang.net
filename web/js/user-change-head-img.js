
var qiniuDomain = $('#qiniuDomain').val();
var qiniuDomainBeaut = $('#qiniuDomainBeaut').val();
var pickfileId = $('#pickfileId').val();
var fileurlId = $('#fileurlId').val();
var userId = $('#userId').val();
var _file;
var uploader = Qiniu.uploader({
    runtimes: 'html5,flash,html4',    //上传模式,依次退化
    browse_button: pickfileId,       //上传选择的点选按钮，**必需**
    uptoken_url: '/dir/get-uptoken?saveKey=user:'+userId+'/head.$(ext)',
    //Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
    // uptoken : '<Your upload token>',
    //若未指定uptoken_url,则必须指定 uptoken ,uptoken由其他程序生成
    unique_names: false,
    // 默认 false，key为文件名。若开启该选项，SDK会为每个文件自动生成key（文件名）
    //save_key: '$(var)',
    // 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK在前端将不对key进行任何处理
    domain: qiniuDomain,
    //bucket 域名，下载资源时用到，**必需**
    container: pickfileId+'_container',           //上传区域DOM ID，默认是browser_button的父元素，
    max_file_size: '2000mb',           //最大文件体积限制
    flash_swf_url: '/js/qiniu/Moxie.swf',  //引入flash,相对路径
    max_retries: 0,                   //上传失败最大重试次数
    dragdrop: true,                   //开启可拖曳上传
    drop_element: pickfileId+'_container',       //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
    chunk_size: '4mb',                //分块上传时，每片的体积
    auto_start: true,                 //选择文件后自动上传，若关闭需要自己绑定事件触发上传
    init: {
        'FilesAdded': function(up, files) {
            plupload.each(files, function(file) {
                // 文件添加进队列后,处理相关的事情
                _file = file;
            });
            $('#'+fileurlId+'_upload_txt').html('<span style="color:#894A38">上传中,请稍等...</span>');

        },
        'BeforeUpload': function(up, file) {
            // 每个文件上传前,处理相关的事情
        },
        'UploadProgress': function(up, file) {
            // 每个文件上传时,处理相关的事情
        },
        'FileUploaded': function(up, file, info) {
            var res = $.parseJSON(info);
            /*alert(res.key);
             alert(info);*/
            //$('#'+fileurlId+'').val(res.key);
            $('#form-head_img').val(res.key);
            $('#img-upload').attr('src','').attr('src',qiniuDomainBeaut+res.key);
            $('#'+fileurlId+'_upload_txt').html('<span style="color:green;">上传成功</span>');
        },
        'Error': function(up, err, errTip) {
            //上传出错时,处理相关的事情
            $('#'+fileurlId+'_upload_txt').html('<span style="color:red">上传出错</span>');
            /*console.log(up);
             console.log(err);
             console.log(errTip);*/
        },
        'UploadComplete': function() {
            //队列文件处理完毕后,处理相关的事情
        },
        'Key': function(up, file) {
            // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
            // 该配置必须要在 unique_names: false , save_key: false 时才生效
            //var key = "";
            // do something with key here
            //return key
        }
    }
});