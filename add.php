<?php
/**新增的demo
 * Created by PhpStorm.
 * User: Xuan
 * Date: 2019/3/27
 * Time: 11:19
 */
$host = "127.0.0.1";//连接的ip
$user = "root";//账号
$password = "root";//密码
$database = "jdbc";//需要操作的数据库
$con =mysqli_connect($host,$user,$password,$database);//启动连接
if (!$con){
    die ("数据库连接出现错误".mysqli_error($con));
    return;
}
echo "数据库连接成功.......";
$account   = "123456789";
$password = "123zxvb";
mysqli_query($con,"set names UTF-8");//设置插入字符编码格式
$sql = "INSERT INTO userlist (`account`,`password`)"." VALUES"."('$account','$password')";//编写sql语句
$status = mysqli_query($con,$sql);//执行sql语句
if (!$status){
    die ("插入出现错误".mysqli_error($con));
}
echo "插入成功";
mysqli_close($con);//关闭数据库连接
absdjkhb