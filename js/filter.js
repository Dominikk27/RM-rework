document.addEventListener('DOMContentLoaded', () => {

    const mainToggle = document.getElementById('filterToggle');
    const mainPanel = document.getElementById('filterPanel');
    const mainIcon = document.getElementById('filterIcon');

    // FILTER GROUPS
    document.querySelectorAll('.filterGroupToggle').forEach(btn => {
        const body = document.getElementById(btn.dataset.target);
        const icon = btn.querySelector('.fa-chevron-down');

        if (btn.getAttribute('aria-expanded') === 'true') {
            body.style.maxHeight = body.scrollHeight + 'px';
        }

        btn.addEventListener('click', () => {
            const isOpen = btn.getAttribute('aria-expanded') === 'true';
            if (isOpen) {
                body.style.maxHeight = '0px';
                btn.setAttribute('aria-expanded', 'false');
                icon.classList.remove('rotate-180');
                body.classList.remove('border');
            } else {
                body.style.maxHeight = body.scrollHeight + 'px';
                btn.setAttribute('aria-expanded', 'true');
                icon.classList.add('rotate-180');
                body.classList.add('border');
            }
        });
    });

    mainToggle.addEventListener('click', () => {
        const isOpen = mainToggle.getAttribute('aria-expanded') === 'true';

        if (isOpen) {
            mainPanel.style.maxHeight = '0px';
            mainToggle.setAttribute('aria-expanded', 'false');
            mainIcon.classList.remove('rotate-180');

            setTimeout(() => {
                mainPanel.classList.remove('overflow-visible');
                mainPanel.classList.add('overflow-hidden');
            }, 300);
        } else {
            mainPanel.classList.remove('overflow-visible');
            mainPanel.classList.add('overflow-hidden')

            document.querySelectorAll('.filterGroup').forEach(group => {
                const body = group.querySelector('.filterGroupBody');
                const toggle = group.querySelector('.filterGroupToggle');
                if (toggle.getAttribute('aria-expanded') === 'true') {
                    body.style.maxHeight = body.scrollHeight + 'px';
                }
            });

            mainToggle.setAttribute('aria-expanded', 'true');
            mainIcon.classList.add('rotate-180');

            requestAnimationFrame(() => {
                mainPanel.style.maxHeight = mainPanel.scrollHeight + 'px';

                setTimeout(() =>{
                    mainPanel.classList.remove('overflow-hidden');
                    mainPanel.classList.add('overflow-visible');
                }, 300);

            });
        }
    });


    document.addEventListener('click', (event) => {

        const clickedGroup = event.target.closest('.filterGroup');

        document.querySelectorAll('.filterGroup').forEach(group => {

            const body = group.querySelector('.filterGroupBody');
            const toggle = group.querySelector('.filterGroupToggle');
            const icon = toggle.querySelector('.fa-chevron-down');

            const isOpen = toggle.getAttribute('aria-expanded') === 'true';

            if (!isOpen) {
                return;
            }

            // Ak klikol do iného filter boxu alebo mimo všetkých filter boxov
            if (group !== clickedGroup) {

                body.style.maxHeight = '0px';
                toggle.setAttribute('aria-expanded', 'false');
                icon.classList.remove('rotate-180');
                body.classList.remove('border');

            }

        });

    });

});