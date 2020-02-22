<?php
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
    <title>后台管理-导航菜单</title>
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
                <h1>导航菜单</h1>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <form>
                        <h2>添加新导航链接</h2>
                        <div class="form-group">
                            <label for="text">
                                文本
                            </label>
                            <input type="text" name="text" id="text" class="form-control" placeholder="文本">
                        </div>
                        <div class="form-group">
                            <label for="title">
                                标题
                            </label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="标题">
                        </div>
                        <div class="form-group">
                            <label for="href">
                                链接
                            </label>
                            <input type="text" class="form-control" name="href" id="href" placeholder="链接">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary">添加</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="page-action">
                        <a href="javascript:;" class="btn btn-danger btn-sm" style="display: none">批量删除</a>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" width="40"><input type="checkbox"></th>
                                <th>文本</th>
                                <th>标题</th>
                                <th>链接</th>
                                <th class="text-center" width="100">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><input type="checkbox"></td>
                                <td><i class="fa fa-glass"></i>奇趣事</td>
                                <td>奇趣事</td>
                                <td>#</td>
                                <td class="text-center">
                                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="checkbox"></td>
                                <td><i class="fa fa-phone"></i>潮科技</td>
                                <td>潮科技</td>
                                <td>#</td>
                                <td class="text-center">
                                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="checkbox"></td>
                                <td><i class="fa fa-fire"></i>会生活</td>
                                <td>会生活</td>
                                <td>#</td>
                                <td class="text-center">
                                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <?php $current_page = 'nav-menus'; ?>
    <?php include 'inc/sidebar.php'; ?>

    <script src="/pro/jingcaishenghuo/static/assets/vendors/jquery/jquery-2.2.4.js"></script>
    <script src="/pro/jingcaishenghuo/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script>
        NProgress.done()
    </script>


</body>

</html>