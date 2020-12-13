<?php

/**
 * Smartlib Widgets Classes
 *
 * Theme's widgets extends the default WordPress
 * widgets by giving users highly-customizable widget settings.
 *
 * @subpackage Smartlib
 * @since      Smartlib 1.0
 */


/**
 * Custom Search widget class
 *
 * @since 1.0
 */
class Blogrock_Smart_Widget_Search extends WP_Widget
{

    function __construct()
    {

        $widget_ops = array('classname' => 'BlogRock Core_widget_search', 'description' => esc_attr__("A search form for your site", 'blogrock-core'));
        parent::__construct('search', esc_attr__('Blogrock Core Search', 'blogrock-core'), $widget_ops);
    }

    function widget($args, $instance)
    {

        $title = wp_filter_post_kses( apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base));

        echo wp_filter_post_kses( $args['before_widget'] );
        if ($title)
            echo wp_filter_post_kses( $args['before_title'] . $title . $args['after_title']);

        ?>
        <div class="panel-body smartlib-inside-box">
            <?php
            get_search_form();
            ?>
        </div>
        <?php
        echo wp_filter_post_kses( $args['after_widget'] );
    }

    function form($instance)
    {
        $instance = wp_parse_args((array)$instance, array('title' => ''));
        $title = $instance['title'];

        ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'blogrock-core'); ?>
                <input class="widefat"
                       id="<?php echo esc_attr( $this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr( $this->get_field_name('title') ); ?>"
                       type="text"
                       value="<?php echo esc_attr($title); ?>"/></label>
        </p>
    <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $new_instance = wp_parse_args((array)$new_instance, array('title' => ''));
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

}

/**
 * Recent_Posts widget class
 *
 * @since 1.0
 *
 */
class Blogrock_Smart_Widget_Recent_Posts extends WP_Widget
{

