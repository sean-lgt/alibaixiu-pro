<?php
/*
 * @Author: your name
 * @Date: 2020-01-09 19:10:37
 * @LastEditTime : 2020-01-09 19:16:54
 * @LastEditors  : Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \pro\jingcaishenghuo\admin\api\comment-delete.php
 */

/**
 * 删除评论
 */

// 引进function 文件 
require_once '../../function.php';

// 设置响应类型为JSON
header('Content-Type:application/json');

if (empty($_GET['id'])) {
    // 缺少必要参数
    exit(json_encode(
        array(
            'success' => false,
            'message' => '缺少必要参数'
        )
    ));
}

// 拼接Sql  并执行

$affected_row = sean_execute(sprintf('delete from comments where id in(%s)', $_GET['id']));

//输出结果
echo json_encode(array(
    'success' => $affected_row > 0
));
