<?php


class blogrock_Actions
{

    static $instance;
    public $default_config;

    public function __construct($conObj)
    {
        self::$instance =& $this;

        $this->default_config = $conObj;

        //add actions

        add_action('blogrock_breadcrumb', array($this, 'blogrock_breadcrumb'), 10);
        add_action('blogrock_footer_text', array($this, 'blogrock_footer_text'), 10);
        add_action('blogrock_prev_next_post_navigation', array($this, 'blogrock_prev_next_post_navigation'), 10);
        add_action('blogrock_custom_single_page_pagination', array($this, 'blogrock_custom_single_page_pagination'), 10, 1);
        add_action('blogrock_comment_list', array($this, 'blogrock_comment_list'), 10);
        add_action('blogrock_excerpt_max_charlength', array($this, 'blogrock_excerpt_max_charlength'), 10, 1);
        add_action('blogrock_display_postformat', array($this, 'blogrock_display_postformat'), 10, 1);
        add_action('blogrock_display_meta_post', array($this, 'blogrock_display_meta_post'), 10, 1);
        add_action('blogrock_mobile_menu', array($this, 'blogrock_mobile_menu'), 10, 1);
        add_action('blogrock_date_and_link', array($this, 'blogrock_date_and_link'), 10, 1);
        add_action('blogrock_comment_link_header', array($this, 'blogrock_comment_link_header'), 10);
        add_action('blogrock_comments_count', array($this, 'blogrock_comments_count'), 10);

        add_action('blogrock_category_line', array($this, 'blogrock_category_line'), 10, 1);
        add_action('blogrock_get_layout_sidebar', array($this, 'blogrock_get_layout_sidebar'), 10, 1);
        add_action('blogrock_get_related_post_box', array($this, 'blogrock_get_related_post_box'), 10, 2);
        add_action('blogrock_dynamic_sidebar_grid', array($this, 'blogrock_dynamic_sidebar_grid'), 10, 1);
        add_action('blogrock_password_form', array($this, 'blogrock_password_form'), 10);
        add_action('blogrock_sticky_post_slider', array($this, 'blogrock_sticky_post_slider'), 10);
        add_action('blogrock_footer_sidebar', array($this, 'blogrock_footer_sidebar'), 10, 1);

        add_action('blogrock_author_line', array($this, 'blogrock_author_line'), 10, 1);
        add_action('blogrock_entry_tags', array($this, 'blogrock_entry_tags'), 10, 1);

        add_action('blogrock_block_date', array($this, 'blogrock_block_date'), 10);

        add_action('blogrock_social_links', array($this, 'blogrock_social_links'), 10, 1);


        /*pagination hooks*/
        add_action('blogrock_prev_next_links', array($this, 'blogrock_prev_next_links'), 10);
        add_action('blogrock_pagination_number_links', array($this, 'blogrock_pagination_number_links'), 10);

        add_action('blogrock_before_content', array($this, 'blogrock_preloader'), 10);

        add_action('blogrock_header_page', array($this, 'blogrock_single_page_header'), 10);

        /*navigation actions*/

        add_action('blogrock_top_bar', array($this, 'blogrock_display_top_bar'), 10);
        add_action('blogrock_top_search', array($this, 'blogrock_top_search'), 10);

        /*footer actions*/

        add_action('blogrock_after_content', array($this, 'blogrock_go_top_button'), 10);


    }


    /**
     * Print breadcrumb trail


     */
    function blogrock_breadcrumb()
    {

        global $post;

        //Get bredcrumb separator option
        $sep = '<span class="smartlib-separator">'.get_theme_mod('blogrock_breadcrumb_separator_page', '/'). '</span>';



        echo '<ol class="breadcrumb">';
        if (!is_front_page()) {
            echo '<li><a href="';
            echo esc_url( home_url() );
            echo '">';
            esc_attr( bloginfo('name') );
            echo '</a>' .   $sep   . '</li>';

            if (is_category() || is_single()) {
                $args = array('fields' => 'all');
                $categories = wp_get_post_categories( $post->ID, $args );

                if(count($categories)){

                    foreach($categories  as $category){
                        ?>
                        <li><a href="<?php echo esc_url( get_category_link($category->term_id) ) ?>"><?php echo esc_html( $category->name ) ?></a><?php echo  $sep   ?></li>
                        <?php
                    }

                }


            }

            if (is_page()) {
                echo '<li>' . esc_attr( get_the_title() ) . '</li>';
            }
        }
        echo '</ol>';
    }

