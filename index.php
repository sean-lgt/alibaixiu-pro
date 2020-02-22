<!--
/*
 * @Author: your name
 * @Date: 2019-12-27 14:24:24
 * @LastEditTime: 2020-01-09 19:40:23
 * @LastEditors: your name
 * @Description: In User Settings Edit
 * @FilePath: \pro\jingcaishenghuo\index.php
 */
 * @Author: your name
 * @Date: 2019-12-27 14:24:24
 * @LastEditTime: 2019-12-27 15:45:49
 * @LastEditors: your name
 * @Description: In User Settings Edit
 * @FilePath: \jingcailshenghuo\index.html
 -->
<?php

// 引进配置文件
include_once('config.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>精彩生活</title>
</head>

<body>

    <?php
    // 载入配置文件
    require 'config.php';
    ?>
    <h1>前台</h1>
    <p><?php echo DB_HOST; ?></p>
    <p><a href="/pro/jingcaishenghuo/admin/">管理系统</a></p>
</body>

</html>