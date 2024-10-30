<?php
// template block-photo

// Récupération informations photo sibling
$photo_post = get_the_post_thumbnail(get_the_ID(), 'full');
$reference_photo = get_field('reference');
$date_post = get_field('annee');
$titre_post = get_the_title();
$titre_slug = sanitize_title($titre_post);
$lien_post = get_site_url() . '/photo/' . $titre_slug;
$photo_post_full = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');

// Récupération format  photo et stockage pour filtrage : HOME
$formats = get_the_terms(get_the_ID(), 'format');
if ($formats && !is_wp_error($formats)) {
    $noms_formats = array();
    foreach ($formats as $format) {
        $noms_formats[] = $format->name;
    }
    $liste_formats = join(', ', $noms_formats);
}

// Récupération  catégorie photo et stockage pour filtrage
$categories = get_the_terms(get_the_ID(), 'categorie');
if ($categories && !is_wp_error($categories)) {
    $noms_categories = array();
    foreach ($categories as $categorie) {
        $noms_categories[] = $categorie->name;
    }
    $liste_categories = join(', ', $noms_categories);
}
?>
<div class="block">
    <div class="block__photo">
        <?= $photo_post; ?>
    </div>
    <div class="blockSurvol">
        <div class="blockSurvol__overlay">
            <button class="blockSurvol__iconLightbox" type="button" data-full-image="<?= $photo_post_full[0]; ?>">
                <img src="<?= get_stylesheet_directory_uri() . '/assets/images/icon-lightbox.svg' ?>" alt="lightbox" />
            </button>
            <a class="blockSurvol__iconEye" href=" <?= $lien_post; ?>" aria-label="<?php the_title(); ?>">
                <img id="icon-eye" src="<?= get_stylesheet_directory_uri() . '/assets/images/icon-eye.svg' ?>" alt="Afficher les infos de la photo" />
            </a>
            <div class="blockSurvol__infos">
                <div class="blockSurvol__infos--Ref">
                    <p><?= $reference_photo ?></p>
                </div>
                <div class="blockSurvol__infos--Categorie">
                    <p><?= $liste_categories ?></p>
                </div>
            </div>
        </div>
    </div>
</div>