    function __construct()
    {

        $widget_ops = array('classname' => 'smartlib-last-articles-widget', 'description' => esc_attr__("The most recent posts on your site (extended contorls)", 'blogrock-core'));
        parent::__construct('smartlib-recent-posts', esc_attr__('Blogrock Core  Extended Recent Posts', 'blogrock-core'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries_Smartlib';


    }

    function widget($args, $instance)
    {

        $cache = wp_cache_get('smartlib-recent-posts', 'widget');

        $title =  apply_filters('widget_title', empty($instance['title']) ? esc_attr__('Recent Posts', 'blogrock-core') : $instance['title'], $instance, $this->id_base);
        if (empty($instance['number']) || !$number = absint($instance['number']))
            $number = 10;
        $show_date = isset($instance['show_date']) ? $instance['show_date'] : false;
        $show_post_thumbnail = isset($instance['show_post_thumbnail']) ? $instance['show_post_thumbnail'] : false;
        $show_post_author = isset($instance['show_post_author']) ? $instance['show_post_author'] : false;

        $r = new WP_Query( esc_attr(apply_filters('widget_posts_args', array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true))));
        ?>
        <?php echo wp_filter_post_kses( $args['before_widget'] ); ?>
        <?php if ($title) echo wp_filter_post_kses( $args['before_title']) . esc_attr( $title ) . wp_filter_post_kses( $args['after_title']); ?>
        <div class="smartlib-inside-box panel-body">
            <?php

            if ($r->have_posts()) :
                ?>
                <ul class="smartlib-layout-list smartlib-vertical-list">
                    <?php while ($r->have_posts()) : $r->the_post(); ?>
                        <li class="smartlib-content-with-separator">
                            <div class="row">
                                <div class="col-xs-4 smartlib-no-padding-right">
                                    <?php
                                    if ('' != get_the_post_thumbnail() && $show_post_thumbnail) {
                                        ?>

                                        <a href="<?php the_permalink() ?>"
                                           class="smartlib-widget-image-outer"><?php the_post_thumbnail('blogrock-medium-square'); ?>
                                        </a>

                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-xs-8">

                                    <h4 class="widget-post-title"><a
                                            href="<?php the_permalink() ?>"><?php if (get_the_title()) the_title();
                                            else the_ID(); ?></a></h4>

                                    <p class="smartlib-meta-line">
                                        <?php do_action('blogrock_date_and_link', 'blog_loop') ?>
                                        <?php do_action('blogrock_author_line', 'blog_loop') ?>
                                    </p>

                                </div>
                            </div>
                        </li>
                    <?php endwhile;

                    wp_reset_postdata();
                    ?>
                </ul>
            <?php
            endif;
            ?>
        </div>
        <?php echo wp_filter_post_kses( $args['after_widget'] ); ?>
        <?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();


        /*
                $cache[$args['widget_id']] = ob_get_flush();
                wp_cache_set( 'widget_recent_posts', $cache, 'widget' );
        
            */
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = esc_attr(($new_instance['title']));
        $instance['number'] = (int) esc_attr($new_instance['number']);
        $instance['show_date'] = (bool)isset($new_instance['show_date'])?1:0;
        $instance['show_post_thumbnail'] = (bool)isset($new_instance['show_post_thumbnail'])?1:0;
        $instance['show_post_author'] = (bool)isset($new_instance['show_post_author'])?1:0;


        $alloptions = wp_cache_get('alloptions', 'options');
        if (isset($alloptions['widget_recent_entries']))
            delete_option('widget_recent_entries');

        return $instance;
    }



    function form($instance)
    {


        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? esc_attr( absint($instance['number'])) : 5;
        $show_date = isset($instance['show_date']) ? (bool)$instance['show_date'] : false;
        $show_post_thumbnail = isset($instance['show_post_thumbnail']) ? (bool)$instance['show_post_thumbnail'] : true;
        $show_post_author = isset($instance['show_post_author']) ? (bool)$instance['show_post_author'] : true;
        ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'blogrock-core'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr( $this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/></p>

        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of posts to show:', 'blogrock-core'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('number')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('number')); ?>"
                   type="text" value="<?php echo esc_attr($number); ?>" size="3"/></p>

        <p><input class="checkbox" type="checkbox" <?php checked($show_date); ?>
                  id="<?php echo esc_attr( $this->get_field_id('show_date') ); ?>"
                  name="<?php echo esc_attr($this->get_field_name('show_date') ); ?>"/>
            <label
                for="<?php echo esc_attr($this->get_field_id('show_date')); ?>"><?php esc_html_e('Display post date?', 'blogrock-core'); ?></label>
        </p>

        <p><input class="checkbox" type="checkbox" <?php checked($show_post_thumbnail); ?>
                  id="<?php echo esc_attr($this->get_field_id('show_post_thumbnail')); ?>"
                  name="<?php echo esc_attr($this->get_field_name('show_post_thumbnail', 'blogrock-core')); ?>"/>
            <label
                for="<?php echo esc_attr($this->get_field_id('show_post_thumbnail')); ?>"><?php esc_html_e('Display post thumbnail?', 'blogrock-core'); ?></label>
        </p>

        <p><input class="checkbox" type="checkbox" <?php checked($show_post_author); ?>
                  id="<?php echo esc_attr($this->get_field_id('show_post_author')); ?>"
                  name="<?php echo esc_attr($this->get_field_name('show_post_author')); ?>"/>
            <label
                for="<?php echo esc_attr($this->get_field_id('show_post_author')); ?>"><?php esc_html_e('Display post author?', 'blogrock-core'); ?></label>
        </p>
    <?php
    }
}


/**
 * One author info widget
 *
 * @since 1.0
 *
 */
class Blogrock_Smart_Widget_One_Author extends WP_Widget
{

    function __construct()
    {
        $widget_ops = array('classname' => 'BlogRock Core_one_author', 'description' => esc_attr__("Short  info & avatar", 'blogrock-core'));
        parent::__construct('BlogRock Core_one-author', esc_attr__('Blogrock Core  One Author Profile', 'blogrock-core'), $widget_ops);
        $this->alt_option_name = 'smartlib-one-author';


    }

    function widget($args, $instance)
    {

        wp_reset_postdata();
        $title = apply_filters('widget_title', $instance['title']);


        $author = get_userdata($instance['user_id']);


        $name = isset( $author->display_name ) ? $author->display_name: '';

        $avatar = esc_url(get_avatar($instance['user_id'], $instance['size']));
        $description = esc_attr(get_the_author_meta('description', $instance['user_id']));
        $author_link = esc_url( get_author_posts_url($instance['user_id']));


        ?>

        <?php echo wp_filter_post_kses( $args['before_widget']); ?>
        <?php if ($title) echo wp_filter_post_kses( $args['before_title'] . esc_attr( $title ) . esc_html( $args['after_title'] )); ?>
        <div class="smartlib-inside-box panel-body">
            <span class="widget-image-outer"><?php echo wp_filter_post_kses( $avatar ) ?></span>
            <h4><a href="<?php echo esc_url($author_link) ?>"><?php echo esc_html($name) ?></a></h4>

            <p class="description-widget"><?php echo esc_html($description) ?></p>
            <?php echo wp_filter_post_kses( $args['after_widget'] ); ?>
        </div>
    <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = esc_attr(strip_tags($new_instance['title']));
        $instance['size'] = esc_attr(strip_tags($new_instance['size']));
        $instance['user_id'] = esc_attr(strip_tags($new_instance['user_id']));

        return $instance;
    }

    function form($instance)
    {
        if (array_key_exists('title', $instance)) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }

        if (array_key_exists('user_id', $instance)) {
            $user_id = esc_attr($instance['user_id']);
        } else {
            $user_id = 1;
        }

        if (array_key_exists('size', $instance)) {
            $size = esc_attr($instance['size']);
        } else {
            $size = 64;
        }

        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'blogrock-core'); ?>
                <input class="widefat"
                       id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                       type="text"
                       value="<?php echo esc_attr($title); ?>"/></label>
        </p>
        <p><label for="<?php echo esc_attr($this->get_field_id('user_id')); ?>"><?php esc_html_e('Authot Name:', 'blogrock-core'); ?>
                <select id="<?php echo esc_attr($this->get_field_id('user_id')); ?>"
                        name="<?php echo esc_attr($this->get_field_name('user_id')); ?>" value="<?php echo esc_attr($user_id); ?>">
                    <?php

                    $args = array(
                        'order' => 'ASC'
                    );

                    $users = get_users($args);

                    foreach ($users as $row) {
                        echo wp_filter_post_kses("<option value='$row->ID' " . ($row->ID == $user_id ? "selected='selected'" : '') . ">$row->user_nicename</option>");
                    }
                    ?>
                </select></label></p>
        <p><label for="<?php echo esc_attr($this->get_field_id('size')); ?>"><?php esc_html_e('Avatar Size:', 'blogrock-core'); ?>
                <select id="<?php echo esc_attr($this->get_field_id('size')); ?>"
                        name="<?php echo esc_attr($this->get_field_name('size')); ?>"
                        value="<?php echo esc_attr($size); ?>">
                    <?php
                    for ($i = 16; $i <= 256; $i += 16) {
                        echo wp_filter_post_kses("<option value='$i' " . ($size == $i ? "selected='selected'" : '') . ">$i</option>");
                    }
                    ?>
                </select></label></p>
    <?php
    }


}


/**
 * Add social profile icons -  widget
 *
 * @since 1.0
 *
 */
class Blogrock_Smart_Widget_Social_Icons extends WP_Widget
{

    public $form_args;

    function __construct()
    {
        $widget_ops = array('classname' => 'BlogRock Core_widget_social_icons', 'description' => esc_attr__("Add social profile icons", 'blogrock-core'));
        parent::__construct('smartlib-social-icons', esc_attr__('Blogrock Core   Social Icons', 'blogrock-core'), $widget_ops);
        $this->alt_option_name = 'smartlib-social-icons';


        $this->form_args = array(
            'title',
            'facebook',
            'gplus',
            'twitter',
            'youtube',
            'pinterest',
            'linkedin',
            'rss'

        );
    }

