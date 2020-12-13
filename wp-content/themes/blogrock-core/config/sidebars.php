<?php
return
    array(
        'main_sidebar' =>
        array(
            'name' =>  esc_attr__('Main Sidebar', 'blogrock-core'),
            'id' => 'main_sidebar',
            'description' => esc_attr__('Appears on  Front Page', 'blogrock-core'),
            'before_widget' => '<li><div id="%1$s" class="rocksite-o-widget rocksite-o-widget -%2$s">',
            'after_widget' => '</div></li>',
            'before_title' => '<header class="rocksite-o-widget__header"><h3 class="rocksite-o-widget__header__title">',
            'after_title' => '</h3></header>',
        ),

        'page_sidebar' =>
            array(
                'name' => esc_attr__('Page Sidebar', 'blogrock-core'),
                'id' => 'page_sidebar',
                'description' => esc_attr__('Appears on  Single Page', 'blogrock-core'),
                'before_widget' => '<li><div id="%1$s" class="rocksite-o-widget rocksite-o-widget -%2$s">',
                'after_widget' => '</div></li>',
                'before_title' => '<header class="rocksite-o-widget__header"><h3 class="rocksite-o-widget__header__title">',
                'after_title' => '</h3></header>',
            ),

        'footer_sidebar' =>
        array (
            'name' => esc_attr__('Footer Sidebar', 'blogrock-core'),
            'id' => 'footer_sidebar',
            'description' => esc_attr__('Appears in footer', 'blogrock-core'),
            'before_widget' => '<div class="col-lg-3 col-md-6"><div id="%1$s" class="rocksite-o-widget rocksite-o-widget -%2$s -dark -footer">',
            'after_widget' => '</div></div>',
            'before_title' => '<header class="rocksite-o-widget__header"><h3 class="rocksite-o-widget__header__title">',
            'after_title' => '</h3></header>'
        )

    );