    /**
     * Display footer text
     */
    public function blogrock_footer_text()
    {
        return esc_html(get_theme_mod('blogrock_text_footer'));
    }


    /**
     * Display meta line under post title - use for widgets, boxs
     *
     * @param string $type author|category|date
     */
    function blogrock_display_meta_post($type = 'blog_loop')
    {
        ?>
        <p class="smartlib-meta-line">
            <?php

            do_action('blogrock_date_and_link', $type);
            do_action('blogrock_display_postformat', $type);
            do_action('blogrock_comment_link_header');
            do_action('blogrock_category_line', $type);
            ?>
        </p>
    <?php

    }

    /**
     * Display Date Line with link
     *
     * @param string $type
     *
     * @return void
     */
    function blogrock_date_and_link($type = '')
    {


        $type = $this->get_context_type($type);


        $option = (int) esc_attr( $this->blogrock_get_option('blogrock_show_date_', $type, '1') );

        if ($option == 1) {

            $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

            if (get_the_time('U') !== get_the_modified_time('U')) {
                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
            }

            $archive_year  = get_the_time('Y');
            $archive_month = get_the_time('m');
            $archive_day   = get_the_time('d');

            $time_string = sprintf($time_string,
                esc_attr(get_the_date('c')),
                esc_html(get_the_date()),
                esc_attr(get_the_modified_date('c')),
                esc_html(get_the_modified_date())
            );
            $class = apply_filters('blogrock_conditional_class', '', 'blogrock_display_sidepanel_blog_single', '0');
            printf('<span class="smartlib-data-line%1$s"><i class="fa fa-calendar"></i> <a href="%2$s" rel="bookmark">%3$s</a></span>',
                esc_attr( $class ),
                esc_url(get_day_link($archive_year, $archive_month, $archive_day)),
                 $time_string
            );
        }

    }

    /**
     * Get context type based on conditional tags and passed type
     *
     * @param $passed_type
     *
     * @return string
     */
    public function get_context_type($passed_type)
    {
        global $post;

        $type = '';

        if ($passed_type == '') {

            if (is_page()) {
                $type = 'page';
            }

            if (is_single()) {
                $type = 'blog_single';
            }
            if (is_archive()) {
                $type = 'blog_loop';
            }

            if ($type == '') {
                $type = 'default';
            }
            return $type;

        } else {
            return $passed_type;
        }


    }

    /**
     * Get theme option based on prefix and context - if not exists get default
     * @param $prefix
     * @param $type
     * @param int $default
     * @return int
     */
    private function blogrock_get_option($prefix, $type, $default = 1)
    {

        $option = esc_attr( get_theme_mod($prefix . $type) );

        if ($option == '') {
            $option = esc_attr( get_theme_mod($prefix . 'default', $default) );
        }
        return (int)$option;
    }

    /**
     * Get large date block on single post page
     * @param string $type
     */
    function blogrock_block_date($type = '')
    {


        $type = $this->get_context_type($type);


        $option = (int) esc_attr( $this->blogrock_get_option('blogrock_show_date_', $type) );


        if ($option == 1) {
            ?>

            <?php
            $time_string = '<span class="smartlib-date-label"><time datetime="%1$s"><strong>%2$s</strong>%3$s</time></span>';


            $time_string = sprintf($time_string,
                esc_attr(get_the_date('c')),
                esc_html(get_the_date('d')),
                esc_html(get_the_date('M Y'))

            );

            echo esc_attr( $time_string );
        }

    }

    /**
     * Display comment link
     *
     * @param string $type
     */
    public function blogrock_comment_link_header($type = '')
    {

        $type = $this->get_context_type($type);

        $option = (int) esc_attr( get_theme_mod('blogrock_show_replylink_' . $type, 1));
        if ($option == 1) {
            if (comments_open() && is_single()) {
                ?>
                <span
                    class="meta-label comment-label"><?php comments_popup_link(__('Comment', 'blogrock-core') . esc_attr( apply_filters('blogrock_get_awesome_ico', 'comments')) . '</span>', esc_attr__('1 Reply', 'blogrock-core'), esc_attr__('% Replies', 'blogrock-core')); ?></span>
            <?php

            }
        }
    }

