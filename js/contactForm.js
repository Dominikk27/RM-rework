const showContactForm = document.getElementById('displayContactForm');
const contactForm = document.getElementById('productContactForm');
const closeContactForm = document.getElementById('closeContactForm');


showContactForm.addEventListener('click', ()=>{
    contactForm.classList.remove('hidden');
    document.documentElement.classList.add('overflow-hidden');
    document.body.classList.add('overflow-hidden');
});

closeContactForm.addEventListener('click', () => {
    contactForm.classList.add('hidden');
    document.documentElement.classList.remove('overflow-hidden');
    document.body.classList.remove('overflow-hidden');
});

contactForm.addEventListener('click', (e) => {
    if (e.target === contactForm) {
        contactForm.classList.add('hidden');
        document.documentElement.classList.remove('overflow-hidden');
        document.body.classList.remove('overflow-hidden');
    }
});