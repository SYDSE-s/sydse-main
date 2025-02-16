const qr = require("qrcode");
const fs = require("fs");
const path = require("path");

// Fungsi untuk membuat direktori jika belum ada
function createDirIfNotExists(dirPath) {
    if (!fs.existsSync(dirPath)) {
        fs.mkdirSync(dirPath);
    }
}

// Fungi untuk generate QR code
async function generateQR(url, filename) {
    try {
        // Membuat folder 'qr' jika belum ada
        const qrDir = path.join(__dirname, "qr");
        createDirIfNotExists(qrDir);

        // Generate nama file dengan timestamp
        const timestamp = new Date().getTime();
        const finalFilename = filename || `qr_${timestamp}.png`;
        const filePath = path.join(qrDir, finalFilename);

        // Generate QR code
        await qr.toFile(filePath, url, {
            color: {
                dark: "#000000", // Warna QR code
                light: "#ffffff", // Warna background
            },
            width: 400, // Ukuran QR code
            margin: 4, // Margin QR code
        });

        console.log(`QR Code berhasil dibuat dan disimpan di: ${filePath}`);
        return filePath;
    } catch (error) {
        console.error("Terjadi kesalahan:", error);
        throw error;
    }
}

// Contol
const url = "https://www.example.com";
generateQR(url, "contoh_qr.png")
    .then((filePath) => console.log("Selesai!"))
    .catch((error) => console.error("Gagal generate QR:", error));
