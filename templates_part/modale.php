<!-- Structure de la modale -->
<div id="contact-overlay">
    <div class="contact-popup">
        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/Contact-header.png' ?>" alt="Contact_Banner" class="contact-banner">
        <div class="contact-form">
            <?php
            echo do_shortcode('[contact-form-7 id="d82c76f" title="Contact"]');
            ?>
        </div>
    </div>
</div>