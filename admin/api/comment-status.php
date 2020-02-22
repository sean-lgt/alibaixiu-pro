<?php
/*
 * @Author: your name
 * @Date: 2020-01-09 19:17:06
 * @LastEditTime: 2020-01-09 19:25:33
 * @LastEditors: your name
 * @Description: In User Settings Edit
 * @FilePath: \pro\jingcaishenghuo\admin\api\comment-status.php
 */

/**
 * 修改评论状态
 */

/**
 *POST 方式请求 
 * -id 参数在URL中
 *-statu 参数 在 form-data中
 * 两种参数混着用
 */

require_once '../../function.php';

//   设置响应类型为 JSON
header('Content-Type: application/json');

if (empty($_GET['id']) || empty($_POST['status'])) {
    // 缺少必要参数
    exit(json_encode(array(
        'success' => false,
        'message' => '缺少必要参数'
    )));
}


// 拼接SQL并执行
$affected_rows = sean_execute(sprintf("update comments set status = '%s' where id in (%s)", $_POST['status'], $_GET['id']));
// 输出结果
echo json_encode(array(
    'success' => $affected_rows > 0
));
