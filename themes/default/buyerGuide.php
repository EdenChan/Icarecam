<?php
require_once('header.php');
?>
    <!-- Page Title
            ============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h1>购买指南</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url(); ?>">主页</a></li>
                <li class="active">购买指南</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">
                <?php echo $siteInfo['siteInfo_desc']; ?>
            </div>
        </div>

    </section><!-- #content end -->
<?php
require_once('footer.php');
?>