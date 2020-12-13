<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wpxon_Blog
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head> 
<body <?php body_class(); ?>> 
    <?php global $post; ?>
    <div class="wpxon-wrapper">    
        <header class="wpxon-header">
            <div class="main-menu-area-one">
                <div class="container">
                    <div class="menu-logo">
                        <div class="logo logo-area">
                            <?php wpxon_logo(); ?>
                        </div>
                        <nav id="easy-menu">
                            <?php wpxon_main_menu(); ?> 
                        </nav><!--#easy-menu-->
                       <div class="header-icons hidden-lg hidden-md ">  
                           <a href="#" class="header-humberger-icon" id="humbarger-icon"><i class="fa fa-bars"></i> </a>
                       </div>
                    </div>
                </div>
            </div>
        </header>
        <nav class="mobile-background-nav">
            <div class="mobile-inner">
                <span class="mobile-menu-close"><i class="icon-icomoon-close"></i></span>
                <?php wpxon_mobile_menu(); ?> 
            </div>
        </nav>   

        <?php  
            if(is_page()){  
                $wpxon_hdr_switch = get_post_meta($post->ID,'_wpxon_blog_banner_style',true);  
                if($wpxon_hdr_switch=='2'){
                    $wpxon_hdr_img = true;
                }elseif($wpxon_hdr_switch=='1'){
                    $wpxon_hdr_img = false;   
                }else{
                    $wpxon_hdr_img = false;    
                }
            }else{ 
                $wpxon_hdr_switch =  get_theme_mod( 'choice_header' );
                if($wpxon_hdr_switch=='2'){
                    $wpxon_hdr_img = true;
                }elseif($wpxon_hdr_switch=='1'){
                    $wpxon_hdr_img = false;   
                }else{
                    $wpxon_hdr_img = false;    
                }
            }
            if($wpxon_hdr_switch=='3'):
                get_template_part( 'inc/slider');
            else:
        ?> 
        <div id="page-title-wrap" class="<?php echo ($wpxon_hdr_img)? 'extra-height' : ''; ?>">
            <div class="container">
                    <h1 class="page-title <?php echo (is_front_page() && is_home()) ? 'text-center' : ''; ?>">
                        <?php wpxon_breadcrumb(); ?>
                    </h1> 
                <?php if($wpxon_hdr_switch!='2'): ?>
                    <?php if(!is_front_page() && !is_home()): ?>
                        <div id="crumbs">
                            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home','wpxon-blog'); ?></a>  <span class="current"><?php wpxon_breadcrumb(); ?></span>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div> 
        </div>
        <?php  endif; ?>