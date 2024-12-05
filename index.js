const mysql = require("mysql2");
const { Client, LocalAuth } = require("whatsapp-web.js");
const qrcode = require("qrcode-terminal");

// Konfigurasi MySQL
const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "kijang123",
  database: "whatsapp_users",
});

// Koneksi database
connection.connect((err) => {
  if (err) {
    console.error("Error koneksi: " + err.stack);
    return;
  }
  console.log("Terhubung ke database");

  // Buat tabel users jika belum ada
  const createTableQuery = `
    CREATE TABLE IF NOT EXISTS users (
        phone_number VARCHAR(20) PRIMARY KEY,
        name VARCHAR(100),
        address TEXT,
        status ENUM('start', 'asking_name', 'asking_address', 'complete') DEFAULT 'start'
    )`;

  connection.query(createTableQuery, (err) => {
    if (err) throw err;
  });
});

// Inisialisasi WhatsApp Client
const client = new Client({
  authStrategy: new LocalAuth(),
  puppeteer: { headless: true },
});

// Generate QR Code
client.on("qr", (qr) => {
  qrcode.generate(qr, { small: true });
});

client.on("ready", () => {
  console.log("WhatsApp Bot Siap");
});

client.on("message", async (message) => {
  const sender = message.from;

  // Query untuk cek status pengguna
  connection.query(
    "SELECT * FROM users WHERE phone_number = ?",
    [sender],
    (err, results) => {
      if (err) {
        console.error(err);
        return;
      }

      const user = results[0];

      if (!user || user.status === "start") {
        // Pengguna baru, minta nama
        connection.query(
          "INSERT INTO users (phone_number, status) VALUES (?, ?) ON DUPLICATE KEY UPDATE status = ?",
          [sender, "asking_name", "asking_name"]
        );
        client.sendMessage(
          message.from,
          "Selamat datang! Boleh disebutkan nama Anda?"
        );
      } else {
        // Proses berdasarkan status
        switch (user.status) {
          case "asking_name":
            connection.query(
              "UPDATE users SET name = ?, status = ? WHERE phone_number = ?",
              [message.body, "asking_address", sender]
            );
            client.sendMessage(
              message.from,
              "Terima kasih. Boleh sebutkan alamat Anda?"
            );
            break;

          case "asking_address":
            connection.query(
              "UPDATE users SET address = ?, status = ? WHERE phone_number = ?",
              [message.body, "complete", sender]
            );
            client.sendMessage(
              message.from,
              "Data Anda sudah tersimpan. Terima kasih!"
            );
            break;

          case "complete":
            client.sendMessage(message.from, "Data Anda sudah lengkap.");
            break;
        }
      }
    }
  );
});

client.initialize();
