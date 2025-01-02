const { Client, LocalAuth, MessageMedia } = require("whatsapp-web.js");
const mysql = require("mysql2/promise");
const qrcode = require("qrcode-terminal");
const validator = require("validator");
const axios = require("axios");
const QRCode = require("qrcode");
const fs = require("fs");
const path = require("path");

class WhatsAppBot {
    constructor() {
        this.pool = mysql.createPool({
            host: "localhost",
            user: "root",
            password: "",
            database: "",
            waitForConnections: true,
            connectionLimit: 10,
            queueLimit: 0,
        });

        this.client = new Client({
            authStrategy: new LocalAuth(),
            puppeteer: { headless: true },
        });

        // Expanded registration stages
        this.REGISTRATION_STAGES = {
            START: "start",
            // Business Profile
            ASKING_BUSINESS_NAME: "asking_business_name",
            ASKING_BUSINESS_CATEGORY: "asking_business_category",
            ASKING_BUSINESS_DURATION: "asking_business_duration",
            ASKING_OWNER_NAME: "asking_owner_name",
            ASKING_EMAIL: "asking_email",
            ASKING_PHONE: "asking_phone",
            // Business Location
            ASKING_PROVINCE: "asking_province",
            ASKING_CITY: "asking_city",
            ASKING_SUB_DISTRICT: "asking_sub_district",
            ASKING_VILLAGE: "asking_village",
            // Documentation
            ASKING_ID_CARD_NUMBER: "asking_id_card_number",
            ASKING_ID_CARD_PHOTO: "asking_id_card_photo",
            ASKING_ID_CARD_SELFIE: "asking_id_card_selfie",
            ASKING_PRODUCT_PHOTO: "asking_product_photo",
            // Bank Account
            ASKING_BANK_NAME: "asking_bank_name",
            ASKING_BANK_ACCOUNT_NUMBER: "asking_bank_account_number",
            ASKING_BANK_HOLDERS_NAME: "asking_bank_holders_name",
            // Business Cluster
            ASKING_LEGALITY: "asking_legality",
            ASKING_NIB_LICENSE: "asking_nib_license",
            ASKING_HALAL_LICENSE: "asking_halal_license",
            ASKING_PIRT_LICENSE: "asking_pirt_license",
            ASKING_BPOM_LICENSE: "asking_bpom_license",
            ASKING_HKI_LICENSE: "asking_hki_license",
            ASKING_NUTRITION_TEST_LICENSE: "asking_nutrition_test_license",
            ASKING_HACCP_LICENSE: "asking_haccp_license",
            VERIFICATION: "verification",
            COMPLETE: "complete",
        };

        // Registration questions
        this.REGISTRATION_QUESTIONS = {
            [this.REGISTRATION_STAGES.ASKING_BUSINESS_NAME]:
                "Selamat datang di Register UMKM   Mohon masukkan nama bisnis Anda:",
            [this.REGISTRATION_STAGES.ASKING_BUSINESS_CATEGORY]:
                "Pilih kategori bisnis Anda:\n1. Kuliner Kering\n2. Kuliner Basah\n3. Fashion\n4. Jasa\n5. Craft\n6. Drink\n7. Beauty\n8. Furniture",
            [this.REGISTRATION_STAGES.ASKING_BUSINESS_DURATION]:
                "Sudah berapa lama bisnis Anda berjalan? (dalam tahun)",
            [this.REGISTRATION_STAGES.ASKING_OWNER_NAME]:
                "Mohon masukkan nama pemilik bisnis:",
            [this.REGISTRATION_STAGES.ASKING_EMAIL]:
                "Mohon masukkan alamat email bisnis:",
            [this.REGISTRATION_STAGES.ASKING_PHONE]:
                "Mohon masukkan nomor telepon bisnis:",
            [this.REGISTRATION_STAGES.ASKING_PROVINCE]:
                "Masukkan provinsi lokasi bisnis:",
            [this.REGISTRATION_STAGES.ASKING_CITY]:
                "Masukkan kota/kabupaten lokasi bisnis:",
            [this.REGISTRATION_STAGES.ASKING_SUB_DISTRICT]:
                "Masukkan kecamatan lokasi bisnis:",
            [this.REGISTRATION_STAGES.ASKING_VILLAGE]:
                "Masukkan kelurahan/desa lokasi bisnis:",
            [this.REGISTRATION_STAGES.ASKING_ID_CARD_NUMBER]:
                "Masukkan nomor KTP pemilik bisnis:",
            [this.REGISTRATION_STAGES.ASKING_ID_CARD_PHOTO]:
                "Mohon kirimkan foto KTP (kirim sebagai gambar):",
            [this.REGISTRATION_STAGES.ASKING_ID_CARD_SELFIE]:
                "Mohon kirimkan foto selfie dengan KTP (kirim sebagai gambar):",
            [this.REGISTRATION_STAGES.ASKING_PRODUCT_PHOTO]:
                "Mohon kirimkan foto produk bisnis Anda (kirim sebagai gambar):",
            [this.REGISTRATION_STAGES.ASKING_BANK_NAME]: "Masukkan nama bank:",
            [this.REGISTRATION_STAGES.ASKING_BANK_ACCOUNT_NUMBER]:
                "Masukkan nomor rekening bank:",
            [this.REGISTRATION_STAGES.ASKING_BANK_HOLDERS_NAME]:
                "Masukkan nama pemegang rekening bank:",
            [this.REGISTRATION_STAGES.ASKING_LEGALITY]:
                "Apakah bisnis Anda memiliki legalitas? (Ya/Tidak)",
            [this.REGISTRATION_STAGES.ASKING_NIB_LICENSE]:
                "Masukkan nomor NIB (jika ada, ketik - jika tidak ada):",
            [this.REGISTRATION_STAGES.ASKING_HALAL_LICENSE]:
                "Masukkan nomor sertifikat Halal (jika ada, ketik - jika tidak ada):",
            [this.REGISTRATION_STAGES.ASKING_PIRT_LICENSE]:
                "Masukkan nomor PIRT (jika ada, ketik - jika tidak ada):",
            [this.REGISTRATION_STAGES.ASKING_BPOM_LICENSE]:
                "Masukkan nomor BPOM (jika ada, ketik - jika tidak ada):",
            [this.REGISTRATION_STAGES.ASKING_HKI_LICENSE]:
                "Masukkan nomor HKI (jika ada, ketik - jika tidak ada):",
            [this.REGISTRATION_STAGES.ASKING_NUTRITION_TEST_LICENSE]:
                "Masukkan nomor uji nutrisi (jika ada, ketik - jika tidak ada):",
            [this.REGISTRATION_STAGES.ASKING_HACCP_LICENSE]:
                "Masukkan nomor HACCP (jika ada, ketik - jika tidak ada):",
            [this.REGISTRATION_STAGES.VERIFICATION]:
                "Untuk menyelesaikan pendaftaran, silakan masukkan kode verifikasi 8 digit yang telah dikirimkan:",
        };

        this.BUSINESS_CATEGORIES = [
            "kuliner kering",
            "kuliner basah",
            "fashion",
            "jasa",
            "craft",
            "drink",
            "beauty",
            "furniture",
        ];

        this.qrCodeDir = path.join(__dirname, "user_qrcodes");
        if (!fs.existsSync(this.qrCodeDir)) {
            fs.mkdirSync(this.qrCodeDir);
        }

        this.mediaDir = path.join(__dirname, "media");
        if (!fs.existsSync(this.mediaDir)) {
            fs.mkdirSync(this.mediaDir);
        }

        this.initializeDatabase();
        this.setupClientListeners();
    }

