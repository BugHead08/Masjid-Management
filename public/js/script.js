const sidebarToggle = document.getElementById('sidebar-toggle');
const sidebar = document.querySelector('.sidebar');
const backdrop = document.querySelector('.sidebar-backdrop');
const sidebarClose = document.querySelector('.sidebar-close');

function toggleSidebar() {
    sidebar.classList.toggle('show');
    backdrop.classList.toggle('show');
}

sidebarToggle.addEventListener('click', toggleSidebar);
backdrop.addEventListener('click', toggleSidebar);
sidebarClose.addEventListener('click', toggleSidebar);

// Close sidebar when clicking outside
document.addEventListener('click', (e) => {
    if (!sidebar.contains(e.target) && 
        !sidebarToggle.contains(e.target) && 
        sidebar.classList.contains('show')) {
        toggleSidebar();
    }
});


function toggleEditForm(id) {
    const formRow = document.getElementById(`edit-form-${id}`);
    const currentDisplay = formRow.style.display;

    // Toggle display between none and table-row
    formRow.style.display = currentDisplay === 'none' ? 'table-row' : 'none';
}

var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})