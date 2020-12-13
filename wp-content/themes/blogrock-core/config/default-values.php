<?php

/**
 * Default values - key should be the same in the customizer field
 */

return array(


    'font-primary' =>
        array(

            '"Nunito", sans-serif' => 'Nunito:400,700'


        ),

    'font-secondary' => array(

        '"Poppins", sans-serif' => 'Poppins:400,600,700'


    ),



    'images_sizes' => array (

        'rocksite_thumbnail_square' => array(250, 250, true),
        'rocksite_large_square' => array(600, 600, true),
        'rocksite_medium_wide' => array(300, 200, true),
        'rocksite_large_wide' => array(820, 615, true),



    ),

    /**
     * Logo Settings
     */

    'logo_settings' => array(

        'height'      => 77,
        'width'       => 245,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' )

    ),

    /**
     * Define menus areas
     */

    'menus' => array (

        'main_menu' => esc_attr__('Main Menu', 'blogrock-core'),
        'footer_pages' => esc_attr__('Footer Menu', 'blogrock-core'),
        'top_pages' => esc_attr__('Top Menu', 'blogrock-core'),
        'social_menu' => esc_attr__('Social Menu', 'blogrock-core')

    ),



   'social_icons' => array (

       'facebook' => 'lab la-facebook-f',
       'twitter' => 'lab la-twitter',
       'instagram' => 'lab la-instagram',
       'youtube' => 'lab la-youtube',
       'snapchat' => 'lab la-snapchat'

   ),

    'layout_variables' => array (

        'width' => '1200px',
        'gutter' => '40px',

    )


);