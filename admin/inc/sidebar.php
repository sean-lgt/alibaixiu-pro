<?php


// 页面访问权限控制
// 校验数据当前访问的用户的 箱子（session）有没有登录的登录标识
session_start();


if (empty($_SESSION['current_login_user'])) {
    //没有当前登录的用户信息，意味着没有登录
    header('location:/pro/jingcaishenghuo/admin/login.php');
}

$userdetails = $_SESSION['current_login_user'];

?>

<!-- 也可以使用 $_SERVER['PHP_SELF'] 取代 $current_page -->
<?php $current_page = isset($current_page) ? $current_page : ''; ?>
<div class="aside">
    <div class="profile">
        <img class="avatar" src="<?php echo $userdetails['avatar'] ?>">
        <h3 class="name"><?php echo $userdetails['nickname'] ?></h3>
    </div>
    <ul class="nav">
        <li><a href="/pro/jingcaishenghuo/index.html" target="_blank"><i class="fa fa-indent"></i>前台页面</a></li>
        <li<?php echo $current_page === 'index' ? ' class="active"' : '' ?>>
            <a href="/pro/jingcaishenghuo/admin/index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
            </li>
            <?php $menu_posts = array('posts', 'post-add', 'categories'); ?>
            <li<?php echo in_array($current_page, $menu_posts) ? ' class="active"' : '' ?>>
                <a href="#menu-posts" <?php echo in_array($current_page, $menu_posts) ? '' : ' class="collapsed"' ?> data-toggle="collapse">
                    <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
                </a>
                <ul id="menu-posts" class="collapse<?php echo in_array($current_page, $menu_posts) ? ' in' : '' ?>">
                    <li<?php echo $current_page === 'posts' ? ' class="active"' : '' ?>><a href="/pro/jingcaishenghuo/admin/posts.php">所有文章</a></li>
                        <li<?php echo $current_page === 'post-add' ? ' class="active"' : '' ?>><a href="/pro/jingcaishenghuo/admin/post-add.php">写文章</a></li>
                            <li<?php echo $current_page === 'categories' ? ' class="active"' : '' ?>><a href="/pro/jingcaishenghuo/admin/categories.php">分类目录</a></li>
                </ul>
                </li>
                <li<?php echo $current_page === 'comments' ? ' class="active"' : '' ?>>
                    <a href="/pro/jingcaishenghuo/admin/comments.php"><i class="fa fa-comments"></i>评论</a>
                    </li>
                    <li<?php echo $current_page === 'users' ? ' class="active"' : '' ?>>
                        <a href="/pro/jingcaishenghuo/admin/users.php"><i class="fa fa-users"></i>用户</a>
                        </li>
                        <?php $menu_settings = array('nav-menus', 'slides', 'settings'); ?>
                        <li<?php echo in_array($current_page, $menu_settings) ? ' class="active"' : '' ?>>
                            <a href="#menu-settings" <?php echo in_array($current_page, $menu_settings) ? '' : ' class="collapsed"' ?> data-toggle="collapse">
                                <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
                            </a>
                            <ul name="menu-settings" id="menu-settings" class="collapse<?php echo in_array($current_page, $menu_settings) ? ' in' : '' ?>">
                                <li<?php echo $current_page === 'nav-menus' ? ' class="active"' : '' ?>><a href="/pro/jingcaishenghuo/admin/nav-menus.php">导航菜单</a></li>
                                    <li<?php echo $current_page === 'slides' ? ' class="active"' : '' ?>><a href="/pro/jingcaishenghuo/admin/slides.php">图片轮播</a></li>
                                        <li<?php echo $current_page === 'settings' ? ' class="active"' : '' ?>><a href="/pro/jingcaishenghuo/admin/settings.php">网站设置</a></li>
                            </ul>
                            </li>
    </ul>
</div>