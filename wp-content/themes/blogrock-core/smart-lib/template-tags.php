<?php


/**
 * Display Slider on Home Page
 * 1 - animate slider
 * 2 - sticky post slider
 * 3 - external slider
 * 4 - ithoust slider
 *
 * @return mixed
 */

function blogrock_slider()
{

    /* get home page slider options */

    $slider_version = (int) esc_attr( get_theme_mod('blogrock_homepage_slider', 2));
    $slider_shortcode = esc_attr( get_theme_mod('blogrock_homepage_slider_shortcode') );

    switch ($slider_version) {
        case 1:
            do_action('blogrock_sticky_post_slider');
            break;
        case 2:
            echo do_shortcode('[as-slider]'); //display animate slider
            break;
        case 3:
            if (strlen($slider_shortcode) > 0)
                //echo do_shortcode( $slider_shortcode );
                break;
        default:

    }

}

/**
 * Display author box
 */
function blogrock_display_author_box()
{

    $type = 'blog_single';
    $option = (int) esc_attr( get_theme_mod('blogrock_show_author_' . $type, 1) );

    if ( is_multi_author() && $option == 1) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries.

        require_once locate_template('/views/snippets/info-author.php');

    endif;

}


/**
 * Display breadcrub trail
 */
function blogrock_breadcrumb()
{
    ?>
    <section class="smartlib-content-section">
        <?php do_action('blogrock_breadcrumb'); ?>
    </section>
<?php
}


function blogrock_post_thumbnail($size = 'thumbnail')
{
    if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
        return;
    }

    if (is_singular()) :
        ?>

        <span>
		<?php the_post_thumbnail($size); ?>
	</span><!-- .post-thumbnail -->

    <?php else : ?>

        <a href="<?php the_permalink(); ?>" aria-hidden="true">
            <?php
            the_post_thumbnail($size, array('alt' => get_the_title()));
            ?>
        </a>

    <?php endif; // End is_singular()
}

/**
 * Display all thumbnail block
 * @param string $size
 * @param string $type
 */
function blogrock_post_thumbnail_block($size = 'thumbnail', $type = 'blog_loop')
{
    global $post;

    if (strlen($img = get_the_post_thumbnail(get_the_ID(), array(150, 150)))) {
        ?>
        <div class="smartlib-thumbnail-outer">
            <?php blogrock_get_postformat($type); ?>
            <?php blogrock_get_category_line($type); ?>
            <?php blogrock_post_thumbnail($size) ?>
            <?php

            if(!is_single()){
                blogrock_meta_post();
            }

            ?>
        </div>
    <?php
    }
}

/**
 * Display meta line insingle post, loop
 * @param string $type
 */
function blogrock_meta_post($type = 'blog_loop')
{
    ?>
    <p class="smartlib-meta-line">


        <?php
        if (!strlen($img = get_the_post_thumbnail(get_the_ID(), array(150, 150)))) {

            blogrock_get_category_line($type);
            blogrock_get_postformat($type);
        }
        ?>
        <?php
        do_action('blogrock_date_and_link', $type);
        if (is_single()) {
            do_action('blogrock_author_line', $type);
            do_action('blogrock_comments_count', 'default');

        }


        ?>
    </p>
<?php
}

/**
 * Display home page articles
 */
function blogrock_display_homepage_articles()
{

    $sticky = esc_attr( get_option('sticky_posts') );
    $slider_version = esc_attr( get_theme_mod('home_page_slider') );
    $news_column = esc_attr( get_theme_mod('home_page_columns') );
    $limit = esc_attr( get_theme_mod('home_page_columns') );

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


    /* if sticky post in slider above ommit sticky post*/

    if ($slider_version == 3) {
        $args = array(


            'post___not_in' => $sticky,
            'ignore_sticky_posts' => 1,
            'paged' => $paged

        );
    } else {

        $args = array(
            'paged' => $paged

        );
    }


    $news = new WP_Query($args);

    if ($news->have_posts()) : ?>
        <ul class="smartlib-grid-list smartlib-list-columns-<?php echo esc_attr( $news_column ); ?>">
            <?php /* start the loop */ ?>
            <?php while ($news->have_posts()) : $news->the_post(); ?>
                <li>  <?php
                    get_template_part('views/content'); ?>

                </li>
            <?php endwhile;
            ?>
        </ul>
        <?php blogrock_list_pagination('nav-below') ?>
    <?php else : ?>
        <article id="post-0" class="post no-results not-found">

            <?php get_template_part('views/content', 'none'); ?>
        </article>
    <?php endif; // end have_posts() check

}

