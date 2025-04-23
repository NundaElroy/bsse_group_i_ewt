// JavaScript function to calculate the total amount based on ticket selection
function calculateTotal() {
    // Extract prices from the DOM
    let adultPriceCitizen = 5000; // Default fallback value
    let childPriceCitizen = 3000; // Default fallback value
    let adultPriceForeign = 15000; // Default fallback value
    let childPriceForeign = 10000; // Default fallback value
    
    // Get all ticket price items
    const ticketItems = document.querySelectorAll('.ticket-price-item');
    
    // Extract prices from data attributes
    ticketItems.forEach(item => {
        const category = item.getAttribute('data-category');
        const ageType = item.getAttribute('data-age');
        const price = parseInt(item.getAttribute('data-price'));
        
        if (category === 'ugandan_citizen') {
            if (ageType === 'adult') adultPriceCitizen = price;
            if (ageType === 'child') childPriceCitizen = price;
        } else if (category === 'foreign_visitor') {
            if (ageType === 'adult') adultPriceForeign = price;
            if (ageType === 'child') childPriceForeign = price;
        }
    });
    
    // Rest of your calculation function continues here...
    const visitorType = document.getElementById('visitor_type').value;
    const adultTickets = parseInt(document.getElementById('adult').value) || 0;
    const childTickets = parseInt(document.getElementById('child').value) || 0;
    
    let adultPrice, childPrice, totalAmount;
    
    if (visitorType === 'Ugandan Citizen') {
        adultPrice = adultPriceCitizen;
        childPrice = childPriceCitizen;
    } else { // Foreign Visitor
        adultPrice = adultPriceForeign;
        childPrice = childPriceForeign;
    }
    
    // Calculate totals
    const adultTotal = adultTickets * adultPrice;
    const childTotal = childTickets * childPrice;
    totalAmount = adultTotal + childTotal;
    
    // Update displays
    document.getElementById('adult-count').textContent = adultTickets;
    document.getElementById('child-count').textContent = childTickets;
    document.getElementById('adult-total').textContent = `UGX ${adultTotal.toLocaleString()}`;
    document.getElementById('child-summary').textContent = `UGX ${childTotal.toLocaleString()}`;
    document.getElementById('summary-total').textContent = `UGX ${totalAmount.toLocaleString()}`;
    
    document.getElementById('total_amount').value = totalAmount;
}

// JavaScript function to validate National ID and Passport format
function validateDocumentFormat() {
    const documentType = document.getElementById('document_type').value;
    const documentNumber = document.getElementById('id_number').value;
    const idError = document.getElementById('id_error');
    let isValid = false;
    let errorMessage = '';
    let placeholderText = '';

    if (documentType === 'national_id') {
        // National ID should start with "U" followed by 8 digits (e.g., U12345678)
        const nationalIdRegex = /^U\d{8}$/;
        isValid = nationalIdRegex.test(documentNumber);
        errorMessage = 'Invalid National ID format. It should start with "U" followed by 8 digits.';
        placeholderText = 'Enter your National ID (e.g., U12345678)';
    } 
    else if (documentType === 'passport') {
        // Passport should be alphanumeric and between 6 and 9 characters (e.g., A1234567)
        const passportRegex = /^[A-Za-z0-9]{6,9}$/;
        isValid = passportRegex.test(documentNumber);
        errorMessage = 'Invalid Passport format. It should be alphanumeric with 6 to 9 characters.';
        placeholderText = 'Enter your Passport Number (e.g., A1234567)';
    }

    // Update the error message and show or hide the error based on validation
    if (!isValid) {
        idError.style.display = 'block';
        idError.innerHTML = errorMessage;
    } 
    
    else 
    {
        idError.style.display = 'none';
    }

    // Update the placeholder dynamically based on the document type
    document.getElementById('id_number').setAttribute('placeholder', placeholderText);

    return isValid;
}

// Event listener for the document type selection to trigger validation
document.getElementById('document_type').addEventListener('change', validateDocumentFormat);
document.getElementById('id_number').addEventListener('input', validateDocumentFormat);

// Call the calculateTotal function initially
calculateTotal();

// Add event listeners to trigger the total calculation when user inputs the ticket numbers
document.getElementById('adult').addEventListener('input', calculateTotal);
document.getElementById('child').addEventListener('input', calculateTotal);
document.getElementById('visitor_type').addEventListener('change', calculateTotal);

// Event listener for form submission to check document validity before submission
document.getElementById('ticketForm').addEventListener('submit', function (event) {
    if (!validateDocumentFormat()) {
        event.preventDefault();  // Prevent form submission if the document is invalid
    }
});




 // Add this JavaScript to enhance the form functionality
 document.addEventListener('DOMContentLoaded', function() {
    // Quantity buttons functionality
    const quantityBtns = document.querySelectorAll('.quantity-btn');
    quantityBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentNode.querySelector('input');
            const currentValue = parseInt(input.value);
            
            if (this.classList.contains('plus')) {
                input.value = currentValue + 1;
            } else if (this.classList.contains('minus') && currentValue > 0) {
                input.value = currentValue - 1;
            }
            
            // Trigger change event for recalculation
            const event = new Event('change');
            input.dispatchEvent(event);
            calculateTotal();
            updateSummary();
        });
    });
    
    // Initialize summary on page load
    updateSummary();
    
    // Update summary when inputs change
    document.getElementById('adult').addEventListener('change', updateSummary);
    document.getElementById('child').addEventListener('change', updateSummary);
    document.getElementById('visitor_type').addEventListener('change', updateSummary);
    
    function updateSummary() {
        // This is a placeholder - the actual calculation would be done by your JS file
        // You would need to adjust your tickets.js file to work with this new markup
        const adultCount = parseInt(document.getElementById('adult').value) || 0;
        const childCount = parseInt(document.getElementById('child').value) || 0;
        
        document.getElementById('adult-count').textContent = adultCount;
        document.getElementById('child-count').textContent = childCount;
        
        // If no tickets are selected, hide the summary items
        document.getElementById('adult-summary').style.display = adultCount > 0 ? 'flex' : 'none';
        document.getElementById('child-sum').style.display = childCount > 0 ? 'flex' : 'none';
    }
});
