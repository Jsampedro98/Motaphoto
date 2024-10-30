<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package motaphoto
 */

// Inclusion des fonctions AJAX
require get_template_directory() . '/functions-ajax.php';


//chargement des styles et des scripts
function motaphoto_enqueue_assets()
{
    //chargement des styles  (css compilé de sass) 
    wp_enqueue_style('motaphoto-style', get_stylesheet_uri());
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), null);

    //  Chargement des scripts JS
    wp_enqueue_script('script-modale', get_template_directory_uri() . '/assets/js/modale.js', array(), null, true);
    wp_enqueue_script('script-menu-mobile', get_template_directory_uri() . '/assets/js/menu-mobile.js', array(), null, true);
    wp_enqueue_script('script-lightbox', get_template_directory_uri() . '/assets/js/lightbox.js', array(), null, true);
    wp_enqueue_script('scripts', get_template_directory_uri() . '/assets/js/script.js', array(), null, true);
    wp_enqueue_script('scroll-arrow', get_template_directory_uri() . '/assets/js/scroll-arrow.js', array(), null, true);


    //  scripts JS accueil
    if (is_home()) {
        wp_enqueue_script('script-filtre-front-page', get_template_directory_uri() . '/assets/js/filtre-front-page.js', array('jquery'), null, true);
        wp_localize_script('script-filtre-front-page', 'myAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ajax-nonce') // Ajout de la génération de nonce            
        ));
    }
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_assets');

// Ajout gestion menus dashboard 
function register_custom_menu()
{
    register_nav_menus(array(
        'menu_principal' => __('Menu principal', 'motaphoto'),
        'menu_secondaire' => __('Menu secondaire', 'motaphoto'),
    ));
}
add_action('init', 'register_custom_menu');


// Ajout prise en charge logo
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

// custom thumbnails 
function motaphoto_custom_thumbnails_sizes()
{
    // miniatures hover navigation
    add_image_size('custom-thumbnail', 80, 70, true);

    // natif medium 300x300px > visuels block photo
    remove_image_size('medium');
    add_image_size('medium', 564, 495, true);

    // natif medium_large 768x0 > infos photo 570    (564 conflit 'medium' ?)
    remove_image_size('medium_large');
    add_image_size('medium_large', 570, 0, false);

    // natif large 1024x1024 > visuel bannière accueil
    remove_image_size('large');
    add_image_size('large', 1440, 0, false);

    remove_image_size('1536x1536');
    remove_image_size('2048x2048');
}
add_action('after_setup_theme', 'motaphoto_custom_thumbnails_sizes');




// Fonction pour modifier l'attribut 'alt' et 'title' de l'image mise en avant
function motaphoto_custom_featured_image_attributes($attr, $attachment, $size)
{
    global $post;

    if (isset($post) && $post->post_type == 'photo') {
        $post_title = get_the_title($post->ID);
        $site_description = get_bloginfo('description');

        $custom_text = $post_title . ' - ' . $site_description;

        $attr['alt'] = $custom_text;
        $attr['title'] = $custom_text;
    }

    return $attr;
}

add_filter('wp_get_attachment_image_attributes', 'motaphoto_custom_featured_image_attributes', 10, 3);

// custom color palette
function motaphoto_setup_theme_supported_colors()
{
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => __('White', 'motaphoto'),
            'slug'  => 'white',
            'color' => '#ffffff',
        ),
        array(
            'name'  => __('Black', 'motaphoto'),
            'slug'  => 'black',
            'color' => '#000000',
        ),
        array(
            'name'  => __('Deep Grey', 'motaphoto'),
            'slug'  => 'deepgrey',
            'color' => '#313144',
        ),
        array(
            'name'  => __('Grey', 'motaphoto'),
            'slug'  => 'grey',
            'color' => '#c4c4c4',
        ),
        array(
            'name'  => __('Clear Grey', 'motaphoto'),
            'slug'  => 'cleargrey',
            'color' => '#d8d8d8',
        ),
        array(
            'name'  => __('Pale Grey', 'motaphoto'),
            'slug'  => 'palegrey',
            'color' => '#e5e5e5',
        ),
        array(
            'name'  => __('Primary', 'motaphoto'),
            'slug'  => 'primary',
            'color' => '#e00000',
        ),
        array(
            'name'  => __('Clear Primary', 'motaphoto'),
            'slug'  => 'clearprimary',
            'color' => '#fe5858',
        ),
        array(
            'name'  => __('Pale Primary', 'motaphoto'),
            'slug'  => 'paleprimary',
            'color' => '#ffd6d6',
        ),
    ));
}
add_action('after_setup_theme', 'motaphoto_setup_theme_supported_colors');