    function widget($args, $instance)
    {
        $title = esc_attr(apply_filters('widget_title', $instance['title']));


        echo wp_filter_post_kses( $args['before_widget'] );
        ?>
        <?php if ($title) echo wp_filter_post_kses($args['before_title'] . $title . $args['after_title']); ?>
        <div class="smartlib-inside-box panel-body">
            <ul class="smartlib-layout-list smartlib-horizontal-list">
                <?php
                foreach ($this->form_args as $row) {
                    if (isset($instance[$row]) && !empty($instance[$row]) && $row != 'title') {
                        ?>
                        <li><a href="<?php echo esc_attr( $instance[$row] ) ?>"
                               class="smartlib-icon smartlib-large-square-icon smartlib-<?php echo esc_attr( $row ) ?>-ico"><i
                                    class="<?php echo esc_attr(apply_filters('blogrock_get_awesome_ico', 'fa fa-share', $row)); ?>"></i></a>
                        </li>
                    <?php
                    }
                } ?>
            </ul>
        </div>
        <?php
        echo wp_filter_post_kses( $args['after_widget'] ); ?>
    <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        foreach ($this->form_args as $row) {
            $instance[$row] = esc_attr(strip_tags($new_instance[$row]));
        }

        return $instance;
    }

    function form($instance)
    {

        $form_values = array();

        foreach ($this->form_args as $row) {
            if (array_key_exists($row, $instance)) {
                $form_values[$row] = $instance[$row];
            } else {
                $form_values[$row] = '';
            }
        }

        ?>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Short Title:', 'blogrock-core'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($form_values['title']); ?>" /></label>
	<hr />
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php esc_html_e('Facebook:', 'blogrock-core'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($form_values['facebook']); ?>" /></label>
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id('gplus')); ?>"><?php esc_html_e('Google+:', 'blogrock-core'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('gplus')); ?>" name="<?php echo esc_attr($this->get_field_name('gplus')); ?>" type="text" value="<?php echo esc_attr($form_values['gplus']); ?>" /></label>
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php esc_html_e('Youtube:', 'blogrock-core'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" type="text" value="<?php echo esc_attr($form_values['youtube']); ?>" /></label>
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php esc_html_e('Twitter:', 'blogrock-core'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($form_values['twitter']); ?>" /></label>
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id('pinterest') ); ?>"><?php esc_html_e('Pinterest:', 'blogrock-core'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_attr($form_values['pinterest']); ?>" /></label>
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id('linkedin') ); ?>"><?php esc_html_e('LinkedIn:', 'blogrock-core'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_attr($form_values['linkedin']); ?>" /></label>
	</p>



	<?php
    }


}


/**
 * Featured Video Widget
 *
 * @since 1.0
 *
 */
class Blogrock_Smart_Widget_Video extends WP_Widget
{


    function __construct()
    {
        $widget_ops = array('classname' => 'BlogRock Core-video_widget', 'description' => esc_attr__("Featured Video Widget", 'blogrock-core'));
        parent::__construct('BlogRock Core-video-widget', esc_attr__('Blogrock Core  Video Widget', 'blogrock-core'), $widget_ops);
        $this->alt_option_name = 'widget_BlogRock Core-video-widget';




    }

    function widget($args, $instance)
    {
        $title = esc_attr(apply_filters('widget_title', $instance['title']));
        $embed_code = wp_filter_post_kses($instance['embed_code']);
        $more_text = esc_html($instance['more_text']);
        $link = strlen($instance['link'])>0? esc_url($instance['link']):'#';


        echo wp_filter_post_kses( $args['before_widget'] );

        ?>
        <?php if ($title) echo wp_filter_post_kses( apply_filters('blogrock_widget_before_title', $args['before_title'], $instance)) . esc_attr($title) . wp_filter_post_kses(apply_filters('blogrock_widget_after_title', $args['after_title'], $instance)) ; ?>

        <div class="smartlib-inside-box panel-body">
        <?php echo wp_filter_post_kses($embed_code) ?>

        <?php
        if (strlen($more_text) > 0) {
            ?>
            <a href="<?php echo esc_url($link) ?>" class="btn btn-primary more-link pull-right"><?php echo wp_filter_post_kses($more_text) ?></a>
            </div>
        <?php
        }
        ?>

        <?php
        echo wp_filter_post_kses( $args['after_widget'] ); ?>
    <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = esc_attr(strip_tags($new_instance['title']));
        $instance['embed_code'] = wp_filter_post_kses($new_instance['embed_code']);
        $instance['more_text'] = esc_attr($new_instance['more_text']);
        $instance['link'] = esc_url($new_instance['link']);

        return $instance;
    }

    function form($instance)
    {

        $form_values = array();

        if (array_key_exists('title', $instance)) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }

        if (array_key_exists('embed_code', $instance)) {
            $embed_code = wp_filter_post_kses($instance['embed_code']);
        } else {
            $embed_code = '';
        }

        if (array_key_exists('more_text', $instance)) {
            $more_text = esc_attr($instance['more_text']);
        } else {
            $more_text = '';
        }
        if (array_key_exists('link', $instance)) {
            $link = esc_attr($instance['link']);
        } else {
            $link = '';
        }

        ?>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'blogrock-core'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label>
	<hr />
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id('embed_code')); ?>"><?php esc_html_e('Embed code:', 'blogrock-core'); ?><br />
			<textarea id="<?php echo esc_attr($this->get_field_id('embed_code')); ?>" name="<?php echo esc_attr($this->get_field_name('embed_code')); ?>" rows="5" cols="40"><?php echo wp_filter_post_kses($embed_code); ?></textarea></label>
	</p>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id('more_text')); ?>"><?php esc_html_e('More text:', 'blogrock-core'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('more_text')); ?>" name="<?php echo esc_attr($this->get_field_name('more_text')); ?>" type="text" value="<?php echo wp_filter_post_kses($more_text); ?>" /></label>

	</p>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id('link')); ?>"><?php esc_html_e('Link:', 'blogrock-core'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('link')); ?>" name="<?php echo esc_attr($this->get_field_name('link')); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></label>

	</p>

	<?php
    }


}


