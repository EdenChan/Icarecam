<?php
    require_once('header.php');
?>
        <section id="slider" class="slider-parallax swiper_wrapper full-screen clearfix">

            <div class="swiper-container swiper-parent">
                <div class="swiper-wrapper">
                    <?php for($i=1;$i<5;$i++) {
                        $file_name = 'public/uploads/index_slide_'.$i.'.jpg';
                        if (file_exists($file_name)){
                            $index_slide_url = 'index_slide_'.$i.'_url';
                            $index_slide_url_true = $$index_slide_url;
                        ?>
                        <a href="<?php echo $index_slide_url_true['indexInfo_desc'];?>" class="swiper-slide dark" style="background-image: url(<?php echo $file_name; ?>);"></a>
                    <?php }
                    }?>
                </div>
                <div id="slider-arrow-left"><i class="icon-angle-left"></i></div>
                <div id="slider-arrow-right"><i class="icon-angle-right"></i></div>
            </div>

            <script>
                jQuery(document).ready(function($){
                    var swiperSlider = new Swiper('.swiper-parent',{
                        paginationClickable: false,
                        slidesPerView: 1,
                        grabCursor: true,
                        loop: true,
                        autoplay : 3000,
                        speed:1500,
                        onSwiperCreated: function(swiper){
                            $('[data-caption-animate]').each(function(){
                                var $toAnimateElement = $(this);
                                var toAnimateDelay = $(this).attr('data-caption-delay');
                                var toAnimateDelayTime = 0;
                                if( toAnimateDelay ) { toAnimateDelayTime = Number( toAnimateDelay ) + 750; } else { toAnimateDelayTime = 750; }
                                if( !$toAnimateElement.hasClass('animated') ) {
                                    $toAnimateElement.addClass('not-animated');
                                    var elementAnimation = $toAnimateElement.attr('data-caption-animate');
                                    setTimeout(function() {
                                        $toAnimateElement.removeClass('not-animated').addClass( elementAnimation + ' animated');
                                    }, toAnimateDelayTime);
                                }
                            });
                        },
                        onSlideChangeStart: function(swiper){
                            $('#slide-number-current').html(swiper.activeIndex + 1);
                            $('[data-caption-animate]').each(function(){
                                var $toAnimateElement = $(this);
                                var elementAnimation = $toAnimateElement.attr('data-caption-animate');
                                $toAnimateElement.removeClass('animated').removeClass(elementAnimation).addClass('not-animated');
                            });
                        },
                        onSlideChangeEnd: function(swiper){
                            $('#slider .swiper-slide').each(function(){
                                if($(this).find('video').length > 0) { $(this).find('video').get(0).pause(); }
                            });
                            $('#slider .swiper-slide:not(".swiper-slide-active")').each(function(){
                                if($(this).find('video').length > 0) {
                                    if($(this).find('video').get(0).currentTime != 0 ) $(this).find('video').get(0).currentTime = 0;
                                }
                            });
                            if( $('#slider .swiper-slide.swiper-slide-active').find('video').length > 0 ) { $('#slider .swiper-slide.swiper-slide-active').find('video').get(0).play(); }

                            $('#slider .swiper-slide.swiper-slide-active [data-caption-animate]').each(function(){
                                var $toAnimateElement = $(this);
                                var toAnimateDelay = $(this).attr('data-caption-delay');
                                var toAnimateDelayTime = 0;
                                if( toAnimateDelay ) { toAnimateDelayTime = Number( toAnimateDelay ) + 300; } else { toAnimateDelayTime = 300; }
                                if( !$toAnimateElement.hasClass('animated') ) {
                                    $toAnimateElement.addClass('not-animated');
                                    var elementAnimation = $toAnimateElement.attr('data-caption-animate');
                                    setTimeout(function() {
                                        $toAnimateElement.removeClass('not-animated').addClass( elementAnimation + ' animated');
                                    }, toAnimateDelayTime);
                                }
                            });
                        }
                    });

                    $('#slider-arrow-left').on('click', function(e){
                        e.preventDefault();
                        swiperSlider.swipePrev();
                    });

                    $('#slider-arrow-right').on('click', function(e){
                        e.preventDefault();
                        swiperSlider.swipeNext();
                    });

                    $('#slide-number-current').html(swiperSlider.activeIndex + 1);
                    $('#slide-number-total').html(swiperSlider.slides.length);
                });
            </script>

        </section>

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap">

                <div class="section header-stick">
                    <div class="container clearfix">
                        <div class="row">

                            <div class="col-md-9">
                                <div class="heading-block bottommargin-sm">
                                    <h3>Icarecam简介</h3>
                                </div>

                                <p class="nobottommargin"><?php echo $index_brief['indexInfo_desc'];?></p>
                            </div>

                            <div class="col-md-3">
                                <a href="<?php echo site_url('siteInfo/show/companyInfo');?>" class="button button-3d button-dark button-large btn-block center" style="margin-top: 30px;">了解更多</a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="container clearfix">
                    <?php foreach($goods as $v):?>
                    <div class="col_half nobottommargin">
                        <div class="feature-box media-box">
                            <div class="fbox-media">
                                <img src="<?php echo base_url('public/uploads/').'/'.$v['goods_img'];?>" alt="商品图片">
                            </div>
                            <div class="fbox-desc">
                                <h3><a href="<?php echo site_url('goods/single').'/'. $v['goods_id'];?>"><?php echo $v['goods_name'];?></a></h3>
                                <p><?php echo $v['goods_brief'];?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                    <div class="clear"></div>

                </div>

                <div class="section parallax bottommargin-lg" style="background-image: url('themes/default/images/index_para.png'); padding: 100px 0;" data-stellar-background-ratio="0.3">
                    <div class="heading-block center nobottomborder nobottommargin">
                        <h2><span style="color: #333"><?php echo $index_slogan['indexInfo_desc'];?></span></h2>
                    </div>
                </div>

                                <div class="container clearfix">
                                <?php foreach($videos as $a):?>

                                    <div class="col_two_fifth nobottommargin">
                                        <a href="#">
                                            <iframe height=300 width=430 src="<?php echo $a['videos_src'];?>" frameborder=0 allowfullscreen></iframe>
                                        </a>
                                    </div>

                                    <div class="col_three_fifth nobottommargin col_last">

                                        <div class="heading-block">
                                            <h2>推荐视频</h2>
                                        </div>

                                        <p><?php echo $a['videos_desc'];?></p>
                                    </div>
                                    <?php endforeach;?>
                                    <div class="clear"></div>

                                </div>

                                <div class="section topmargin-lg" style="margin-bottom:-80px;">
                                    <div class="container clearfix">

                                        <div class="heading-block center">
                                            <h2>Icarecam产品优势</h2>
                                        </div>

                                        <div class="clear bottommargin-sm"></div>
                                        <div class="col_one_third nobottommargin">
                                            <div class="feature-box fbox-small fbox-plain" data-animate="fadeIn" data-delay="200">
                                                <div class="fbox-icon">
                                                    <a href="#"><i class="icon-bulb"></i></a>
                                                </div>
                                                <h3>优势1</h3>
                                                <p><?php echo $index_merit_1['indexInfo_desc'];?></p>
                                            </div>
                                        </div>

                                        <div class="col_one_third nobottommargin">
                                            <div class="feature-box fbox-small fbox-plain" data-animate="fadeIn" data-delay="400">
                                                <div class="fbox-icon">
                                                    <a href="#"><i class="icon-heart2"></i></a>
                                                </div>
                                                <h3>优势2</h3>
                                                <p><?php echo $index_merit_2['indexInfo_desc'];?></p>
                                            </div>
                                        </div>

                                        <div class="col_one_third nobottommargin col_last">
                                            <div class="feature-box fbox-small fbox-plain" data-animate="fadeIn" data-delay="600">
                                                <div class="fbox-icon">
                                                    <a href="#"><i class="icon-note"></i></a>
                                                </div>
                                                <h3>优势3</h3>
                                                <p><?php echo $index_merit_3['indexInfo_desc'];?></p>
                                            </div>
                                        </div>

                                        <div class="clear"></div>

                                    </div>
                                </div>


                    <div class="clear"></div>
            </div>

        </section><!-- #content end -->
<?php
    require_once('footer.php');
?>