    async initializeDatabase() {
        try {
            await this.pool.query(`
        CREATE TABLE IF NOT EXISTS users (
          id INT AUTO_INCREMENT PRIMARY KEY,
          whatsapp_number VARCHAR(20) UNIQUE NOT NULL,

          -- Business Profile
          business_name VARCHAR(100),
          business_category ENUM('kuliner kering', 'kuliner basah', 'fashion', 'jasa', 'craft', 'drink', 'beauty', 'furniture'),
          business_duration VARCHAR(50),
          owner_name VARCHAR(100),
          email VARCHAR(100),
          phone_number VARCHAR(20),

          -- Business Location
          province VARCHAR(100),
          city VARCHAR(100),
          sub_district VARCHAR(100),
          village VARCHAR(100),

          -- Documentation
          id_card_number VARCHAR(20),
          id_card_photo VARCHAR(255),
          id_card_selfie VARCHAR(255),
          product_photo VARCHAR(255),

          -- Bank Account
          bank_name VARCHAR(50),
          bank_account_number VARCHAR(50),
          bank_holders_name VARCHAR(100),

          -- Business Cluster
          legality BOOLEAN DEFAULT false,
          nib_license VARCHAR(100),
          halal_license VARCHAR(100),
          pirt_license VARCHAR(100),
          bpom_license VARCHAR(100),
          hki_license VARCHAR(100),
          nutrition_test_license VARCHAR(100),
          haccp_license VARCHAR(100),

          role ENUM('admin', 'user') DEFAULT 'user',
          request_activation BOOLEAN DEFAULT false,
          request_verification BOOLEAN DEFAULT false,

          verification VARCHAR(10),
          is_verified BOOLEAN DEFAULT FALSE,
          qr_code_path VARCHAR(255),
          registration_status ENUM(
            'start', 'asking_business_name', 'asking_business_category',
            'asking_business_duration', 'asking_owner_name', 'asking_email',
            'asking_phone', 'asking_province', 'asking_city',
            'asking_sub_district', 'asking_village', 'asking_id_card_number',
            'asking_id_card_photo', 'asking_id_card_selfie', 'asking_product_photo',
            'asking_bank_name', 'asking_bank_account_number', 'asking_bank_holders_name',
            'asking_legality', 'asking_nib_license', 'asking_halal_license',
            'asking_pirt_license', 'asking_bpom_license', 'asking_hki_license',
            'asking_nutrition_test_license', 'asking_haccp_license',
            'verification', 'complete'
          ) DEFAULT 'start',
          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
          updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
      `);
            console.log("Database initialized successfully");
        } catch (error) {
            console.error("Database initialization error:", error);
        }
    }

