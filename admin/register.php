<?php

include_once '../config.php';
// 连接数据库
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$conn) {
    exit('连接失败');
}


/**
 * 表单校验三大步骤
 * 接收并校验 持久化  响应
 * 
 *  */

function register()
{


    // 接收并校验
    // 三大步骤  接收并校验  持久化 响应
    if (empty($_POST['email'])) {
        $GLOBALS['message'] = '请填写邮箱';
        return;
    }
    if (isset($_POST['email'])) {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $email = $_POST['email'];
        $sql = "select * from users where email='$email'";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $GLOBALS['message'] = '邮箱已被注册过！';
            return;
        }
    }

    $email = $_POST['email'];

    if (empty($_POST['password'])) {
        $GLOBALS['message'] = '请填写密码';
        return;
    }
    if (empty($_POST['comfirm']) || $_POST['password'] !== $_POST['comfirm']) {
        $GLOBALS['message'] = '请重新填写确认密码';
        return;
    }

    $password = $_POST['password'];

    if (empty($_POST['slug'])) {
        $GLOBALS['message'] = '请输入别名';
        return;
    }
    $slug = $_POST['slug'];
    if (empty($_POST['nickname'])) {
        $GLOBALS['message'] = '请输入昵称';
        return;
    }
    $nickname = $_POST['nickname'];

    // var_dump($_FILES['file']);
    // echo $_FILES['file'];

    // // 如果选择了文件 $_FILES['file']['error'] =>0
    // if (empty($_FILES['file']['error'])) {
    //     // php会自动接收客户端上传的文件到一个临时目录
    //     $temp_file = $_FILES['file']['tmp_name'];
    //     // 我们只需把文件保存到我们指定上传的目录
    //     // $target = 'D:/phpstudy_pro/WWW/pro/jingcaishenghuo/static/uploads/' . uniqid() . '-' . $_FILES['file']['name'];
    //     // if (move_uploaded_file($temp_file, $target)) {
    //     //     $image_file = '/pro/jingcaishenghuo/static/uploads/' . uniqid() . '-' . $_FILES['file']['name'];
    //     // } else {
    //     //     $image_file = "aaaa ";
    //     // }
    // }

    // $avatar = $_FILES['file']['tmp_name'];

    // var_dump($avatar);
    // var_dump($avatar);


    //  将文件从临时目录中移动到网站下面
    // php会自动接收客户端上传的文件到一个临时目录

    // 添加到数据库
    $query = mysqli_query($conn, "insert into users values (null, '{$slug}', '{$email}','{$password}','{$nickname}',null,null,'activated');");
    if (!$query) {
        // 查询失败
        return false;
    }
    // 对于增删修改类的操作都是获取受影响的行数
    $affected_rows = mysqli_affected_rows($conn);
    if ($affected_rows > 0) {
        echo "添加成功";
    } else {
        echo "添加失败";
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Content-Type: text/html;charset=utf-8");
    register();
    // if (empty($_FILES['file']['error'])) {
    //     // php会自动接收客户端上传的文件到一个临时目录
    //     $temp_file = $_FILES['file']['tmp_name'];
    //     // 我们只需把文件保存到我们指定上传的目录
    //     $target = 'D:/phpstudy_pro/WWW/pro/jingcaishenghuo/static/uploads/' . uniqid() . '-' . $_FILES['file']['name'];
    //     if (move_uploaded_file($temp_file, $target)) {
    //         echo $image_file = '/pro/jingcaishenghuo/static/uploads/' . uniqid() . '-' . $_FILES['file']['name'];
    //     } else {
    //         echo $image_file = "aaa ";
    //     }
    // }
}

?>




<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>后台管理-注册</title>
    <link rel="stylesheet" href="/pro/jingcaishenghuo/static/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/pro/jingcaishenghuo/static/assets/css/admin.css">
    <link rel="stylesheet" href="/pro/jingcaishenghuo/static/assets/vendors/animate/animate.css">
    <style>
        /* 注册部分 */
        .resign {
            position: fixed;
            width: 100%;
            height: 100%;
            background-color: #2f4050;
        }

        .resign .resign-wrap {
            position: relative;
            max-width: 500px;
            margin: 180px auto;
            padding: 40px 20px;
            border-radius: 4px;
            background-color: #fff;
        }

        .resign .resign-wrap .form-group label {
            margin-right: 5px;
        }

        .resign .resign-wrap .form-group input {
            width: 250px;
            display: inline-block;
        }
    </style>

</head>

<body>
    <div class="resign">
        <form class="resign-wrap<?php echo isset($message) ? ' shake animated' : '' ?>" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off" novalidate>

            <?php if (isset($message)) : ?>
                <div class="alert alert-danger">
                    <strong>错误！</strong> <?php echo $message; ?>
                </div>
            <?php endif ?>

            <div class="form-group">
                <label for="email">邮&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;箱</label>
                <input name="email" id="email" name="email" type="email" class="form-control" placeholder="邮箱">
                <span id="e_check" style="color: red"></span>
            </div>
            <div class="form-group">
                <label for="password">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码</label>
                <input name="password" id="password" name="password" type="password" class="form-control" placeholder="密码">
            </div>
            <div class="form-group">
                <label for="comfirm">确认密码</label>
                <input name="comfirm" id="comfirm" name="comfirm" type="password" class="form-control" placeholder="确认密码">
                <span id="p_check" style="color: red"></span>
            </div>
            <div class="form-group">
                <label for="slug">别&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名</label>
                <input name="slug" id="slug" name="slug" type="text" class="form-control" placeholder="别名">
            </div>
            <div class="form-group">
                <label for="nickname">昵&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;称</label>
                <input name="nickname" id="nickname" name="nickname" type="text" class="form-control" placeholder="昵称">
            </div>
            <div class="form-group">
                <input id="site_logo" name="site_logo" type="hidden">
                <label class="form-image">
                    <input id="upload" type="file">
                    <img src="<?php echo $options['site_logo']; ?>" width="50px" height="50px">
                    <i class="mask fa fa-upload"></i>
                </label>
            </div>
            <div class="form-group">
                <label for="password">验&nbsp;&nbsp;证&nbsp;&nbsp;码</label>
                <!-- <input name="slug" id="slug" name="slug" type="text" class="form-control" placeholder="别名">
                <img src="" alt=""><?php echo $image ?> -->
            </div>
            <button class="btn btn-primary btn-block">注 册</button>
        </form>
    </div>



    <script src="/pro/jingcaishenghuo/static/assets/vendors/jquery/jquery-2.2.4.js"></script>
    <script src="/pro/jingcaishenghuo/static/assets/vendors/bootstrap/js/bootstrap.js"></script>

    <script>
        $(function() {
            $("#comfirm").blur(function() {
                var password = $("#password").val();
                if ($(this).val() !== password) {
                    $("#p_check").html("两次密码输入不一致");
                } else {
                    $("#p_check").html("");
                }
            });
            $("#email").blur(function() {
                var email = $(this).val();
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: "../admin/api/register-api.php",
                    data: {
                        email: email
                    },
                    success: function(data) {
                        $("#e_check").html(data.msg);
                    }
                });
            });


        });

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
                            console.log(res);

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

</body>

</html>