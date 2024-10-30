'use strict';

console.log('modale.js load');

// Gestion de la modale de contact
document.addEventListener('DOMContentLoaded', () => {
    const menuItems = document.querySelectorAll('.menu .menu-item');
    const getModale = document.querySelector(".modale");
    const conteneurModale = document.getElementById("contact-overlay");
    const btnContact = document.querySelector('.btn-contact');  // Bouton "Contact" dans single-photo.php
    const refSingleElement = document.getElementById("photo-ref"); // Élément contenant la référence de la photo
    let openModal = false;

    // Fonction pour alterner entre ouvrir et fermer la modale
    const togglePopup = () => {
        openModal = !openModal;
        openModal ? openPopup() : closePopup();
    };

    // Fonction pour ouvrir la modale
    const openPopup = () => {
        getModale.classList.remove('hide');
        getModale.classList.add('show');
        getModale.style.display = 'flex';
    };

    // Fonction pour fermer la modale
    const closePopup = () => {
        getModale.classList.remove('show');
        getModale.classList.add('hide');
        setTimeout(() => { getModale.style.display = 'none'; }, 500);
    };

    // Recherche de l'élément de menu "Contact" et ajout de l'écouteur
    let menuContact;
    menuItems.forEach(item => {
        if (item.textContent.trim().toLowerCase() === "contact") {
            menuContact = item;
            menuContact.addEventListener('click', togglePopup);
        }
    });

    // Fermeture de la modale lorsqu'on clique en dehors d'elle
    window.addEventListener('click', (e) => {        
        if (e.target === conteneurModale) {
            openModal = false;
            closePopup();
        }
    });

    // Ouverture de la modale avec référence photo dans single-photo.php
    if (btnContact && refSingleElement) {
        const refSingle = refSingleElement.textContent.trim(); // Récupération de la référence de la photo

        btnContact.addEventListener('click', () => {
            const refModaleInput = document.getElementById("ref_photo"); // Champ de référence dans la modale
            if (refModaleInput) {
                refModaleInput.value = refSingle; // Injection de la référence dans le champ de la modale
                console.log(`Référence photo ajoutée : ${refSingle}`);
            } else {
                console.warn("Le champ 'ref_photo' dans le formulaire de la modale est introuvable.");
            }
            openModal = true;
            openPopup();            
        });
    } else {
        console.warn("Le bouton 'Contact' dans single-photo.php ou la référence de la photo est introuvable.");
    }
});