/**
 * Display Layout header - banner or Site description
 *
 * @return mixed
 */

function blogrock_get_header()
{
    ?>
    <header class="frontpage-header" role="banner">

        <?php



        $header_image = get_header_image();

        $banner_header = stripslashes( esc_html( get_theme_mod('blogrock_code_header')));
        $front_page_header = esc_attr( get_theme_mod('blogrock_homepage_header', 1));
        $blogrock_fluid_header = esc_attr( get_theme_mod('blogrock_fluid_header_frontpage') );


        $slider_section_class = ($blogrock_fluid_header=='2')? 'smartlib-section-fluid':'smartlib-content-section';

        //add default value


        $slider_shortcode = esc_attr( get_theme_mod('blogrock_homepage_slider_shortcode') );

        if (is_front_page()) {

            ?>
            <div class="smartlib-content-section">

            <?php

            if (!empty($slider_shortcode)&& $front_page_header == 1) {

                ?>
                <div class="<?php echo esc_attr( $slider_section_class ) ?> smartlib-main-image-header">
                    <?php echo do_shortcode($slider_shortcode) ?>
                </div>
            <?php
            } elseif (!empty($header_image) && $front_page_header == 1) { ?>
                <div class="<?php echo esc_attr( $slider_section_class ) ?> smartlib-main-image-header">
                    <img src="<?php echo esc_url($header_image); ?>"
                         class="header-image"
                         width="<?php echo esc_attr( get_custom_header()->width ); ?>"
                         height="<?php echo esc_attr( get_custom_header()->height ); ?>"
                         alt=""/></div>
            <?php } elseif (!empty($banner_header)) {
                ?>
                <div class="smartlib-header-banner">
                    <?php echo esc_html( $banner_header ); ?>
                </div>
            <?php
            } else {

                if ($front_page_header == 1) {
                    ?>

                    <h2 class="site-description" itemprop="description"><?php esc_html( bloginfo('description') ); ?></h2>

                <?php
                }


            }

            ?>

            </div>
                <?php

        }
        ?>

    </header>
<?php
}

/**
 * Display search menu
 */
function blogrock_searchmenu()
{
    ?>
    <ul id="top-switches" class="no-bullet right">
        <li>
            <a href="#toggle-search" class="harmonux-toggle-topbar toggle-button button">
                <span class="fa fa-search"></span>
            </a>
        </li>
        <li class="hide-for-large">
            <a href="#top-navigation" class="harmonux-toggle-topbar toggle-button button">
                <span class="fa fa-align-justify"></span>
            </a>
        </li>
    </ul>
<?php
}

function blogrock_searchform()
{
    ?>
    <form action="<?php echo esc_url( home_url('/') ); ?>" method="get" role="search" id="smartlib-top-search-container">
        <div class="row">
            <div class="col-md-16">
                <input id="search-input" type="text" name="s"
                       placeholder="<?php esc_attr_e('Search for ...', 'blogrock-core'); ?>" value="">
                <input class="button" id="top-searchsubmit" type="submit"
                       value="<?php esc_html_e('Search', 'blogrock-core'); ?>">
            </div>
        </div>

    </form>
<?php
}

function blogrock_toggle_navigation_button()
{
    ?>
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header pull-right">
        <button type="button" class=" navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navigation">
            <span class="sr-only sr-only-focusable"><?php esc_attr__('Toggle navigation', 'blogrock-core'); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

    </div>
<?php
}

/**
 * Print Search button
 */
function blogrock_toggle_search_button()
{
    ?>
    <button type="button" data-toggle="collapse" data-target="#search-container"
            class="bstarter-toggle-topbar pull-right btn btn-default">
        <span class="sr-only sr-only-focusable"><?php esc_html_e('Search', 'blogrock-core');?></span>
        <span class="glyphicon glyphicon-search"></span>
    </button>
<?php
}



/**
 * Print logo theme
 *
 * @return mixed
 */
function blogrock_logo($logo_image = '')
{


    $imageID = esc_attr (get_theme_mod('blogrock_logo', '') );

    echo  apply_filters('blogrock_before_logo', '<h4 class="smartlib-logo-header" itemprop="headline">') ;
    ?>
    <a href="<?php echo esc_url( home_url('/') ); ?>"
       title="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>"
       rel="home"
       class="smartlib-site-logo <?php echo (is_numeric($imageID) || strlen($logo_image) > 0) ? 'smartlib-image-logo-link' : ''; ?>">
        <?php
        if (strlen($imageID)> 0) {
            ?>
            <img src="<?php echo esc_attr( $imageID ); ?>"
                 alt="<?php echo esc_url( bloginfo('name') ); ?>"/>
        <?php
        } elseif (strlen($logo_image) > 0) {
            ?><img src="<?php echo esc_url( get_template_directory_uri() . $logo_image ) ?>"
                   alt="<?php echo esc_attr( bloginfo('name') ); ?>" /><?php
        } else {
            bloginfo('name');
        }
        ?></a>
    <?php
    echo  apply_filters('blogrock_after_logo', '</h4>') ;
}

