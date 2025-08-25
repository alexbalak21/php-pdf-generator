document.addEventListener('DOMContentLoaded', function () {
    const authToggle = document.querySelector('[data-bs-target="#auth"]');
    const level2Collapse = document.getElementById('level2');

    authToggle.addEventListener('click', function () {
        const bsCollapse = bootstrap.Collapse.getInstance(level2Collapse);
        if (bsCollapse) {
            bsCollapse.hide();
        } else {
            new bootstrap.Collapse(level2Collapse, { toggle: false }).hide();
        }
    });
});


const toggleBtn = document.getElementById('toggle-btn');
const sidebar = document.querySelector('aside');

toggleBtn.addEventListener('click', function () {
    sidebar.classList.toggle('expand');
});
