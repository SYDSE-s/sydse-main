const mysql = require("mysql2/promise");

/**
 * @param {string} tableName
 * @param {string} idColumn
 * @param {Object} dbConfig
 * @returns {Promise<Array<number>>}
 */
async function getAllIds({
  tableName,
  idColumn = "id",
  dbConfig = {
    host: "localhost",
    user: "root",
    password: "",
    database: "cobakan",
  },
}) {
  let connection;
  try {
    connection = await mysql.createConnection(dbConfig);

    const [rows] = await connection.execute(
      `SELECT ${idColumn} FROM ${tableName}`
    );

    const ids = rows.map((row) => row[idColumn]);

    return ids;
  } catch (error) {
    console.error("Error saat mengambil ID:", error);
    throw error;
  } finally {
    if (connection) {
      await connection.end();
    }
  }
}

module.exports = getAllIds;
