<?php
require_once('header.php');
?>
    <section id="page-title">

        <div class="container clearfix">
            <h1>视频演示</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url(); ?>">主页</a></li>
                <li><a href="<?php echo site_url('videos/all'); ?>">视频演示</a></li>
                <li class="active"><?php echo $videos['videos_name']; ?></li>
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
                            <h2><?php echo $videos['videos_name']; ?></h2>
                        </div>
                        <!-- .entry-title end -->

                        <!-- Entry Meta
                        ============================================= -->
                        <ul class="entry-meta clearfix">
                            <li><i class="icon-calendar3"></i><?php echo substr($videos['add_time'], 0, 10); ?></li>
                        </ul>
                        <!-- .entry-meta end -->

                        <!-- Entry Image
                        ============================================= -->
                        <div class="entry-image bottommargin">
                            <iframe width="600" height="400" src="<?php echo $videos['videos_src']; ?>" frameborder=0
                                    allowfullscreen></iframe>
                        </div>
                        <!-- .entry-image end -->

                        <!-- Entry Content
                        ============================================= -->
                        <div class="entry-content notopmargin">

                            <?php echo $videos['videos_desc']; ?>

                            <!-- Comments
                            ============================================= -->
                            <!-- 多说评论框 start -->
                            <div class="ds-thread" data-thread-key="<?php echo $videos['videos_id'] + 99999; ?>"
                                 data-title="<?php echo $videos['videos_name']; ?>"
                                 data-url="<?php echo site_url('videos/single') . '/' . $videos['videos_id']; ?>"></div>
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
        </div>


    </section><!-- #content end -->

<?php
require_once('footer.php');
?>