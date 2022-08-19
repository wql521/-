<?php

class Mysql_DB
{
// 定义属性
    public string $host='localhost';  // 数据库主机名
    public string $user='root';  // 数据库用户名
    public string $password='wangqianlong0';  // 数据库密码
    public string $dbname='Users';    // 数据库名

// 增加数据
public function add($connID,$table,$data)
{
    $keys=join(",",array_keys($data));  // 获取数组的键名
    $vals="'".join("','",array_values($data))."'";  // 获取数组的键值
    $sql="insert into {$table}({$keys}) values({$vals})";   // 创建sql语句
    mysqli_query($connID,$sql); // 执行sql语句
}
// 删除数据
public function delete($connID,$table,$where)
{
    $where="delete from {$table} where {$where}";   // 创建sql语句
    mysqli_query($connID,$where);   // 执行sql语句
}
// 更新数据
public function update($connID,$table,$data,$where)
{
    foreach ($data as $key => $val) {   // 遍历数组
        $val="'$val'";  // 将键值转换为字符串
        $keyArr[]="{$key}={$val}";  // 将键值放入数组
    }
    $keystr=join(",",$keyArr);  // 将数组转换为字符串
    $where="update {$table} set {$keystr} where {$where}";  // 创建sql语句
    mysqli_query($connID,$where);   // 执行sql语句
}
// 查询数据
public function select($connID,$table,$where)
{
    $where="select * from {$table} where {$where}"; // 创建sql语句
    $result=mysqli_query($connID,$where);   // 执行sql语句
    while ($row=mysqli_fetch_assoc($result)) {  // 将查询结果转换为数组
        $rows[]=$row;   // 将数组放入数组
    }
    return $rows;   // 返回数组
}
// 查询数据总数
public function selectAll($connID,$table)
{
    $sql="select * from {$table}";  // 创建sql语句
    $result=mysqli_query($connID,$sql);  // 执行sql语句
    $num=mysqli_num_rows($result);  // 获取查询结果的行数
    return $num;    // 返回行数
}
// 查询数据总数
public function selectPage($connID,$table,$page,$pagesize)
{
    $sql="select * from {$table} limit {$page},{$pagesize}";    // 创建sql语句
    $result=mysqli_query($connID,$sql); // 执行sql语句
    while ($row=mysqli_fetch_assoc($result)) {  // 将查询结果转换为数组
        $rows[]=$row;   // 将数组放入数组
    }
    return $rows;   // 返回数组
}
// 关闭数据库连接
public function close($connID): void
{
    mysqli_close($connID);  // 关闭数据库连接
}

    public function connect(): bool|mysqli
    {
        // 连接数据库
        return mysqli_connect($this->host,$this->user,$this->password,$this->dbname); // 返回连接标识符
    }
}
