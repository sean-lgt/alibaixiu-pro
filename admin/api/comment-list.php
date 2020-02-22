<?php
/*
 * @Author: your name
 * @Date: 2020-01-07 14:14:48
 * @LastEditTime : 2020-01-09 18:07:57
 * @LastEditors  : Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \pro\jingcaishenghuo\admin\api\comments.php
 */

//接收客户端的AJAX请求 返回评论数据

//载入封装的所有函数
require_once '../../function.php';

// 处理分页参数
// ========================================

// 页码
$page = isset($_GET['p']) && is_numeric($_GET['p']) ? intval($_GET['p']) : 1;

// 页大小
$size = isset($_GET['s']) && is_numeric($_GET['s']) ? intval($_GET['s']) : 20;

// 检查页码最小值
if ($page <= 0) {
    header('Location: /pro/jingcaishenghuo/admin/api/comment-list.php?p=1&s=' . $size);
    exit;
}

// 查询总条数
$total_count = intval(sean_fetch_all('select count(1) from comments
inner join posts on comments.post_id = posts.id')[0][0]);

// 计算总页数
$total_pages = ceil($total_count / $size);

// 检查页码最大值
if ($page > $total_pages) {
    // 跳转到最后一页
    header('Location: /pro/jingcaishenghuo/admin/api/comment-list.php?p=' . $total_pages . '&s=' . $size);
    exit;
}

// 查询数据
// ========================================

// 分页查询评论数据
$comments = sean_fetch_all(sprintf('select
  comments.*, posts.title as post_title
from comments
inner join posts on comments.post_id = posts.id
order by comments.created desc
limit %d, %d', ($page - 1) * $size, $size));

// 响应 JSON
// ========================================

// 设置响应类型为 JSON
header('Content-Type: application/json');

// 输出 JSON
echo json_encode(array(
    'success' => true,
    'data' => $comments,
    'total_count' => $total_count
));









//处理分页参数
//============================================


// //页码
// $page = empty($_GET['page']) ? 1 : intval($_GET['page']);

// // 页大小
// $size = 30;

// // // 检查页码最小值
// // if ($page <= 0) {
// //     header('Location:/pro/jingcaishenghuo/admin/api/comment-list.php?p=1&s=' . $size);
// //     exit;
// // }


// $sql = sprintf('select 
//      comments.*,posts.title as post_title
//      from comments
//      inner join posts on comments.post_id = posts.id
//      order by comments.created desc
//      limit 0,30,
//  ');


// // //查询所有的评论数据
// $comments = sean_fetch_all($sql);

// //因为网络之间的传输只能是字符串
// //所以要讲数据转成字符串（序列化）
// $json = json_encode($comments);

// //
// header('Content-Type: application/json');

// //响应给客户端
// echo $json;
// // echo $comments;