/**
 * Display related posts component
 *
 * @param     $display_post_limit
 * @param int $columns_per_slide
 */

function blogrock_get_related_post_box($display_post_limit = 8, $columns_per_slide = 5)
{
    global $post;

    $category = get_the_category();

    $show_related = (int) esc_attr( get_theme_mod('blogrock_show_related_posts', 1));

    $limit = (int) esc_attr( get_theme_mod('blogrock_limit_related_posts', 8) );
    $per_column = (int)esc_attr( get_theme_mod('blogrock_related_posts_limit_per_column') );


    $display_post_limit = $limit ? $limit : $display_post_limit;

    $columns_per_slide = $per_column ? $per_column : $columns_per_slide;

    if ($show_related == 1) {
        $query = __BLOGROCK::$layout->get_related_post_box($category[0]->cat_ID, $post->ID, $display_post_limit, $columns_per_slide);

        $limit = $query->found_posts;
        if ($limit != 0) {

            ?>
            <div class="smartlib-related-posts">

                    <h3><?php esc_html_e('Related posts', 'blogrock-core') ?></h3>


                    <ul class="smartlib-layout-list smartlib-item-list">
                        <?php

                        while ($query->have_posts()) {
                            $query->the_post();

                            $post_format = get_post_format();
                                ?>
                                <li>
                                <?php
                                if ('' != get_the_post_thumbnail()) {
                                    ?>

                                    <a href="<?php the_permalink(); ?>" class="smartlib-thumbnail-outer"
                                       title="<?php echo esc_attr(sprintf(esc_attr__('Permalink to %s', 'blogrock-core'), the_title_attribute('echo=0'))); ?>"
                                        ><?php do_action('blogrock_get_format_ico', $post_format) ?><?php the_post_thumbnail('blogrock-medium-thumb'); ?></a>

                                <?php
                                }


                                ?>
                                <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                                <?php if (!strlen($img = get_the_post_thumbnail(get_the_ID(), array(150, 150)))) { ?>
                                    <?php do_action('blogrock_display_meta_post', 'default') ?>
                                <?php } ?>



                                </li>
                                <?php


                        }// end while


                        ?>
                    </ul>



            </div>
        <?php
        }
        wp_reset_query();
        wp_reset_postdata();
    }
}

/**
 * Display related portfolio
 *
 * @param     $display_post_limit
 * @param int $columns_per_slide
 */


