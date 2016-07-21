var grid_file_thumb = function(){
    $('.filethumb').each(function(){
        _filethumbId = $(this).attr('data-id');
        $.ajax({
            url: '/dir/download',
            type: 'get',
            async : false,
            data: {
                id:_filethumbId,
                preview:true,
                imgUrl:true
            },
            success: function (data) {
                $('.filethumb-'+_filethumbId).attr('src',data+'?imageView2/1/w/128/h/128/interlace/0/q/70');
            }
        });
    });
};

var loading_files_flag = true;
var list_type = $('#var_list_type').val();
var loading_files = function(){
    _page = $('#var_page').val();
    _page_size = $('#var_page_size').val();
    _count = $('#var_count').val();
    loading_files_flag = false;
    $.ajax({
        url: '/dir/get-files',
        type: 'get',
        async: false,
        data: {
            dir_id:$('#var_dir_id').val(),
            p_id:$('#var_p_id').val(),
            order:$('#var_order').val(),
            page:_page,
            page_size:_page_size,
            list_type:list_type
        },
        success: function (data) {
            $('#list-main').append(data);
            if(list_type=='grid'){
                grid_file_thumb();
            }
            loading_num = parseInt(_page) * parseInt(_page_size);
            if(loading_num>=_count){
                $('.loading_num').html('加载完毕');
            }else{
                $('.loading_num').html('已加载'+loading_num+'个');
                $('#var_page').val(parseInt(_page)+1);
                loading_files_flag = true;
            }


        }
    });


};

loading_files();

$(window).scroll( function() {
    /*console.log("滚动条到顶部的垂直高度: "+$(document).scrollTop());
    console.log("页面的文档高度 ："+$(document).height());
    console.log('浏览器的高度：'+$(window).height());*/

    if(loading_files_flag){
        scroll_loading();
    }

});

var totalheight = 0;     //定义一个总的高度变量
function scroll_loading()
{
    totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop()) ;     //浏览器的高度加上滚动条的高度

    if ($(document).height() <= totalheight)     //当文档的高度小于或者等于总的高度的时候，开始动态加载数据
    {
        //加载数据
        loading_files();
    }
}
$('#list-main').on('click','.file-check',function(){

    _c = $('#list-main .file-checkbox:checked').length;
    if(_c>0){
        $('#list-head .head-btns .count-tips').html('已选中'+_c+'个文件/文件夹');
        $('#list-head .head-btns').show();
        $('#list-head .head_cols').hide();
    }else{
        $('#list-head .head-btns').hide();
        $('#list-head .head_cols').show();
    }


    /*if($(this).prop('checked')==false){

    }*/
});


/*$('.file-check').click(function(){
    if($(this).prop('checked')==false){
        $('.file-item').removeClass('file-checked');
        $('.file-check').prop('checked',false);
    }else{
        $('.file-item').removeClass('file-checked');
        $('.file-check').prop('checked',false);
        $(this).prop('checked',true);
        $(this).parents('.file-item').addClass('file-checked');
    }
});*/

$('.dir-item.dl_enable.is-dir').click(function(){
    location.href='/dir?p_id='+$(this).attr('data-id');
});

/*$('.dir-item').click(function(){
    if($(this).attr('download-check')=='enable'){
        if($(this).attr('data-is-dir')=='1'){
            location.href='/dir?p_id='+$(this).attr('data-id');
        }else{
            _download_times = parseInt($(this).find('.download_times span').html())+1;
            $(this).find('.download_times span').html(_download_times);
            location.href='/dir/download?id='+$(this).attr('data-id');
        }
    }else{
        if($(this).attr('data-is-dir')=='1'){
            alert('没有权限打开');
        }else{
            alert('没有下载权限');
        }
    }
});*/

/*$('.clickarea').click(function(){
    _this = $(this).parent('.dir-item');
    if(_this.attr('download-check')=='enable'){
        if(_this.attr('data-is-dir')=='1'){
            location.href='/dir?p_id='+_this.attr('data-id');
        }else{
            _download_times = parseInt(_this.find('.download_times span').html())+1;
            _this.find('.download_times span').html(_download_times);
            location.href='/dir/download?id='+_this.attr('data-id');
        }
    }else{
        if(_this.attr('data-is-dir')=='1'){
            alert('没有权限打开');
        }else{
            alert('没有下载权限');
        }
    }
});*/




$('.list-grid-switch a').click(function(){
    location.href = $(this).attr('data-url');
});

