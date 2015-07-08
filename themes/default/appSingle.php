<?php
require_once 'header.php';
?>
    <section id="page-title">

        <div class="container clearfix">
            <h1>App下载</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url(); ?>">主页</a></li>
                <li><a href="<?php echo site_url('apps/all'); ?>">App下载</a></li>
                <li class="active"><?php echo $apps['apps_name']; ?></li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="single-post nobottommargin">

                    <!-- Single Post
                    ============================================= -->
                    <div class="entry clearfix">

                        <!-- Entry Title
                        ============================================= -->
                        <div class="entry-title">
                            <h2><?php echo $apps['apps_name']; ?></h2>
                        </div>
                        <!-- .entry-title end -->

                        <!-- Entry Meta
                        ============================================= -->
                        <ul class="entry-meta clearfix">
                            <li><i class="icon-calendar3"></i><?php echo substr($apps['add_time'], 0, 10); ?></li>
                        </ul>
                        <!-- .entry-meta end -->

                        <!-- Entry Image
                        ============================================= -->
                        <div class="entry-image app-image bottommargin">
                            <img src="<?php echo base_url('public/uploads/') . '/' . $apps['apps_img']; ?>"
                                 alt="AppSingle">
                        </div>
                        <!-- .entry-image end -->

                        <!-- Entry Content
                        ============================================= -->
                        <div class="entry-content notopmargin">
                            <?php echo $apps['apps_desc']; ?><br>
<!--                            <a href="--><?php //echo base_url('public/uploads/') . '/' . $apps['apps_file']; ?><!--"-->
<!--                               class="button button-3d button-small button-rounded button-lime button-light">下载文件</a>-->
                        </div>

                        <!-- Comments
                        ============================================= -->
                        <!-- 多说评论框 start -->
                        <div class="ds-thread" data-thread-key="<?php echo $apps['apps_id'] + 9999; ?>"
                             data-title="<?php echo $apps['apps_name']; ?>"
                             data-url="<?php echo site_url('apps/single') . '/' . $apps['apps_id']; ?>"></div>
                        <!-- 多说评论框 end -->
                        <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
                        <script type="text/javascript">
                            var duoshuoQuery = {short_name: "icarecam"};
                            (function () {
                                var ds = document.createElement('script');
                                ds.type = 'text/javascript';
                                ds.async = true;
                                ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                                ds.charset = 'UTF-8';
                                (document.getElementsByTagName('head')[0]
                                || document.getElementsByTagName('body')[0]).appendChild(ds);
                            })();
                        </script>
                        <!-- 多说公共JS代码 end -->
                        <!-- #comments end -->


                    </div>
                </div>
            </div>
        </div>


    </section><!-- #content end -->

<?php
require_once 'footer.php';
?>