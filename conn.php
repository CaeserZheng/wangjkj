<?php

    error_reporting(0);
    $mysql_servername = "127.0.0.1"; //主机地址
    $mysql_username = "root"; //数据库用户名
    $mysql_password ="zgl3010"; //数据库密码
    $mysql_database ="wangjkj"; //数据库
    /*
    $conn = mysql_connect($mysql_servername , $mysql_username , $mysql_password);
    if (mysqli_connect_errno()) {
        echo "连接数据库失败!";
        exit;
    }
    $db_selected = mysql_select_db($mysql_database,$conn);
    if (!$db_selected)
    {
        die ("Can\'t use test_db : " . mysql_error());
    }
    return $db_selected;
    */
    $db=mysql_connect($mysql_servername,$mysql_username,$mysql_password,$mysql_database);
    if (mysqli_connect_errno()) {
        echo "连接数据库失败!";
        exit;
    }
    return $db;