/**
 * Recent Video Widget
 *
 * @since 1.0
 *
 */
class Blogrock_Smart_Widget_Recent_Videos extends WP_Widget
{


    function __construct()
    {
        $widget_ops = array('classname' => 'smartlib-video_widget', 'description' => esc_attr__("Displays last posts from the video post format", 'blogrock-core'));
        parent::__construct('smartlib-recent-video-widget', esc_attr__('Blogrock Core   Recent Video', 'blogrock-core'), $widget_ops);
        $this->alt_option_name = 'smartlib-recent-videos-widget';




    }

    function widget($args, $instance)
    {
        $title = esc_html( apply_filters('widget_title', $instance['title']) );

        $limit = is_int($instance['video_limit']) ? esc_attr( $instance['video_limit']) : 4;


        echo wp_filter_post_kses( $args['before_widget'] );
        ?>
        <?php if ($title) echo wp_filter_post_kses($args['before_title']) . esc_attr( $title ) . wp_filter_post_kses($args['after_title']);
        ?>
        <div class="smartlib-inside-box panel-body">
            <?php

            $query = new WP_Query(
                array(
                    'posts_per_page' => $limit,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-video')
                        )
                    )
                )
            );
            if ($query->have_posts()) {
                ?>

                <ul class="smartlib-layout-list smartlib-column-list smartlib-graph-columns smartlib-2-columns-list">
                    <?php
                    while ($query->have_posts()) {
                        $query->the_post();
                        if ('' != get_the_post_thumbnail()) {
                            ?>
                            <li>
                                <a href="<?php the_permalink(); ?>"
                                   class="smartlib-thumbnail-outer"><?php the_post_thumbnail('medium-square') ?></a>
                            </li>

                        <?php
                        }
                    }
                    ?></ul>

            <?php
            }
            wp_reset_postdata();
            ?>
        </div>
        <?php
        echo wp_filter_post_kses( $args['after_widget'] ); ?>
    <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = esc_html( strip_tags( $new_instance['title']) ) ;
        $instance['video_limit'] = esc_attr( $new_instance['video_limit'] );

        return $instance;
    }

    function form($instance)
    {

        $form_values = array();

        if (array_key_exists('title', $instance)) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }

        if (array_key_exists('video_limit', $instance)) {
            $limit = esc_attr($instance['video_limit']);
        } else {
            $limit = '';
        }



        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:', 'blogrock-core'); ?>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/></label>

        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('video_limit')); ?>"><?php esc_html_e('Limit:', 'blogrock-core'); ?>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('video_limit') ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name('video_limit') ); ?>" type="text"
                       value="<?php echo esc_attr( $limit ); ?>"/></label>

        </p>

    <?php
    }


}

/**
 * Add Recent Gallery Widget
 *
 * @since 1.0
 *
 */
class Blogrock_Smart_Widget_Recent_Galleries extends WP_Widget
{


    function __construct()
    {
        $widget_ops = array('classname' => 'blogrock_gallery_recent_widget', 'description' => esc_attr__("Displays last posts from the gallery post format", 'blogrock-core'));
        parent::__construct('smartlib-recent-gallery-widget', esc_attr__('Blogrock Core   Recent Galleries', 'blogrock-core'), $widget_ops);
        $this->alt_option_name = 'smartlib-gallery_recent_widget';




    }

    function widget($args, $instance)
    {
        $title = esc_html( apply_filters('widget_title', $instance['title']) );

        $limit = is_int($instance['gallery_limit']) ? esc_attr( $instance['gallery_limit'] ) : 4;


        echo wp_filter_post_kses( $args['before_widget'] );
        ?>
        <?php if ($title) echo wp_filter_post_kses( $args['before_title']) . esc_html( $title ) . wp_filter_post_kses( $args['after_title'] );
        ?>
        <div class="smartlib-inside-box panel-body">
            <?php

            $query = new WP_Query(
                array(
                    'posts_per_page' => $limit,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-gallery')
                        )
                    )
                )
            );
            if ($query->have_posts()) {
                ?>


                <ul class="smartlib-layout-list smartlib-column-list smartlib-graph-columns smartlib-2-columns-list">
                    <?php
                    while ($query->have_posts()) {

                        $query->the_post();

                        ?>

                        <?php

                        if ('' != get_the_post_thumbnail()) {
                            ?>
                            <li>
                                <a href="<?php the_permalink(); ?>"
                                   class="smartlib-thumbnail-outer"><?php the_post_thumbnail('medium-square') ?></a>
                            </li>
                        <?php
                        } else if (!empty($featured_image)) {
                            ?>
                            <li>
                                <a href="<?php the_permalink(); ?>"
                                   class="smartlib-thumbnail-outer"><?php echo esc_html($featured_image) ?></a></li>
                        <?php

                        }
                        ?>

                    <?php
                    }
                    wp_reset_postdata();
                    ?>
                </ul>



            <?php
            }

            ?>
        </div>

        <?php
        echo wp_filter_post_kses( $args['after_widget'] );
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = esc_html( strip_tags($new_instance['title']));
        $instance['gallery_limit'] = esc_attr($new_instance['gallery_limit']);

        return $instance;
    }

    function form($instance)
    {

        $form_values = array();

        if (array_key_exists('title', $instance)) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }

        if (array_key_exists('gallery_limit', $instance)) {
            $limit = esc_attr($instance['gallery_limit']);
        } else {
            $limit = '';
        }



        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:', 'blogrock-core'); ?>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/></label>

        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('gallery_limit') ); ?>"><?php esc_html_e('Limit:', 'blogrock-core'); ?>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('gallery_limit') ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name('gallery_limit') ); ?>" type="text"
                       value="<?php echo esc_attr( $limit ); ?>"/></label>

        </p>

    <?php
    }


}


