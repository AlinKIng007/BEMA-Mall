 // Function to toggle dark mode
 function toggleDarkMode() {
    const body = document.body;
    body.classList.toggle('dark-mode');

    // Toggle icon
    const darkModeBtn = document.getElementById('dark-mode-btn');
    const isDarkMode = body.classList.contains('dark-mode');
    if (isDarkMode) {
        darkModeBtn.innerHTML = '<span class="material-icons-sharp active" id="dark-mode-icon">brightness_3</span>';
    } else {
        darkModeBtn.innerHTML = '<span class="material-icons-sharp active" id="light-mode-icon">wb_sunny</span>';
    }

    // Save dark mode preference to local storage
    localStorage.setItem('darkMode', isDarkMode);
}

// Function to apply dark mode preference from local storage
function applyDarkModePreference() {
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    if (isDarkMode) {
        document.body.classList.add('dark-mode');
    }
}

// Event listener for dark mode button
const darkModeBtn = document.getElementById('dark-mode-btn');
darkModeBtn.addEventListener('click', toggleDarkMode);

// Apply dark mode preference when the page loads
window.addEventListener('load', applyDarkModePreference);


const sideMenu = document.querySelector('aside');
const menuBtn = document.getElementById('menu-btn');
const closeBtn = document.getElementById('close-btn');

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
});

document.addEventListener('DOMContentLoaded', function () {
    // Get the modal
    var modal = document.getElementById('editModal');

    // Get all edit buttons
    var editBtns = document.querySelectorAll(".edit-btn");

    // Get the <span> element that closes the modal
    var span = document.querySelector("#editModal .close");

    // Get pagination links
    var paginationLinks = document.querySelectorAll(".pagination a");



    // Function to open the modal
    function openModal() {
        modal.style.display = "block";
    }

    // Function to close the modal
    function closeModal() {
        modal.style.display = "none";
    }

    // Add event listeners to each edit button
    editBtns.forEach(function (btn) {
        btn.addEventListener('click', openModal);
    });

    // When the user clicks on <span> (x), close the modal
    span.addEventListener('click', closeModal);

    // When the user clicks anywhere outside of the modal, close it
    window.addEventListener('click', function (event) {
        if (event.target == modal) {
            closeModal();
        }
    });

// Pagination event listener
paginationLinks.forEach(function(link) {
link.addEventListener('click', function(event) {
    event.preventDefault();
    var currentPage = parseInt(link.textContent);
    changePage(currentPage);
    highlightActivePage(currentPage); // Highlight active page
});
});

// Function to highlight active pagination link
function highlightActivePage(page) {
paginationLinks.forEach(function(link) {
    if (parseInt(link.textContent) === page) {
        link.classList.add("active");
    } else {
        link.classList.remove("active");
    }
});
}

// Function to change the page
function changePage(page) {
var rowsPerPage = 2; // Adjust this value according to your needs
var rows = document.querySelectorAll("#userTable tbody tr");
var startIndex = (page - 1) * rowsPerPage;
var endIndex = startIndex + rowsPerPage;

// Hide all rows
rows.forEach(function(row) {
    row.style.display = "none";
});

// Show rows for the current page
for (var i = startIndex; i < endIndex && i < rows.length; i++) {
    rows[i].style.display = "table-row";
}
}



});