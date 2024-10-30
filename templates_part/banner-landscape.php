
<?php
// Requête photo format paysage aléatoire
$args_banner = array(
    'post_type' => 'photo',
    'posts_per_page' => 1,
    'orderby' => 'rand',
    'tax_query' => array(
        array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => 'paysage',
        ),
    ),
);

$banner = new WP_Query($args_banner);

if ($banner->have_posts()) {
    while ($banner->have_posts()) {
        $banner->the_post();
        //  'large' custom size 
        the_post_thumbnail('large');
    }
    wp_reset_postdata();
}

?>
