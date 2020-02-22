<?php
/*
 * @Author: your name
 * @Date: 2019-12-30 16:25:14
 * @LastEditTime : 2020-01-09 21:20:44
 * @LastEditors  : Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \pro\jingcaishenghuo\admin\settings.php
 */

// 页面访问权限控制
// 校验数据当前访问的用户的 箱子（session）有没有登录的登录标识
require_once '../function.php';
sean_get_current_user();



//处理表单请求
//---------------------------

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['site_logo'])) {
        sean_execute(sprintf('update `options` set `value` = \'%s\' where `key` = \'site_logo\'', $_POST['site_logo']));
    }
    if (!empty($_POST['site_name'])) {
        sean_execute(sprintf('update `options` set `value` = \'%s\' where `key` = \'site_name\'', $_POST['site_name']));
    }
    if (!empty($_POST['site_description'])) {
        sean_execute(sprintf('update `options` set `value` = \'%s\' where `key` = \'site_description\'', $_POST['site_description']));
    }
    if (!empty($_POST['site_keywords'])) {
        sean_execute(sprintf('update `options` set `value` = \'%s\' where `key` = \'site_keywords\'', $_POST['site_keywords']));
    }

    sean_execute(sprintf('update `options` set `value` = \'%s\' where `key` = \'comment_status\'', !empty($_POST['comment_status'])));

    sean_execute(sprintf('update `options` set `value` = \'%s\' where `key` = \'comment_reviewed\'', !empty($_POST['comment_reviewed'])));
}

//查询数据
//==============================
$data = sean_fetch_all('select * from options');
$options = array();

foreach ($data as $item) {
    $options[$item['key']] = $item['value'];
}


?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台管理-网站设置</title>
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
                <h1>网站设置</h1>
            </div>
            <form class="form-horizontal" action="/pro/jingcaishenghuo/admin/settings.php" method="post">
                <div class="form-group">
                    <label for="site_logo" class="col-sm-2 control-label">网站图标</label>
                    <div class="col-sm-6">
                        <input id="site_logo" name="site_logo" type="hidden">
                        <label class="form-image">
                            <input id="upload" type="file">
                            <img src="<?php echo $options['site_logo']; ?>">
                            <i class="mask fa fa-upload"></i>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="site_name" class="col-sm-2 control-label">站点名称</label>
                    <div class="col-sm-6">
                        <input id="site_name" name="site_name" class="form-control" type="type" value="<?php echo $options['site_name']; ?>" placeholder="站点名称">
                    </div>
                </div>
                <div class="form-group">
                    <label for="site_description" class="col-sm-2 control-label">站点描述</label>
                    <div class="col-sm-6">
                        <textarea id="site_description" name="site_description" class="form-control" placeholder="站点描述" cols="30" rows="6"><?php echo $options['site_description']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="site_keywords" class="col-sm-2 control-label">站点关键词</label>
                    <div class="col-sm-6">
                        <input id="site_keywords" name="site_keywords" class="form-control" type="type" value="<?php echo $options['site_keywords']; ?>" placeholder="站点关键词">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">评论</label>
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label><input id="comment_status" name="comment_status" type="checkbox" <?php echo $options['comment_status'] ? ' checked' : ''; ?>>开启评论功能</label>
                        </div>
                        <div class="checkbox">
                            <label><input id="comment_reviewed" name="comment_reviewed" type="checkbox" <?php echo $options['comment_reviewed'] ? ' checked' : ''; ?>>评论必须经人工批准</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="submit" class="btn btn-primary">保存设置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php $current_page = 'settings'; ?>
    <?php include 'inc/sidebar.php'; ?>

    <script src="/pro/jingcaishenghuo/static/assets/vendors/jquery/jquery-2.2.4.js"></script>
    <script src="/pro/jingcaishenghuo/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script>
        $(function() {
            // 异步上传文件
            $('#upload').on('change', function() {
                // 选择文件后异步上传文件   html5 连接ajax
                var formData = new FormData()
                formData.append('file', $(this).prop('files')[0])

                // 上传图片
                $.ajax({
                    url: '/pro/jingcaishenghuo/admin/api/upload.php',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    type: 'post',
                    success: function(res) {
                        if (res.success) {
                            $('#site_logo').val(res.data)
                            $('#upload').siblings('img').attr('src', res.data).fadeIn()
                        } else {
                            alert('上传文件失败')
                        }
                    }
                })
            })
        })
    </script>

    <script>
        NProgress.done()
    </script>

</body>

</html>