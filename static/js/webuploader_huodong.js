//论坛发起活动
var tipsnow = false;
var posonshow = false;
var maxnum = 50;

// 图片上传demo
jQuery(function() {
    var $ = jQuery,
        $list = $('#imgattachlist'),
        // 优化retina, 在retina下这个值是2
        ratio = window.devicePixelRatio || 1,

        // 缩略图大小
        thumbnailWidth = 100 * ratio,
        thumbnailHeight = 100 * ratio,

        // Web Uploader实例
        uploader;

    // 初始化Web Uploader
    uploader = WebUploader.create({

        // 自动上传。
        auto: true,

        // swf文件路径
        swf: 'http://static.8264.com/static/flash/webuploader.swf',

        // 文件接收服务端。
        server: $("#url_action").val(),

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick : {id : "#filePicker",

			//只能选择一个文件上传

			multiple: false},		

		fileSizeLimit: 10000000,

		threads: 1,

		runtimeOrder: 'html5,flash',

        // 只允许选择文件，可选。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/jpg,image/jpeg,image/png,image/gif,image/bmp'
        },
		
		formData: {
			policy: $("#url_policy").val(),
			signature: $("#url_signature").val()
		}
    });
	
    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
		$("#fileid").val(file.id);
//		$(".webuploader-pick .webuploader-pick").html("图片上传中");
		$("#filePicker input").attr("disabled", true);
    });
	
	// 文件上传upyun以后，从upyun服务器获取返回值
	uploader.on('uploadAccept', function(obj, ret){
		if(ret.code == '200'){
			var fid = $("#fid").val();
			var url = "misc.php?mod=swfupload&type=image&fid="+fid+"&operation=upyunform";

			$.ajax({
				type : 'POST',
				url : url,
				data : {'filesize':ret.file_size, 'type':ret.mimetype, 'url':ret.url, 'time':ret.time, 'raw':ret._raw, 'filename':obj.file.name},
				dataType : 'json',
				async: false,
				success:function(result){
					if(result.flag == 1){
						$('#activityaid').val(result.aid);
						$('#activityattach_image').html('<img src="' + attachserver_image + '/' + ret.url + '!t1w300h300' + '" class="spimg" />');
					}
				}
			});
		}
	});

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file ) {
        $( '#'+file.id ).addClass('upload-state-done');
    });

    // 文件上传失败，现实上传出错。
    uploader.on( 'uploadError', function( file, reason ) {
		// 修改了webuploader.js 6886-6889行

		var rea = eval("("+reason+")");
		if(rea.message == 'authorization has expired'){
			showDialog("签名失效，请刷新页面后再上传图片。");
		}else{
			showDialog("图片上传失败，请刷新页面后再上传图片。");
		}

		//通过upyun cdn检测工具，获取目标upyun的ip、用户ip、用户省份、用户网络运营商
		$.getJSON("http://pubstatic.b0.upaiyun.com/?_upnode&t="+(+new Date()), function(json) {
			// 将form上传过程中出现的错误，记录到日志中
			var url = "misc.php?mod=swfupload&operation=upyunformlog";
			$.ajax({
				type : 'POST',
				url : url,
				data : {'flag':0, 'huodong':1, 'reason':reason, 'upyun_ip':json.addr, 'user_ip':json.remote_addr, 'user_location':json.remote_addr_location},
				dataType : 'json',
				success:function(result){
					if(1){
						
					}
				}
			});

		});

		
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').remove();
    });
	
	uploader.on( 'uploadFinished', function( file ) {
		$("#filePicker input").removeAttr("disabled");
    });

	// 当validate不通过时，会以派送错误事件的形式通知调用者。
	uploader.on('error', function( handler ) {
		if(handler == 'Q_EXCEED_SIZE_LIMIT'){
			alert("文件太大，请选择小于9M的文件");
		}else if(handler == 'Q_TYPE_DENIED'){
			alert("当前只允许上传图片类型文件");
		}
	});
});
