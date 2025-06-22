const mysql = require('mysql2/promise');

const db = mysql.createPool({
  host: 'localhost',
  user: 'root',
  password: 'root',
  database: 'catcare' // Ganti jika database-mu bernama lain
});

module.exports = db;
