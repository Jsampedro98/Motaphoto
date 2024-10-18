<?php

/**
 * The header for our theme
 **
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package motaphoto
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php bloginfo('name') ?> - <?php bloginfo('description') ?></title>
    <?php wp_head(); ?>
</head>

<body>
    <header>
        <div class="logo">
            <?php
            if (function_exists('the_custom_logo')) {
                the_custom_logo();
            } else {
                echo '<h1>' . get_bloginfo('name') . '</h1>';
            }
            ?>
        </div>
        <nav>
            <?php
            wp_nav_menu(array(
                'theme_location' =>    'menu_principal',
                'container' => false,
                'menu_class' => 'menu',
            ));
            ?>
            <div class="modale">
                <?php get_template_part('/templates_part/modale'); ?>
            </div>
        </nav>
    </header>