function blogrock_get_related_portfolio_box($display_post_limit = 8, $columns_per_slide = 5)
{
    global $post;

    $term = get_the_terms($post->ID, 'portfolio_category');

    $show_related = (int) esc_attr( get_theme_mod('blogrock_show_related_posts', 1) );

    $limit = (int) esc_attr( get_theme_mod('blogrock_limit_related_posts', 8) );
    $per_column = (int) esc_attr( get_theme_mod('blogrock_related_posts_limit_per_column'));


    $display_post_limit = $limit ? $limit : $display_post_limit;

    $columns_per_slide = $per_column ? $per_column : $columns_per_slide;

    if ($show_related == 1) {
        $query = __BLOGROCK::$layout->get_related_portfolio_box($term[0]->term_id, $post->ID, $display_post_limit);

        $limit = $query->found_posts;
        if ($limit != 0) {

            ?>
            <div class="smartlib-related-posts panel">
                <header class="panel-heading">
                    <h3><?php esc_html_e('Related works', 'blogrock-core') ?></h3>
                </header>
                <div class="smartlib-slider-container panel-body">
                    <ul class="smartlib-layout-list slider-list slides ">
                        <?php
                        $i = 1;
                        $j = 1;
                        while ($query->have_posts()) {
                            $query->the_post();


                            if ($i == 1) {
                                ?>
                                <li class="row">
                            <?php
                            }
                            ?>
                            <div class="col-md-3">

                                <div class="smartlib-thumbnail-outer smartlib-thumbnail-hover-area ">

                                    <?php
                                    if ('' != get_the_post_thumbnail()) {
                                        ?>
                                        <?php the_post_thumbnail('blogrock-large-thumb'); ?>
                                    <?php
                                    }

                                    $src = esc_attr( wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'));
                                    ?>

                                    <div class="smartlib-thumbnail-caption smartlib-wide-caption">
                                        <div class="smartlib-table-container">
                                            <div class="smartlib-table-cell smartlib-vertical-middle text-center">
                                                <a href="<?php echo esc_url( get_the_permalink()  ); ?>" class="btn btn-primary"><i
                                                        class="fa fa-link"></i></a> <a href="<?php echo esc_url($src[0]) ?>"
                                                                                       class="btn btn-primary "
                                                                                       rel="smartlib-resize-photo[portfolio_telated]"><i
                                                        class="fa fa-expand"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>

                                    <p><?php the_excerpt() ?></p>
                                </div>
                            </div>

                            <?php
                            if ($i % $columns_per_slide == 0 || $j == $limit) {
                                ?>
                                </li>
                                <?php
                                $i = 1;
                            } else {
                                $i++;
                            }

                            $j++;

                        }// end while


                        ?>
                    </ul>
                </div>


            </div>
        <?php
        }
        wp_reset_query();
        wp_reset_postdata();
    }
}

/**
 * Display pagination on the loop page
 *
 * @param $html_id
 *
 * @return mixed
 */
function blogrock_list_pagination($html_id)
{
    global $wp_query;

    $pagination_option = (int) esc_attr( get_theme_mod('blogrock_pagination_posts', 1));
    $html_id = esc_attr($html_id);
    if ($pagination_option > 0) {
        if ($wp_query->max_num_pages > 1) {
            ?>
            <nav id="<?php echo esc_attr($html_id); ?>" class="smartlib-pagination-area" role="navigation">
                <h3 class="sr-only"><?php esc_html_e('Post navigation', 'blogrock-core'); ?></h3>
                <?php

                if ($pagination_option == '1') {

                    do_action('blogrock_prev_next_links');
                } else {
                    //get custom smartlib pagination
                    do_action('blogrock_pagination_number_links');
                }
                ?>
            </nav>
        <?php

        }
    }
}

function blogrock_box_footer()
{
    ?>
    <p class="smartlib-meta-line smartlib-footer-meta-line">
        <?php do_action('blogrock_author_line', 'blog_loop') ?>
        <span class="pull-right"><?php do_action('blogrock_comments_count', 'default') ?></span>
    </p>
<?php
}

/*template tags actions decorators - get prefix*/

function blogrock_get_date_and_link($type = '')
{
    do_action('blogrock_date_and_link', $type);
}

function blogrock_get_postformat($type = '')
{
    do_action('blogrock_display_postformat', $type);
}

function blogrock_get_category_line($type = '')
{
    do_action('blogrock_category_line', $type);
}

function blogrock_get_author_line($type = '')
{
    do_action('blogrock_author_line', $type);
}


function blogrock_page_image_header()
{
    global $post;

    $header_bg = esc_attr( get_post_meta($post->ID, 'blogrock_page_header_background', true));

    return $header_bg;
}

function blogrock_get_section_info_text($area = 'header')
{
    $info = esc_attr( get_theme_mod('blogrock_text_' . $area, '') );

    if (strlen($info) > 0) {
        echo esc_attr( $info );
    }
}

/*
 * Display page subtitle
 */

function blogrock_get_subtitle()
{
    global $post;

    $subtitle = esc_attr(get_post_meta($post->ID, 'blogrock_page_subtitle', true));

    return $subtitle;
}

/*
 * Check if page has traditional title
 */

function blogrock_page_has_title()
{
    $header_bg = blogrock_page_image_header();

    return !(bool)strlen($header_bg) > 0;
}

function blogrock_if_is_one_page(){
    global $post;

    $template = '';

    if(isset($post->ID)){

        $template = esc_attr( get_post_meta( $post->ID, '_wp_page_template', true ) );

    }



    if($template =='page-one-page.php'){
        return true;
    }
    else{
        return false;
    }

}

/**
 * Display home page name
 */
function blogrock_get_onepage_home(){

    echo esc_attr( get_theme_mod('blogrock_breadcrumb_homepage_name', esc_attr__('Home', 'blogrock-core')));

}

/**
 * Return loop template variant insist on sidebar settings
 * @return string
 */

function blogrock_get_loop_variant(){

    $sidebar_option_blog_loop = esc_attr( get_theme_mod('blogrock_layout_blog_loop', 1) );

    $cat = get_query_var('cat');

    $cat_extra_data = esc_attr( get_option( 'category_' . $cat ) );

    $category_variant = isset($cat_extra_data['blogrock_layout_category'])? (int) esc_attr( $cat_extra_data['blogrock_layout_category']):0;



    if($sidebar_option_blog_loop==0){
        return 'no-sidebar';
    }elseif($category_variant==1){
        return 'no-sidebar';
    }else{
        return 'sidebar';
    }


}


/**
 * Template for comments and pingbacks.
 */
function blogrock_comment_template( $comment, $args, $depth ) {

    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
            // Display trackbacks differently than normal comments.
            ?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p><?php esc_html_e( 'Pingback:', 'blogrock-core' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_attr__( '(Edit)', 'blogrock-core' ), '<span class="edit-link">', '</span>' ); ?></p>
            <?php
            break;
        default :
            // Proceed with normal comments.
            global $post;
            ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comment">
                <header class="comment-meta comment-author vcard">
                    <?php
                    $user_photo = esc_url_raw(get_user_meta( $comment->user_id, 'blogrock_profile_image', true ));
                    if ( ! empty( $user_photo ) ) {
                        ?>
                        <img src="<?php echo esc_url( $user_photo) ?>" alt="User" width="44" height="44" />
                    <?php

                    }
                    else
                        echo get_avatar( $comment, 44 );
                    printf( '<cite class="smartlib-comment-author comment-author fn">%1$s %2$s</cite>',
                        get_comment_author_link(),
                        // If current post author is also comment author, make it known visually.
                        ( $comment->user_id === $post->post_author ) ? '<span> ' . esc_html__( 'Post author', 'blogrock-core' ) . '</span>' : ''
                    );
                    printf( '<span class="smartlib-comment-metadata pull-right"><a href="%1$s"><time datetime="%2$s">%3$s</time></a></span>',
                        esc_url( get_comment_link( $comment->comment_ID ) ),
                        esc_attr( get_comment_time( 'c' ) ),
                        /* translators: 1: date, 2: time */
                        sprintf( esc_attr__( '%1$s at %2$s', 'blogrock-core' ), esc_attr( get_comment_date()), esc_attr(get_comment_time()) )
                    );
                    ?>
                    <?php edit_comment_link( esc_attr__( 'Edit', 'blogrock-core' ), '<p class="smartlib-edit-content-link">', '</p>' ); ?>
                </header>
                <!-- .comment-meta -->

                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'blogrock-core' ); ?></p>
                <?php endif; ?>

                <section class="comment-content comment">
                    <?php comment_text(); ?>
                </section>
                <!-- .comment-content -->

                <div class="reply smartlib-comment-replay">
                    <?php
                    echo  preg_replace( '/comment-reply-link/', 'comment-reply-link ' . 'btn btn-default btn-small pull-right',

                        get_comment_reply_link(array_merge( $args, array(
                            'reply_text' => esc_attr__( 'Reply', 'blogrock-core' ),
                            'depth' => $depth,
                            'max_depth' => $args['max_depth']))), 1 );

                    //comment_reply_link( array_merge( $args, array( , 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div>
                <!-- .reply -->
            </article><!-- #comment-## -->
            <?php
            break;
    endswitch; // end comment_type check
}

