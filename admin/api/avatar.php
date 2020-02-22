<?php
/*
 * @Author: your name
 * @Date: 2020-01-02 13:54:56
 * @LastEditTime: 2020-01-02 18:19:20
 * @LastEditors: your name
 * @Description: In User Settings Edit
 * @FilePath: \pro\jingcaishenghuo\admin\api\avatar.php
 */

/**
 * 根据用户邮箱 获取用户头像
 * 
 */
require_once '../../config.php';

//1.接收传递过来的邮箱
if (empty($_GET['email'])) {
    exit("缺少必要参数");
}

$emali = $_GET['email'];

// 查询对应的头像
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$conn) {
    exit("连接数据库失败");
}

$res = mysqli_query($conn, "select avatar from users where email = '{$emali}' limit 1;");
if (!$res) {
    exit("查询失败");
}

$row = mysqli_fetch_assoc($res);

echo $row['avatar'];