    setupClientListeners() {
        this.client.on("qr", (qr) => {
            qrcode.generate(qr, { small: true });
        });

        this.client.on("ready", () => {
            console.log("Bot WhatsApp Siap");
        });

        this.client.on("message", async (message) => {
            try {
                await this.handleMessage(message);
            } catch (error) {
                console.error("Error handling message:", error);
            }
        });
    }

    async handleMessage(message) {
        const sender = message.from;
        const messageBody = message.body.trim();

        try {
            const [users] = await this.pool.query(
                "SELECT * FROM users WHERE whatsapp_number = ?",
                [sender]
            );
            const user = users[0];

            if (
                messageBody.toLowerCase() === "qr" &&
                user &&
                user.is_verified
            ) {
                await this.resendUserQRCode(sender);
                return;
            }

            if (
                !user ||
                user.registration_status === this.REGISTRATION_STAGES.START
            ) {
                await this.startRegistration(sender);
            } else {
                if (
                    message.hasMedia &&
                    this.isPhotoUploadStage(user.registration_status)
                ) {
                    await this.handlePhotoUpload(message, sender, user);
                } else {
                    await this.processRegistrationStage(
                        sender,
                        messageBody,
                        user
                    );
                }
            }
        } catch (error) {
            console.error("Kesalahan:", error);
            this.client.sendMessage(
                sender,
                "Terjadi kesalahan. Silakan coba lagi."
            );
        }
    }

    isPhotoUploadStage(stage) {
        return [
            this.REGISTRATION_STAGES.ASKING_ID_CARD_PHOTO,
            this.REGISTRATION_STAGES.ASKING_ID_CARD_SELFIE,
            this.REGISTRATION_STAGES.ASKING_PRODUCT_PHOTO,
        ].includes(stage);
    }

