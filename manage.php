
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>上传文件管理</title>


	<script src="upload/js/jquery-1.10.2.min.js"></script>
	<script src="upload/js/plupload.full.min.js"></script>
	<style>
	body{ font-size: 12px;}
	body,p,div{ padding: 0; margin: 0;}
	.wraper{ padding: 30px 0;}
	.btn-wraper{ text-align: center;}
	.btn-wraper input{ margin: 0 10px;}
	#file-list{ width: 350px; margin: 20px auto;}
	#file-list li{ margin-bottom: 10px;}
	.file-name{ line-height: 30px;}
	.progress{ height: 4px; font-size: 0; line-height: 4px; background: orange; width: 0;}
	.tip1{text-align: center; font-size:14px; padding-top:10px;}
    .tip2{text-align: center; font-size:12px; padding-top:10px; color:#b00}
    .catalogue{ position: fixed; _position:absolute; _width:200px; left: 0; top: 0; border: 1px solid #ccc;padding: 10px; background: #eee}
    .catalogue a{ line-height: 30px; color: #0c0}
    .catalogue li{ padding: 0; margin: 0; list-style: none;}
    </style>
</head>
<body>
<div id='b1'>
<h1>用户：<?php $uname = $_GET['user'];echo $uname;?></h1>
</div>


<div id='upload'>
	<p class="tip2">注意：该demo把上传的地址设为了一个静态的html页面，所以文件并不会真正的上传到服务器，但这不会影响上传功能的演示！</p>
		<div class="wraper">
			<div class="btn-wraper">
				<input type="button" value="选择文件..." id="browse" />
				<input type="button" value="开始上传" id="upload-btn" />
			</div>
			<ul id="file-list">

			</ul>
		</div>
	
<script>

	var uploader = new plupload.Uploader({ //实例化一个plupload上传对象
		
		browse_button : 'browse',
		url : 'upload.php',
		flash_swf_url : 'js/Moxie.swf',
		silverlight_xap_url : 'js/Moxie.xap',
	});
	uploader.init(); //初始化

	//绑定文件添加进队列事件
	uploader.bind('FilesAdded',function(uploader,files){
		for(var i = 0, len = files.length; i<len; i++){
			var file_name = files[i].name; //文件名
			//构造html来更新UI
			var html = '<li id="file-' + files[i].id +'"><p class="file-name">' + file_name + '</p><p class="progress"></p></li>';
			$(html).appendTo('#file-list');
		}
	});

	//绑定文件上传进度事件
	uploader.bind('UploadProgress',function(uploader,file){
		$('#file-'+file.id+' .progress').css('width',file.percent + '%');//控制进度条
	});

	//上传按钮
	$('#upload-btn').click(function(){
		uploader.start(); //开始上传
	});

	</script>
</div>


<div id='video'>
<h1>视频管理</h1>
<?php
error_reporting(0);
$mysql_servername = "127.0.0.1"; //主机地址
$mysql_username = "root"; //数据库用户名
$mysql_password ="zgl3010"; //数据库密码
$mysql_database ="wangjkj"; //数据库
mysql_connect($mysql_servername , $mysql_username , $mysql_password);
mysql_select_db($mysql_database); 

$sql = "SELECT * FROM video WHERE owner = '$uname' ";
#echo $sql;
$res = mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows)
{
    echo "<table border=1><tr>";
    echo "<td>ID</td><td>拥有者</td><td>标题</td><td>视频名字</td><td>视频路径</td>
    <td>是否转码</td><td>高清</td><td>普清</td><td>低清</td><td>备注</td>";
        
    echo"</tr>";
    while($rows = mysql_fetch_row($res))
    {//使用while遍历所有记录，并显示在表格的tr中
	   echo "<tr>";
	   for($i = 0; $i < count($rows); $i++)
	   echo "<td>&nbsp;".$rows[$i]."</td>";
	   echo "</tr>";
    }
    echo "</tr></table>";
}
else 
{
    echo "未发现上传视频";
}

?>
</body>
</html>