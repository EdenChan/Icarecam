<?php
require_once('header.php');
//由于参数未定义会产生错误信息 暂时屏蔽 待改进
error_reporting(0);
?>
<!-- Page Title
		============================================= -->
<section id="page-title">

    <div class="container clearfix">
        <h1>用户信息</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>">主页</a></li>
            <li><a href="#">用户信息</a></li>
        </ol>
    </div>

</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">

    <div class="content-wrap">

        <div class="container clearfix">

            <div class="row clearfix">
                <div class="accordion accordion-bg clearfix col_half">

                    <div class="acctitle acctitlec"><i class="acc-closed icon-ok-circle"></i><i
                            class="acc-open icon-remove-circle"></i>设置配送信息
                    </div>
                    <div class="acc_content clearfix" style="display: block;"><p>请在下方设置或更改您的详细联系方式及送货地址（请确保详细到街道门牌号）</p>

                        <form id="billing-form" name="billing-form" class="nobottommargin"
                              action="<?php echo site_url('userinfo/setInfo'); ?>" method="post">

                            <div class="col_one_third col_last">
                                <label for="billing-form-name">收货人真实姓名:</label>
                                <input type="text" id="user_realname" name="user_realname"
                                       value="<?php echo $userinfo['user_realname']; ?>" class="sm-form-control"/>
                                <input type="hidden" id="userinfo_id" name="userinfo_id"
                                       value="<?php echo $user['user_id']; ?>"/>
                            </div>
                            <div class="clear"></div>

                            <div class="col_one_third">
                                <label for="billing-form-city">省份：</label>
                                <select name="location_p" id="location_p" class="sm-form-control"></select>
                            </div>

                            <div class="col_one_third">
                                <label for="billing-form-address">城市：</label>
                                <select name="location_c" id="location_c" class="sm-form-control"></select>
                            </div>

                            <div class="col_one_third col_last">
                                <label for="billing-form-city">区县：</label>
                                <select name="location_a" id="location_a" class="sm-form-control"></select>
                            </div>

                            <div class="clear"></div>

                            <div class="col_full">
                                <label for="billing-form-address">街道：</label>
                                <input type="text" id="user_street" name="user_street"
                                       value="<?php echo $userinfo['user_street']; ?>" class="sm-form-control"/>
                            </div>

                            <div class="clear"></div>

                            <div class="col_half">
                                <label for="billing-form-phone">手机/电话号码：</label>
                                <input type="text" id="user_mobile" name="user_mobile"
                                       value="<?php echo $userinfo['user_mobile']; ?>" class="sm-form-control"/>
                            </div>

                            <div class="col_half col_last">
                                <label for="billing-form-zipcode">邮编：</label>
                                <input type="text" id="user_zipcode" name="user_zipcode"
                                       value="<?php echo $userinfo['user_zipcode']; ?>" class="sm-form-control"/>
                            </div>

                            <div class="clear"></div>

                            <div class="col_full">
                                <input type="submit" class="button button-3d fright" value="设置信息"/>
                            </div>
                        </form>
                    </div>

                    <div class="acctitle"><i class="acc-closed icon-ok-circle"></i><i
                            class="acc-open icon-remove-circle"></i>修改邮箱
                    </div>
                    <div class="acc_content clearfix" style="display: none;">
                        <p>
                            原邮箱地址：<?php echo $user['email']; ?>
                        </p>

                        <p>
                            <button class="button button-3d button-small button-rounded" data-toggle="modal"
                                    data-target=".bs-example-modal-lg1">修改邮箱
                            </button>
                        <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog"
                             aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-body">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">修改邮箱</h4>
                                        </div>
                                        <form id="updatemail-form" name="updatepassmail-form" class="nobottommargin"
                                              action="<?php echo site_url('user/updatemail'); ?>" method="post">
                                            <div class="modal-body">
                                                <div class="col_full">
                                                    新邮箱地址：<input type="text" id="email" name="email" value=""
                                                                 class="form-control"/>
                                                    <input type="hidden" name="user_id"
                                                           value="<?php echo $user['user_id']; ?>"/>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="button button-3d nomargin"
                                                       id="register-form-submit" name="register-form-submit"
                                                       value="修改邮箱"/>
                                                <a class="button button-3d button-black nomargin" data-dismiss="modal"
                                                   aria-hidden="true">取消</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </p>
                    </div>

                    <div class="acctitle"><i class="acc-closed icon-ok-circle"></i><i
                            class="acc-open icon-remove-circle"></i>修改密码
                    </div>
                    <div class="acc_content clearfix" style="display: none;">
                        <p>
                            <button class="button button-3d button-small button-rounded" data-toggle="modal"
                                    data-target=".bs-example-modal-lg2">修改密码
                            </button>
                        <div class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog"
                             aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-body">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">修改密码</h4>
                                        </div>
                                        <form id="updatepass-form" name="updatepass-form" class="nobottommargin"
                                              action="<?php echo site_url('user/updatepass'); ?>" method="post">
                                            <div class="modal-body">
                                                <div class="col_full">
                                                    新密码：<input type="password" id="password" name="password" value=""
                                                               class="form-control"/>
                                                    确认密码：<input type="password" id="repassword" name="repassword"
                                                                value="" class="form-control"/>
                                                    <input type="hidden" name="user_id"
                                                           value="<?php echo $user['user_id']; ?>"/>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="button button-3d nomargin"
                                                       id="register-form-submit" name="register-form-submit"
                                                       value="修改密码"/>
                                                <a class="button button-3d button-black nomargin" data-dismiss="modal"
                                                   aria-hidden="true">取消</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </p>
                    </div>
                </div>

                <div class="divider"><i class="icon-circle"></i></div>
                <h4>历史订单</h4>
                <?php if (empty($orders)) : ?>
                    <div class="message">
                        <p>您还没有在Icarecam购买过商品，您可以去<a href="<?php echo site_url('goods/all'); ?>">商品页</a>挑选喜欢的商品</p>
                    </div>
                <?php else: ?>
                    <b>(请注意：已发货订单无法撤销)</b>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>订单号</th>
                                <th>订单状态</th>
                                <th>购物车总额</th>
                                <th>快递方式</th>
                                <th>订单总额</th>
                                <th>下单时间</th>
                                <th>订单详情</th>
                                <th>撤销订单</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($orders as $v): ?>
                                <tr>
                                    <td><?php echo $v['order_sn']; ?></td>
                                    <td><?php echo $v['order_status']; ?></td>
                                    <td>￥<?php echo $v['goods_amount']; ?></td>
                                    <td><?php echo $v['shipping_method']; ?></td>
                                    <td>￥<?php echo $v['order_amount']; ?></td>
                                    <td><?php echo $v['order_time']; ?></td>
                                    <td>
                                        <a class="btn btn-primary"
                                           href="<?php echo site_url('order/detail') . '/' . $v['order_sn']; ?>">订单详情</a>
                                    </td>
                                    <td>
                                        <?php if ($v['order_status'] == '未发货') { ?>
                                            <button class="btn btn-danger" data-toggle="modal"
                                                    data-target=".bs-example-modal-lg<?php echo $v['order_sn']; ?>">撤销
                                            </button>
                                            <div class="modal fade bs-example-modal-lg<?php echo $v['order_sn']; ?>"
                                                 tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-body">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title" id="myModalLabel">撤销订单</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>确定撤销此订单吗</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a class="btn btn-danger"
                                                                   href="<?php echo site_url('order/delete') . '/' . $v['order_sn']; ?>">确定</a>
                                                                <a class="btn btn-default" data-dismiss="modal"
                                                                   aria-hidden="true">取消</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <button class="btn btn-danger disabled">撤销</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                <a class="button button-3d button-small button-rounded" href="<?php echo site_url('order/show'); ?>">查看当前订单</a>
                <button class="button button-3d button-small button-rounded button-red" data-toggle="modal"
                        data-target=".bs-example-modal-lg3">退出登录
                </button>
                <div class="modal fade bs-example-modal-lg3" tabindex="-1" role="dialog"
                     aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">退出登录</h4>
                                </div>
                                <div class="modal-body">
                                    <p>确认退出吗</p>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-danger" href="<?php echo site_url('user/logout'); ?>">退出</a>
                                    <a class="btn btn-default" data-dismiss="modal" aria-hidden="true">取消</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section><!-- #content end -->

<script type="text/javascript" src="<?php echo base_url('themes/default/js/area.js'); ?>"></script>
<script type="text/javascript">
    new PCAS('location_p', 'location_c', 'location_a', <?php echo "'".$userinfo['user_province']."'";?>, <?php echo "'".$userinfo['user_city']."'";?>, <?php echo "'".$userinfo['user_district']."'";?>);
</script>
<?php
require_once('footer.php');
?>
