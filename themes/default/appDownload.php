<?php
require_once 'header.php';
?>
<section id="page-title">

    <div class="container clearfix">
        <h1>App下载</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url();?>">主页</a></li>
            <li><a href="<?php echo site_url('apps/all');?>">App下载</a></li>
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
                    <div id="posts" class="small-thumbs">
                        <?php foreach ($apps as $v): ?>
                            <div class="entry clearfix">
                                <div class="entry-image">
                                    <a href="<?php echo base_url('public/uploads/') . '/' . $v['apps_img'];?>" data-lightbox="image"><img class="image_fade" src="<?php echo base_url('public/uploads/') . '/' . $v['apps_img'];?>" alt="Standard Post with Image"></a>
                                </div>
                                <div class="entry-c">
                                    <div class="entry-title">
                                        <h2><a href="<?php echo site_url('apps/single') . '/' . $v['apps_id'];?>"><?php echo $v['apps_name'];?></a></h2>
                                    </div>
                                    <div class="entry-content">
                                        <p><?php echo $v['apps_brief'];?></p>
                                        <a href="<?php echo site_url('apps/single') . '/' . $v['apps_id'];?>"class="button button-3d button-small button-rounded button-lime button-light">了解更多</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>

                        <!-- #posts end -->

                    <!-- Pagination
                    ============================================= -->
                    <?php echo $pageinfo;?>
                    <!-- .pager end -->
                </div>
            </div>
        </div>

    </section><!-- #content end -->
<?php
require_once 'footer.php';
?>