    async handlePhotoUpload(message, sender, user) {
        try {
            const media = await message.downloadMedia();
            if (!media || !media.mimetype.startsWith("image/")) {
                this.client.sendMessage(
                    sender,
                    "Mohon kirim file dalam bentuk gambar/foto."
                );
                return;
            }

            const fileName = `${user.whatsapp_number}_${
                user.registration_status
            }_${Date.now()}.${media.mimetype.split("/")[1]}`;
            const filePath = path.join(this.mediaDir, fileName);

            fs.writeFileSync(filePath, media.data, "base64");

            const nextStage = this.getNextStage(user.registration_status);
            const updateField = user.registration_status.replace("asking_", "");

            await this.pool.query(
                `UPDATE users SET ${updateField} = ?, registration_status = ? WHERE whatsapp_number = ?`,
                [fileName, nextStage, sender]
            );

            if (nextStage !== this.REGISTRATION_STAGES.COMPLETE) {
                this.client.sendMessage(
                    sender,
                    this.REGISTRATION_QUESTIONS[nextStage]
                );
            }
        } catch (error) {
            console.error("Error handling photo upload:", error);
            this.client.sendMessage(
                sender,
                "Terjadi kesalahan saat mengupload foto. Silakan coba lagi."
            );
        }
    }

    async startRegistration(sender) {
        await this.pool.query(
            "INSERT INTO users (whatsapp_number, registration_status) VALUES (?, ?) ON DUPLICATE KEY UPDATE registration_status = ?",
            [
                sender,
                this.REGISTRATION_STAGES.ASKING_BUSINESS_NAME,
                this.REGISTRATION_STAGES.ASKING_BUSINESS_NAME,
            ]
        );
        this.client.sendMessage(
            sender,
            this.REGISTRATION_QUESTIONS[
                this.REGISTRATION_STAGES.ASKING_BUSINESS_NAME
            ]
        );
    }
    generateVerificationCode() {
        return Math.floor(10000000 + Math.random() * 90000000).toString();
    }

    async processRegistrationStage(sender, messageBody, user) {
        const nextStage = this.getNextStage(user.registration_status);
        let isValid = true;
        let value = messageBody;
        let updateQuery = "";

        switch (user.registration_status) {
            case this.REGISTRATION_STAGES.ASKING_BUSINESS_NAME:
                isValid = messageBody.length >= 2;
                updateQuery = "business_name";
                break;

            case this.REGISTRATION_STAGES.ASKING_BUSINESS_CATEGORY:
                const category = this.parseBusinessCategory(messageBody);
                isValid = category !== null;
                value = category;
                updateQuery = "business_category";
                break;

            case this.REGISTRATION_STAGES.ASKING_EMAIL:
                isValid = validator.isEmail(messageBody);
                updateQuery = "email";
                break;

            case this.REGISTRATION_STAGES.ASKING_PHONE:
                const cleanedPhone = messageBody.replace(/\D/g, "");
                isValid =
                    cleanedPhone.length >= 10 && cleanedPhone.length <= 15;
                value = cleanedPhone;
                updateQuery = "phone_number";
                break;

            case this.REGISTRATION_STAGES.ASKING_LEGALITY:
                isValid = ["ya", "tidak"].includes(messageBody.toLowerCase());
                value = messageBody.toLowerCase() === "ya";
                updateQuery = "legality";
                break;

            default:
                updateQuery = user.registration_status.replace("asking_", "");
                break;
        }
        if (
            user.registration_status ===
            this.REGISTRATION_STAGES.ASKING_HACCP_LICENSE
        ) {
            try {
                // Update HACCP license
                await this.pool.query(
                    `UPDATE users SET haccp_license = ? WHERE whatsapp_number = ?`,
                    [value, sender]
                );

                // Generate dan simpan kode verifikasi
                const verificationCode = this.generateVerificationCode();
                await this.pool.query(
                    `UPDATE users SET verification = ?, registration_status = ? WHERE whatsapp_number = ?`,
                    [
                        verificationCode,
                        this.REGISTRATION_STAGES.VERIFICATION,
                        sender,
                    ]
                );

                // Kirim kode verifikasi
                await this.client.sendMessage(
                    sender,
                    `Kode verifikasi Anda adalah: ${verificationCode}\n\nSilakan masukkan kode verifikasi tersebut untuk menyelesaikan pendaftaran.`
                );
                return;
            } catch (error) {
                console.error("Error in HACCP processing:", error);
                this.client.sendMessage(
                    sender,
                    "Terjadi kesalahan saat memproses data. Silakan coba lagi."
                );
                return;
            }
        }

        if (!isValid) {
            this.client.sendMessage(
                sender,
                "Input tidak valid. Mohon coba lagi."
            );
            return;
        }

        try {
            await this.pool.query(
                `UPDATE users SET ${updateQuery} = ?, registration_status = ? WHERE whatsapp_number = ?`,
                [value, nextStage, sender]
            );

            if (nextStage !== this.REGISTRATION_STAGES.COMPLETE) {
                this.client.sendMessage(
                    sender,
                    this.REGISTRATION_QUESTIONS[nextStage]
                );
            } else {
                this.client.sendMessage(
                    sender,
                    "Pendaftaran selesai. Data Anda telah disimpan."
                );
                await this.generateQRCodeForUser(sender);
            }
        } catch (error) {
            console.error("Error processing registration stage:", error);
            this.client.sendMessage(
                sender,
                "Terjadi kesalahan saat menyimpan data. Silakan coba lagi."
            );
        }
    }

