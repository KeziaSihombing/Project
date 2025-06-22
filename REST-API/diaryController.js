const db = require('../db');

exports.getAllDiaries = async (req, res) => {
  try {
    const [rows] = await db.query(`
      SELECT d.*, c.name AS cat_name 
      FROM diary d 
      JOIN cat c ON c.id_cat = d.id_cat 
      ORDER BY d.date DESC
    `);
    res.status(200).json(rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

exports.createDiary = async (req, res) => {
  const { title, date, content, diary_image, id_cat } = req.body;
  try {
    const sql = "INSERT INTO diary (title, date, content, diary_image, id_cat) VALUES (?, ?, ?, ?, ?)";
    await db.execute(sql, [title, date, content, diary_image, id_cat]);
    res.status(201).json({ success: true });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

exports.getDiaryById = async (req, res) => {
  try {
    const [rows] = await db.query(`
      SELECT d.*, c.name AS cat_name 
      FROM diary d 
      JOIN cat c ON c.id_cat = d.id_cat 
      WHERE d.id_diary = ?
    `, [req.params.id]);
    if (rows.length === 0) return res.status(404).json({ message: 'Not found' });
    res.status(200).json(rows[0]);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};

exports.deleteDiary = async (req, res) => {
  try {
    await db.execute("DELETE FROM diary WHERE id_diary = ?", [req.params.id]);
    res.status(200).json({ success: true });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
};
