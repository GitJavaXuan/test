<?php
/**
 * Created by PhpStorm.
 * User: 岚
 * Date: 2019/3/27
 * Time: 13:54
 */
$mysql_server_name="localhost";
$mysql_username="root";
$mysql_password="root";
$mysql_database="jdbc";
$update_account="唐海岚";
$update_password="999";
$mysqli=new mysqli($mysql_server_name,$mysql_username,$mysql_password,$mysql_database);
$sql="UPDATE `userlist` SET `password` = '$update_password' WHERE `account`='$update_account'";
if ($mysqli->query($sql)==TRUE){
    echo "修改成功！";
}else{
    echo "修改失败！";
}