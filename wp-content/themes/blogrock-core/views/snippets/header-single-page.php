<?php

global $post;

$header_bg = blogrock_page_image_header();
$dark_section = esc_attr( get_post_meta($post->ID, 'blogrock_header_dark_section', true) );
$paralax_section = esc_attr( get_post_meta($post->ID, 'blogrock_header_paralax_effect', true) );
$section_overlay_color = esc_attr( get_post_meta($post->ID, 'blogrock_page_header_color_background', true) );

if(strlen($header_bg)>0){

    $image = esc_attr( wp_get_attachment_image_src($header_bg, 'full'));
    $image
    ?>
    <section class="<?php echo esc_attr( apply_filters('blogrock_page_header_class', 'smartlib-full-width-section smartlib-page-image-header',  $dark_section, $paralax_section, $section_overlay_color)); ?>" style="background: url('<?php echo esc_url( $image[0] ); ?>')" <?php echo strlen(esc_attr($section_overlay_color))>0? 'data-type="background" data-overlay-color="'.esc_attr($section_overlay_color).'"' :''; ?>>

        <div class="container smartlib-no-padding">

            <div class="smartlib-table-container">

                <div class="smartlib-table-cell">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="page-header smartlib-page-title"><?php the_title() ?>
                                <small><?php echo esc_html( blogrock_get_subtitle() ) ?></small>
                            </h1>
                        </div>
                        <div class="col-sm-4 text-right">
                            <div class="smartlib-breadcrumb">
                                <?php do_action('blogrock_breadcrumb'); ?>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </section>
    <?php
}else{
?>
<section class="smartlib-content-section container">
    <?php do_action('blogrock_breadcrumb'); ?>

</section>
<?php
}
?>
