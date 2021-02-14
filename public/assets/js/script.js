const lw = window.livewire;
const locales = document.querySelectorAll('.language-menu li');

locales.forEach((locale) => {
    locale.addEventListener('click', (e) => {
        document.querySelector('#locale').value = locale.getAttribute('data-locale');
        document.querySelector('#locale-form').submit();
    });
});

lw.on("studentAdded", () => {
    $('#add-student-modal').modal('hide');
});

lw.on("studentUpdated", () => {
    $('#update-student-modal').modal('hide');
});

document.querySelector('.modal').addEventListener('hidden.bs.modal', function () {
    lw.emit('reset:inputs')
});

function confirmDialog(id) {
    const locale = document.body.getAttribute('data-locale');
    confirm(locale === 'fa' ? 'آیا مطمئن هستید؟' : 'Are your sure?') && lw.emit(`set:destroy`, id);
}
