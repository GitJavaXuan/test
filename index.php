<?php
/**
 * Created by PhpStorm.
 * User: Xuan
 * Date: 2019/3/28
 * Time: 10:12
 */
?>
<html>
    <head>
        <title>显示主页</title>
    </head>
    <body>
                <?php
                    $type = "";
                    $host = "127.0.0.1";//地址ip
                    $user = "root";//账号
                    $password = "root";//密码
                    $database = "jdbc";//数据库名
                    if(is_array($_GET)&&count($_GET)>0||is_array($_POST)&&count($_POST)>0){
                        if (isset($_GET['do'])||isset($_POST['do'])){
                            if (isset($_GET['do'])){
                                $type = $_GET['do'];
                            }else{
                                $type = $_POST['do'];
                            }
                            if(!strcmp($type,'index')||$type == null){
                                $con = mysqli_connect($host,$user,$password,$database);//获取连接对象
                                if (!$con){
                                    die("数据库连接出现错误:".mysqli_error($con));
                                }
                                $sql = "select * from userlist";//编写sql语句
                                $result = mysqli_query($con,$sql);//执行sql语句
                                mysqli_query($con,"set names UTF8");
                                if (!$result){
                                    die("查询数据出现错误:".mysqli_error($con));
                                }
                                echo "<table border='1' style='border:red'><tr><td>序号</td><td>账号</td><td>昵称</td><td>性别</td><td>年龄</td><td>选项</td></tr>";
                                while($row = mysqli_fetch_array($result)){
                                    $sex = '男';
                                    if($row['sex']==1){
                                        $sex = '女';
                                    }
                                    echo "<tr><td>{$row['id']}</td><td>{$row['account']}</td><td>{$row['username']}</td><td>{$sex}</td><td>{$row['age']}</td>
                                          <td><a href='index.php?do=update&id={$row['id']}'>修改</a> <a href='index.php?do=delete&id={$row['id']}'>删除</a></td></tr>";
                                }
                                echo "</table>";
                                mysqli_free_result($result);//释放对象
                                mysqli_close($con);//关闭数据库连接
                            }else if(!strcmp($type,'delete')){
                                $con = mysqli_connect($host,$user,$password,$database);//获取连接对象
                                $sql = "delete from userlist where id=".$_GET['id'];//编写sql语句
                                $result = mysqli_query($con,$sql);
                                if (!$result){
                                    die("删除数据出现错误:".mysqli_error($con));
                                }
                                mysqli_close($con);//关闭数据库连接
                                echo "<script>alert('删除成功');location.href='index.php?do=index'</script>";
                            }else if(!strcmp($type,'update')){
                                if (isset($_GET['id'])){
                                    $id = $_GET['id'];
                                    echo "<form action='index.php' method='post'>";
                                    echo "<input type='hidden' name='id' value='{$id}'/>";
                                    echo "<input type='hidden' name='do' value='up'/>";
                                    echo "账号:<input type='text' name='account'/></br>";
                                    echo "密码:<input type='password' name='password'/></br>";
                                    echo "昵称:<input type='text' name='username'/></br>";
                                    echo "年龄:<input type='text' name='age'/></br>";
                                    echo "性别:<input type='radio' name='sex' value='0'/>男<input type='radio' name='sex' value='1'/>女</br>";
                                    echo "<input type='submit' value='保存'/>";
                                    echo "</form>";
                                }
                            }else if (!strcmp($type,'up')){
                                if (isset($_POST['id'])){
                                    $con = mysqli_connect($host,$user,$password,$database);
                                    $sql = "update userlist set account=".$_POST['account'].",password=".$_POST['password'].",username=".$_POST['username'].",age=".$_POST['age'].",sex=".$_POST['sex']." where id=".$_POST['id'];
                                    $result = mysqli_query($con,$sql);
                                    if(!$result){
                                        die("更新失败:".mysqli_error($con));
                                    }
                                    echo "<script>alert('保存成功');location.href='index.php?do=index'</script>";
                                }
                            }else if(!strcmp($type,'add')){
                                echo "<form action='index.php' method='post'>";
                                echo "<input type='hidden' name='do' value='addc'/>";
                                echo "账号:<input type='text' name='account'/></br>";
                                echo "密码:<input type='password' name='password'/></br>";
                                echo "昵称:<input type='text' name='username'/></br>";
                                echo "年龄:<input type='text' name='age'/></br>";
                                echo "性别:<input type='radio' name='sex' value='0'/>男<input type='radio' name='sex' value='1'/>女</br>";
                                echo "<input type='submit' value='新增'/>";
                                echo "</form>";
                            }else if (!strcmp($type,'addc')){
                                $con = mysqli_connect($host,$user,$password,$database);
                                $sql = "INSERT INTO userlist (`account`,`password`,`username`,`sex`,`age`) VALUES(".$_POST['account'].",".$_POST['password'].",".$_POST['username'].",".$_POST['age'].",".$_POST['sex'] .")";
                                echo $sql;
                                $result = mysqli_query($con,$sql);
                                if(!$result){
                                    die("新增失败:".mysqli_error($con));
                                }
                                echo "<script>alert('新增成功');location.href='index.php?do=index'</script>";
                            }else if (!strcmp($type,'login')){
                                echo "<form method='post' action=index.php>";
                                echo "<input type=text required=required placeholder=账号 name='account' id='account'/>";
                                echo "<input type='hidden' name='do' value='register'/>";
                                echo "<input type=password required=required placeholder=密码 name='password' id='password'/>";
                                echo "<button class=but type=submit>登录</button>";
                                echo "</form>";
                            }else if (!strcmp($type,'register')){
                                $con = mysqli_connect($host,$user,$password,$database);
                                $sql = "SELECT * FROM `userlist` WHERE `ACCOUNT` = (".$_POST['account'].")  AND `PASSWORD` = (".$_POST['password'].")";
                                $result = mysqli_query($con,$sql);
                                if (!$result){
                                    echo "<script>alert('登录失败');location.href='index.php?do=login'</script>";
                                }
                                echo "<script>alert('登录成功');location.href='index.php?do=index'</script>";
                            }else{
                                echo "参数无效".$type;
                            }
                        }else{
                                echo "请不要非法访问!";
                        }
                    }
                ?>
    </body>
</html>
