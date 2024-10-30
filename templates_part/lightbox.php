<div class="lightbox">
    <button class="lightbox__close" aria-controls="lightbox" aria-expanded="false" aria-label="lightbox close" type="button">
        <span class="dashicons dashicons-no-alt"></span>
    </button>
    <button class="lightbox__arrows--previous" aria-controls="lightbox" aria-label="lightbox previous" type="button">
        <img src="<?= get_stylesheet_directory_uri() . '/assets/images/arrow-left-white.svg' ?>" alt="previous" />

    </button>
    <button class="lightbox__arrows--next" aria-controls="lightbox" aria-label="lightbox next" type="button">

        <img src="<?= get_stylesheet_directory_uri() . '/assets/images/arrow-right-white.svg' ?>" alt="next" />
    </button>
    <div class="lightbox__open">
        <img class="lightbox__image" src="" alt="lightbox image" />
    </div>
    <div class="lightbox__infos">
        <p class="lightbox__infos--Ref">référence</p>
        <p class="lightbox__infos--Categorie">catégorie</p>
    </div>
</div>