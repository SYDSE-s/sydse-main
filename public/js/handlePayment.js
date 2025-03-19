let currentStep = 1;
const totalSteps = 4;

function showStep(step) {
    if (step === 1) {
        document.querySelector(".checkout-content").style.display = "flex";
        document.querySelectorAll(".checkout-step").forEach((el) => {
            el.style.display = "none";
        });
    } else {
        document.querySelector(".checkout-content").style.display = "none";
        document.querySelectorAll(".checkout-step").forEach((el) => {
            el.style.display = "none";
        });
        document.querySelector(
            `.checkout-step[data-step="${step}"]`
        ).style.display = "block";
    }

    // Update current step
    currentStep = step;
    updateStepIndicator(step);
    updateStepNavigation();
}

function updateStepNavigation() {
    const btnLanjutkan = document.getElementById("btnLanjutkan");
    const btnKembali = document.getElementById("btnKembali");

    // Update tombol Lanjutkan
    if (currentStep === totalSteps) {
        btnLanjutkan.textContent = "Konfirmasi Pesanan";
        btnLanjutkan.classList.remove("btn-continue");
        btnLanjutkan.classList.add("btn-primary");
    } else {
        btnLanjutkan.textContent = "Lanjutkan";
        btnLanjutkan.classList.add("btn-continue");
        btnLanjutkan.classList.remove("btn-primary");
    }

    // Sembunyikan tombol Kembali di step pertama
    btnKembali.style.display = currentStep === 1 ? "none" : "block";
}

function updateStepIndicator(step) {
    document.querySelectorAll(".step").forEach((el, index) => {
        el.classList.remove("active", "completed");
        if (index + 1 < step) el.classList.add("completed");
        if (index + 1 === step) el.classList.add("active");
    });
}

function validateStep1() {
    // Implement validasi sederhana
    const name = document.querySelector(
        'input[placeholder="Masukkan nama lengkap"]'
    ).value;
    if (!name) {
        alert("Harap isi nama lengkap");
        return false;
    }
    return true;
}

function updateConfirmationData() {
    document.getElementById("confirm-name").textContent = `Nama: ${
        document.querySelector('input[placeholder="Masukkan nama lengkap"]')
            .value
    }`;
    document.getElementById("confirm-email").textContent = `Email: ${
        document.querySelector('input[type="email"]').value
    }`;
    document.getElementById("confirm-phone").textContent = `Telepon: ${
        document.querySelector('input[type="tel"]').value
    }`;
    document.getElementById("confirm-address").textContent = `Alamat: ${
        document.querySelector('input[placeholder="Jalan, No. Rumah, RT/RW"]')
            .value
    }`;
}

function updateShippingData() {
    const shippingMethod = document.querySelector(
        'input[name="shipping"]:checked'
    ).parentNode;
    document.getElementById("confirm-shipping").textContent = `Metode: ${
        shippingMethod.querySelector("label div:first-child").textContent
    }`;
    document.getElementById("confirm-shipping-cost").textContent = `Biaya: ${
        shippingMethod.querySelector(".shipping-price").textContent
    }`;
}

function updatePaymentData() {
    const paymentMethod = document.querySelector(
        'input[name="payment"]:checked'
    ).parentNode;
    document.getElementById(
        "confirm-payment"
    ).textContent = `Metode: ${paymentMethod
        .querySelector("label")
        .textContent.split("\n")[0]
        .trim()}`;
}

// Fungsi untuk menampilkan modal
function showCheckoutModal(e) {
    if (e) {
        e.preventDefault(); // Mencegah tindakan default link
    }
    const modal = document.getElementById("checkoutModal");
    modal.classList.add("show");
    document.body.style.overflow = "hidden"; // Mencegah scrolling pada body
}

// Fungsi untuk menutup modal
function closeCheckoutModal() {
    const modal = document.getElementById("checkoutModal");
    modal.classList.remove("show");
    document.body.style.overflow = ""; // Mengembalikan scrolling pada body
}

// Event listener untuk tombol "Beli Sekarang"
document
    .getElementById("beliSekarangBtn")
    .addEventListener("click", showCheckoutModal);

// Event listener untuk tombol close pada modal
document.getElementById("closeModal").addEventListener("click", function (e) {
    e.stopPropagation(); // Mencegah event bubbling
    closeCheckoutModal();
});

// Event listener untuk background modal (hanya menutup jika yang diklik adalah background)
document
    .getElementById("checkoutModal")
    .addEventListener("click", function (e) {
        // Hanya tutup jika yang diklik adalah modal background, bukan elemen di dalamnya
        if (e.target === this) {
            closeCheckoutModal();
        }
    });

// Mencegah event propagation dari container
document
    .querySelector(".checkout-container")
    .addEventListener("click", function (e) {
        e.stopPropagation(); // Mencegah event klik merambat ke parent (modal background)
    });

// Button untuk navigasi antar step
document.getElementById("btnLanjutkan").addEventListener("click", function (e) {
    e.preventDefault();

    if (currentStep === totalSteps) {
        // Handle konfirmasi akhir
        if (document.getElementById("agreeTerms").checked) {
            alert("Pesanan berhasil dikonfirmasi!");
            closeCheckoutModal();
        } else {
            alert("Anda harus menyetujui syarat & ketentuan");
        }
        return;
    }

    // Validasi form
    if (currentStep === 1 && !validateStep1()) return;

    // Update data konfirmasi
    if (currentStep === 1) updateConfirmationData();
    if (currentStep === 2) updateShippingData();
    if (currentStep === 3) updatePaymentData();

    // Show next step
    showStep(currentStep + 1);
});

document.getElementById("btnKembali").addEventListener("click", function (e) {
    e.preventDefault(); // Mencegah tindakan default
    e.stopPropagation(); // Mencegah event bubbling

    if (currentStep > 1) {
        showStep(currentStep - 1);
    } else {
        closeCheckoutModal();
    }
});

// Initialize on page load
updateStepNavigation();
