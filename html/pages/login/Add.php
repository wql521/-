<?php
header("content-type:text/html;charset=utf-8");
require 'Mysql_DB.php'; // 引入数据库连接文件
$db=new Mysql_DB(); // 实例化对象
$connID=$db->connect(); // 连接数据库
if ($connID) { // 判断是否连接成功
    echo "数据库连接成功"; // 数据库连接成功
}
else
{
    echo "数据库连接失败"; // 数据库连接失败
}
//接收$_POST用户名和密码
$zhanghao=$_POST['zhanghao'];   // 接收用户名
echo $zhanghao; // 输出用户名
$password=$_POST['password'];   // 获取密码
echo $password; // 输出密码
$username=$_POST['username'];   // 获取姓名
echo $username; // 输出姓名
$userphone=$_POST['userphone'];   // 获取手机号
echo $userphone; // 输出手机号
$usermail=$_POST['usermail'];   // 获取邮箱
echo $usermail; // 输出邮箱

$ID=rand(1,10000); // 生成随机ID
echo $ID; // 输出随机ID

$sql_select = "SELECT * FROM users WHERE  IP='$ID'"; // 查询语句
$result = mysqli_query($connID,$sql_select); // 执行查询语句
$row = mysqli_fetch_array($result); // 获取查询结果
while ($row['IP']==$ID) { // 判断查询结果是否与随机ID相同
    echo "查询结果与随机ID相同"; // 查询结果与随机ID相同
    $ID=rand(1,10000); // 重新生成随机ID
    echo $ID; // 输出随机ID

    $sql_select = "SELECT * FROM users WHERE  IP='$ID'"; // 查询语句
    $result = mysqli_query($connID,$sql_select); // 执行查询语句
    $row = mysqli_fetch_array($result); // 获取查询结果
}

echo "查询结果与随机ID不相同"; // 查询结果与随机ID不相同
$db->add($connID,'users',['IP'=>$ID,'zhanghao'=>$zhanghao,'password'=>$password,'username'=>$username,'userphone'=>$userphone,'usermail'=>$usermail]); // 选择数据库
$db->close($connID); // 关闭数据库连接
echo "添加成功"; // 输出成功
//header("refresh:3;url=http://www.wangqianlong.com/pages/3d/xinxin.html");
//print "3秒后跳转到首页";   // 输出成功