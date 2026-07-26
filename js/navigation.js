function initNavigationScrollEffect(){
    const header = document.getElementById('navigationHeader');
    const scrollTreshold = 20;

    const scrollNavbarClasses = [
        'bg-[var(--decent-color)]/70', 
        'backdrop-blur-md', 
        'border-b', 
        'border-[var(--line-color)]'
    ];

    window.addEventListener('scroll', () => {
        const isScrolled = window.scrollY > scrollTreshold;
        if(isScrolled){
            header.classList.add(...scrollNavbarClasses);
        }
        else{
            header.classList.remove(...scrollNavbarClasses);
        }
    })
}


function initMobileMenu(){
    const toggleBTN = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');

    const bar1 = document.getElementById('bar1');
    const bar2 = document.getElementById('bar2');
    const bar3 = document.getElementById('bar3');

    let isOpen = false;

    function openMenu(){
        mobileMenu.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
        mobileMenu.classList.add('opacity-100', 'scale-100', 'pointer-events-auto');

        bar1.classList.add('rotate-45', 'translate-y-[10px]');
        bar2.classList.add('opacity-0');
        bar3.classList.add('-rotate-45', '-translate-y-[10px]');

        document.body.classList.add('overflow-hidden');
        isOpen = true;

    }

    function closeMenu(){
        mobileMenu.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
        mobileMenu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');

        bar1.classList.remove('rotate-45', 'translate-y-[10px]');
        bar2.classList.remove('opacity-0');
        bar3.classList.remove('-rotate-45', '-translate-y-[10px]');

        document.body.classList.remove('overflow-hidden');
        isOpen = false;
    }


    toggleBTN.addEventListener('click', () =>{
        isOpen ? closeMenu() : openMenu();
    });

    mobileMenu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', closeMenu);
    })

}


document.addEventListener('DOMContentLoaded', () =>{
    initNavigationScrollEffect();
    initMobileMenu();
})