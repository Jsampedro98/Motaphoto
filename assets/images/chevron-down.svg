'use strict';

document.addEventListener('DOMContentLoaded', () => {
    attachLightboxEvents();

    document.addEventListener('refreshLightboxEvents', () => {
        attachLightboxEvents();
    });
});

const attachLightboxEvents = () => {
    const lightbox = document.querySelector('.lightbox');
    const lightboxImage = lightbox.querySelector('.lightbox__image');
    const lightboxRef = lightbox.querySelector('.lightbox__infos--Ref');
    const lightboxCategorie = lightbox.querySelector('.lightbox__infos--Categorie');
    const closeBtn = lightbox.querySelector('.lightbox__close');
    const prevBtn = lightbox.querySelector('.lightbox__arrows--previous');
    const nextBtn = lightbox.querySelector('.lightbox__arrows--next');

    const images = [];
    document.querySelectorAll('.blockSurvol__iconLightbox').forEach((trigger, index) => {
        const fullImage = trigger.getAttribute('data-full-image');
        const ref = trigger.closest('.blockSurvol').querySelector('.blockSurvol__infos--Ref p').innerText;
        const categorie = trigger.closest('.blockSurvol').querySelector('.blockSurvol__infos--Categorie p').innerText;

        images.push({ fullImage, ref, categorie });

        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            openLightbox(index);
        });
    });

    let currentIndex = 0;

    const openLightbox = (index) => {
        if (index < 0 || index >= images.length) {
            console.error(`Invalid index: ${index}`);
            return;
        }

        currentIndex = index;
        const image = images[currentIndex];

        if (!image) {
            console.error(`Image not found at index: ${currentIndex}`);
            return;
        }

        lightboxImage.src = image.fullImage;
        lightboxRef.innerText = image.ref;
        lightboxCategorie.innerText = image.categorie;
        lightbox.style.display = 'flex';
        document.addEventListener('keydown', handleKeydown);
    };

    const changeImage = (direction) => {
        const newIndex = (currentIndex + direction + images.length) % images.length;
        openLightbox(newIndex);
    };

    const closeLightbox = () => {
        lightbox.style.display = 'none';
        document.removeEventListener('keydown', handleKeydown);
    };

    const handleKeydown = (e) => {
        if (e.key === 'ArrowLeft') {
            changeImage(-1);
        } else if (e.key === 'ArrowRight') {
            changeImage(1);
        } else if (e.key === 'Escape') {
            closeLightbox();
        }
    };

    closeBtn.addEventListener('click', closeLightbox);

    prevBtn.addEventListener('click', () => changeImage(-1));
    
    nextBtn.addEventListener('click', () => changeImage(1));

    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });
};
