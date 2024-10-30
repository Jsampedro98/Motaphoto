<?php

// Fonction principale pour gérer le filtrage et la pagination des photos
function filtrer_paginer_catalogue()
{
    // Vérification de sécurité avec un nonce pour éviter les requêtes non autorisées
    check_ajax_referer('ajax-nonce', 'nonce');

    // Initialisation de la requête taxonomique, avec une relation AND pour combiner plusieurs filtres si nécessaire
    $tax_query = array('relation' => 'AND');

    // Récupération et validation de l'ordre de tri (ASC ou DESC)
    // Le tri par défaut est en ordre croissant (ASC) pour éviter les erreurs
    $order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : 'ASC';
    switch ($order) {
        case 'ASC':
        case 'DESC':
            break;
        default:
            $order = 'ASC';
    }

    // Récupération de la page actuelle pour la pagination, par défaut à la première page (1)
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    // Ajout du filtre par catégorie si une catégorie spécifique est sélectionnée
    if (isset($_POST['category']) && $_POST['category'] !== 'all') {
        $category = $_POST['category'];
        $tax_query[] = array(
            'taxonomy' => 'categorie',  // Taxonomie utilisée pour le filtrage
            'field' => 'slug',          // Utilisation du slug de la catégorie
            'terms' => $category,       // Terme de la catégorie sélectionnée
        );
    }

    // Ajout du filtre par format si un format spécifique est sélectionné
    if (isset($_POST['format']) && $_POST['format'] !== 'all') {
        $format = $_POST['format'];
        $tax_query[] = array(
            'taxonomy' => 'format',     // Taxonomie utilisée pour le format
            'field' => 'slug',          // Utilisation du slug du format
            'terms' => $format,         // Terme du format sélectionné
        );
    }

    // Création des arguments pour la requête WP_Query avec le type de publication, la pagination, et les filtres
    $args = array(
        'post_type' => 'photo',       // Type de post 'photo' pour la requête
        'posts_per_page' => 8,        // Limite de photos par page
        'orderby' => 'date',          // Tri des résultats par date
        'order' => $order,            // Ordre de tri selon la sélection (ASC ou DESC)
        'paged' => $paged,            // Page courante pour la pagination
        'tax_query' => $tax_query,    // Inclusion des filtres de taxonomie
    );

    // Exécution de la requête avec les arguments définis
    $photo_query = new WP_Query($args);

    // Mise en tampon de sortie pour capturer l'output HTML
    ob_start();

    // Boucle pour afficher les résultats si des publications sont trouvées
    if ($photo_query->have_posts()) {
        while ($photo_query->have_posts()) {
            $photo_query->the_post();
            get_template_part('templates_part/bloc-photo');  // Inclusion du template pour chaque photo
        }
        wp_reset_postdata();
    } else {
        // Message affiché si aucune photo n'est trouvée avec les critères de filtrage
        echo '<p>aucune photo avec cette selection... pour l\'instant !</p>';
    }

    // Récupération de l'output généré et du nombre total de photos trouvées
    $output = ob_get_clean();
    $total_photos = $photo_query->found_posts;

    // Envoi de la réponse au format JSON pour les traitements AJAX côté client
    wp_send_json_success(array(
        'html' => $output,          // Code HTML des résultats
        'total' => $total_photos,   // Nombre total de photos trouvées
    ));
}

// Enregistrement de la fonction pour les actions AJAX pour les utilisateurs connectés et non connectés
add_action('wp_ajax_filtrer_paginer_catalogue', 'filtrer_paginer_catalogue');
add_action('wp_ajax_nopriv_filtrer_paginer_catalogue', 'filtrer_paginer_catalogue');
