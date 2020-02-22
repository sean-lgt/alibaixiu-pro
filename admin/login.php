<?php


// 载入配置文件
require_once '../config.php';

// 给用户找一个箱子（如果你之前有就用之前的，没有给个新的）存储
session_start();


function login()
{
    // 三大步骤  接收并校验  持久化 响应
    if (empty($_POST['email'])) {
        $GLOBALS['message'] = '请填写邮箱';
        return;
    }
    if (empty($_POST['password'])) {
        $GLOBALS['message'] = '请填写密码';
        return;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];


    // 当客户端提交过来的完整的表单信息就应该开始对其进行数据的校验
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        exit("<h1>连接数据库失败</h1>");
    }

    $query = mysqli_query($conn, "select * from users where email = '{$email}' limit 1;");

    if (!$query) {
        $GLOBALS['message'] = '登录失败，请重试！';
        return;
    }

    //获取登录用户
    $user = mysqli_fetch_assoc($query);
    if (!$user) {
        //用户名不存在
        $GLOBALS['message'] = "邮箱和密码不匹配";
        return;
    }

    // 一般密码是加密的  md5  但现在不安全了
    if ($user['password'] !== $password) {
        // 密码不正确
        $GLOBALS['message'] = "邮箱和密码不匹配";
        return;
    }

    //存一个登录标识  
    $_SESSION['current_login_user'] = $user;

    header('location:/pro/jingcaishenghuo/admin/');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    login();
}

//退出功能
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'logout') {
    // 删除登录标识   也就是删除session
    unset($_SESSION['current_login_user']);
}

?>


<!DOCTYPE html>

<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>后台管理-登录</title>
    <link rel="stylesheet" href="/pro/jingcaishenghuo/static/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/pro/jingcaishenghuo/static/assets/css/admin.css">
    <link rel="stylesheet" href="/pro/jingcaishenghuo/static/assets/vendors/animate/animate.css">
    <style>
    </style>

</head>

<body>
    <div class="login">
        <form class="login-wrap<?php echo isset($message) ? ' shake animated' : '' ?>" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off" novalidate>
            <img class="avatar" src="/pro/jingcaishenghuo/static/assets/img/default.png">
            <!-- 作为一个优秀的页面开发人员，必须考虑一个页面的不同状态下展示的内容不一样的情况 -->
            <!-- 有错误信息时展示 -->
            <?php if (isset($message)) : ?>
                <div class="alert alert-danger">
                    <strong>错误！</strong> <?php echo $message; ?>
                </div>
            <?php endif ?>
            <div class="form-group">
                <label for="email" class="sr-only">邮箱</label>
                <input name="email" id="email" name="email" type="email" class="form-control" placeholder="邮箱" autofocus value="<?php echo empty($_POST['email']) ? '' : $_POST['email'] ?>">
            </div>
            <div class="form-group">
                <label for="password" class="sr-only">密码</label>
                <input name="password" id="password" name="password" type="password" class="form-control" placeholder="密码">
            </div>
            <div class="form-group">
                <!-- <a class="register" href="register.php">没有账号？点击注册>></a> -->
                <!-- <input name="password" id="password" name="password" type="password" class="form-control" placeholder="密码"> -->
            </div>
            <button class="btn btn-primary btn-block">登 录</button>
        </form>
    </div>



    <script src="/pro/jingcaishenghuo/static/assets/vendors/jquery/jquery.min.js"></script>
    <script>
        $(function($) {
            // console.log("aaa");
            //入口函数的作用： 单独作用域  确保页面加载过后执行

            // 目标  在用户输入自己的邮箱过后  页面上展示这个邮箱对应的头像
            //失去焦点 blur  src  


            // 邮箱正则表达式
            var emailFormat = /^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/

            $('#email').on('blur', function() {
                var value = $(this).val()
                // 忽略掉文本框为空或者不是一个邮箱
                if (!value || !emailFormat.test(value)) return

                // 用户输入了一个合理的邮箱地址
                // 获取这个邮箱对应的头像地址
                // 因为客户端的 JS 无法直接操作数据库，应该通过 JS 发送 AJAX 请求 告诉服务端的某个接口，
                // 让这个接口帮助客户端获取头像地址

                $.get('/pro/jingcaishenghuo/admin/api/avatar.php', {
                    email: value
                }, function(res) {
                    // 希望 res => 这个邮箱对应的头像地址
                    if (!res) return
                    // 展示到上面的 img 元素上
                    // $('.avatar').fadeOut().attr('src', res).fadeIn()
                    $('.avatar').fadeOut(function() {
                        // 等到 淡出完成
                        $(this).on('load', function() {
                            // 图片完全加载成功过后
                            $(this).fadeIn()
                        }).attr('src', res)
                    })
                })
            })


        });
    </script>


</body>

</html>