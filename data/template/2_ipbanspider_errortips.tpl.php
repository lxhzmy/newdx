<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE HTML PUBLIC ��-//IETF//DTD HTML 2.0//EN��>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<title>503 Service Temporarily Unavailable</title>
<?php echo $style;?>
<style>
#returnmsg{font-weight:bold;}
.red{color:red;}
.green{color:green;}
p{margin:0;}
#unban{height:30px;width:50px;}
.gt_holder .gt_slider_holder{width:auto;}
</style>
<base href="<?php echo $baseurl;?>"/>
</head>
<body>
<table cellpadding="0" cellspacing="0" border="0" width="700" align="center" height="85%">
  <tr align="center" valign="middle">
    <td>
    <table cellpadding="20" cellspacing="0" border="0" width="80%" align="center" style="font-family: Verdana, Tahoma; color: #666666; font-size: 12px">
    <tr>
      <td valign="middle" align="center" bgcolor="#EBEBEB">
<br/>
        <b id='title' style="font-size: 16px">����IP�����쳣�����϶���֤����ȷ��
</b>
        <br /><br/>
        <br />
<form id="formv" action="plugin.php?id=ipbanspider:userunban" method="POST">
<div style="width:270px;margin:0 auto;display:table">
<script src="http://api.geetest.com/get.php?gt=273df89437f54dac2bfb5b69afe1c318" type="text/javascript"></script>
</div>
        <br />
        <p id="returnmsg"></p>
        <br />
<input id="unban" type='button' value="ȷ��" />
<br/><br />
<a target="_blank" href="http://sighttp.qq.com/authd?IDKEY=f16db6810382cb0472e6f9aeb8c704db4041f3a7505c1107"><img border="0"  src="http://wpa.qq.com/imgd?IDKEY=f16db6810382cb0472e6f9aeb8c704db4041f3a7505c1107&amp;pic=41" alt="���������ҷ���Ϣ" title="���������ҷ���Ϣ"/></a>
<a target="_blank" href="http://sighttp.qq.com/authd?IDKEY=64f76275390cda40da76aa4f0538c3b66d10d2deb3f2e6b8"><img border="0"  src="http://wpa.qq.com/imgd?IDKEY=64f76275390cda40da76aa4f0538c3b66d10d2deb3f2e6b8&amp;pic=41" alt="���������ҷ���Ϣ" title="���������ҷ���Ϣ"/></a>
<br /><br/><p>�ѹ������ȫ�����ټ�ʹ�ô������û������ܵ�Ӱ��<br/>�Ƽ������������ʹ�����������������վ</p>
<br />
</form>
      </td>
    </tr>
    </table>
    </td>
  </tr>
</table>
<script src="static/js/jquery-1.6.1.min.js" type="text/javascript" type="text/javascript"></script>
<script src="static/js/jquery.form.js" type="text/javascript" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();;(function($) {
$('#unban').click(function(){
$('#formv').ajaxSubmit({
dataType: 'html',
type:'post',
success:function(data){$('#returnmsg').html(data);},
error:function(data){$('#returnmsg').html('<span class="red">��֤ʧ�������³���</span>');}});
});
})(jQuery);
</script>
</body>