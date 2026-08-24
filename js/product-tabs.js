const tabButtons = document.querySelectorAll('.tabButton');
const tabContents = document.querySelectorAll('.tabContent');


tabButtons.forEach(button =>{
    button.addEventListener('click', () =>{
        const target = button.dataset.tab;

        tabContents.forEach(content =>{
            content.classList.add('hidden');
        });

        document.getElementById(target).classList.remove('hidden');

        tabButtons.forEach(btn =>{
            btn.classList.remove('text-[var(--product-price-color)]');
        });

        button.classList.add('text-[var(--product-price-color)]');
    });
});