    public function blogrock_comments_count($type = 'default')
    {


        $option = (int) esc_attr( get_theme_mod('blogrock_show_comments_count_' . $type, 1) );

        if ($option == 1) {
            ?>
            <a href="<?php echo esc_url( get_comments_link() ); ?>"><i class="fa fa-comments" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="Comments"></i> <?php echo esc_attr( get_comments_number()) ?>
            </a>
        <?php
        }

    }


    /*
                * Display smartlib paginate links
                */

    /**
     * @param string $type - single or loop
     */
    public function blogrock_category_line($type = '')
    {

        $type = $this->get_context_type($type);

        $option = (int) esc_attr( get_theme_mod('blogrock_show_category_' . $type, '1'));

        if ($option == 1) {

            $category_list = get_the_category_list(__(' / ', 'blogrock-core'));

            if (strlen($category_list > 0)) {
                ?>
                <span class="label label-default smartlib-category-line">
	                <?php echo esc_html( get_the_category_list(esc_attr__(' / ', 'blogrock-core')) ); ?>
                </span>
            <?php
            }

        }
    }

    public function blogrock_display_postformat($type = '', $show_text = false)
    {
        global $post;


        $type = $this->get_context_type($type);
        $option = (int)$this->blogrock_get_option('blogrock_show_postformat_', $type, 1);



        $post_format = esc_attr( get_post_format($post->ID) );

        $promoted_formats = $this->default_config->get_promoted_formats();
        if ($option == 1) {
            if (in_array($post_format, $promoted_formats)) {
                ?>
                <span
                    class="smartlib-format-ico <?php echo esc_attr( apply_filters('blogrock_get_awesome_ico', 'fa-li fa fa-check-square', $post_format)) ?>"><?php echo ($show_text) ? esc_attr( $post_format ) : ''; ?></span>
            <?php
            }
        }
    }

    public function blogrock_pagination_number_links()
    {
        global $wp_query;

        $big = 999999999; // This needs to be an unlikely integer
        $current = max(1, get_query_var('paged'));
        // For more options and info view the docs for paginate_links()
        // http://codex.wordpress.org/public function_Reference/paginate_links
        $paginate_links = paginate_links(array(
            'base' => str_replace($big, '%#%', get_pagenum_link($big)),
            'current' => $current,
            'total' => $wp_query->max_num_pages,
            'mid_size' => 5,
            'type' => 'array'
        ));

        // Display the pagination if more than one page is found
        if ($paginate_links) {

            echo '<ul class="pagination smartlib-pagination">';
            foreach ($paginate_links as $row) {

                ?>
                <li><?php echo esc_html( $row ) ?></li>
            <?php

            }
            echo '</ul><!--// end .pagination -->';
        }
    }

    public function blogrock_prev_next_links()
    {
        ?>
        <div class="smartlib-next-prev">
            <?php next_posts_link(esc_attr__('&larr; Older posts', 'blogrock-core')); ?>
            <?php previous_posts_link(esc_attr__('Newer posts &rarr;', 'blogrock-core')); ?>
        </div>
    <?php

    }

    /**
     * Displays navigation to next/previous post on single  page.
     */

    public function blogrock_prev_next_post_navigation()
    {
        $option = esc_attr( get_theme_mod('blog_show_prev_next'));

        if ($option == '1') {
            locate_template('/views/snippets/prev-next-nav.php', true);

        }
    }

