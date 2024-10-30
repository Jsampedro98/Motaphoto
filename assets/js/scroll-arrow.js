'use strict';

document.addEventListener('DOMContentLoaded', () => {
    // AJAX updates
    document.addEventListener('refreshLightboxEvents', () => {
        setTimeout(toggleScrollArrows, 100); 
    });

    const scrollDown = document.getElementById('scroll-down');
    const scrollUp = document.getElementById('scroll-up');
    const scrollThreshold = 200; // Adjust this value as needed

    // Fonction pour alterner (toggle) la visibilité des flèches de défilement
    function toggleScrollArrows() {
        if (document.body.scrollHeight > window.innerHeight + scrollThreshold) {
            scrollDown?.classList.add('visible');
        } else {
            scrollDown?.classList.remove('visible');
        }

        if (window.scrollY > 0) {
            scrollUp?.classList.add('visible');
        } else {
            scrollUp?.classList.remove('visible');
        }

        if (window.scrollY + window.innerHeight >= document.body.scrollHeight - scrollThreshold) {
            scrollDown?.classList.remove('visible');
        } else {
            scrollDown?.classList.add('visible');
        }
    }

    // Défilement vers le bas lors du clic sur la flèche
    if (scrollDown) {
        scrollDown.addEventListener('click', () => {
            window.scrollBy({
                top: window.innerHeight,
                left: 0,
                behavior: 'smooth'
            });
        });
    }

    // Défilement vers le haut lors du clic sur la flèche
    if (scrollUp) {
        scrollUp.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });
        });
    }

    // Initial check
    toggleScrollArrows();
    window.addEventListener('resize', toggleScrollArrows);
    window.addEventListener('scroll', toggleScrollArrows);
});
