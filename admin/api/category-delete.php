<?php

/**
 * 根据客户端传过来的ID删除对应数据
 */

require_once '../function.php';

if (empty($_GET['id'])) {
    exit('缺少必要参数');
}

$id = $_GET['id'];

$rows = sean_execute('delete from categories where id in (' . $id . ')');

header('Location: /pro/jingcaishenghuo/admin/categories.php');