    /**
     * Modyfication wp_link_pages() - <!--nextpage--> pagination
     *
     * @return mixed
     */
    public function blogrock_custom_single_page_pagination($args = '')
    {

        $defaults = array(
            'before' => '<div id="post-pagination" class="smartlib-pagination-area">' . esc_attr__('Pages:', 'blogrock-core'),
            'after' => '</div>',
            'text_before' => '',
            'text_after' => '',
            'next_or_number' => 'number',
            'nextpagelink' => esc_attr__('Next page', 'blogrock-core'),
            'previouspagelink' => esc_attr__('Previous page', 'blogrock-core'),
            'pagelink' => '%',
            'echo' => 1
        );

        $r = wp_parse_args($args, $defaults);
        $r =  apply_filters('wp_link_pages_args', $r);
        extract($r, EXTR_SKIP);

        global $page, $numpages, $multipage, $more, $pagenow;

        $output = '';
        if ($multipage) {
            if ('number' == $next_or_number) {
                $output .= $before;
                for ($i = 1; $i < ($numpages + 1); $i = $i + 1) {
                    $j = str_replace('%', $i, $pagelink);
                    $output .= ' ';
                    if ($i != $page || ((!$more) && ($page == 1)))
                        $output .= _wp_link_page($i);
                    else
                        $output .= '<span class="current-post-page">';

                    $output .= $text_before . $j . $text_after;
                    if ($i != $page || ((!$more) && ($page == 1)))
                        $output .= '</a>';
                    else
                        $output .= '</span>';
                }
                $output .= $after;
            } else {
                if ($more) {
                    $output .= $before;
                    $i = $page - 1;
                    if ($i && $more) {
                        $output .= _wp_link_page($i);
                        $output .= $text_before . $previouspagelink . $text_after . '</a>';
                    }
                    $i = $page + 1;
                    if ($i <= $numpages && $more) {
                        $output .= _wp_link_page($i);
                        $output .= $text_before . $nextpagelink . $text_after . '</a>';
                    }
                    $output .= $after;
                }
            }
        }else{

            wp_link_pages( $defaults );
        }
        if (is_single() || is_page()) {
            if ($echo)
                echo esc_html( $output );

            return $output;
        } else {
            return '';
        }
    }

    /*
                * Return excerpt with limit
                */

    /**
     * Display comment components
     *
     * @param $comment
     * @param $args
     * @param $depth
     *
     * @return mixed
     */
    public function blogrock_comment_component($comment, $args, $depth)
    {
        // Proceed with normal comments.
        global $post;



        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                // Display trackbacks differently than normal comments.
                ?>
                <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                    <p><?php esc_html_e('Pingback:', 'blogrock-core'); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_attr__('(Edit)', 'blogrock-core'), '<span class="edit-link">', '</span>'); ?></p>
                </li>
                <?php
                break;
            default :


               locate_template('smart-lib/snippets/comment-component.php', true);

