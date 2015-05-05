<?php
    require_once('header.php');
?>

<?php
    #将参数字符串转化为参数数组输出
    function str2arr ($str)
    {
        $arr = str_replace(array("：","，"),array('"=>"','","'),'array("'.$str.'")');
        eval("\$arr"." = $arr;");
        return $arr;
    }
?>
<section id="page-title">

            <div class="container clearfix">
                <h1>云摄像头</h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo site_url();?>">主页</a></li>
                    <li><a href="<?php echo site_url('goods/all');?>">云摄像头</a></li>
                    <li class="active"><?php echo $goods['goods_name'];?></li>
                </ol>
            </div>

        </section><!-- #page-title end -->

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap" style="margin-bottom:-50px;">

                <div class="container clearfix">

                    <div class="single-product">

                        <div class="product">

                            <div class="col_two_fifth">

                                <!-- Product Single - Gallery
                                ============================================= -->
                                <div class="product-image">
                                    <div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
                                        <div class="flexslider">
                                            <div class="slider-wrap" data-lightbox="gallery">
                                                <div class="slide"><a href="<?php echo base_url('public/uploads/').'/'.$goods['goods_img'];?>" title="<?php echo $goods['goods_name'];?>" data-lightbox="gallery-item"><img src="<?php echo base_url('public/uploads/').'/'.$goods['goods_img'];?>" alt="产品图片"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- Product Single - Gallery End -->

                            </div>

                            <div class="col_two_fifth product-desc">

                                <!-- Product Single - Price
                                ============================================= -->
                                <div class="product-price"><del>￥<?php echo $goods['market_price'];?></del> <ins>￥<?php echo $goods['shop_price'];?></ins></div><!-- Product Single - Price End -->
                                <div class="clear"></div>
                                <div class="line"></div>

                                <!-- Product Single - Quantity & Cart Button
                                ============================================= -->
                                <form class="cart nobottommargin clearfix" method="post" enctype='multipart/form-data' action="<?php echo site_url('cart/add');?>">
                                    <div class="quantity clearfix">
                                        <input type="button" value="-" class="minus">
                                        <input type="text" step="1" min="1"  name="goods_quantity" value="1" title="Qty" class="qty" size="4" />
                                        <input type="button" value="+" class="plus">
                                        <input type="hidden" name="goods_name" value="<?php echo $goods['goods_name'];?>">
                                        <input type="hidden" name="shop_price" value="<?php echo $goods['shop_price'];?>">
                                        <input type="hidden" name="goods_id" value="<?php echo $goods['goods_id'];?>">
                                        <input type="hidden" name="goods_img" value="<?php echo $goods['goods_img'];?>">
                                    </div>
                                    <input type="submit" class="add-to-cart button nomargin" value="加入购物车" />
                                </form><!-- Product Single - Quantity & Cart Button End -->

                                <div class="clear"></div>
                                <div class="line"></div>

                                <!-- Product Single - Short Description
                                ============================================= -->
                                <p><?php echo $goods['goods_brief'];?></p>
                                <!-- Product Single - Short Description End -->

                            </div>


                            <div class="col_full nobottommargin">

                                <div class="tabs clearfix nobottommargin" id="tab-1">

                                    <ul class="tab-nav clearfix">
                                        <li><a href="#tabs-1"><i class="icon-align-justify2"></i><span class="hidden-xs">详细介绍</span></a></li>
                                        <li><a href="#tabs-2"><i class="icon-info-sign"></i><span class="hidden-xs">参数</span></a></li>
                                        <li><a href="#tabs-3"><i class="icon-star3"></i><span class="hidden-xs">评论</span></a></li>
                                    </ul>

                                    <div class="tab-container">

                                        <div class="tab-content clearfix" id="tabs-1">
                                            <?php echo $goods['goods_desc'];?>
                                        </div>
                                        <div class="tab-content clearfix" id="tabs-2">

                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                   <?php
                                                        $params = str2arr($goods['goods_params']);
                                                        foreach ($params as $k => $v) {
                                                        echo "<tr><td>".$k."</td><td>".$v."</td></tr>";
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="tab-content clearfix" id="tabs-3">

                                            <!-- 多说评论框 start -->
                                                <div class="ds-thread" data-thread-key="<?php echo $goods['goods_id']+999;?>" data-title="<?php echo $goods['goods_name'];?>" data-url="<?php echo site_url('goods/single').'/'. $goods['goods_id'];?>"></div>
                                            <!-- 多说评论框 end -->
                                            <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
                                            <script type="text/javascript">
                                            var duoshuoQuery = {short_name:"icarecam"};
                                                (function() {
                                                    var ds = document.createElement('script');
                                                    ds.type = 'text/javascript';ds.async = true;
                                                    ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                                                    ds.charset = 'UTF-8';
                                                    (document.getElementsByTagName('head')[0]
                                                     || document.getElementsByTagName('body')[0]).appendChild(ds);
                                                })();
                                                </script>
                                            <!-- 多说公共JS代码 end -->

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="clear"></div>


                </div>

            </div>

        </section><!-- #content end -->

<?php
    require_once('footer.php');
?>