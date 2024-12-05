const { Client, LocalAuth } = require("whatsapp-web.js");
const qrcode = require("qrcode-terminal");
const sqlite3 = require("sqlite3").verbose();

// Koneksi Database
const db = new sqlite3.Database("users.db");

// Buat tabel users jika belum ada
db.run(`CREATE TABLE IF NOT EXISTS users (
    phone_number TEXT PRIMARY KEY,
    name TEXT,
    address TEXT,
    status TEXT DEFAULT 'start'
)`);

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
  const chat = await message.getChat();
  const sender = message.from;

  // Cek status pengguna di database
  db.get(
    "SELECT * FROM users WHERE phone_number = ?",
    [sender],
    (err, user) => {
      if (err) {
        console.error(err);
        return;
      }

      if (!user || user.status === "start") {
        // Pengguna baru, minta nama
        db.run(
          "INSERT OR REPLACE INTO users (phone_number, status) VALUES (?, ?)",
          [sender, "asking_name"]
        );
        client.sendMessage(
          message.from,
          "Selamat datang! Boleh disebutkan nama Anda?"
        );
      } else {
        // Proses berdasarkan status
        switch (user.status) {
          case "asking_name":
            db.run(
              "UPDATE users SET name = ?, status = ? WHERE phone_number = ?",
              [message.body, "asking_address", sender]
            );
            client.sendMessage(
              message.from,
              "Terima kasih. Boleh sebutkan alamat Anda?"
            );
            break;

          case "asking_address":
            db.run(
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
