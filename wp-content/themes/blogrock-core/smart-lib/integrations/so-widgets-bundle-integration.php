<?php

add_filter('siteorigin_widgets_active_widgets', 'blogrock_default_so_widgets');


/**
 *
 * Modify  & return default widget array
 * @param $active_widgets
 * @return array
 */
function blogrock_default_so_widgets($active_widgets){

    $default_active_widgets = array(

        'so-headline-widget' => true,
        'so-price-table-widget'  => true,
        'so-features-widget' => true,
    );

    return array_merge($default_active_widgets, $active_widgets);
}