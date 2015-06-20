<?php
require_once('header.php');
?>
    <!-- Page Title
            ============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h1>售后政策</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url(); ?>">主页</a></li>
                <li class="active">售后政策</li>
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
                            <h3>产品退、换、修服务说明</h3>
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