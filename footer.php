<?php

/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * *
 * @package motaphoto
 */

?>
</main>

<footer>
    <?php get_template_part('/templates_part/scroll-arrow'); ?>
    <div class="modale">
        <?php get_template_part('/templates_part/modale'); ?>
    </div>
    <?php get_template_part('/templates_part/lightbox'); ?>
    <div>
        <?php
        wp_nav_menu(array(
            'theme_location' =>    'menu_secondaire',
            'container' => false,
            'menu_class' => 'menu',
        ));
        ?>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>