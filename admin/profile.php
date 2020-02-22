<?php
/*
 * @Author: your name
 * @Date: 2019-12-30 13:55:13
 * @LastEditTime: 2020-01-05 21:37:55
 * @LastEditors: your name
 * @Description: In User Settings Edit
 * @FilePath: \pro\jingcaishenghuo\admin\profile.php
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
    <title>后台管理-个人资料</title>
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
                <h1>我的个人资料</h1>
            </div>
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-3 control-label">头像</label>
                    <div class="col-sm-6">
                        <label class="form-image">
                            <input id="avatar" type="file">
                            <img src="/pro/jingcaishenghuo/static/assets/img/default.png">
                            <i class="mask fa fa-upload"></i>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">邮箱</label>
                    <div class="col-sm-6">
                        <input id="email" class="form-control" name="email" type="type" value="sean@com" placeholder="邮箱" readonly>
                        <p class="help-block">登录邮箱不允许修改</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="slug" class="col-sm-3 control-label">别名</label>
                    <div class="col-sm-6">
                        <input id="slug" class="form-control" name="slug" type="type" value="sean涛" placeholder="slug">
                        <p class="help-block">https://sean.xyz/post/<strong>slug</strong></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nickname" class="col-sm-3 control-label">昵称</label>
                    <div class="col-sm-6">
                        <input id="nickname" class="form-control" name="nickname" type="type" value="sean涛" placeholder="昵称">
                        <p class="help-block">限制在 2-16 个字符</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="bio" class="col-sm-3 control-label">简介</label>
                    <div class="col-sm-6">
                        <textarea id="bio" class="form-control" placeholder="Bio" cols="30" rows="6">一屋两人，三餐四季</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary">更新</button>
                        <a class="btn btn-link" href="password-reset.html">修改密码</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php $current_page = 'profile'; ?>
    <?php include 'inc/sidebar.php'; ?>

    <script src="/pro/jingcaishenghuo/static/assets/vendors/jquery/jquery-2.2.4.js"></script>
    <script src="/pro/jingcaishenghuo/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script>
        NProgress.done()
    </script>
</body>

</html>