/**
 * Extend content widget
 *
 * @since 1.0
 *
 */
class Blogrock_Smart_Extend_Content extends WP_Widget
{

    function __construct()
    {
        $widget_ops = array('classname' => 'blogrock_extend_content', 'description' => esc_attr__("Extend Content", 'blogrock-core'));
        parent::__construct('blogrock_extend_content', esc_attr__('Blogrock Core  Extend Content', 'blogrock-core'), $widget_ops);
        $this->alt_option_name = 'smartlib-extend-content';


    }

    function widget($args, $instance)
    {


        $title = esc_html( apply_filters('widget_title', $instance['title']));

        $box_image = isset($instance['box_image']) ? esc_url( $instance['box_image'] ) : '';
        $box_text = isset($instance['box_text']) ? esc_html( $instance['box_text'] ) : '';

        $box_page_id = isset($instance['box_page_id']) ? (int) esc_attr($instance['box_page_id']) : '';
        $box_external_link = isset($instance['box_external_link']) ? esc_url( $instance['box_external_link'] ) : '';

        ?>

        <?php echo wp_filter_post_kses( $args['before_widget'] );
        ?>
        <div class="panel smartlib-center-align smartlib-widget smartlib-icon-feture-box">

            <span class="widget-image-outer"><img src="<?php echo esc_url($box_image) ?>" alt="<?php echo esc_attr($title) ?>"/></span>

            <div class="panel-body">
                <h4><?php echo esc_html( $title ) ?></h4>

                <p class="description-widget"><?php echo wp_filter_post_kses( $box_text ) ?></p>
                <?php
                $link_href = '';

                if (strlen($box_external_link) > 0) {
                    $link_href = $box_external_link;
                } else if ($box_page_id) {
                    $link_href = esc_url(get_permalink($box_page_id));
                }

                if (strlen($link_href) > 0) {
                    ?>

                    <a href="<?php echo esc_url( $link_href ) ?>"
                       class="btn btn-default"><?php esc_html_e('Learn More', 'blogrock-core') ?></a>
                <?php
                }
                ?>
            </div>
        </div>
        <?php echo wp_filter_post_kses( $args['after_widget'] ); ?>
    <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = esc_html( strip_tags($new_instance['title']) );
        $instance['box_image'] = esc_url( strip_tags($new_instance['box_image']) );
        $instance['box_text'] = esc_html( strip_tags($new_instance['box_text']) );
        $instance['box_page_id'] = (int) esc_attr( $new_instance['box_page_id'] );
        $instance['box_external_link'] = esc_url( strip_tags($new_instance['box_external_link']) );


        return $instance;
    }

    function form($instance)
    {
        if (array_key_exists('title', $instance)) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }

        if (array_key_exists('box_text', $instance)) {

            $box_text = esc_attr($instance['box_text']);
        } else {
            $box_text = '';
        }

        if (array_key_exists('box_page_id', $instance)) {

            $box_page_id = esc_attr($instance['box_page_id']);
        } else {
            $box_page_id = 0;
        }
        if (array_key_exists('box_external_link', $instance)) {

            $box_external_link = esc_attr($instance['box_external_link']);
        } else {
            $box_external_link = '';
        }


        if (array_key_exists('box_image', $instance)) {
            $box_image = esc_attr($instance['box_image']);
        } else {
            $box_image = '';
        }

        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'blogrock-core'); ?>
                <input class="widefat"
                       id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                       type="text"
                       value="<?php echo esc_attr($title); ?>"/></label>

        </p>
        <p><label for="<?php echo esc_attr($this->get_field_id('box_image')); ?>"><?php esc_html_e('Box image:', 'blogrock-core'); ?><br/>
                <input class="smartlib-media-input"
                       id="<?php echo esc_attr($this->get_field_id('box_image')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('box_image')); ?>"
                       type="hidden"
                       value="<?php echo esc_attr($box_image); ?>"/>
                <a href="#" class="smartlib-media-button button-primary so-close"
                   onclick="bstarter_admin.common.click_manager_init(this)"><?php esc_html_e('Add file', 'blogrock-core') ?></a>
                <span class="smartlib-image-area">
                    <?php
                    if (strlen($box_image) == 0) {
                        ?>
                        <img
                            src="<?php echo esc_url( get_template_directory_uri() ) ?>/assets/img/logo-1.png"/>
                    <?php
                    } else {
                        ?>
                        <img
                            src="<?php echo esc_url( $box_image ) ?>"/>
                    <?php
                    }
                    ?>
                </span>
        </p>
        <p><label for="<?php echo esc_attr($this->get_field_id('box_text')); ?>"><?php esc_html_e('Box Text:', 'blogrock-core'); ?></label>
				<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('box_text')); ?>"
                          name="<?php echo esc_attr($this->get_field_name('box_text')); ?>"
                          ?><?php echo esc_html($box_text); ?></textarea>

        </p>
        <p>
            <label
                for="<?php echo esc_attr( $this->get_field_id('box_page_id')); ?>"><?php esc_html_e('Box read more link', 'blogrock-core') ?></label><br/>
            <?php wp_dropdown_pages(array('name' => esc_attr( $this->get_field_name('box_page_id') ), 'id' => esc_attr( $this->get_field_id('box_page_id')), 'show_option_none' => esc_attr__('Choose Page', 'blogrock-core'), 'selected' =>  esc_attr( $box_page_id) )); ?>
        </p>
        <p><label
                for="<?php echo esc_attr($this->get_field_id('box_external_link')); ?>"><?php esc_html_e('External link', 'blogrock-core') ?></label><br/>
            <input
                id="<?php echo esc_attr( $this->get_field_id('box_external_link')); ?>"
                name="<?php echo esc_attr( $this->get_field_name('box_external_link')); ?>"
                type="text"
                value="<?php echo esc_attr($box_external_link); ?>"/>
        </p>
    <?php
    }


}



/**
 * Add Section header widget
 *
 * @since 1.0
 *
 */
class Blogrock_Smart_Widget_Section_Header extends WP_Widget
{


