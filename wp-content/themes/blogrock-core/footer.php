<footer class="smartlib-footer-area ">
    <!--Footer sidebar-->

                <?php do_action('blogrock_footer_sidebar', 'default'); ?>

    <!--END Footer sidebar-->
    <!--Footer bottom - customizer-->
    <section class="smartlib-content-section smartlib-bottom-footer">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <?php

                    $one_page_check = blogrock_if_is_one_page();
                    if (has_nav_menu('footer_pages') && !$one_page_check) {

                        wp_nav_menu(
                            array('theme_location' => 'footer_pages',
                            'menu_class' => 'smartlib-menu', 'depth' =>1));

                    }

                    ?>
                </div>

            </div>
            <div class="row">

                <div class="col-lg-6">
                    <p><?php blogrock_get_section_info_text('footer'); ?></p>
                </div>
                <div class="col-lg-6">
                    <?php do_action('blogrock_social_links', 'footer') ?>
                </div>
            </div>
        </div>
    </section>
    <!--END Footer bottom - customizer-->
</footer>

<?php
do_action('blogrock_after_content');
wp_footer();

?>

</body>
</html>
