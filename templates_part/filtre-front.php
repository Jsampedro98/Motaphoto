<div class='filters'>
    <!-- Bloc de filtres pour les catégories et les formats -->
    <div class='filters-block' id="tax">
        <!-- Menu déroulant pour les catégories -->
        <menu class="dropdown" id="tri-categorie">
            <!-- Input caché pour activer le menu déroulant -->
            <input type="checkbox" class="dropdown__switch" id="filter-switch-categorie" aria-label="Sélectionnez une catégorie" hidden />
            <label for="filter-switch-categorie" class="dropdown__options-filter" aria-haspopup="listbox" aria-expanded="false">
                <span class="dropdown__filter-selected">Catégories</span>
            </label>
            <span class="dropdown__icon"></span>
            <!-- Liste des catégories -->
            <ul class="dropdown__select" role="listbox" aria-label="Sélectionnez une catégorie">
                <li id="categorie-full" class="dropdown__select-full" role="option" aria-label="Toutes les catégories">Catégories</li>
                <?php
                // Récupère les termes de la taxonomie 'photocategories'
                $events = get_terms('categorie');
                if (!empty($events) && !is_wp_error($events)) {
                    foreach ($events as $event) {
                        // Affiche chaque catégorie sous forme d'élément de liste                            
                        echo '<li class="dropdown__select-option" role="option" id="' . esc_attr($event->slug) . '" aria-selected="false">' . esc_html($event->name) . '</li>';
                    }
                }
                ?>
            </ul>
        </menu>

        <!-- Menu déroulant pour les formats -->
        <menu class="dropdown" id="tri-format">
            <!-- Input caché pour activer le menu déroulant -->
            <input type="checkbox" class="dropdown__switch" id="filter-switch-format" aria-label="Sélectionnez un format" hidden />
            <label for="filter-switch-format" class="dropdown__options-filter" aria-haspopup="listbox" aria-expanded="false">
                <span class="dropdown__filter-selected">Formats</span>
            </label>
            <span class="dropdown__icon"></span>
            <!-- Liste des formats -->
            <ul class="dropdown__select" role="listbox" aria-label="Sélectionnez un format">
                <li id="format-full" class="dropdown__select-full" role="option" aria-label="Tous les formats">Formats</li>
                <?php
                // Récupère les termes de la taxonomie 'formats'
                $sizes = get_terms('format');
                if (!empty($sizes) && !is_wp_error($sizes)) {
                    foreach ($sizes as $size) {
                        // Affiche chaque format sous forme d'élément de liste                            
                        echo '<li class="dropdown__select-option" role="option" id="' . esc_attr($size->slug) . '" aria-selected="false">' . esc_html($size->name) . '</li>';
                    }
                }
                ?>
            </ul>
        </menu>
    </div>

    <!-- Bloc de filtres pour le tri par date -->
    <div class='filters-block' id="date">
        <!-- Menu déroulant pour le tri chronologique -->
        <menu class="dropdown" id="tri-date">
            <!-- Input caché pour activer le menu déroulant -->
            <input type="checkbox" class="dropdown__switch" id="filter-switch-date" aria-label="Sélectionnez un sens de tri chronologique" hidden />
            <label for="filter-switch-date" class="dropdown__options-filter" aria-haspopup="listbox" aria-expanded="false">
                <span class="dropdown__filter-selected">Trier par</span>
            </label>
            <span class="dropdown__icon"></span>
            <!-- Liste des options de tri par date -->
            <ul class="dropdown__select" role="listbox" aria-label="Sélectionnez un sens de tri chronologique">
                <li id="date-full" class="dropdown__select-full" role="option" aria-label="tri par défaut">Trier par</li>
                <li id="DESC" class="dropdown__select-option" role="option" aria-selected="false">À partir des plus récentes</li>
                <li id="ASC" class="dropdown__select-option" role="option" aria-selected="false">À partir des plus anciennes</li>
            </ul>
        </menu>
    </div>
</div>