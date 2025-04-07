// JavaScript function to calculate the total amount based on ticket selection
function calculateTotal() {
    const adultPriceCitizen = 5000;
    const childPriceCitizen = 3000;
    const adultPriceForeign = 15000;
    const childPriceForeign = 10000;

    const visitorType = document.getElementById('visitor_type').value;
    const adultTickets = document.getElementById('adult').value;
    const childTickets = document.getElementById('child').value;

    let totalAmount = 0;

    if (visitorType === 'citizen') {
        totalAmount = (adultTickets * adultPriceCitizen) + (childTickets * childPriceCitizen);
    } else if (visitorType === 'foreign') {
        totalAmount = (adultTickets * adultPriceForeign) + (childTickets * childPriceForeign);
    }

    // Update the total amount field
    document.getElementById('total_amount').value = 'UGX ' + totalAmount.toLocaleString();
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
