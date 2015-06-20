<?php
require_once('header.php');
?>
    <!-- Page Title
            ============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h1>常见问题</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url(); ?>">主页</a></li>
                <li class="active">常见问题</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <!-- Post Content
                ============================================= -->
                <div class="postcontent nobottommargin clearfix">

                    <div id="faqs" class="faqs">

                        <div id="faqs-list" class="fancy-title title-bottom-border">
                            <h3>关于使用Icarecam的方方面面</h3>
                        </div>

                        <?php echo $siteInfo['siteInfo_desc']; ?>
                    </div>

                </div>
                <!-- .postcontent end -->

            </div>

        </div>

    </section><!-- #content end -->
<?php
require_once('footer.php');
?>