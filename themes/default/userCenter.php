<?php
require_once('header.php');
?>
<!-- Page Title
		============================================= -->
<section id="page-title">

    <div class="container clearfix">
        <h1>用户注册/登录</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>">主页</a></li>
            <li><a href="#">用户注册登录</a></li>
        </ol>
    </div>

</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

            <div class="accordion accordion-lg divcenter nobottommargin clearfix" style="max-width: 550px;">

                <div class="acctitle"><i class="acc-closed icon-lock3"></i><i class="acc-open icon-unlock"></i>用户登录
                </div>
                <div class="acc_content clearfix">
                    <form id="login-form" name="login-form" class="nobottommargin"
                          action="<?php echo site_url('user/signin'); ?>" method="post">
                        <div class="col_full">
                            <label for="login-form-username">用户名</label>
                            <input type="text" id="username" name="username" value="" class="form-control"/>
                        </div>

                        <div class="col_full">
                            <label for="login-form-password">密码</label>
                            <input type="password" id="password" name="password" value="" class="form-control"/>
                        </div>
                        <div class="col_full">
                            <input type="submit" class="button button-3d button-black nomargin" id="login-form-submit"
                                   name="login-form-submit" value="点击登录"/>
                        </div>
                    </form>
                </div>

                <div class="acctitle"><i class="acc-closed icon-user4"></i><i class="acc-open icon-ok-sign"></i>用户注册
                </div>
                <div class="acc_content clearfix">
                    <form id="register-form" name="register-form" class="nobottommargin"
                          action="<?php echo site_url('user/do_register'); ?>" method="post">
                        <div class="col_full">
                            <label for="register-form-name">用户名</label>
                            <input type="text" id="username" name="username" value="" class="form-control"/>
                        </div>

                        <div class="col_full">
                            <label for="register-form-email">邮箱</label>
                            <input type="text" id="email" name="email" value="" class="form-control"/>
                        </div>

                        <div class="col_full">
                            <label for="register-form-password">密码</label>
                            <input type="password" id="password" name="password" value="" class="form-control"/>
                        </div>

                        <div class="col_full">
                            <label for="register-form-repassword">确认密码</label>
                            <input type="password" id="repassword" name="repassword" value="" class="form-control"/>
                        </div>

                        <div class="col_full nobottommargin">
                            <input type="submit" class="button button-3d button-black nomargin"
                                   id="register-form-submit" name="register-form-submit" value="点击注册"/>
                            <input type="reset" value=" 重置 " class="button button-3d button-black nomargin"/>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </div>

</section><!-- #content end -->
<?php
require_once('footer.php');
?>