                break;
        endswitch; // end comment_type check
    }


    public function blogrock_excerpt_max_charlength($charlength)
    {
        $excerpt = get_the_excerpt();
        $charlength++;

        if (mb_strlen($excerpt) > $charlength) {
            $subex = mb_substr($excerpt, 0, $charlength - 5);
            $exwords = explode(' ', $subex);
            $excut = -(mb_strlen($exwords[count($exwords) - 1]));
            if ($excut < 0) {
                echo esc_html( mb_substr($subex, 0, $excut) );
            } else {
                echo esc_attr( $subex );
            }
            echo '...';
        } else {
            echo esc_attr( $excerpt );
        }
    }


    /*
                             *  Add dynamic select menus  for mobile device navigation * *
                             *
                             * @since BlogRock Core 1.0
                             * @link: http://kopepasah.com/tutorials/creating-dynamic-select-menus-in-wordpress-for-mobile-device-navigation/
                             *
                             * @param array $args
                             *
                        */



    /**
     * Display lt ie7 info
     */

    public function blogrock_lt_ie7_info()
    {
        ?>
        <!--[if lt IE 7]>
        <p class=chromeframe>Your browser is <em>ancient!</em> Upgrade to a
            different browser.
        </p>
        <![endif]-->
    <?php

    }

    public function  blogrock_mobile_menu($args = array())
    {


        $defaults = array(
            'theme_location' => '',
            'menu_class' => 'mobile-menu',
        );

        $args = wp_parse_args($args, $defaults);

        $menu_item = $this->wp_nav_menu_select();

        if ($menu_item) {
            ?>

            <select id="menu-<?php echo $args['theme_location'] ?>" class="<?php echo esc_attr( $args['menu_class'] ) ?>">
                <option value=""><?php esc_html_e('- Select -', 'blogrock-core'); ?></option>
                <?php foreach ($menu_item as $id => $data) : ?>
                    <?php if ($data['parent'] == true) : ?>
                        <optgroup label="<?php echo esc_attr($data['item']->title) ?>">
                            <option value="<?php echo esc_attr($data['item']->url) ?>"><?php echo esc_html($data['item']->title) ?></option>
                            <?php foreach ($data['children'] as $id => $child) : ?>
                                <option value="<?php echo esc_attr($child->url) ?>"><?php echo esc_html($child->title) ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    <?php else : ?>
                        <option value="<?php echo esc_url( $data['item']->url ) ?>"><?php echo esc_html( $data['item']->title ) ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        <?php

        } else {
            ?>
            <select class="menu-not-found">
                <option value=""><?php esc_html_e('Menu Not Found', 'blogrock-core'); ?></option>
            </select>
        <?php

        }

    }

    public function wp_nav_menu_select($args = array())
    {

        $menu = array();


        $menu_locations = get_nav_menu_locations();

        $layout_variant = esc_attr( get_theme_mod('page_layout') );

        //*check layout variant
        if (!in_array($layout_variant, $this->mobile_menu_exclude)) {

            if (isset($menu_locations[$args['theme_location']])) {
                $menu = wp_get_nav_menu_object($menu_locations[$args['theme_location']]);
            }

            if (count($menu) > 0 && isset($menu->term_id)) {


                $menu_items = wp_get_nav_menu_items($menu->term_id);

                $children = array();
                $parents = array();

                foreach ($menu_items as $id => $data) {
                    if (empty($data->menu_item_parent)) {
                        $top_level[$data->ID] = $data;
                    } else {
                        $children[$data->menu_item_parent][$data->ID] = $data;
                    }
                }

                foreach ($top_level as $id => $data) {
                    foreach ($children as $parent => $items) {
                        if ($id == $parent) {
                            $menu_item[$id] = array(
                                'parent' => true,
                                'item' => $data,
                                'children' => $items,
                            );
                            $parents[] = $parent;
                        }
                    }
                }

                foreach ($top_level as $id => $data) {
                    if (!in_array($id, $parents)) {
                        $menu_item[$id] = array(
                            'parent' => false,
                            'item' => $data,
                        );
                    }
                }

                uksort($menu_item, array(__CLASS__, 'wp_nav_menu_select_sort'));
                return $menu_item;


            } else {

                return false;
            }
        }
    }


    /*
                * Print author line
                */

    /**
     * Get alyout sidebar- based on main layout setting - blogrock_get_sidebar decorator
     *
     * @param string $type
     */
    public function blogrock_get_layout_sidebar($type = 'default')
    {
        global $post;


        //get columns layout class
        $layout_class_array = $this->default_config->layout_class_array;

        /*get option index from get_theme_mod()*/

        $index = esc_attr( get_theme_mod('blogrock_layout_' . $type) );

        //get category layout type

        $cat = get_query_var('cat');

        $cat_extra_data = esc_attr( get_option('category_' . $cat) );

        $category_variant = isset($cat_extra_data['blogrock_layout_category']) ? (int) esc_attr( $cat_extra_data['blogrock_layout_category'] ) : 0;


        if (isset($post) && is_singular('page')) {
            $index = esc_attr( get_post_meta($post->ID, 'blogrock_layout_' . $type, true) );
        }


        if ($index == '') {

            $index = esc_attr( get_theme_mod('blogrock_layout_default', 1) );

        }

        if (isset($layout_class_array[$index]) && strlen($layout_class_array[$index]['sidebar']) > 0 && $category_variant != 1) {
            ?>
            <section id="sidebar"
                     class="smartlib-layout-sidebar <?php echo esc_attr( apply_filters('blogrock_sidebar_layout_class', 'col-sm-16 col-md-4', $layout_class_array[$index]['sidebar']) ) ?>">
                <?php

                $this->blogrock_get_sidebar($type); //get sidebar based on configuration

                ?>
            </section>
        <?php

        }

    }

    /**
     * @param string $type - context or type sidebar param
     */
    public function blogrock_get_sidebar($type = 'default')
    {


        echo  apply_filters('blogrock_before_sidebar', '<ul class="smartlib-layout-list">', $type) ?>
        <?php

        dynamic_sidebar($this->blogrock_get_context_sidebar($type));//get sidebar based on configuration

        ?>
        <?php echo  apply_filters('blogrock_after_sidebar', '</ul>', $type)  ?>

    <?php

    }

    /**
     * Return awesome icon based on key_class
     *
     * @param $key_class
     */

    /**
     * Get sidebar key based on context index
     * see $assign_context_sidebar in class-config.php file
     *
     * @param string $type
     *
     * @return mixed
     */
    private function blogrock_get_context_sidebar($type = 'default')
    {
        $assign_context_sidebar = $this->default_config->assign_context_sidebar;
        if (isset($assign_context_sidebar[$type][1])) {
            return $assign_context_sidebar[$type][1];
        } else {
            return $assign_context_sidebar['default'][1];
        }

    }

    public function blogrock_author_line($type = '')
    {

        $type = esc_attr( $this->get_context_type($type) );

        $option = (int) esc_attr($this->blogrock_get_option('blogrock_show_author_', $type) );


        if ($option == 1) {
            ?>
            <span
                class="smartlib-metaline smartlib-author-line vcard"><?php esc_html_e('Published by: ', 'blogrock-core') ?> <?php esc_url(the_author_posts_link() ); ?> </span>
        <?php

        }
    }

    /**
     * Prints tag line with HTML
     */
    public function blogrock_entry_tags($type = 'blog_loop')
    {
        $option = (int) esc_attr( get_theme_mod('blogrock_show_tags_' . $type, 1) );
        ?>
        <?php if (has_tag() && $option == 1): ?>
        <div class="smartlib-entry-tags">
            <i class="fa fa-tags"></i> <?php the_tags(esc_attr__('Tags: ', 'blogrock-core'), '  '); ?>
        </div>
    <?php endif ?>
    <?php

    }

    /**
     * Custom form password
     *
     * @since BlogRock Core 1.0
     * @return string
     */

    public function blogrock_password_form()
    {
        global $post;
        $label = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
        $o = '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post" class="password-form"><div class="row"><div class="sixteen"><i class="icon-lock icon-left"></i>' . esc_html__("To view this protected post, enter the password below:", 'blogrock-core') . '</div><label for="' . $label . '" class="four mobile-four">' . esc_attr__("Password:", 'blogrock-core') . ' </label><div class="eight mobile-four"><input name="post_password" id="' . $label . '" type="password" size="20" /></div><div class="four mobile-four"><input type="submit" name="Submit" value="' . esc_attr__("Submit", 'blogrock-core') . '" /></div>
    </div></form>
    ';
        return $o;
    }

    /**
     * Return version of homepage layout
     * 1 - blog + sidebar
     * 2 - classic blog
     *
     * @return mixed
     */
    public function blogrock_version_homepage()
    {

        $version = esc_attr( get_theme_mod('project_homepage_version') );
        if (empty($version)) {
            //return default (first value)
            return 1;
        }
        return $version;

    }

    public function blogrock_sticky_post_slider()
    {


        $sticky = esc_url( get_option('sticky_posts') );

        $args = array(
            'post__in' => $sticky,
        );

        $slider_news = new WP_Query($args);
        if ($slider_news->have_posts()) {
            ?>

            <!-- Front Page Slider -->
            <div class="smartlib-front-slider">
                <ul class="slides">
                    <?php
                    while ($slider_news->have_posts()) {
                        $slider_news->the_post();

                        locate_template('/views/snippets/sticky-slider.php', true);

                    }
                    ?>
                </ul>
            </div>
            <!-- .End Front Page Slider -->
            <?php

            wp_reset_postdata();
        }
    }

    /**
     * Athor avatar action
     */
    function blogrock_author_avatar()
    {

        $option = (int) esc_attr( get_theme_mod('blogrock_show_avatar', 1) );

        $author_meta_image = isset($this->default_config->layout_class_array['author_meta_image'])
            ? esc_attr( $this->default_config->layout_class_array['author_meta_image'] ) : '';
        if ($option == 1) {
            ?>
            <div class="author-avatar">
                <?php
                $user_image = esc_url( get_the_author_meta($author_meta_image, get_the_author_meta('ID')));
                if (!empty($user_image)) {
                    ?>
                    <img src="<?php echo esc_url( $user_image ) ?>"
                         alt="<?php  printf(esc_attr__('About %s', 'blogrock-core'), get_the_author()); ?>"/>
                <?php

                } else
                    echo get_avatar(esc_html(get_the_author_meta('user_email')), esc_attr( apply_filters('blogrock_author_bio_avatar_size', 68))); ?>
            </div>
        <?php

        }

    }

    /**
     *  Return value form  $this->icon_awesome_translate_class
     *
     * @param $key
     *
     * @return mixed|void
     */
    public function get_awesome_icon_class($key)
    {

        $icon_awesome_translate_class = $this->default_config->icon_awesome_translate_class;

        if (isset($icon_awesome_translate_class[$key])) {
            $icon_class = $icon_awesome_translate_class[$key];
        } else {
            $icon_class = $icon_awesome_translate_class['default_icon'];
        }

        return esc_attr( apply_filters('blogrock_icon_class', $icon_class));
    }




    /**
     * Show preloader
     */
    public function blogrock_preloader()
    {

        $show_preloader = esc_attr( get_theme_mod('blogrock_show_preloader', 1) );

        if ($show_preloader == 1) {
            ?>
            <div class="smartlib-pre-loader">
                <div class="smartlib-load-icon">

                    <div class="smartlib-spinner">
                        <i class="fa fa-spinner fa-pulse  fa-3x fa-spin"></i>
                    </div>
                </div>
            </div>
        <?php
        }
    }

    /**
     * Display image page header
     */
    function blogrock_single_page_header()
    {

        global $post;

        if (is_page() && !is_front_page()) {

            locate_template('/views/snippets/header-single-page.php', true);

        }
        ?>

    <?php

    }


    function blogrock_display_top_bar($type = 'default')
    {
        global $post;

        $meta_option = '';

        $option = (int) esc_attr( $this->blogrock_get_option('blogrock_show_top_bar_', $type, 1));

        if (isset($post->ID))
            $meta_option = esc_attr( get_post_meta($post->ID, 'blogrock_show_top_bar_page', true) );

        if (strlen($meta_option) > 0) {
            $option = (int)$meta_option;
        }

        if ($option == 1)

            locate_template('/views/snippets/top-bar.php', true);

    }

    /**
     * Display Search Form
     */
    function blogrock_top_search($type = 'default')
    {
        $option = (int) esc_attr($this->blogrock_get_option('blogrock_show_search_in_navbar_', $type, 2));

        if ($option == 2)
            locate_template('/views/snippets/top-search.php', true);
    }

    function blogrock_social_links($area = 'top')
    {

        $config_media_options = $this->default_config->supported_social_media;


        $option = (int) esc_attr( get_theme_mod('blogrock_display_social_links_' . $area, 1));

        $i = 1;
        if ($option == 1) {
            ?>
            <ul class="list-inline  smartlib-social-icons-navbar pull-right">

                <?php
                foreach ($config_media_options as $key => $row) {
                    $link =  esc_attr( get_theme_mod('blogrock_socialmedia_link_' . $key, 1)) ;
                    if (strlen($link) > 0) {
                        ?>
                        <li><a href="<?php echo esc_url($link) ?>"
                               class="smartlib-icon smartlib-small-square-icon smartlib-<?php echo esc_attr($key ) ?>-ico"><i
                                    class="<?php echo esc_attr(apply_filters('blogrock_get_awesome_ico', 'fa fa-facebook', $key)) ?>"></i></a>
                        </li>
                    <?php
                    }
                }
                ?>


            </ul>
        <?php
        }
    }


    /**
     * Display sidebar in footer
     *
     * @param string $type
     */
    function blogrock_footer_sidebar($type = 'default')
    {
        global $post;

        $meta_option = '';

        $show_sidebar = (int) esc_attr( get_theme_mod('blogrock_display_sidebar_footer_' . $type, '1') );

        if (isset($post->ID)) {
            $meta_option = esc_attr( get_post_meta($post->ID, 'blogrock_display_sidebar_footer_page', true) );
        }


        if (strlen($meta_option) > 0) {
            $show_sidebar = (int) esc_attr( $meta_option );
        }


        if ($show_sidebar == 1) {
            ?>
            <section class="smartlib-content-section smartlib-dark-section smartlib-full-width-section">
                <div class="container smartlib-footer-sidebar">

                    <div class="row">
                        <?php
                        dynamic_sidebar('sidebar-footer');
                        ?>
                    </div>
                </div>
            </section>
        <?php
        }
    }

    /**
     * Display Go to To button
     */
    function blogrock_go_top_button()
    {

        $show_button = esc_attr( get_theme_mod('blogrock_display_go_top_link_footer', '1') );

        if ($show_button == '1') {
            ?>
            <a href="#" class="btn btn-primary smartlib-btn-go-top animated" id="scroll-top-top"><i
                    class="fa fa-chevron-up"></i></a>
        <?php
        }

    }


}



?>