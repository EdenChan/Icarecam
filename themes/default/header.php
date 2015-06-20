<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

    <!-- Stylesheets
    ============================================= -->
    <link rel="stylesheet" href="<?php echo base_url('themes/default/css/bootstrap.css'); ?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url('themes/default/style.css'); ?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url('themes/default/css/dark.css'); ?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url('themes/default/css/font-icons.css'); ?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url('themes/default/css/animate.css'); ?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url('themes/default/css/magnific-popup.css'); ?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url('themes/default/css/colors.css'); ?>" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url('themes/default/css/responsive.css'); ?>" type="text/css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <!-- External JavaScripts
    ============================================= -->
    <script type="text/javascript" src="<?php echo base_url('themes/default/js/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('themes/default/js/plugins.js'); ?>"></script>

    <!-- Document Title
    ============================================= -->
    <title>IcareCam</title>

</head>

<body class="stretched">

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Header
    ============================================= -->
    <header id="header">

        <div id="header-wrap">

            <div class="container clearfix">

                <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                <!-- Logo
                ============================================= -->
                <div id="logo">
                    <a href="<?php echo site_url(); ?>" class="standard-logo"><img
                            src="<?php echo base_url('themes/default/images/logo.png'); ?>" alt="Logo"></a>
                </div>
                <!-- #logo end -->

                <!-- Primary Navigation
                ============================================= -->
                <nav id="primary-menu">

                    <ul>
                        <li class="sub-menu"><a href="<?php echo site_url('goods/all'); ?>">
                                <div>云摄像头</div>
                            </a></li>
                        <li class="sub-menu"><a href="<?php echo site_url('videos/all'); ?>">
                                <div>视频演示</div>
                            </a></li>
                        <li><a href="#">
                                <div>服务支持</div>
                            </a>
                            <ul>
                                <li><a href="<?php echo site_url('apps/all'); ?>">
                                        <div>APP下载</div>
                                    </a></li>
                                <li><a href="<?php echo site_url('siteInfo/show/faqs'); ?>">
                                        <div>常见问题</div>
                                    </a></li>
                                <li><a href="<?php echo site_url('siteInfo/show/aftermarketPolicies'); ?>">
                                        <div>售后政策</div>
                                    </a></li>
                            </ul>
                        <li class="sub-menu"><a href="<?php echo site_url('user/showCenter'); ?>">
                                <div>会员中心</div>
                            </a></li>
                    </ul>

                    <!-- Top Cart
                    ============================================= -->
                    <div id="top-cart">
                        <a href="<?php echo site_url('cart/show'); ?>"
                           onclick="window.location.href='<?php echo site_url('cart/show'); ?>'"
                           id="top-cart-trigger"><i class="icon-shopping-cart"></i><span>购</span></a>
                    </div>
                    <!-- #top-cart end

                                            <!-- Top Search
                                            ============================================= -->
                    <!-- <div id="top-search">
                        <a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
                        <form action="search.html" method="get">
                            <input type="text" name="q" class="form-control" value="" placeholder="搜索本站产品">
                        </form>
                    </div> --><!-- #top-search end -->

                </nav>
                <!-- #primary-menu end -->

            </div>

        </div>

    </header>
    <!-- #header end -->