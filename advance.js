// import module dan library
const { Client, LocalAuth } = require("whatsapp-web.js"); //library untuk menyambungkan wa web karo bot. client kelas utama untuk membuat bot , localAuth untuk autentikasi lokal
const mysql = require("mysql2/promise"); //library dinggo nyambungke ke mysql dengan dukungan async/await
const qrcode = require("qrcode-terminal"); //library dinggo nampilke qr code neng terminal supaya ketika discan bisa terhubung ke bot wa
const validator = require("validator"); // library dinggo mengecek data seperti email atau email
const axios = require("axios");

class WhatsAppBot {
  constructor() {
    // Konfigurasi database
    this.pool = mysql.createPool({
      host: "localhost",
      user: "root",
      password: "kijang123",
      database: "advanced_whatsapp_users",
      waitForConnections: true,
      connectionLimit: 20,
      queueLimit: 0,
    });

    // Inisialisasi WhatsApp Client
    this.client = new Client({
      authStrategy: new LocalAuth(),
      puppeteer: { headless: true }, // menjalankan browser secara tersembunyi
    });

    // Daftar status pendaftaran
    this.REGISTRATION_STAGES = {
      START: "start",
      ASKING_NAME: "asking_name",
      ASKING_EMAIL: "asking_email",
      ASKING_PHONE: "asking_phone",
      ASKING_ADDRESS: "asking_address",
      VERIFICATION: "verification",
      COMPLETE: "complete",
    };

    this.initializeDatabase();
    this.setupClientListeners();
  }

  async initializeDatabase() {
    try {
      // Buat tabel users dengan skema seng kompleks
      await this.pool.query(`
                CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    whatsapp_number VARCHAR(20) UNIQUE NOT NULL,
                    name VARCHAR(100),
                    email VARCHAR(100),
                    phone_number VARCHAR(20),
                    address TEXT,
                    verification_code VARCHAR(10),
                    is_verified BOOLEAN DEFAULT FALSE,
                    registration_status ENUM('start', 'asking_name', 'asking_email', 'asking_phone', 'asking_address', 'verification', 'complete') DEFAULT 'start',
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )
            `);

      console.log("Database sudah succes terconenct"); //saat berhasil akan tampil succes
    } catch (error) {
      console.error("Database error bos:", error); // saat gagal menyambung akan tampil seperti ini
    }
  }

  setupClientListeners() {
    this.client.on("qr", (qr) => {
      qrcode.generate(qr, { small: true }); // menampilkan qr code di terminal saat bot membutuhkan autentifikasi
    });

    this.client.on("ready", () => {
      console.log("Bot WhatsApp Siap"); //Notifikasi di terminal ketika bot siap digunakan
    });

    this.client.on("message", this.handleMessage.bind(this)); //memanggil fungsi handleMassage untuk menangani setiap pesan yang diterima
  }

  async handleMessage(message) {
    const sender = message.from;
    const messageBody = message.body.trim();

    try {
      // Ambil data user dari database
      const [users] = await this.pool.query(
        "SELECT * FROM users WHERE whatsapp_number = ?",
        [sender]
      );
      const user = users[0];

      // Logika alur registrasi
      if (
        !user ||
        user.registration_status === this.REGISTRATION_STAGES.START
      ) {
        await this.startRegistration(sender);
      } else {
        await this.processRegistrationStage(sender, messageBody, user);
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

      case this.REGISTRATION_STAGES.ASKING_EMAIL:
        await this.validateAndSaveEmail(sender, messageBody);
        break;

      case this.REGISTRATION_STAGES.ASKING_PHONE:
        await this.validateAndSavePhone(sender, messageBody);
        break;

      case this.REGISTRATION_STAGES.ASKING_ADDRESS:
        await this.validateAndSaveAddress(sender, messageBody);
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
      [name, this.REGISTRATION_STAGES.ASKING_EMAIL, sender]
    );
    this.client.sendMessage(
      sender,
      "Terima kasih. Sekarang, mohon masukkan email Anda."
    );
  }

  async validateAndSaveEmail(sender, email) {
    if (!validator.isEmail(email)) {
      this.client.sendMessage(
        sender,
        "Email tidak valid. Mohon masukkan email yang benar."
      );
      return;
    }

    await this.pool.query(
      "UPDATE users SET email = ?, registration_status = ? WHERE whatsapp_number = ?",
      [email, this.REGISTRATION_STAGES.ASKING_PHONE, sender]
    );
    this.client.sendMessage(
      sender,
      "Email tersimpan. Mohon masukkan nomor telepon Anda."
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
      [cleanedPhone, this.REGISTRATION_STAGES.ASKING_ADDRESS, sender]
    );
    this.client.sendMessage(
      sender,
      "Nomor telepon tersimpan. Mohon masukkan alamat lengkap Anda."
    );
  }

  async validateAndSaveAddress(sender, address) {
    if (address.length < 10) {
      this.client.sendMessage(
        sender,
        "Alamat terlalu singkat. Mohon masukkan alamat lengkap."
      );
      return;
    }

    // Generate kode verifikasi
    const verificationCode = Math.floor(
      100000 + Math.random() * 900000
    ).toString();

    await this.pool.query(
      "UPDATE users SET address = ?, verification_code = ?, registration_status = ? WHERE whatsapp_number = ?",
      [address, verificationCode, this.REGISTRATION_STAGES.VERIFICATION, sender]
    );

    this.client.sendMessage(
      sender,
      `Alamat tersimpan. Kode verifikasi Anda adalah: ${verificationCode}. Silakan masukkan kode ini untuk menyelesaikan pendaftaran.`
    );
  }

  async verifyCode(sender, inputCode) {
    const [users] = await this.pool.query(
      "SELECT * FROM users WHERE whatsapp_number = ? AND verification_code = ?",
      [sender, inputCode]
    );

    if (users.length > 0) {
      await this.pool.query(
        "UPDATE users SET is_verified = ?, registration_status = ?, verification_code = NULL WHERE whatsapp_number = ?",
        [true, this.REGISTRATION_STAGES.COMPLETE, sender]
      );

      // Kirim notifikasi ke admin (bisa diganti dengan email/SMS)
      await this.notifyAdminNewUser(users[0]);

      this.client.sendMessage(
        sender,
        "Selamat! Pendaftaran Anda berhasil dan terverifikasi."
      );
    } else {
      this.client.sendMessage(
        sender,
        "Kode verifikasi salah. Silakan coba lagi."
      );
    }
  }
  async notifyAdminNewUser(user) {
    // Contoh notifikasi (bisa diganti dengan metode lain)
    console.log("Pengguna Baru:", user);

    // Opsional: Kirim email/SMS ke admin
    try {
      await axios.post("https://your-notification-service.com/notify", {
        type: "new_user",
        userData: user,
      });
    } catch (error) {
      console.error("Gagal mengirim notifikasi:", error);
    }
  }

  initialize() {
    this.client.initialize();
  }
}

// Jalankan bot
const bot = new WhatsAppBot();
bot.initialize();
