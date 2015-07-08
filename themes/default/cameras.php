<?php
require_once('header.php');
?>
    <section id="page-title">

        <div class="container clearfix">
            <h1>云摄像头</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url(); ?>">主页</a></li>
                <li><a href="<?php echo site_url('goods/all'); ?>">云摄像头</a></li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <!-- Posts
                ============================================= -->
                <div id="posts" class="post-grid grid-2 clearfix">
                    <?php foreach ($goods as $v): ?>

                        <div class="entry clearfix">
                            <div class="entry-image">
                                <a href="<?php echo base_url('public/uploads/') . '/' . $v['goods_img']; ?>"
                                   data-lightbox="image"><img class="image_fade"
                                                              src="<?php echo base_url('public/uploads/') . '/' . $v['goods_img']; ?>"
                                                              alt="Standard Post with Image"></a>
                            </div>
                            <div class="entry-c">
                                <div class="entry-title">
                                    <h2>
                                        <a href="<?php echo site_url('goods/single') . '/' . $v['goods_id']; ?>"><?php echo $v['goods_name']; ?></a>
                                    </h2>
                                </div>
                                <div class="entry-content">
                                    <p><?php echo $v['goods_brief']; ?></p>
                                    <a href="<?php echo site_url('goods/single') . '/' . $v['goods_id']; ?>"
                                       class="button button-3d button-small button-rounded button-lime button-light">立即购买</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>


                    <!-- #posts end -->

                    <!-- Pagination
                    ============================================= -->
                    <?php echo $pageinfo; ?>
                    <!-- .pager end -->


                </div>
            </div>
        </div>

    </section><!-- #content end -->
<?php
require_once('footer.php');
?>