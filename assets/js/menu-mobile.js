'use strict';

console.log('menu-mobile.js load');

document.addEventListener('DOMContentLoaded', () => {
    const btnBurgerMenu = document.querySelector('.menu-toggle');
    const mobileMenu = document.querySelector('nav');
    const menuLinks = document.querySelectorAll('.menu .menu-item a'); // Tous les liens du menu

    let isOpen = false;

    // Fonction pour alterner l'état du menu
    function toggleMenu() {
        isOpen = !isOpen;
        isOpen ? openMenu() : closeMenu();
    }

    // Fonction pour ouvrir le menu
    function openMenu() {
        console.log('Opening menu...');
        btnBurgerMenu.classList.add('active');
        mobileMenu.classList.add('open', 'slideRight');
        mobileMenu.classList.remove('slideOutRight');
    }

    // Fonction pour fermer le menu
    function closeMenu() {
        console.log('Closing menu...');
        btnBurgerMenu.classList.remove('active');
        mobileMenu.classList.remove('slideRight');
        mobileMenu.classList.add('slideOutRight');

        setTimeout(() => {
            mobileMenu.classList.remove('open');
        }, 500); // Durée de la transition CSS
    }

    // Écouteur de clic pour le bouton burger
    btnBurgerMenu.addEventListener('click', () => {
        console.log('Bouton burger cliqué');
        toggleMenu();
    });

    // Fermer le menu au clic sur chaque lien sans interrompre la navigation
    menuLinks.forEach(link => {
        link.addEventListener('click', () => {
            console.log('Lien du menu cliqué');
            closeMenu(); // Ferme le menu burger
        });
    });
});
