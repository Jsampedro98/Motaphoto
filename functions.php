<?php

/**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

//chargement des styles et des scripts
function motaphoto_enqueue_styles()
{
    wp_enqueue_style('motaphoto-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_styles');


//  Chargement du script JS de la modale
function motaphoto_enqueue_scripts()
{
    wp_enqueue_script('script modale', get_template_directory_uri() . '/assets/js/modale.js');
}

add_action('wp_enqueue_scripts', 'motaphoto_enqueue_scripts');

// Ajout de la gestion de menu dans le dashboard  wordpress

function register_custom_menu()
{
    register_nav_menus(array(
        'menu_principal' => __('Menu principal', 'motaphoto'),
        'menu_secondaire' => __('Menu secondaire', 'motaphoto'),
    ));
}
add_action('init', 'register_custom_menu');



// Ajout de la prise en charge du logo
function motaphoto_custom_logo_setup()
{
    $defaults = array(
        'height'      => 44,
        'width'       => 690,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'motaphoto_custom_logo_setup');
