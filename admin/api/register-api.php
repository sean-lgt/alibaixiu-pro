<?php
/*
 * @Author: your name
 * @Date: 2020-01-12 22:41:25
 * @LastEditTime: 2020-01-13 11:55:17
 * @LastEditors: your name
 * @Description: In User Settings Edit
 * @FilePath: \pro\jingcaishenghuo\admin\api\register-api.php
 */

include_once '../../config.php';
// 连接数据库
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

/**
 * 表单校验三大步骤
 * 接收并校验 持久化  响应
 * 
 *  */

$email = $_POST['email'];
$sql = "select * from users where email='$email'";
$res = $conn->query($sql);
if ($email == "" || $res->num_rows > 0) {
    //echo "用户已经存在!";
    $data = array("status" => 1, "msg" => "邮箱已被注册了！");
} else {
    //echo "用户可以使用!";
    $data = array("status" => 2, "msg" => "");
}
echo json_encode($data);
