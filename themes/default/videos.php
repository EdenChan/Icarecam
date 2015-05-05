<?php
    require_once('header.php');
?>
<section id="page-title">

            <div class="container clearfix">
                <h1>视频演示</h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo site_url();?>">主页</a></li>
                    <li><a href="<?php echo site_url('videos/all');?>">视频演示</a></li>
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
                        <?php foreach($videos as $v):?>
                        <div class="entry clearfix">
                            <div class="entry-image">
                                <iframe width="300" height="200" src="<?php echo $v['videos_src'];?>" frameborder=0 allowfullscreen></iframe>
                            </div>
                            <div class="entry-c">
                                <div class="entry-title">
                                    <h2><a href="<?php echo site_url('videos/single').'/'. $v['videos_id'];?>"><?php echo $v['videos_name'];?></a></h2>
                                </div>
                                <div class="entry-content">
                                    <p><?php echo $v['videos_desc'];?></p>
                                    <a href="<?php echo site_url('videos/single').'/'. $v['videos_id'];?>"class="button button-3d button-small button-rounded button-lime button-light">了解更多</a>
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
            require_once('footer.php');
        ?>