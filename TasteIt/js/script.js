// Inventory Scripts

// Display Supplier Contact Overlay
function displaySupplierContact() {
    $('.supplier-name').click(function() {
        var supplierContact = $(this).data('supplier-contact');
        var supplierName = $(this).data('supplier-contact-name');
        $('#supplier-contact-info').text(supplierContact);
        $('#supplier-contact-name').text(supplierName + " Contact");

        // Adjust overlay position
        var offset = $(this).offset();
        var overlayHeight = $('#supplier-contact-overlay').outerHeight();
        var topPosition = offset.top + $(this).outerHeight();

        // Set overlay position
        $('#supplier-contact-overlay').css({
            'display': 'block',
            'left': offset.left,
            'top': topPosition
        });
    });
}

function closeSupplierContact() {
    $('#supplier-contact-overlay').css('display', 'none');
}

$(document).ready(function() {
    displaySupplierContact();
});



//  Select all inventory filter checkboxes
document.addEventListener('DOMContentLoaded', (event) => {
    const parentCheckboxes = document.querySelectorAll('#inv-filter-outer-ul > li > input[type="checkbox"]');

    parentCheckboxes.forEach(parentCheckbox => {
        parentCheckbox.addEventListener('change', (e) => {
            const nestedCheckboxes = e.target.parentElement.querySelectorAll('ul input[type="checkbox"]');
            const collapseElement = e.target.parentElement.querySelector('.collapse');

            nestedCheckboxes.forEach(nestedCheckbox => {
                nestedCheckbox.checked = e.target.checked;
            });

            if (e.target.checked) {
                const bsCollapse = new bootstrap.Collapse(collapseElement, { show: true });
                bsCollapse.show();
            } else {
                const bsCollapse = new bootstrap.Collapse(collapseElement, { hide: true });
                bsCollapse.hide();
            }
        });
    });
});

//  Select all product filter checkboxes
document.addEventListener('DOMContentLoaded', (event) => {
    const parentCheckboxes = document.querySelectorAll('#pro-filter-outer-ul > li > input[type="checkbox"]');

    parentCheckboxes.forEach(parentCheckbox => {
        parentCheckbox.addEventListener('change', (e) => {
            const nestedCheckboxes = e.target.parentElement.querySelectorAll('ul input[type="checkbox"]');
            const collapseElement = e.target.parentElement.querySelector('.collapse');

            nestedCheckboxes.forEach(nestedCheckbox => {
                nestedCheckbox.checked = e.target.checked;
            });

            if (e.target.checked) {
                const bsCollapse = new bootstrap.Collapse(collapseElement, { show: true });
                bsCollapse.show();
            } else {
                const bsCollapse = new bootstrap.Collapse(collapseElement, { hide: true });
                bsCollapse.hide();
            }
        });
    });
});



// Search Filter
function searchfilter() {
    // Declare variables
    var input, filter, ul, li, label, i, txtValue;
    input = document.getElementById('inv-filter-searchbar');
    filter = input.value.toUpperCase();
    ul = document.getElementById("inv-filter-search-container"); // Use the container for inner lists
    li = ul.getElementsByTagName('li'); // Select all <li> elements inside container

    // Loop through all <li> elements
    for (i = 0; i < li.length; i++) {
        var currentLI = li[i];
        var innerUL = currentLI.querySelector('.inv-filter-inner-ul'); // Find inner <ul> within current <li>
        
        if (innerUL) {
            var checkboxes = innerUL.getElementsByTagName('input'); // Get checkboxes inside inner <ul>
            var foundMatch = false; // Flag to check if any checkbox matches the filter

            // Loop through checkboxes in current inner <ul>
            for (var j = 0; j < checkboxes.length; j++) {
                label = checkboxes[j].nextElementSibling; // Get the label associated with the checkbox
                txtValue = label.textContent || label.innerText;

                // Check if the label contains the filter text
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    foundMatch = true; // Set flag to true if match found
                    checkboxes[j].style.display = ""; // Show checkbox
                    checkboxes[j].parentNode.style.display = ""; // Show <li> parent of checkbox
                } else {
                    checkboxes[j].style.display = "none"; // Hide checkbox
                    checkboxes[j].parentNode.style.display = "none"; // Hide <li> parent of checkbox
                }
            }

            // Show or hide the inner <ul> based on match found
            if (foundMatch) {
                innerUL.style.display = ""; // Show inner <ul>
                currentLI.style.display = ""; // Show parent <li> element
            } else {
                innerUL.style.display = "none"; // Hide inner <ul>
                currentLI.style.display = "none"; // Hide parent <li> element
            }
        }
    }
}



// Date Placeholder
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('date_restocked');

    dateInput.addEventListener('focus', function() {
        // Set the input type to 'date' first
        this.type = 'date';

        // Check if the input already has a value; if not, set it to today's date
        if (!this.value) {
            const today = new Date();
            const dd = String(today.getDate()).padStart(2, '0'); // Ensure two digits for day
            const mm = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based, so add 1
            const yyyy = today.getFullYear();

            this.value = yyyy + '-' + mm + '-' + dd; // Format as YYYY-MM-DD
        }
    });

    dateInput.addEventListener('blur', function() {
        // If the input loses focus and no date was selected, revert to text type
        if (!this.value) {
            this.type = 'text';
        }
    });
});















