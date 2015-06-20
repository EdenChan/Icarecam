<!DOCTYPE html>
<html>
<head>
    <title>Icarecam管理后台</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="<?php echo base_url('application/views/css/bootstrap.min.css'); ?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url('application/views/css/bootstrap-responsive.min.css'); ?>"
          type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url('application/views/css/unicorn.login.css'); ?>" type="text/css"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<body>
<div id="logo">
    <img src="<?php echo base_url('application/views/img/logo.png'); ?>" alt=""/>
</div>
<div id="loginbox">
    <form id="loginform" class="form-vertical" method="post" action="<?php echo site_url('admin/privilege/signin'); ?>"
          name='theForm'>
        <p>请输入用户名和密码</p>

        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-user"></i></span><input type="text" name="username"
                                                                                placeholder="用户名"/>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-lock"></i></span><input type="password" name="password"
                                                                                placeholder="密码"/>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <span class="pull-right"><input type="submit" class="btn btn-inverse" value="登录"/></span>
        </div>
    </form>
</div>
<script src="<?php echo base_url('application/views/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('application/views/js/unicorn.login.js'); ?>"></script>
</body>
</html>