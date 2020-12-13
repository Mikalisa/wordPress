<!DOCTYPE html>
<!--[if lt IE 9]>
<html class="ie lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width"/>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <link rel="pingback" href="<?php  bloginfo('pingback_url'); ?>"/>

    <?php

    wp_head();
    ?>

</head>

<body <?php body_class(); ?>>
<?php
do_action('blogrock_before_content');


        if ( function_exists( 'wp_body_open' ) ) {
            wp_body_open();
        } else {
            do_action( 'wp_body_open' );
        }

?>

<a class="skip-link screen-reader-text" href="#blogrock-content"><?php esc_html_e('Skip to content', 'blogrock-core') ?></a>
<!-- Navigation -->

<nav class="navbar navbar-default navbar-inverse smrtlib-navigation-bar-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"><?php blogrock_logo(); ?></div>
            <div class="col-md-8">


                <div class="nav navbar-nav navbar-right" >

                    <?php
                    wp_nav_menu(
                        array('theme_location' => 'top_pages',
                            'menu_class' => 'nav navbar-nav navbar-right smartlib-menu smartlib-navbar-menu',
                            'fallback_cb' => 'blogrock_bootstrap_navwalker::fallback',
                            'walker' => new blogrock_bootstrap_navwalker()

                        )); ?>

                </div>
                <?php

                do_action('blogrock_top_search');


                ?>

            </div>
            <!-- /.navbar-collapse --></div>
    </div>
    <!-- Brand and toggle get grouped for better mobile display -->


    <!-- Collect the nav links, forms, and other content for toggling -->

    </div>
    <!-- /.container-fluid -->
</nav>

<nav class="navbar navbar-inverse  navbar-default smrtlib-navigation-bar-bottom" role="navigation">


                <!-- navbar collapse -->

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only"><?php esc_html_e('Toggle navigation', 'blogrock-core');?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <?php
                    wp_nav_menu(
                        array('theme_location' => 'main_menu',
                            'menu_class' => 'nav navbar-nav smartlib-menu smartlib-navbar-menu',
                            'fallback_cb' => 'blogrock_bootstrap_navwalker::fallback',
                            'walker' => new blogrock_bootstrap_navwalker()

                        )); ?>
                </div>
                <!-- /.navbar-collapse -->





    </div>
    <!-- /.container -->
</nav>
<!-- END Navigation -->

<div id="blogrock-content"></div>
