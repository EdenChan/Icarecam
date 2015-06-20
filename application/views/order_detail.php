<?php require_once('header.php'); ?>
<?php require_once('sidebar.php'); ?>

    <div id="content">
        <div id="content-header">
            <h1>订单详情</h1>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title">
						<span class="icon">
							<i class="icon-align-justify"></i>
						</span>
                            <h5>订单详情</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <h4>订单中的商品</h4>
                            <table class="table table-hover">
                                <thead>
                                <tr>

                                    <th class="cart-product-thumbnail">产品图片</th>
                                    <th class="cart-product-name">产品名称</th>
                                    <th class="cart-product-price">单价</th>
                                    <th class="cart-product-quantity">购买数量</th>
                                    <th class="cart-product-subtotal">小计</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($order_goods as $v) : ?>
                                    <tr class="cart_item">
                                        <td class="cart-product-thumbnail">
                                            <img width="64" height="64"
                                                 src="<?php echo base_url('public/uploads/') . '/' . $v['goods_img']; ?>"
                                                 alt="产品图片">
                                        </td>

                                        <td class="cart-product-name">
                                            <?php echo $v['goods_name']; ?>
                                        </td>

                                        <td class="cart-product-price">
                                            ￥<span class="amount"><?php echo $v['shop_price']; ?></span>
                                        </td>

                                        <td class="cart-product-quantity">
                                            <div class="quantity clearfix">
                                                <input type="text" name="quantity"
                                                       value="<?php echo $v['goods_number']; ?>" readonly="readonly"
                                                       class="qty"/>
                                            </div>
                                        </td>
                                        <td class="cart-product-quantity">
                                            ￥<span class="subtotal"><?php echo $v['subtotal']; ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <h4>订单详细信息</h4>
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <td>订单号</td>
                                    <td><?php echo $order['order_sn']; ?></td>
                                </tr>
                                <tr>
                                    <td>订单提交时间</td>
                                    <td><?php echo $order['order_time']; ?></td>
                                </tr>
                                <tr>
                                    <td>订单状态</td>
                                    <td><?php echo $order['order_status']; ?></td>
                                </tr>
                                <tr>
                                    <td>配送方式</td>
                                    <td><?php echo $order['shipping_method']; ?></td>
                                </tr>
                                <tr>
                                    <td>订单总额</td>
                                    <td>￥<?php echo $order['order_amount']; ?></td>
                                </tr>
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
                            <h4>订单附言</h4>

                            <p><?php echo $order['postscripts']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>