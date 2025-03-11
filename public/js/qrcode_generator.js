// Wait for document to be fully loaded
document.addEventListener("DOMContentLoaded", function () {
    // Find all Generate QR buttons
    const qrButtons = document.querySelectorAll(".qr-generate-btn");

    // Add event listener to each button
    qrButtons.forEach((button) => {
        button.addEventListener("click", generateQRCodeForButton);
    });
});

// Function to generate QR code when button is clicked
function generateQRCodeForButton() {
    // Get the data ID from the button's data attribute
    const dataId = this.getAttribute("data-id");
    const qrContainer = this.nextElementSibling;

    // Show loading state
    qrContainer.innerHTML = "Generating QR Code...";

    // Send request to server to generate QR code
    fetch(`/generate-qrcode/${dataId}`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            Accept: "application/json",
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                // Display the generated QR code image
                qrContainer.innerHTML = `
                <div style="padding: 10px; background: #fff; display: inline-block; margin: 10px 0;">
                    <img src="${data.qr_url}" alt="QR Code" width="128" height="128">
                    <a href="${data.qr_url}" download="qrcode-${dataId}.png" class="btn btn-sm btn-info mt-2 d-block">Download QR Code</a>
                </div>
            `;
            } else {
                qrContainer.innerHTML = "Error: " + data.message;
            }
        })
        .catch((error) => {
            console.error("Error generating QR code:", error);
            qrContainer.innerHTML =
                "Error generating QR code. Please try again.";
        });
}
