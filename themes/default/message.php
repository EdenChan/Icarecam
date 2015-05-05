<?php require_once('header.php');?>
	<meta http-equiv="Refresh" content ="<?php echo $wait;?> ;url=<?php echo $url;?>"/>
	<!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div class="heading-block center nobottomborder">
                        <h4><?php echo $message;?></h4>
                        <br>
                        <?php echo $wait;?> 秒之后跳转
                    </div>

                </div>

            </div>

        </section><!-- #content end -->

<?php require_once('footer.php');?>