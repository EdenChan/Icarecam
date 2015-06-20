<?php
require_once('header.php');
?>
    <script type="text/javascript">
        $(document).ready(function () {
            if (<?php echo $this->cart->total();?><
            100
            )
            {
                $(".shippingMethod").click(function () {
                    if ($(this).attr('id') == "normal") {
                        $("#order_total").html(<?php echo $this->cart->total()+10;?>);
                    }
                    else if ($(this).attr('id') == "ems") {
                        $("#order_total").html(<?php echo $this->cart->total()+20;?>);
                    }
                    else if ($(this).attr('id') == "shunfeng") {
                        $("#order_total").html(<?php echo $this->cart->total()+30;?>);
                    }
                });
            }
            else
            {
                $(".order_shipping").hide();
                $(".order_shipping_free").show();
                $("#order_total").html(<?php echo $this->cart->total();?>);
            }

        });
    </script>
    <!-- Page Title
            ============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h1>确认订单</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url(); ?>">主页</a></li>
                <li><a href="<?php echo site_url('goods/all'); ?>">云摄像头</a></li>
                <li class="active">确认订单</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">
                <?php if (empty($carts)) : ?>
                    <!-- 购物车为空 -->
                    <div class="message">
                        <p>购物车内暂时没有商品，您可以去<a href="<?php echo site_url('goods/all'); ?>">商品页</a>挑选喜欢的商品</p>
                    </div>
                    <!-- 购物车为空 end-->
                <?php else : ?>
                    <b>请在下订单前确认或更改您的详细联系方式及送货地址（请确保详细到街道门牌号）</b>
                    <br><br>
                    <div class="col_half">

                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td>收件人姓名</td>
                                <td><?php echo $userinfo['user_realname']; ?></td>
                            </tr>
                            <tr>
                                <td>收件人详细地址</td>
                                <td><?php echo $userinfo['user_province'] . $userinfo['user_city'] . $userinfo['user_district'] . $userinfo['user_street']; ?></td>
                            </tr>
                            <tr>
                                <td>收件人联系方式</td>
                                <td><?php echo $userinfo['user_mobile']; ?></td>
                            </tr>
                            <tr>
                                <td>收件人邮编</td>
                                <td><?php echo $userinfo['user_zipcode']; ?></td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="<?php echo site_url('user/showCenter'); ?>">点击修改信息</a>
                    </div>
                    <div class="clear"></div>
                    <div class="table-responsive">

                        <table class="table cart" id="table_cart">
                            <thead>
                            <tr>
                                <th class="cart-product-remove">移除产品</th>
                                <th class="cart-product-thumbnail">产品图片</th>
                                <th class="cart-product-name">产品</th>
                                <th class="cart-product-price">单价</th>
                                <th class="cart-product-quantity">购买数量</th>
                                <th class="cart-product-subtotal">小计</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($carts as $cart) : ?>
                                <tr class="cart_item">
                                    <td class="cart-product-remove">
                                        <a href="<?php echo site_url('cart/delete') . '/' . $cart['rowid']; ?>"
                                           class="remove" title="Remove this item"><i
                                                class="icon-line-circle-cross"></i></a>
                                    </td>

                                    <td class="cart-product-thumbnail">
                                        <img width="64" height="64"
                                             src="<?php echo base_url('public/uploads/') . '/' . $cart['img']; ?>"
                                             alt="产品图片">
                                    </td>

                                    <td class="cart-product-name">
                                        <a href="<?php echo site_url('goods/single') . '/' . $cart['id']; ?>"><?php echo $cart['name']; ?></a>
                                    </td>

                                    <td class="cart-product-price">
                                        ￥<span class="amount"><?php echo $cart['price']; ?></span>
                                    </td>

                                    <td class="cart-product-quantity">
                                        <div class="quantity clearfix">
                                            <input type="text" name="quantity" value="<?php echo $cart['qty']; ?>"
                                                   readonly="readonly" class="qty"/>
                                        </div>
                                    </td>
                                    <td class="cart-product-quantity">
                                        ￥<span class="subtotal"><?php echo $cart['subtotal']; ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="cart_result">
                                <td colspan="6">
                                    <div class="row clearfix">
                                        <div class="col-md-4 col-xs-4 nopadding">
                                            <strong>购物车费用总计 ￥<span
                                                    class="amount color lead cart-total"><?php echo $this->cart->total(); ?></span></strong>
                                            <input type="hidden" name="cart-total" id="cart-total"
                                                   value="<?php echo $this->cart->total(); ?>"/>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                    <form id="order-form" name="order-form" action="<?php echo site_url('order/add'); ?>" method="post">
                        <div class="col_half">
                            <label for="order_postscripts">订单附言(可留空)：</label><br>
                            <textarea rows="5" cols="35" name="postscripts" id="postscripts"></textarea>
                        </div>
                        <div class="col_half col-last order_shipping">
                            <label for="order_postscripts">快递方式：</label>
                            <input type="radio" name="shipping" class="shippingMethod" id="normal" value="1"
                                   checked="checked"/>普通
                            <input type="radio" name="shipping" class="shippingMethod" id="ems" value="2"/>EMS
                            <input type="radio" name="shipping" class="shippingMethod" id="shunfeng" value="3"/>顺丰
                            <br><br>

                            <h3>订单总计 ￥<span class="amount color lead cart-total"
                                            id="order_total"><?php echo $this->cart->total() + 10; ?></span></h3>
                        </div>
                        <div class="col_half col-last order_shipping_free" style="display: none">
                            <h3>订单总计 ￥<span class="amount color lead cart-total"
                                            id="order_total"><?php echo $this->cart->total(); ?></span></h3>
                            <b>商品总价超过100元，本订单将享受免运费优惠</b></div>
                        <a href="<?php echo site_url('goods/all'); ?>" class="button button-3d fright">继续购物</a>
                        <input type="submit" class="button button-3d fright" value="提交订单"/>
                    </form>
                <?php endif; ?>
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