const mainImage = document.getElementById('mainProductImage');
const thumbnails = document.querySelectorAll('.productThumbnail');
const nextButton = document.getElementById('nextImage');

let currentIndex = 0;

if (mainImage && thumbnails.length) {

    thumbnails.forEach((thumbnail, index) => {

        thumbnail.addEventListener('click', () => {

            currentIndex = index;
            
            const image = thumbnail.dataset.image;


            mainImage.src = image;

            thumbnails.forEach(item => {
                item.classList.remove('border-[var(--accent-primary-color)]');
                item.classList.add('border-[var(--catalog-border-color)]');
            });

            thumbnail.classList.remove('border-[var(--catalog-border-color)]');
            thumbnail.classList.add('border-[var(--accent-primary-color)]');
        });

    });

    nextButton?.addEventListener('click', () => {
        currentIndex++;

        if(currentIndex >= thumbnails.length) {
            currentIndex = 0;
        }

        thumbnails[currentIndex].click();
    });

}