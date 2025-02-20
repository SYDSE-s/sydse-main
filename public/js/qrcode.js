function test() {

    const getAllIds = require("./getId.js");
    const qr = require("qrcode");
    const fs = require("fs");
    const path = require("path");

    let ids;

    // Fungsi untuk membuat direktori jika belum ada
    function createDirIfNotExists(dirPath) {
        if (!fs.existsSync(dirPath)) {
            fs.mkdirSync(dirPath);
        }
    }

    // Fungsi untuk generate QR code
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
                    dark: "#000000",
                    light: "#ffffff",
                },
                width: 400,
                margin: 4,
            });

            console.log(`QR Code berhasil dibuat dan disimpan di: ${filePath}`);
            return filePath;
        } catch (error) {
            console.error("Terjadi kesalahan:", error);
            throw error;
        }
    }

    // Fungsi utama untuk mendapatkan ID dan membuat QR Code
    async function main() {
        try {
            ids = await getAllIds({
                tableName: "products",
                idColumn: "id",
                dbConfig: {
                    host: "localhost",
                    user: "root",
                    password: "",
                    database: "pus",
                },
            });

            console.log("Data ID yang ditemukan:", ids);

            // Generate QR untuk setiap ID yang ditemukan
            for (let id of ids) {
                const url = `https://www.example.com/${id}`;
                const filename = `qr_${id}.png`;
                await generateQR(url, filename);
            }

            console.log("Semua QR Code telah dibuat.");
        } catch (error) {
            console.error("Terjadi kesalahan:", error);
        }
    }

    main();

    module.exports = { generateQR, main };
}