    getNextStage(currentStage) {
        const stageKeys = Object.keys(this.REGISTRATION_STAGES);
        const currentIndex = stageKeys.indexOf(
            Object.keys(this.REGISTRATION_STAGES).find(
                (key) => this.REGISTRATION_STAGES[key] === currentStage
            )
        );
        return this.REGISTRATION_STAGES[stageKeys[currentIndex + 1]];
    }

    parseBusinessCategory(input) {
        const index = parseInt(input) - 1;
        return this.BUSINESS_CATEGORIES[index] || null;
    }

    async generateQRCodeForUser(sender) {
        try {
            const [users] = await this.pool.query(
                "SELECT * FROM users WHERE whatsapp_number = ?",
                [sender]
            );
            const user = users[0];

            if (!user) {
                this.client.sendMessage(
                    sender,
                    "Data pengguna tidak ditemukan."
                );
                return;
            }

            const qrData = {
                business_name: user.business_name,
                owner_name: user.owner_name,
                phone_number: user.phone_number,
                email: user.email,
            };

            const qrPath = path.join(
                this.qrCodeDir,
                `${user.whatsapp_number}_qr.png`
            );
            await QRCode.toFile(qrPath, JSON.stringify(qrData), { width: 300 });

            await this.pool.query(
                "UPDATE users SET qr_code_path = ? WHERE whatsapp_number = ?",
                [qrPath, sender]
            );

            const media = MessageMedia.fromFilePath(qrPath);
            this.client.sendMessage(sender, media);
            this.client.sendMessage(sender, "Berikut adalah QR Code Anda.");
        } catch (error) {
            console.error("Error generating QR code:", error);
            this.client.sendMessage(
                sender,
                "Terjadi kesalahan saat membuat QR Code. Silakan coba lagi."
            );
        }
    }

    async resendUserQRCode(sender) {
        try {
            const [users] = await this.pool.query(
                "SELECT * FROM users WHERE whatsapp_number = ?",
                [sender]
            );
            const user = users[0];

            if (!user || !user.qr_code_path) {
                this.client.sendMessage(
                    sender,
                    "QR Code belum tersedia untuk akun Anda."
                );
                return;
            }

            const media = MessageMedia.fromFilePath(user.qr_code_path);
            this.client.sendMessage(sender, media);
            this.client.sendMessage(sender, "Berikut adalah QR Code Anda.");
        } catch (error) {
            console.error("Error resending QR code:", error);
            this.client.sendMessage(
                sender,
                "Terjadi kesalahan saat mengirim ulang QR Code. Silakan coba lagi."
            );
        }
    }
}

const bot = new WhatsAppBot();
bot.client.initialize();
