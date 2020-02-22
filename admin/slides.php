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
    <title>后台管理-图片轮播</title>
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
                <h1>图片轮播</h1>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <form>
                        <h2>添加新的轮播内容</h2>
                        <div class="form-group">
                            <lable for="image">图片</lable>
                            <img src="" alt="" class="help-block thumbnail" style="display:none">
                            <input type="file" id="image" name="image" class="form-control">
                        </div>
                        <div class="form-group">
                            <lable for="text">文本</lable>
                            <input type="text" id="text" name="text" class="form-control" placeholder="文本">
                        </div>
                        <div class="form-group">
                            <lable for="link">连接</lable>
                            <input type="text" id="link" name="link" class="form-control" placeholder="链接">
                        </div>
                        <div class="form-group">
                            <button class="btn brn-primary" type="submit">添加</button>
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
                                <th class="text-center">图片</th>
                                <th>文本</th>
                                <th>链接</th>
                                <th class="text-center" width="100">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><input type="checkbox" name="" id=""></td>
                                <td class="text-center"><img class="slide" src="/pro/jingcaishenghuo/static/uploads/slide_1.jpg" alt=""></td>
                                <td>sean功能演示</td>
                                <td>#</td>
                                <td class="text-center">
                                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center"><input type="checkbox" name="" id=""></td>
                                <td class="text-center"><img class="slide" src="/pro/jingcaishenghuo/static/uploads/slide_2.jpg" alt=""></td>
                                <td>sean功能演示</td>
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

    <?php $current_page = 'slides'; ?>
    <?php include 'inc/sidebar.php'; ?>

    <script src="/pro/jingcaishenghuo/static/assets/vendors/jquery/jquery-2.2.4.js"></script>
    <script src="/pro/jingcaishenghuo/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script>
        NProgress.done()
    </script>


</body>

</html>