    function __construct()
    {
        $widget_ops = array('classname' => 'smartlib-header-section-widget', 'description' => esc_attr__("Section Header", 'blogrock-core'));
        parent::__construct('smartlib-header-section-widget', esc_attr__('Blogrock Core   Section Header', 'blogrock-core'), $widget_ops);
        $this->alt_option_name = 'smartlib-header-section-widget';



    }

    function widget($args, $instance)
    {
        $title = esc_html( apply_filters('widget_title', $instance['title']) );

        $header_subtitle = strlen($instance['header_subtitle']) > 0 ? esc_attr( $instance['header_subtitle'] ) : '';
        $header_align = strlen($instance['header_align']) > 0 ? esc_attr($instance['header_align']) : 'left';
        $header_size = strlen($instance['header_size']) ? esc_attr($instance['header_size']) : 'large';

        ?>
        <?php echo wp_filter_post_kses( $args['before_widget'] ); ?>
            <header
                class="smartlib-section-header<?php echo esc_attr( apply_filters('blogrock_algin_text', 'text-center', $header_align)); ?>">
                <h2 class="<?php echo 'smartlib-header-' . esc_attr($header_size) ?>"><?php echo esc_html( $title ) ?></h2>
                <?php
                if (strlen($header_align) > 0) {
                    ?>
                    <p><?php echo wp_filter_post_kses( $header_subtitle ) ?></p>
                <?php
                }
                ?>
            </header>
        <?php echo wp_filter_post_kses( $args['after_widget'] ); ?>
    <?php

    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = esc_html( strip_tags($new_instance['title'])) ;
        $instance['header_size'] = esc_attr( strip_tags($new_instance['header_size']) );
        $instance['header_align'] = esc_attr( $new_instance['header_align']);
        $instance['header_subtitle'] = esc_attr( $new_instance['header_subtitle']);

        return $instance;
    }

    function form($instance)
    {

        $form_values = array();

        if (array_key_exists('title', $instance)) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }
        if (array_key_exists('header_subtitle', $instance)) {
            $header_subtitle = esc_attr($instance['header_subtitle']);
        } else {
            $header_subtitle = '';
        }
        if (array_key_exists('header_align', $instance)) {
            $header_align = esc_attr($instance['header_align']);
        } else {
            $header_align = '';
        }
        if (array_key_exists('header_size', $instance)) {
            $header_size = esc_attr($instance['header_size']);
        } else {
            $header_size = '';
        }

        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:', 'blogrock-core'); ?>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_html( $title ); ?>"/></label>

        </p>
        <p>
            <label
                for="<?php echo esc_attr( $this->get_field_id('header_subtitle') ); ?>"><?php esc_html_e('Header Subtitle:', 'blogrock-core'); ?>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('header_subtitle')); ?>"
                       name="<?php echo esc_attr( $this->get_field_name('header_subtitle') ) ; ?>" type="text"
                       value="<?php echo esc_attr( $header_subtitle ); ?>"/></label>

        </p>
        <p>
            <label
                for="<?php echo esc_attr( $this->get_field_id('header_align') ); ?>"><?php esc_html_e('Header Align:', 'blogrock-core'); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id('header_align') ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name('header_align') ); ?>" class="widefat" style="width:100%;">
                <option <?php echo esc_attr( $header_align) == 'left' ? 'selected="selected"' : '' ?>
                    value="left"><?php esc_html_e('Left Align', 'blogrock-core'); ?></option>
                <option <?php echo esc_attr( $header_align ) == 'center' ? 'selected="selected"' : '' ?>
                    value="center"><?php esc_html_e('Center Align', 'blogrock-core'); ?></option>
                <option <?php echo esc_attr( $header_align ) == 'right' ? 'selected="selected"' : '' ?>
                    value="right"><?php esc_html_e('Right Align', 'blogrock-core'); ?></option>
            </select>
        </p>
        <p>
            <label
                for="<?php echo esc_attr( $this->get_field_id('header_size') ); ?>"><?php esc_html_e('Header Size:', 'blogrock-core'); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id('header_size') ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name('header_size') ); ?>" class="widefat" style="width:100%;">
                <option <?php echo esc_attr( $header_size ) == 'small' ? 'selected="selected"' : '' ?>
                    value="small"><?php esc_html_e('Small', 'blogrock-core'); ?></option>
                <option <?php echo esc_attr( $header_size ) == 'medium' ? 'selected="selected"' : '' ?>
                    value="medium"><?php esc_html_e('Medium', 'blogrock-core'); ?></option>
                <option <?php echo esc_attr( $header_size ) == 'large' ? 'selected="selected"' : '' ?>
                    value="large"><?php esc_html_e('Large', 'blogrock-core'); ?></option>
            </select>
        </p>

    <?php
    }



}



/**
 * Last Articles Widget
 *
 * @since 1.0
 *
 */
class Blogrock_Smart_Widget_Last_Articles_Columns extends WP_Widget
{


    function __construct()
    {
        $widget_ops = array('classname' => 'blogrock_last_articles_columns_widget', 'description' => esc_attr__("Displays the latest articles in Columns", 'blogrock-core'));
        parent::__construct('blogrock_last_articles_columns_widget', esc_attr__('Blogrock Core   Last Articles in  Columns', 'blogrock-core'), $widget_ops);
        $this->alt_option_name = 'blogrock_last_articles_columns_widget';




    }

