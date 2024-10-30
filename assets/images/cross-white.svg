'use strict';

console.log ('modale.js load');

// Gestion de la modale de contact
document.addEventListener('DOMContentLoaded', () => {
    const menuItems = document.querySelectorAll('#menu-header .menu-item');
    const getModale = document.querySelector(".modale");
    const boutonClose = document.querySelector(".close-btn");
    const conteneurModale = document.getElementById("contact-overlay");

    let openModal = false;

    // toggle sur le contact du menu
    const togglePopup = () => {
        openModal = !openModal;
        openModal ? openPopup() : closePopup();
    };

    // ouverture modale
    const openPopup = () => {
        getModale.classList.remove('hide');
        getModale.classList.add('show');
        setTimeout(() => { getModale.style.display = 'flex';}, 500); 
    };

    // fermeture modale
    const closePopup = () => {
        getModale.classList.remove('show');
        getModale.classList.add('hide');
        setTimeout(() => { getModale.style.display = 'none';}, 500); 
    };

    // recherche élément menu "Contact" et écoute
    let menuContact;
    menuItems.forEach(item => {
        if (item.textContent.trim().toLowerCase() === "contact") {
            menuContact = item;
            menuContact.addEventListener('click', togglePopup);
        }
    });

    // fermeture modale au clic sur la croix
    boutonClose.addEventListener('click', () => {
        openModal = false;
        closePopup();
    });

    // Fermeture modale au clic hors de la modale 
    window.addEventListener('click', (e) => {        
        if (e.target === conteneurModale) {
            openModal = false;
            closePopup();
        }
    });

    // modale à partir de single-photographies ou page 404
    const btnContact = document.querySelector('.btn-contact');  
    const refSingleElement = document.getElementById("photo-ref");
    let refSingle = refSingleElement ? refSingleElement.textContent : null;

    if(btnContact && refSingle) {

        btnContact.addEventListener('click', () => {
            const refModale = document.querySelector(".popup-refPhoto input");
            refModale.value = refSingle
            openModal = true;
            openPopup();            
        });
    };
})


