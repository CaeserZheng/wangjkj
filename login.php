<?
error_reporting(0);
$mysql_servername = "127.0.0.1"; //主机地址
$mysql_username = "root"; //数据库用户名
$mysql_password ="zgl3010"; //数据库密码
$mysql_database ="wangjkj"; //数据库
mysql_connect($mysql_servername , $mysql_username , $mysql_password);
mysql_select_db($mysql_database); 
$name=$_POST['name'];
$passowrd=$_POST['password'];
session_start();
$_SESSION['uname']=$name;
#$echo $_SESSION['uname'];

if ($name && $passowrd){
 $sql = "SELECT * FROM user WHERE uname = '$name' and pword='$passowrd'";
 #echo $sql;
 $res = mysql_query($sql);
 $rows=mysql_num_rows($res);
 #echo $rows;
  if($rows){
   #header("refresh:0;url=manage.php");//跳转页面，注意路径
   header("Location: content/index.php?user=$name");
   exit;
 }
 echo "<script language=javascript>alert('用户名密码错误');history.back();</script>";
}else {
 echo "<script language=javascript>alert('用户名密码不能为空');history.back();</script>";
}
?>