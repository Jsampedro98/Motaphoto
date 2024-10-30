<?php

/**
 * The template for displaying The home page template which is the front page by default
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * *
 * @package motaphoto
 */

?>

<?php
// Inclut l'en-tête de la page
get_header();
?>

<!-- Section pour l'en-tête de la page -->
<section class="hero">
    <h1> Photographe Event</h1>
    <div class="hero-banner">
        <!-- Inclut le template partiel pour la bannière format paysage-->
        <?php get_template_part('/templates_part/banner-landscape'); ?>
    </div>
</section>

<!-- Section pour le catalogue de photos -->
<section class="catalog">
    <!-- Inclut le template partiel pour les filtres du catalogue -->
    <?php get_template_part('/templates_part/filtre-front'); ?>
    <div class="catalog-space">
        <div class="siblings-items">
            <?php

            // requête pour récupérer les posts de type 'photographies'
            $photos_siblings = new WP_Query(array(
                'post_type' => 'photo',
                'posts_per_page' => 8,
                'orderby' => 'date',
                'order' => 'ASC',
                'paged' => 1,
            ));

            // Vérifie si des posts ont été trouvés
            if ($photos_siblings->have_posts()) {
                // Boucle à travers les posts trouvés
                while ($photos_siblings->have_posts()) {
                    $photos_siblings->the_post();
                    // Inclut le template partiel pour chaque photo
                    get_template_part('templates_part/bloc-photo');
                }
                // Réinitialise les données de post
                wp_reset_postdata();
            } else {
                // Message affiché si aucun post n'a été trouvé
                echo 'aucune photo avec le ou les filtres selectionnés';
            }

            ?>

        </div>
    </div>
    <!-- Section pour le bouton "Charger plus" -->
    <div class="bouton-front">
        <div id="total-photos-count"></div>
        <button id="charger-plus" class="btn-chargerPlus">Charger plus</button>
    </div>
</section>


<?php
// Inclut le pied de page de la page
get_footer();
?>