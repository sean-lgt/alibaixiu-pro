<?php
/*
 * @Author: your name
 * @Date: 2019-12-30 12:47:50
 * @LastEditTime: 2020-01-05 21:37:28
 * @LastEditors: your name
 * @Description: In User Settings Edit
 * @FilePath: \pro\jingcaishenghuo\admin\password-reset.php
 */

// 页面访问权限控制
// 校验数据当前访问的用户的 箱子（session）有没有登录的登录标识
require_once '../function.php';
sean_get_current_user();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台管理-密码重置</title>
    <link rel="stylesheet" href="/pro/jingcaishenghuo/static/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/pro/jingcaishenghuo/static/assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/pro/jingcaishenghuo/static/assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="/pro/jingcaishenghuo/static/assets/css/admin.css">
    <script src="/pro/jingcaishenghuo/static/assets/vendors/nprogress/nprogress.js"></script>
</head>

<body>

    <script>
        NProgress.start()
    </script>
    <div class="main">
        <?php include 'inc/navbar.php'; ?>

        <div class="container-fluid">
            <div class="page-title">
                <h1>修改密码</h1>
            </div>
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="old" class="col-sm-3 control-label">旧密码</label>
                    <div class="col-sm-7">
                        <input id="old" class="form-control" type="password" placeholder="旧密码">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">新密码</label>
                    <div class="col-sm-7">
                        <input id="password" class="form-control" type="password" placeholder="新密码">
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm" class="col-sm-3 control-label">确认新密码</label>
                    <div class="col-sm-7">
                        <input id="confirm" class="form-control" type="password" placeholder="确认新密码">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-7">
                        <button type="submit" class="btn btn-primary">修改密码</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php $current_page = 'password-reset'; ?>
    <?php include 'inc/sidebar.php'; ?>

    <script src="/pro/jingcaishenghuo/static/assets/vendors/jquery/jquery-2.2.4.js"></script>
    <script src="/pro/jingcaishenghuo/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script>
        NProgress.done()
    </script>
</body>

</html>