    function widget($args, $instance)
    {


        $limit = $instance['items_limit'] ? esc_attr( $instance['items_limit'] ) : 4;
        $articles_category = strlen($instance['articles_category']) > 0 ? (int) esc_attr( $instance['articles_category'] ) : 0;

        echo wp_filter_post_kses( $args['before_widget'] );
         echo  wp_filter_post_kses ( $args['after_title'] );
        ?>

            <?php

            $query_args =
                array(
                    'posts_per_page' => $limit,
                    'post_type' => 'post',

                );

            if ($articles_category > 0) {

                $query_args =
                    array(
                        'posts_per_page' => $limit,
                        'post_type' => 'post',
                        'cat' => $articles_category
                    );

            }


            $query = new WP_Query($query_args);

            if ($query->have_posts()) {
                ?>


                <ul class="smartlib-layout-list smartlib-column-list smartlib-<?php echo esc_attr( $limit ) ?>-columns-list">
                    <?php
                    while ($query->have_posts()) {

                        $query->the_post();
                        ?>

                        <li>
                            <div class="panel smartlib-inside-box smartlib-widget">
                                <?php blogrock_post_thumbnail_block('blogrock-large-thumb', 'default') ?>

                                <div class="panel-body">
                                    <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>

                                    <p><?php the_excerpt() ?></p>
                                    <a href="<?php the_permalink() ?>" class="btn btn-primary"><?php esc_html_e('Read more', 'blogrock-core'); ?></a>
                        	<span class="pull-right">
											<?php do_action('blogrock_comments_count', 'default'); ?>
										</span>
                                </div>
                            </div>

                        </li>
                    <?php
                    }
                    wp_reset_postdata();
                    ?>
                </ul>



            <?php
            }

            ?>


        <?php
        echo wp_filter_post_kses( $args['after_widget']);
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['items_limit'] = esc_attr( $new_instance['items_limit'] );
        $instance['articles_category'] = isset($new_instance['articles_category'])? esc_attr( $new_instance['articles_category'] ):'';

        return $instance;
    }

    function form($instance)
    {





        if (array_key_exists('items_limit', $instance)) {
            $items_limit = esc_attr($instance['items_limit']);
        } else {
            $items_limit = 4;
        }

        if (array_key_exists('articles_category', $instance)) {
            $articles_category = esc_attr($instance['articles_category']);
        } else {
            $articles_category = 0;
        }

        ?>

        <?php

        $categories = get_categories();
        if (!empty($categories) && !is_wp_error($categories)) {
            ?>
            <p>
                <label
                    for="<?php echo esc_attr( $this->get_field_id('articles_category') ); ?>"><?php esc_html_e('Category Articles:', 'blogrock-core'); ?>
                    <select name="<?php echo esc_attr( $this->get_field_name('articles_category') ); ?>">
                        <option><?php esc_html_e('All', 'blogrock-core') ?></option>
                        <?php
                        foreach ($categories as $term) {
                            ?>
                            <option <?php echo $term->term_id == $articles_category ? 'selected="selected"' : '' ?>
                                value="<?php echo esc_attr( $term->term_id ); ?>"><?php echo esc_html( $term->name ) ?></option>
                        <?php

                        }
                        ?>
                    </select>
            </p>
        <?php
        }

        ?>


        <p>
            <label
                for="<?php echo esc_attr( $this->get_field_id('items_limit') ); ?>"><?php esc_html_e('How many items is displayed:', 'blogrock-core'); ?></label>
            <select name="<?php echo esc_attr( $this->get_field_name('items_limit') ); ?>">
                <option <?php echo $items_limit == '2' ? 'selected="selected"' : '' ?> value="2">2</option>
                <option <?php echo $items_limit == '3' ? 'selected="selected"' : '' ?> value="3">3</option>
                <option <?php echo $items_limit == '4' ? 'selected="selected"' : '' ?> value="4">4</option>
                <option <?php echo $items_limit == '5' ? 'selected="selected"' : '' ?> value="5">5</option>
                <option <?php echo $items_limit == '6' ? 'selected="selected"' : '' ?> value="6">6</option>
            </select>


        </p>

    <?php
    }


}



/**
 * Display Page Content
 *
 * @since 1.0
 *
 */
class Blogrock_Smart_Display_Page_Content extends WP_Widget
{

    function __construct()
    {

        $widget_ops = array('classname' => 'smartlib-display_page-widget', 'description' => esc_attr__("Display content from selected page", 'blogrock-core'));
        parent::__construct('smartlib-display_page-widget', esc_attr__('Blogrock Core  Display Page Content', 'blogrock-core'), $widget_ops);
        $this->alt_option_name = 'smartlib-display_page-widget';


    }

    function widget($args, $instance)
    {

        $cache = wp_cache_get('smartlib-display_page-widget', 'widget');

        $title = isset($instance['title']) ? esc_attr($instance['title']) : false;

        $page_id = isset($instance['page_id']) ? esc_attr($instance['page_id']) : false;

        ?>
        <?php echo wp_filter_post_kses( $args['before_widget'] ); ?>
        <?php if ($title) echo wp_filter_post_kses( apply_filters('blogrock_widget_before_title', $args['before_title'], $instance)) . esc_html( $title ) . wp_filter_post_kses( apply_filters('blogrock_widget_after_title', $args['after_title'], $instance) ); ?>
        <div class="smartlib-inside-box panel-body">
            <?php
            if ($page_id) {

                $query = new WP_Query(array('page_id' => $page_id));
                while ($query->have_posts()): $query->the_post();
                    the_content();
                endwhile;
            }
            wp_reset_postdata();
            ?>
        </div>
        <?php echo wp_filter_post_kses( $args['after_widget'] ); ?>
        <?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();


        /*
                $cache[$args['widget_id']] = ob_get_flush();
                wp_cache_set( 'widget_recent_posts', $cache, 'widget' );

            */
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = esc_attr($new_instance['title']);
        $instance['page_id'] = (int)esc_attr($new_instance['page_id']);




        $alloptions = wp_cache_get('alloptions', 'options');
        if (isset($alloptions['smartlib-contact-form-widget']))
            delete_option('smartlib-contact-form-widget');

        return $instance;
    }



    function form($instance)
    {


        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $page_id = isset($instance['page_id']) ? esc_attr($instance['page_id']) : 5;

        $post_args = array('post_type' => 'page');
        $pages = get_posts($post_args);

        ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:', 'blogrock-core'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/></p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('page_id') ); ?>"><?php esc_html_e('Select Page:', 'blogrock-core'); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id('page_id') ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name('page_id') ); ?>" class="widefat" style="width:100%;">
                <?php
                foreach ($pages as $page) {
                    ?>
                    <option <?php echo $page->ID == $page_id ? 'selected="selected"' : '' ?>
                        value="<?php echo esc_attr( $page->ID ); ?>"><?php echo esc_html( $page->post_title ); ?></option>
                <?php
                }
                ?>
            </select>
        </p>


    <?php
    }
}




