(() => {
    const menuButton = document.querySelector('.menu-button');
    const menu = document.querySelector('.main-nav');

    menuButton?.addEventListener('click', () => {
        const isOpen = menu.classList.toggle('open');
        menuButton.setAttribute('aria-expanded', String(isOpen));
        menuButton.querySelector('.sr-only').textContent = isOpen ? 'Menüyü kapat' : 'Menüyü aç';
    });

    menu?.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            menu.classList.remove('open');
            menuButton?.setAttribute('aria-expanded', 'false');
        });
    });

    const dateElement = document.querySelector('#today-date');
    if (dateElement) {
        const today = new Intl.DateTimeFormat('tr-TR', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
        }).format(new Date());
        dateElement.textContent = today.charAt(0).toUpperCase() + today.slice(1);
    }

    const openStatus = document.querySelector('#open-status');
    const now = new Date();
    const isWeekday = now.getDay() >= 1 && now.getDay() <= 5;
    const currentMinutes = now.getHours() * 60 + now.getMinutes();
    const isOpen = isWeekday && currentMinutes >= 8 * 60 && currentMinutes < 17 * 60;
    if (openStatus && !isOpen) {
        openStatus.classList.add('closed');
        openStatus.lastChild.textContent = ' Kapalı';
    }

    const dialog = document.querySelector('#service-dialog');
    const dialogTitle = document.querySelector('#dialog-title');
    const dialogDescription = document.querySelector('#dialog-description');
    const dialogRequirements = document.querySelector('#dialog-requirements');

    const openDialog = (title, description, requirements) => {
        if (!dialog) return;
        dialogTitle.textContent = title;
        dialogDescription.textContent = description;
        dialogRequirements.textContent = requirements;
        dialog.showModal();
    };

    document.querySelectorAll('.service-detail-button').forEach((button) => {
        button.addEventListener('click', () => {
            openDialog(button.dataset.service, button.dataset.description, button.dataset.requirements);
        });
    });

    document.querySelectorAll('.doctor-hours-button').forEach((button) => {
        button.addEventListener('click', () => {
            openDialog(button.dataset.doctor, 'Birim çalışma saatleri', button.dataset.hours);
        });
    });

    document.querySelector('.dialog-close')?.addEventListener('click', () => dialog.close());
    dialog?.addEventListener('click', (event) => {
        if (event.target === dialog) dialog.close();
    });
})();
