<?php
/*
 * @Author: your name
 * @Date: 2020-01-02 18:56:36
 * @LastEditTime : 2020-01-26 23:14:36
 * @LastEditors  : Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: \pro\jingcaishenghuo\function.php
 */

require_once 'config.php';


session_start();

/**
 * 获取当前登录用户信息  如果没有获取到则自动跳转到登录页
 */
function sean_get_current_user()
{
    if (empty($_SESSION['current_login_user'])) {
        //如果没有当前登录用户信息  意味着没有登录
        header('location:/pro/jingcaishenghuo/admin/login.php');
        exit();
    }
    return $_SESSION['current_login_user'];
}




/**
 * 执行一个查询语句，返回查询到的数据（关联数组混合索引数组）
 * @param  string $sql 需要执行的查询语句
 * @return array       查询到的数据（二维数组）
 */
function sean_fetch_all($sql)
{
    // 获取数据库连接

    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        exit('连接失败');
    }
    // 定义结果数据容器，用于装载查询到的数据
    $data = array();

    // 执行参数中指定的 SQL 语句
    if ($result = mysqli_query($conn, $sql)) {
        // 查询成功，则获取结果集中的数据

        // 遍历每一行的数据
        while ($row = mysqli_fetch_array($result)) {
            // 追加到结果数据容器中
            $data[] = $row;
        }

        // 释放结果集
        mysqli_free_result($result);
    }

    // 关闭数据库连接
    mysqli_close($conn);

    // 返回容器中的数据
    return $data;
}

/**
 * 通过数据库查询获取单条数据   
 * =>关联数组
 */
function sean_fetch_one($sql)
{
    $res = sean_fetch_all($sql);
    return isset($res[0]) ? $res[0] : null;
}


/**
 * 执行一个增删改语句
 */
function sean_execute($sql)
{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        exit('连接失败');
    }

    $query = mysqli_query($conn, $sql);
    if (!$query) {
        // 查询失败
        return false;
    }

    // 对于增删修改类的操作都是获取受影响的行数
    $affected_rows = mysqli_affected_rows($conn);

    mysqli_close($conn);

    return $affected_rows;
}


/**
 * 
 * 判断上传图片  文件
 */
function sean_upload()
{
    if (!isset($_FILES['feature'])) {
        $GLOBALS['message'] = '您还没有选择上传的文件';
        // 客户端提交的表单内容中根本没有文件域
        return;
    }

    //返回的是一个关联数组
    $avatar = $_FILES['feature'];

    // echo $avatar['error'];
    if ($avatar['error'] !== UPLOAD_ERR_OK) {
        // 服务端没有接收到上传的文件
        $GLOBALS['message'] = '111上传失败';
        return;
    }

    //var_dump($avatar);

    //接收到了文件
    //将文件从临时目录移动到网站范围之内
    $source = $avatar['tmp_name']; // 源文件在哪
    // => 'C:\Windows\Temp\php1138.tmp'
    $target = '../../static/uploads/' . uniqid() . $avatar['name']; // 目标放在哪
    // => './uploads/icon-02.png'
    // 移动的目标路径中文件夹一定是一个已经存在的目录
    $moved = move_uploaded_file($source, $target);

    if (!$moved) {
        $GLOBALS['message'] = '上传失败33';
        return;
    } else {
        $image_file = '/pro/jingcaishenghuo/static/uploads/' .  uniqid() . $avatar['name'];
    }


    return isset($image_file) ? $image_file : '没成功！';

    //移动成功（上传整个过程OK）

}
