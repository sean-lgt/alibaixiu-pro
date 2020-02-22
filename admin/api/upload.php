<?php
/*
 * @Author: your name
 * @Date: 2020-01-09 21:07:42
 * @LastEditTime : 2020-01-27 14:52:43
 * @LastEditors  : Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \pro\jingcaishenghuo\admin\api\upload.php
 */

//接收用户 文件上传请求

// 如果选择了文件 $_FILES['file']['error'] =>0
if (empty($_FILES['file']['error'])) {
    // php会自动接收客户端上传的文件到一个临时目录
    $temp_file = $_FILES['file']['tmp_name'];
    // 我们只需把文件保存到我们指定上传的目录
    $target = '../../static/uploads/' . uniqid() . '-' . $_FILES['file']['name'];
    if (move_uploaded_file($temp_file, $target)) {
        $image_file = '/pro/jingcaishenghuo/static/uploads/' . uniqid() . '-' . $_FILES['file']['name'];
    }
}

// 设置响应类型为JSON
header('Content-Type:application/json');

if (empty($image_file)) {
    echo json_encode(array(
        'success' => false
    ));
} else {
    echo json_encode(array(
        'success' => true,
        'data' => $image_file
    ));
}
