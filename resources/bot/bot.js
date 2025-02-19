require("dotenv").config();
const axios = require("axios");
const { text } = require("express");
const mysql = require("mysql2");

// Buat koneksi ke database
const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "cobakan",
});

// Hubungkan ke database
connection.connect((err) => {
  if (err) {
    console.error("Koneksi database gagal:", err);
    return;
  }
  console.log("Koneksi ke database berhasil!");

  // Query untuk mengecek jumlah data dengan status = true
  connection.query(
    "SELECT COUNT(*) AS count FROM legality WHERE status = true",
    (err, results) => {
      if (err) {
        console.error("Query error:", err);
        connection.end();
        return;
      }

      if (results.length === 0) {
        console.log("Query tidak mengembalikan data.");
        connection.end();
        return;
      }

      if (results[0].count > 0) {
        console.log("Chatbot telah menerima data.");
        sendTemplateMessage();
      } else {
        console.log("Data belum diterima oleh chatbot.");
      }

      connection.end();
    }
  );
});

const pesananBaru =
  "hai, ada pesananan nih untuk gula jawa dengan jumlah 100 buah untuk dikirimkan ke tegal mohon segera untuk mengkonfirmasinya ";

const pesananHabis = "mohon maaf pesan habis";
const pembayaran = "Kirim ke rekening BCA 1234567890";

// Fungsi untuk mengirim pesan ke WhatsApp API
async function sendTemplateMessage() {
  console.log("Mengirim pesan ke WhatsApp...");

  try {
    const response = await axios({
      url: "https://graph.facebook.com/v22.0/550123971519477/messages",
      method: "POST",
      headers: {
        Authorization: `Bearer ${process.env.WHATSAPP_TOKEN}`,
        "Content-Type": "application/json",
      },
      data: {
        messaging_product: "whatsapp",
        to: "6285741148380",
        type: "text",
        text: {
          body: pesananHabis,
        },
      },    
    });

    console.log("Pesan berhasil dikirim:", response.data);
  } catch (error) {
    console.error(
      "Gagal mengirim pesan:",
      error.response ? error.response.data : error.message
    );
  }
}
