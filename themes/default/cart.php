<?php
    require_once('header.php');
?>
<!-- Page Title
        ============================================= -->
        <section id="page-title">

            <div class="container clearfix">
                <h1>购物车</h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo site_url();?>">主页</a></li>
                    <li><a href="<?php echo site_url('goods/all');?>">云摄像头</a></li>
                    <li class="active">购物车</li>
                </ol>
            </div>

        </section><!-- #page-title end -->

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">
                    <?php if (empty($carts)) :?>
                    <!-- 购物车为空 -->
                            <div class="message">
                                <p>购物车内暂时没有商品，您可以去<a href="<?php echo site_url('goods/all');?>">商品页</a>挑选喜欢的商品</p>
                            </div>
                    <!-- 购物车为空 end-->
                    <?php else :?>
                    <div class="table-responsive bottommargin">

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
                            <?php foreach($carts as $cart) :?>
                                <tr class="cart_item">
                                    <td class="cart-product-remove">
                                        <a href="<?php echo site_url('cart/delete').'/'.$cart['rowid'];?>" class="remove" title="Remove this item"><i class="icon-line-circle-cross"></i></a>
                                    </td>

                                    <td class="cart-product-thumbnail">
                                        <img width="64" height="64" src="<?php echo base_url('public/uploads/').'/'.$cart['img'];?>" alt="产品图片">
                                    </td>

                                    <td class="cart-product-name">
                                        <a href="<?php echo site_url('goods/single').'/'. $cart['id'];?>"><?php echo $cart['name'];?></a>
                                    </td>

                                    <td class="cart-product-price">
                                        ￥<span class="amount"><?php echo $cart['price'];?></span>
                                    </td>

                                    <td class="cart-product-quantity">
                                        <div class="quantity clearfix">
                                            <input type="text" name="quantity" value="<?php echo $cart['qty'];?>" readonly="readonly" class="qty" />
                                        </div>
                                    </td>
                                    <td class="cart-product-quantity">
                                        ￥<span class="subtotal"><?php echo $cart['subtotal'];?></span>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                                <tr class="cart_result">
                                    <td colspan="6">
                                        <div class="row clearfix">
                                            <div class="col-md-4 col-xs-4 nopadding">
                                                 <strong>购物车费用总计 ￥<span class="amount color lead cart-total"><?php echo $this->cart->total();?></span></strong>
                                                 <input type="hidden" name="cart-total" id="cart-total" value="<?php echo $this->cart->total();?>" />
                                            </div>
                                            <div class="col-md-8 col-xs-8 nopadding">
                                                <a href="<?php echo site_url('goods/all');?>" class="button button-3d nomargin fright">继续购物</a>
                                                <a href="<?php echo site_url('order/show');?>" class="button button-3d notopmargin fright">前往结账</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <?php endif;?>
                </div>
            </div>

        </section><!-- #content end -->
<?php
    require_once('footer.php');
?>
