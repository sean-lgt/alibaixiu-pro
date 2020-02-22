<?php
/*
 * @Author: your name
 * @Date: 2019-12-30 13:07:20
 * @LastEditTime : 2020-01-26 23:45:43
 * @LastEditors  : Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \pro\jingcaishenghuo\admin\post-add.php
 */

// 页面访问权限控制
// 校验数据当前访问的用户的 箱子（session）有没有登录的登录标识
require_once '../function.php';

sean_get_current_user();

// 处理提交请求
// ===========================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 数据校验
    // ---------------------------------
    if (empty($_POST['slug']) || empty($_POST['title']) || empty($_POST['created']) || empty($_POST['content']) || empty($_POST['status']) || empty($_POST['category'])) {
        $message = '请完整填写所有内容';
    } else if (sean_fetch_all(sprintf("select count(1) from posts where slug = '%s'", $_POST['slug']))[0][0] > 0) {
        $message = '别名已经存在，请修改别名';
    } else {


        // 如果选择了文件 $_FILES['file']['error'] =>0
        if (empty($_FILES['file']['error'])) {
            // php会自动接收客户端上传的文件到一个临时目录
            $temp_file = $_FILES['file']['tmp_name'];
            // 我们只需把文件保存到我们指定上传的目录
            $target = 'D:/phpstudy_pro/WWW/pro/jingcaishenghuo/static/uploads/' . uniqid() . '-' . $_FILES['file']['name'];
            if (move_uploaded_file($temp_file, $target)) {
                $image_file = '/pro/jingcaishenghuo/static/uploads/' . uniqid() . '-' . $_FILES['file']['name'];
            } else {
                $image_file = " ";
            }
        }

        // var_dump($image_file);


        // 接收数据
        $slug = $_POST['slug'];
        $title = $_POST['title'];
        $feature = isset($image_file) ? $image_file : '';
        $created = $_POST['created'];
        $content = $_POST['content'];
        $status = $_POST['status'];
        $user_id = $_SESSION['current_login_user']['id'];
        $category_id = $_POST['category'];


        // 保存数据
        // ---------------------------------------------

        // 拼接查询语句
        $sql = sprintf("insert into posts values (null,'%s','%s','%s','%s','%s',0,0,'%s','%d','%d')", $slug, $title, $feature, $created, $content, $status, $user_id, $category_id);

        // 执行 SQL 保存数据
        if (sean_execute($sql) > 0) {
            // 保存成功  跳转
            header('Location: /pro/jingcaishenghuo/admin/posts.php');
            exit;
        } else {
            //保存失败
            $message = "保存失败，请重试";
        }
    }
}

// 查询数据
// =======================================

// 查询全部分类数据
$categories = sean_fetch_all('select * from categories');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台管理-写文章</title>
    <link rel="stylesheet" href="/pro/jingcaishenghuo/static/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/pro/jingcaishenghuo/static/assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/pro/jingcaishenghuo/static/assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="/pro/jingcaishenghuo/static/assets/css/admin.css">
    <link rel="stylesheet" href="/pro/jingcaishenghuo/static/assets/vendors/simplemde/simplemde.min.css">
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
                <h1>写文章</h1>
            </div>
            <?php if (isset($message)) : ?>
                <div class="alert alert-danger">
                    <strong>错误!</strong><?php echo $message; ?>
                </div>
            <?php endif; ?>
            <form class="row" action="/pro/jingcaishenghuo/admin/post-add.php" method="post" enctype="multipart/form-data">
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="title">标题</label>
                        <input id="title" class="form-control input-lg" name="title" type="text" value="<?php echo isset($_POST['title']) ? $_POST['title'] : ''; ?>" placeholder="文章标题">
                    </div>
                    <div class="form-group">
                        <label for="content">
                            内容
                        </label>
                        <script id="content" name="content" type="text/plain" placeholder="内容"><?php echo isset($_POST['content']) ? $_POST['content'] : ''; ?></script>
                        <!-- <textarea name="content" id="content" cols="30" rows="10" class="form-control input-lg" placeholder="内容"></textarea> -->
                    </div>
                </div>
                <div class="col-md-3">

                    <div class="form-group">
                        <label for="slug">别名</label>
                        <input id="slug" class="form-control" name="slug" type="text" value="<?php echo isset($_POST['slug']) ? $_POST['slug'] : ''; ?>" placeholder="slug">
                        <p class="help-block">https://sean.xyz/post/<strong><?php echo isset($_POST['slug']) ? $_POST['slug'] : 'slug'; ?></strong></p>
                    </div>
                    <div class="form-group">
                        <label for="file">特色图像</label>
                        <!-- show when image chose -->
                        <img class="help-block thumbnail" style="display: none">
                        <input id="feature" class="form-control" name="file" type="file" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="category">所属分类</label>
                        <select id="category" class="form-control" name="category">
                            <?php foreach ($categories as $item) { ?>
                                <option value="<?php echo $item['id']; ?>" <?php echo isset($_POST['category']) && $_POST['category'] == $item['id'] ? ' selected' : ''; ?>><?php echo $item['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="created">发布时间</label>
                        <input id="created" class="form-control" name="created" type="datetime-local" value="<?php echo isset($_POST['created']) ? $_POST['created'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="status">状态</label>
                        <select id="status" class="form-control" name="status">
                            <option value="drafted" <?php echo isset($_POST['status']) && $_POST['status'] == 'draft' ? ' selected' : ''; ?>>草稿</option>
                            <option value="published" <?php echo isset($_POST['status']) && $_POST['status'] == 'published' ? ' selected' : ''; ?>>已发布</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">保存</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php $current_page = 'post-add'; ?>
    <?php include 'inc/sidebar.php'; ?>

    <script src="/pro/jingcaishenghuo/static/assets/vendors/jquery/jquery-2.2.4.js"></script>
    <script src="/pro/jingcaishenghuo/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
    <!-- 富文本编辑器 -->
    <script src="/pro/jingcaishenghuo/static/assets/vendors/ueditor/ueditor.config.js"></script>
    <script src="/pro/jingcaishenghuo/static/assets/vendors/ueditor/ueditor.all.js"></script>
    <!-- 富文本编辑器 -->
    <script src="/pro/jingcaishenghuo/static/assets/vendors/simplemde/simplemde.min.js"></script>
    <script src="/pro/jingcaishenghuo/static/assets/vendors/moment/moment.js"></script>

    <script>
        // 富文本编辑器
        UE.getEditor('content', {
            initialFrameHeight: 300,
            autoHeight: false
        });


        $(function() {
            // 当文本域文件选择发生改变过后 本地预览选择的图片
            $('#feature').on('change', function() {
                var file = $(this).prop('files')[0];
                // 为这个文件对象创建一个 Object URL
                var url = URL.createObjectURL(file);
                $(this).siblings('.thumbnail').attr('src', url).fadeIn()
            })

            // slug
            $('#sulg').on('input', function() {
                $(this).next().children().text($(this).val())
            });

            $('#created').val(moment().format('YYYY-MM-DDTHH:mm'))
        });
    </script>

    <script>
        NProgress.done()
    </script>

</body>

</html>