<?php
    require_once('header.php');
?>
<!-- Page Title
        ============================================= -->
        <section id="page-title">

            <div class="container clearfix">
                <h1>企业文化</h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo site_url();?>">主页</a></li>
                    <li class="active">企业文化</li>
                </ol>
            </div>

        </section><!-- #page-title end -->

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">
                    <?php echo $siteInfo['siteInfo_desc'];?>
                </div>

            </div>

        </section><!-- #content end -->
        <?php
            require_once('footer.php');
        ?>