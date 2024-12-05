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
    // Konfigurasi database
    this.pool = mysql.createPool({
      host: "localhost",
      user: "root",
      password: "kijang123",
      database: "data",
      waitForConnections: true,
      connectionLimit: 10,
      queueLimit: 0,
    });

    // Inisialisasi WhatsApp Client
    this.client = new Client({
      authStrategy: new LocalAuth(),
      puppeteer: { headless: true },
    });

    // Daftar status pendaftaran
    this.REGISTRATION_STAGES = {
      START: "start",
      ASKING_NAME: "asking_name",
      ASKING_BUSSINESNAME: "asking_bussinesname",
      ASKING_PHONE: "asking_phone",
      ASKING_CATEGORY: "asking_category",
      VERIFICATION: "verification",
      COMPLETE: "complete",
    };

    // Direktori untuk menyimpan QR Code
    this.qrCodeDir = path.join(__dirname, "user_qrcodes");
    if (!fs.existsSync(this.qrCodeDir)) {
      fs.mkdirSync(this.qrCodeDir);
    }

    this.initializeDatabase();
    this.setupClientListeners();
  }

  async initializeDatabase() {
    try {
      // Buat tabel users dengan skema lengkap
      await this.pool.query(`
                CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    whatsapp_number VARCHAR(20) UNIQUE NOT NULL,
                    name VARCHAR(100),
                    bussines_name VARCHAR(100),
                    phone_number VARCHAR(20),
                    category VARCHAR(20),
                    verification_code VARCHAR(10),
                    is_verified BOOLEAN DEFAULT FALSE,
                    qr_code_path VARCHAR(255),
                    registration_status ENUM('start', 'asking_name', 'asking_bussinesname', 'asking_phone','verification', 'complete') DEFAULT 'start',
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

    this.client.on("message", this.handleMessage.bind(this));
  }

  async handleMessage(message) {
    const sender = message.from;
    const messageBody = message.body.trim().toLowerCase();

    try {
      // Ambil data user dari database
      const [users] = await this.pool.query(
        "SELECT * FROM users WHERE whatsapp_number = ?",
        [sender]
      );
      const user = users[0];

      // Perintah khusus
      if (messageBody === "qr" && user && user.is_verified) {
        await this.resendUserQRCode(sender);
        return;
      }

      // Logika alur registrasi
      if (
        !user ||
        user.registration_status === this.REGISTRATION_STAGES.START
      ) {
        await this.startRegistration(sender);
      } else {
        await this.processRegistrationStage(sender, message.body, user);
      }
    } catch (error) {
      console.error("Kesalahan:", error);
      this.client.sendMessage(sender, "Terjadi kesalahan. Silakan coba lagi.");
    }
  }

  async startRegistration(sender) {
    await this.pool.query(
      "INSERT INTO users (whatsapp_number, registration_status) VALUES (?, ?) ON DUPLICATE KEY UPDATE registration_status = ?",
      [
        sender,
        this.REGISTRATION_STAGES.ASKING_NAME,
        this.REGISTRATION_STAGES.ASKING_NAME,
      ]
    );
    this.client.sendMessage(
      sender,
      "Selamat datang! Boleh disebutkan nama Anda?"
    );
  }

  async processRegistrationStage(sender, messageBody, user) {
    switch (user.registration_status) {
      case this.REGISTRATION_STAGES.ASKING_NAME:
        await this.validateAndSaveName(sender, messageBody);
        break;

      case this.REGISTRATION_STAGES.ASKING_BUSSINESNAME:
        await this.validateAndSaveBussinesName(sender, messageBody);
        break;

      case this.REGISTRATION_STAGES.ASKING_PHONE:
        await this.validateAndSavePhone(sender, messageBody);
        break;

      case this.REGISTRATION_STAGES.ASKING_CATEGORY:
        await this.validateAndSaveCategory(sender, messageBody);
        break;

      case this.REGISTRATION_STAGES.VERIFICATION:
        await this.verifyCode(sender, messageBody);
        break;
    }
  }

  async validateAndSaveName(sender, name) {
    if (name.length < 2) {
      this.client.sendMessage(
        sender,
        "Nama terlalu pendek. Mohon masukkan nama lengkap."
      );
      return;
    }

    await this.pool.query(
      "UPDATE users SET name = ?, registration_status = ? WHERE whatsapp_number = ?",
      [name, this.REGISTRATION_STAGES.ASKING_BUSSINESNAME, sender]
    );
    this.client.sendMessage(
      sender,
      "Terima kasih. Sekarang, mohon masukkan nama Bisnis Anda."
    );
  }

  async validateAndSaveBussinesName(sender, bussines_name) {
    if (bussines_name.length < 0) {
      this.client.sendMessage(sender, "Nama Bisnis Harus ditulis.");
      return;
    }

    await this.pool.query(
      "UPDATE users SET bussines_name = ?, registration_status = ? WHERE whatsapp_number = ?",
      [bussines_name, this.REGISTRATION_STAGES.ASKING_PHONE, sender]
    );
    this.client.sendMessage(
      sender,
      "Nama Bisnis tersimpan. Mohon masukkan nomor telepon Anda."
    );
  }

  async validateAndSavePhone(sender, phoneNumber) {
    const cleanedPhone = phoneNumber.replace(/\D/g, "");
    if (!validator.isMobilePhone(cleanedPhone, "id-ID")) {
      this.client.sendMessage(
        sender,
        "Nomor telepon tidak valid. Mohon masukkan nomor telepon Indonesia yang benar."
      );
      return;
    }

    await this.pool.query(
      "UPDATE users SET phone_number = ?, registration_status = ? WHERE whatsapp_number = ?",
      [cleanedPhone, this.REGISTRATION_STAGES.ASKING_CATEGORY, sender]
    );
    this.client.sendMessage(
      sender,
      "Nomor telepon tersimpan. Mohon masukkan nama bisnis Anda."
    );
  }

  async validateAndSaveCategory(sender, category) {
    if ((category.length = 0)) {
      this.client.sendMessage(sender, "Kategori Bisnis Anda Harus diisi.");
      return;
    }

    // Generate kode verifikasi
    const verificationCode = Math.floor(
      100000 + Math.random() * 900000
    ).toString();

    await this.pool.query(
      "UPDATE users SET address = ?, verification_code = ?, registration_status = ? WHERE whatsapp_number = ?",
      [
        category,
        verificationCode,
        this.REGISTRATION_STAGES.VERIFICATION,
        sender,
      ]
    );

    this.client.sendMessage(
      sender,
      `Kategori bisnis tersimpan. Kode verifikasi Anda adalah: ${verificationCode}. Silakan masukkan kode ini untuk menyelesaikan pendaftaran.`
    );
  }

  async verifyCode(sender, inputCode) {
    const [users] = await this.pool.query(
      "SELECT * FROM users WHERE whatsapp_number = ? AND verification_code = ?",
      [sender, inputCode]
    );

    if (users.length > 0) {
      const user = users[0];

      // Generate QR Code
      const qrCodePath = await this.generateUserQRCode(user);

      // Update database dengan path QR Code
      await this.pool.query(
        "UPDATE users SET is_verified = ?, registration_status = ?, verification_code = NULL, qr_code_path = ? WHERE whatsapp_number = ?",
        [true, this.REGISTRATION_STAGES.COMPLETE, qrCodePath, sender]
      );

      // Kirim QR Code ke pengguna
      const media = MessageMedia.fromFilePath(qrCodePath);
      this.client.sendMessage(sender, media, {
        caption:
          'Selamat! Pendaftaran Anda berhasil. Ini adalah QR Code data Anda.\n\nKetik "QR" kapan saja untuk mendapatkan ulang QR Code ini.',
      });
    } else {
      this.client.sendMessage(
        sender,
        "Kode verifikasi salah. Silakan coba lagi."
      );
    }
  }

  async generateUserQRCode(user) {
    // Buat objek data yang akan dimasukkan ke QR Code
    const userData = {
      id: user.id,
      name: user.name,
      bussines_name: user.bussines_name,
      phone: user.phone_number,
      address: user.address,
      registrationDate: user.created_at,
    };

    // Konversi data ke JSON
    const userDataString = JSON.stringify(userData, null, 2);

    // Jalur penyimpanan QR Code
    const qrCodePath = path.join(this.qrCodeDir, `user_${user.id}_qrcode.png`);

    // Opsi generasi QR Code
    const qrCodeOptions = {
      errorCorrectionLevel: "H",
      type: "png",
      quality: 0.92,
      margin: 1,
      color: {
        dark: "#000000",
        light: "#FFFFFF",
      },
    };

    try {
      // Generate QR Code
      await QRCode.toFile(qrCodePath, userDataString, qrCodeOptions);
      console.log(`QR Code generated for user ${user.id}`);
      return qrCodePath;
    } catch (error) {
      console.error("Gagal membuat QR Code:", error);
      return null;
    }
  }

  async resendUserQRCode(sender) {
    const [users] = await this.pool.query(
      "SELECT * FROM users WHERE whatsapp_number = ? AND is_verified = ?",
      [sender, true]
    );

    if (users.length > 0) {
      const user = users[0];
      const qrCodePath = user.qr_code_path;

      if (qrCodePath && fs.existsSync(qrCodePath)) {
        const media = MessageMedia.fromFilePath(qrCodePath);
        this.client.sendMessage(sender, media, {
          caption: "Berikut adalah QR Code data Anda",
        });
      } else {
        // Generate ulang jika QR Code hilang
        const newQrCodePath = await this.generateUserQRCode(user);

        if (newQrCodePath) {
          // Update path QR Code baru di database
          await this.pool.query(
            "UPDATE users SET qr_code_path = ? WHERE id = ?",
            [newQrCodePath, user.id]
          );

          const media = MessageMedia.fromFilePath(newQrCodePath);
          this.client.sendMessage(sender, media, {
            caption: "QR Code Anda telah di-generate ulang",
          });
        } else {
          this.client.sendMessage(sender, "Maaf, gagal membuat ulang QR Code.");
        }
      }
    } else {
      this.client.sendMessage(sender, "Anda belum menyelesaikan verifikasi.");
    }
  }

  initialize() {
    this.client.initialize();
  }
}

// Jalankan bot
const bot = new WhatsAppBot();
bot.initialize();
