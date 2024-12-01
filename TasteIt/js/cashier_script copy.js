// JavaScript for filtering products
document.getElementById('cashier-searchbar').addEventListener('input', function() {
    var searchQuery = this.value.toLowerCase();
    var products = document.getElementsByClassName('product-item');

    for (var i = 0; i < products.length; i++) {
        var productName = products[i].getAttribute('data-name').toLowerCase();
        if (productName.includes(searchQuery)) {
            products[i].style.display = 'block';
        } else {
            products[i].style.display = 'none';
        }
    }
});

// Auto Focus after modal is opened
document.addEventListener('DOMContentLoaded', function () {
    var quantityModal = document.getElementById('quantityModal');

    quantityModal.addEventListener('shown.bs.modal', function () {
        document.getElementById('productQuantity').focus();
    });
});

// Reset quantity modal input
document.addEventListener('DOMContentLoaded', function () {
    var quantityModal = document.getElementById('quantityModal');
    var quantityForm = document.getElementById('quantityForm');

    quantityModal.addEventListener('shown.bs.modal', function () {
        document.getElementById('productQuantity').focus();
    });

    quantityModal.addEventListener('hidden.bs.modal', function () {
        quantityForm.reset();
    });

    quantityForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Handle form submission logic
        
        var bootstrapModalInstance = bootstrap.Modal.getInstance(quantityModal);
        bootstrapModalInstance.hide();
        
        quantityForm.reset();
    });
});

// Add product to order list
var selectedProductElement;

document.querySelectorAll('.productResultContainer').forEach(item => {
    item.addEventListener('click', function() {
        selectedProductElement = this.closest('.product-item');
        var productId = selectedProductElement.getAttribute('data-id');
        var productName = selectedProductElement.getAttribute('data-name');
        var productPrice = selectedProductElement.getAttribute('data-price');

        document.getElementById('productId').value = productId;
        document.getElementById('productName').value = productName;
        document.getElementById('productPrice').value = productPrice;
    });
});

document.getElementById('quantityForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var productId = document.getElementById('productId').value;
    var productName = document.getElementById('productName').value;
    var productPrice = parseFloat(document.getElementById('productPrice').value);
    var productQuantity = parseFloat(document.getElementById('productQuantity').value);

    var orderList = document.getElementById('order-list');
    var totalAmountElement = document.getElementById('total-amount');
    var totalAmount = parseFloat(totalAmountElement.innerText.replace('₱', '').replace(',', '')) || 0;
    var itemAmount = productPrice * productQuantity;
    totalAmount += itemAmount;

    var rowCount = orderList.rows.length;
    var newRow = orderList.insertRow(rowCount);
    newRow.innerHTML = `
        <td>${rowCount + 1}</td>
        <td>${productName}</td>
        <td>₱${productPrice.toFixed(2)}</td>
        <td>${productQuantity.toFixed(2)}</td>
        <td>₱${itemAmount.toFixed(2)}</td>
        <td>
            <button class="btn btn-warning btn-sm edit-item-btn">Edit</button>
            <button class="btn btn-danger btn-sm remove-item-btn">Remove</button>
        </td>
    `;

    totalAmountElement.innerText = `₱${totalAmount.toFixed(2)}`;

    document.getElementById('productQuantity').value = '';
    document.getElementById('productId').value = '';
    document.getElementById('productName').value = '';
    document.getElementById('productPrice').value = '';
    var quantityModal = bootstrap.Modal.getInstance(document.getElementById('quantityModal'));
    quantityModal.hide();
});

// Remove or edit item from order list
document.getElementById('order-list').addEventListener('click', function(e) {
    if (e.target && e.target.matches('.remove-item-btn')) {
        var row = e.target.closest('tr');
        var itemAmount = parseFloat(row.cells[4].innerText.replace('₱', '').replace(',', '')) || 0;
        var totalAmountElement = document.getElementById('total-amount');
        var totalAmount = parseFloat(totalAmountElement.innerText.replace('₱', '').replace(',', '')) || 0;
        totalAmount -= itemAmount;
        totalAmountElement.innerText = `₱${totalAmount.toFixed(2)}`;
        row.remove();
    }

    if (e.target && e.target.matches('.edit-item-btn')) {
        var row = e.target.closest('tr');
        var productId = row.getAttribute('data-id');
        var productName = row.cells[1].innerText;
        var productPrice = parseFloat(row.cells[2].innerText.replace('₱', '').replace(',', '')) || 0;
        var productQuantity = parseFloat(row.cells[3].innerText) || 0;

        document.getElementById('productId').value = productId;
        document.getElementById('productName').value = productName;
        document.getElementById('productPrice').value = productPrice;
        document.getElementById('productQuantity').value = productQuantity;

        var quantityModal = new bootstrap.Modal(document.getElementById('quantityModal'));
        quantityModal.show();

        var itemAmount = parseFloat(row.cells[4].innerText.replace('₱', '').replace(',', '')) || 0;
        var totalAmountElement = document.getElementById('total-amount');
        var totalAmount = parseFloat(totalAmountElement.innerText.replace('₱', '').replace(',', '')) || 0;
        totalAmount -= itemAmount;
        totalAmountElement.innerText = `₱${totalAmount.toFixed(2)}`;
        row.remove();
    }
});












// Update total price in checkout modal when it is shown
document.addEventListener('DOMContentLoaded', function () {
    var checkoutModal = document.getElementById('checkoutModal');
    var checkoutForm = document.getElementById('checkoutForm');

    checkoutModal.addEventListener('show.bs.modal', function () {
        var totalAmountElement = document.getElementById('total-amount');
        var totalAmount = parseFloat(totalAmountElement.innerText.replace('₱', '').replace(',', '')) || 0;
        document.getElementById('checkoutTotalPrice').value = totalAmount.toFixed(2);
        
        var amountPaidInput = document.getElementById('amountPaid');
        var changeAmountInput = document.getElementById('changeAmount');
        
        amountPaidInput.value = '';
        changeAmountInput.value = '';
        
        // Calculate the change amount when the amount paid is entered
        amountPaidInput.addEventListener('input', function () {
            var amountPaid = parseFloat(amountPaidInput.value.replace('₱', '').replace(',', '')) || 0;
            var changeAmount = amountPaid - totalAmount;
            changeAmountInput.value = `${changeAmount.toFixed(2)}`;
        });
    });
});