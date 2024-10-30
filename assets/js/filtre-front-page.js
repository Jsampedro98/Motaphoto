'use strict';

console.log('filtre-front-page.js load');

document.addEventListener('DOMContentLoaded', () => {


    //////////// FILTRES :  selections de filtrage/////////////

    // Fonction pour ouvrir les menus déroulants
    const openDropdown = (dropdownId, switchId) => {
        const dropdown = document.querySelector(`#${dropdownId}`);
        const toggle = dropdown.querySelector(`#${switchId}`);

        if (!dropdown || !toggle) return;

        const label = dropdown.querySelector('.dropdown__filter-selected');
        const options = Array.from(dropdown.querySelectorAll('.dropdown__select-option'));

        // Met à jour l'attribut aria-expanded selon l'état du menu
        toggle.addEventListener('change', () => {
            const isChecked = toggle.checked;
            dropdown.setAttribute('aria-expanded', isChecked ? 'true' : 'false');
        });

        // Gestion du choix des options dans le menu
        options.forEach((option) => {
            option.addEventListener('click', () => {
                label.textContent = option.textContent;
                options.forEach(opt => {
                    opt.classList.remove('dropdown__select-option--selected');
                    opt.setAttribute('aria-selected', 'false');
                });
                option.classList.add('dropdown__select-option--selected');
                option.setAttribute('aria-selected', 'true');
                toggle.checked = false;
            });
        });

        // Fermer le menu lors du clic à l'extérieur de celui-ci
        document.addEventListener('click', (e) => {
            if (e.target === toggle || e.target.closest(`#${dropdownId}`)) return;
            toggle.checked = false;
            dropdown.setAttribute('aria-expanded', 'false');
        });
    };

    // Initialiser tous les menus déroulants
    const initDropdowns = () => {
        openDropdown("tri-categorie", "filter-switch-categorie");
        openDropdown("tri-format", "filter-switch-format");
        openDropdown("tri-date", "filter-switch-date");
    };

    
    ////////////  FILTRATION  ET PAGINATION :  requête AJAX de nouveaux catalogues sur sélection
    let currentPage = 1;
    let totalPhotos = 0;

    // Fonction pour charger un nouveau catalogue via AJAX
    const newCatalog = (category, format, order = 'ASC', page = 1, reset = false) => {
        jQuery.ajax({
            url: myAjax.ajaxurl,
            method: 'POST',
            data: {
                action: 'filtrer_paginer_catalogue',
                category: category,
                format: format,
                order: order,
                page: page,
                nonce: myAjax.nonce
            },
            success: (response) => {
                if (response.success) {
                    if (reset || page === 1) {
                        catalogItems.innerHTML = response.data.html;
                    } else {
                        catalogItems.insertAdjacentHTML('beforeend', response.data.html);
                    }
                    totalPhotos = response.data.total;
                    totalPhotosCount.textContent = `Total photos: ${totalPhotos}`;
                    compterChargerPlus(totalPhotos);
                    document.dispatchEvent(new CustomEvent('refreshLightboxEvents'));
                    document.dispatchEvent(new Event('refreshArrowEvents'));
                } else {
                    console.log('Erreur dans la réponse Ajax');
                }
            },
            error: (error) => {
                console.log(error);
            }
        });
    };

    // Fonction pour gérer l'affichage du bouton "Charger plus"
    const compterChargerPlus = (total) => {
        const nombrePhotosAffichees = catalogItems.querySelectorAll('.block__photo').length;
        btnChargerPlus.style.display = (nombrePhotosAffichees < total) ? 'block' : 'none';
    };

    // Sélecteurs pour les options de filtrage
    const elementsCategorie = document.querySelectorAll('#tri-categorie .dropdown__select-option');
    const elementsFormats = document.querySelectorAll('#tri-format .dropdown__select-option');
    const elementsTri = document.querySelectorAll('#tri-date .dropdown__select-option');
    const catalogItems = document.querySelector('.siblings-items');
    const btnChargerPlus = document.getElementById('charger-plus');
    const totalPhotosCount = document.getElementById('total-photos-count');

    let itemsCategorie = 'all';
    let itemsFormat = 'all';
    let itemsTri = 'ASC';

    initDropdowns();

    // Ajouter des écouteurs pour le filtrage et la pagination
    elementsCategorie.forEach(function (element) {
        element.addEventListener("click", function() {
            itemsCategorie = element.id;
            currentPage = 1; // Reset pagination
            newCatalog(itemsCategorie, itemsFormat, itemsTri, currentPage, true);
        });
    });

    elementsFormats.forEach(function (element) {
        element.addEventListener("click", function() {
            itemsFormat = element.id;
            currentPage = 1; // Reset pagination
            newCatalog(itemsCategorie, itemsFormat, itemsTri, currentPage, true);
        });
    });

    elementsTri.forEach(function (element) {
        element.addEventListener("click", function() {
            itemsTri = element.id;
            currentPage = 1; // Reset pagination
            newCatalog(itemsCategorie, itemsFormat, itemsTri, currentPage, true);
        });
    });

    // Gestion du clic sur le bouton "Charger plus"
    btnChargerPlus.addEventListener('click', () => {
        currentPage++;
        newCatalog(itemsCategorie, itemsFormat, itemsTri, currentPage);
    });


    //////////// FILTRES :  reset /////////////

     // Sélecteurs pour nettoyer les options de filtrage
    const categorieLabel = document.querySelector('#tri-categorie .dropdown__filter-selected');
    const formatLabel = document.querySelector('#tri-format .dropdown__filter-selected');
    const dateLabel = document.querySelector('#tri-date .dropdown__filter-selected');

    const categorieFull = document.getElementById('categorie-full');
    const formatFull = document.getElementById('format-full');
    const triFull = document.getElementById('date-full');

    // Réinitialiser les filtres
    const resetFilter = (elementFull, elements, label, setDefaultValue) => {
        elementFull.addEventListener("click", () => {
            setDefaultValue();
            elements.forEach(element => {
                element.classList.remove('dropdown__select-option--selected');
                element.setAttribute('aria-selected', 'false');
            });
            label.textContent = elementFull.textContent;
            label.setAttribute('aria-selected', 'false');
            currentPage = 1;
            newCatalog(itemsCategorie, itemsFormat, itemsTri, currentPage, true);
        });
    };

    // Appliquer la réinitialisation pour chaque filtre
    resetFilter(categorieFull, elementsCategorie, categorieLabel, () => itemsCategorie = 'all');
    resetFilter(formatFull, elementsFormats, formatLabel, () => itemsFormat = 'all');
    resetFilter(triFull, elementsTri, dateLabel, () => itemsTri = 'ASC');
});