/**
 * Our Team Box Widget
 *
 * @since 1.0
 *
 */
class Blogrock_Smart_Team_Box extends WP_Widget
{

    function __construct()
    {

        $widget_ops = array('classname' => 'smartlib-team-box-widget', 'description' => esc_attr__("Display your team members in columns", 'blogrock-core'));
        parent::__construct('smartlib-team-box-widget', esc_attr__('Blogrock Core  Our Team Columns', 'blogrock-core'), $widget_ops);
        $this->alt_option_name = 'smartlib-team-box-widget';


    }

    function widget($args, $instance)
    {



        $title = isset($instance['title']) ? esc_attr($instance['title']) : false;


        $user_array = array();

        $j = 0;
        $columns = 0;
        for ($i = 0; $i < 4; $i++) {

            if (isset($instance['user_array'][$i]) && strlen($instance['user_array'][$i]) > 0) {

                $columns++;
                if (isset($instance['user_array'][$i]))
                    $user_array[$j] = $instance['user_array'][$i];
                else
                    $user_array[$j] = '';
            }
            $j++;
        }


        if ($columns > 0)
            $column_size = 12 / $columns;
        else
            $column_size = 1;
        ?>
            <div class="row">
                <?php


                for ($j = 0; $j < 4; $j++) {
                    if (isset($user_array[$j])) {
                        // $user_info = get_post($user_array[$j]);

                        ?>
                        <div class="col-md-<?php echo esc_attr( $column_size ) ?>">
                            <div class="panel  smartlib-center-align">
                                <div class="panel-body smartlib-inside-box">
                                    <?php echo get_the_post_thumbnail( esc_attr( $user_array[$j] ), 'blogrock-col-sm-square', array('class' => 'img-responsive img-circle')) ?>
                                    <h4><?php echo esc_html( get_the_title($user_array[$j]) ) ?></h4>

                                    <p class="text-muted"><?php echo esc_attr( get_post_meta( $user_array[$j] ), 'blogrock_member_position', true); ?></p>
                                    <?php
                                    //get social info
                                    $social_info = array();
                                    $social_info['email'] = esc_url(get_post_meta($user_array[$j], 'blogrock_user_email', true));
                                    $social_info['twitter'] = esc_url( get_post_meta($user_array[$j], 'blogrock_twitter_url', true));
                                    $social_info['facebook'] = esc_url( get_post_meta($user_array[$j], 'blogrock_facebook_url', true));
                                    $social_info['pinterest'] = esc_url( get_post_meta($user_array[$j], 'blogrock_pinterest_url', true));
                                    $social_info['linkedin'] = esc_url(get_post_meta($user_array[$j], 'blogrock_linkedin_url', true));
                                    $social_info['gplus'] = esc_url( get_post_meta($user_array[$j], 'blogrock_googlep_url', true));



                                    ?>

                                    <ul class="list-inline social-buttons">
                                        <?php
                                        foreach ($social_info as $key => $row) {
                                            if (strlen($row) > 0) {
                                                ?>
                                                <li><a href="<?php echo esc_url( $row ) ?>"><i
                                                            class="<?php echo esc_attr( apply_filters('blogrock_get_awesome_ico', 'fa fa-share', $key) ); ?>"></i></a>
                                                </li>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>


                        </div>
                    <?php
                    }
                }
                ?>
            </div>


        <?php



    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = esc_attr( strip_tags($new_instance['title']));

        $instance['user_array'] = array();

        for ($i = 0; $i < 4; $i++) {
            $instance['user_array'][$i] = esc_attr( $new_instance['user_array'][$i] );
        }




        $alloptions = wp_cache_get('alloptions', 'options');
        if (isset($alloptions['smartlib-team-box-widget']))
            delete_option('smartlib-team-box-widget');

        return $instance;
    }

  

    function form($instance)
    {

        if (!defined('SMARTLIB_PLUGIN_PATH')) {
            ?>
            <p><?php esc_html_e('Please install Smartlib Tools', 'blogrock-core') ?> </p>
            <?php
            return;
        }


        $title = isset($instance['title']) ? esc_attr( $instance['title'] ) : '';


        $user_array = array();
        for ($i = 0; $i < 4; $i++) {

            $user_array[$i] = isset($instance['user_array'][$i]) ? esc_attr( $instance['user_array'][$i] ) : '';

        }


        $post_args = array('post_type' => 'smartlib_team');
        $users = get_posts($post_args);

        ?>
        <p><label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:', 'blogrock-core'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/></p>
        <?php
        for ($i = 0; $i < 4; $i++) {

            ?>
            <fieldset>

                <p>
                    <label
                        for="<?php echo esc_attr( $this->get_field_id('user_array_' . $i) ); ?>"><?php echo esc_html__('Coulumn ', 'blogrock-core') . esc_html ( $i ); ?></label>
                    <select id="<?php echo esc_attr( $this->get_field_id('user_array_' . $i) ); ?>"
                            name="<?php echo esc_attr($this->get_field_name('user_array') ); ?>[<?php echo esc_attr ( $i ) ?>]" class="widefat"
                            style="width:100%;">
                        <option><?php esc_html_e('Select User', 'blogrock-core') ?></option>
                        <?php

                        foreach ($users as $user) {

                            ?>
                            <option <?php echo $user->ID == $user_array[$i] ? 'selected="selected"' : '' ?>
                                value="<?php echo esc_attr( $user->ID ) ?>"><?php echo esc_html( $user->post_title ); ?></option>
                        <?php

                        }
                        ?>
                    </select>
                </p>
            </fieldset>
        <?php
        }
        ?>

    <?php
    }
}






