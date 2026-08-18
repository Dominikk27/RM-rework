document.addEventListener('DOMContentLoaded', () => {

    const mainToggle = document.getElementById('filterToggle');
    const mainPanel = document.getElementById('filterPanel');
    const mainIcon = document.getElementById('filterIcon');

    // FILTER GROUPS
    document.querySelectorAll('.filterGroupToggle').forEach(btn => {
        const body = document.getElementById(btn.dataset.target);
        const icon = btn.querySelector('i');

        if (btn.getAttribute('aria-expanded') === 'true') {
            body.style.maxHeight = body.scrollHeight + 'px';
        }

        btn.addEventListener('click', () => {
            const isOpen = btn.getAttribute('aria-expanded') === 'true';
            if (isOpen) {
                body.style.maxHeight = '0px';
                btn.setAttribute('aria-expanded', 'false');
                icon.classList.remove('rotate-180');
            } else {
                body.style.maxHeight = body.scrollHeight + 'px';
                btn.setAttribute('aria-expanded', 'true');
                icon.classList.add('rotate-180');
            }
        });
    });

    mainToggle.addEventListener('click', () => {
        const isOpen = mainToggle.getAttribute('aria-expanded') === 'true';

        if (isOpen) {
            mainPanel.style.maxHeight = '0px';
            mainToggle.setAttribute('aria-expanded', 'false');
            mainIcon.classList.remove('rotate-180');
        } else {
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
            });
        }
    });

});