/**
 * Display Aythor social profiles
 */

function blogrock_ext_user_profile_fields(){
    /*
     * Social Icons
     */
    $profile_links = array();

    $profile_links['twitter'] =  esc_url(get_the_author_meta('twitter'));
    $profile_links['facebook'] = esc_url(get_the_author_meta('facebook'));
    $profile_links['gplus'] = esc_url(get_the_author_meta('gplus'));
    $profile_links['pinterest'] = esc_url(get_the_author_meta('pinterest'));
    $profile_links['linkedin'] = esc_url(get_the_author_meta('linkedin'));
    $profile_links['youtube'] = esc_url(get_the_author_meta('youtube'));

    if(count($profile_links)>0){
        ?>
        <ul class="smartlib-author-profile-links list-inline">
            <?php
            foreach($profile_links as $key =>$row){
               if(strlen($row)>0){
                ?>
                <li><a href="<?php echo esc_attr( $row ) ?>" class="smartlib-icon smartlib-small-square-icon smartlib-<?php echo esc_attr( $key ) ?>-ico"><i class="<?php echo esc_attr( apply_filters('blogrock_get_awesome_ico', 'fa fa-share', $key) ); ?>"></i></a></li>
            <?php
               }
            }
            ?>
        </ul>

    <?php

    }

}
