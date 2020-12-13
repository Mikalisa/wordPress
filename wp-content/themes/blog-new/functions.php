<?php
/**
 *Recommended way to include parent theme styles.
 *(Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 */
/**
 * Loads the child theme textdomain.
 */
function blog_new_load_language() {
    load_child_theme_textdomain( 'blog-new' );
}
add_action( 'after_setup_theme', 'blog_new_load_language' );

/**
* Enqueue Style
*/
function blog_new_style() {
    wp_enqueue_style( 'gist-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'blog-new-style',get_stylesheet_directory_uri() . '/style.css',array('gist-style') );
    wp_enqueue_style('blog-new-google-fonts', '//fonts.googleapis.com/css?family=Oswald');
}
add_action( 'wp_enqueue_scripts', 'blog_new_style' );
/**
 * Gist Theme Customizer default value
 *
 * @package Gist
 */
if ( !function_exists('gist_default_theme_options') ) :
    function gist_default_theme_options() {

        $default_theme_options = array(
            'gist_primary_color' => '#d6002a',
            'gist-footer-copyright'=> esc_html__('All Rights Reserved 2020','blog-new'),
            'gist-footer-gototop' => 1,
            'gist-sticky-sidebar'=> 1,
            'gist-sidebar-options'=>'right-sidebar',
            'gist-font-url'=> esc_url('//fonts.googleapis.com/css?family=Merriweather', 'blog-new'),
            'gist-font-family' => esc_html__('Merriweather','blog-new'),
            'gist-font-size'=> 16,
            'gist-font-line-height'=> 2,
            'gist-letter-spacing'=> 0,
            'gist-blog-excerpt-options'=> 'excerpt',
            'gist-blog-excerpt-length'=> 25,
            'gist-blog-featured-image'=> 'full-image',
            'gist-blog-meta-options'=> 1,
            'gist-blog-read-more-options' => esc_html__('Read More','blog-new'),
            'gist-blog-related-post-options'=> 1,
            'gist-blog-pagination-type-options'=>'numeric',
            'gist-related-post'=> 0,
            'gist-single-featured'=> 1,
            'gist-footer-social' => 0,
            'gist-extra-breadcrumb' => 1,
            'gist-breadcrumb-text' => esc_html__('You Are Here','blog-new'),
            'gist-breadcrumb-display-from-option'=> 'theme-default',
            'gist-breadcrumb-display-from-plugins'=>'yoast'
        );
        return apply_filters( 'gist_default_theme_options', $default_theme_options );
    }
endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blog_new_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Footer Widget 1', 'blog-new'),
        'id' => 'footer-1',
        'description' => esc_html__('Add widgets here.', 'blog-new'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget 2', 'blog-new'),
        'id' => 'footer-2',
        'description' => esc_html__('Add widgets here.', 'blog-new'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget 3', 'blog-new'),
        'id' => 'footer-3',
        'description' => esc_html__('Add widgets here.', 'blog-new'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget 4', 'blog-new'),
        'id' => 'footer-4',
        'description' => esc_html__('Add widgets here.', 'blog-new'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'blog_new_widgets_init');

/**
 * Add class in post list
 *
 * @since Blog New 1.0.0
 *
 */
add_filter('post_class', 'blog_new_post_column_class');
function blog_new_post_column_class($classes)
{
    if( !is_singular()){
            $classes[] = 'ct-col-2';
        }
    return $classes;
}