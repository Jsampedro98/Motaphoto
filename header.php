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
    <!-- Permet d'assurer que le site est responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Mots-clés pour le SEO -->
    <meta name="keywords" content="photographe événementiel, photographe event, Nathalie Mota, photographie" />
    <!-- Description pour le SEO -->
    <meta name="description" content="Nathalie Mota, Photographe pour immortaliser vos moments." />

    <!-- Titre du site, composé du titre de la page et du nom du site -->
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>

<body>
    <header>
        <!-- Section pour afficher le logo du site -->
        <div class="logo">
            <?php
            // S'il est défini, affiche le logo personnalisé du site
            if (function_exists('the_custom_logo')) {
                the_custom_logo();
            } else {
                echo '<h1>' . get_bloginfo('name') . '</h1>';
            }
            ?>
        </div>

        <!-- Bouton pour ouvrir/fermer le menu sur les appareils mobiles -->
        <button class="menu-toggle" aria-controls="nav-menu" aria-expanded="false" aria-label="mobile menu" type="button">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </button>

        <!-- Navigation principale du site -->
        <nav id="nav-menu" role="navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' =>    'menu_principal',
                'container' => false,
                'menu_class' => 'menu',
            ));
            ?>
        </nav>
    </header>

    <main>