const express = require('express');
const cors = require('cors');
const mysql = require('mysql2/promise');
const jwt = require('jsonwebtoken');

const app = express();
const port = 8000;

const router = express.Router();
app.use(express.json());
app.use(cors());

const getUserByUsername = async(req, res) => {
    const {username} = req.body;
    try{
        const db = await mysql.createConnection({
            host: 'localhost',
            user: 'root',
            password: '',
            database: 'catcare'
        });
        const sql = 'SELECT * FROM users WHERE name = ?';
        const [rows] = await db.execute(sql, [username]);
        const user = rows[0];
        db.end();
        
        if(rows.length==0){
            return res.status(401).json({message: 'User Not Found'});
        }

        const token = jwt.sign(
            {id: user.id_user}, //data yang seharusnya disimpan di session
            "catcarepass", //kunci rahasia
            {expiresIn: '1h'}
        );
        res.status(200).json({token});
        
    }catch(error){
        res.status(409).json({error});
    }
}
router.post('/login', getUserByUsername);

const getAllCats = async (req, res) => {
    try {
        const token = req.body.token;
        const decoded = jwt.verify(token, 'catcarepass');
        const userId = decoded.id;

        const db = await mysql.createConnection({
            host: 'localhost',
            user: 'root',
            password: '',
            database: 'catcare'
        });
        const sql = 'SELECT * FROM cat WHERE id_user = ?';
        const [rows] = await db.execute(sql, [userId]);
        db.end();

        if (rows.length === 0) {
            return res.status(401).json({ message: 'No cats found for this user' });
        }

        res.status(200).json({ rows });
    } catch (error) {
        res.status(409).json({ error });
    }
};
router.get('/getAllCats', getAllCats);

const createCat = async (req, res) => {
    const { token, name, breed, age, weight, cat_img } = req.body;
    try {
        const decoded = jwt.verify(token, 'catcarepass');
        const userId = decoded.id;

        if (!name || !breed || !age || !weight || !cat_img) {
            return res.status(400).json({ message: 'All fields are required' });
        }

        if (!/\.(jpg|png)$/i.test(cat_img)) {
            return res.status(400).json({ message: 'Image must be .jpg or .png' });
        }

        if (weight < 0 || weight > 999.99) {
            return res.status(400).json({ message: 'Weight must be between 0.00 and 999.99' });
        }

        const db = await mysql.createConnection({
            host: 'localhost',
            user: 'root',
            password: '',
            database: 'catcare'
        });

        const sql = 'INSERT INTO cat (name, breed, age, weight, cat_img, id_user) VALUES (?, ?, ?, ?, ?, ?)';
        const [result] = await db.execute(sql, [name, breed, age, weight, cat_img, userId]);
        db.end();

        res.status(201).json({ message: 'Cat added', id_cat: result.insertId });
    } catch (error) {
        res.status(409).json({ error });
    }
};
router.post('/createCat', createCat);

const updateCat = async (req, res) => {
    const { token, id_cat, name, breed, age, weight, cat_img } = req.body;
    try {
        const decoded = jwt.verify(token, 'catcarepass');
        const userId = decoded.id;

        if (!name || !breed || !age || !weight || !cat_img) {
            return res.status(400).json({ message: 'All fields are required' });
        }

        if (!/\.(jpg|png)$/i.test(cat_img)) {
            return res.status(400).json({ message: 'Image must be .jpg or .png' });
        }

        if (weight < 0 || weight > 999.99) {
            return res.status(400).json({ message: 'Weight must be between 0.00 and 999.99' });
        }

        const db = await mysql.createConnection({
            host: 'localhost',
            user: 'root',
            password: '',
            database: 'catcare'
        });

        const sql = 'UPDATE cat SET name = ?, breed = ?, age = ?, weight = ?, cat_img = ? WHERE id_cat = ? AND id_user = ?';
        const [result] = await db.execute(sql, [name, breed, age, weight, cat_img, id_cat, userId]);
        db.end();

        if (result.affectedRows === 0) {
            return res.status(401).json({ message: 'Cat not found or not owned by user' });
        }

        res.status(200).json({ message: 'Cat updated' });
    } catch (error) {
        res.status(409).json({ error });
    }
};
router.put('/editCat', updateCat);

const deleteCat = async (req, res) => {
    const { token, id_cat } = req.body;
    try {
        const decoded = jwt.verify(token, 'catcarepass');
        const userId = decoded.id;

        const db = await mysql.createConnection({
            host: 'localhost',
            user: 'root',
            password: '',
            database: 'catcare'
        });

        const sql = 'DELETE FROM cat WHERE id_cat = ? AND id_user = ?';
        const [result] = await db.execute(sql, [id_cat, userId]);
        db.end();

        if (result.affectedRows === 0) {
            return res.status(401).json({ message: 'Cat not found or not owned by user' });
        }

        res.status(200).json({ message: 'Cat deleted' });
    } catch (error) {
        res.status(409).json({ error });
    }
};
router.delete('/deleteCat', deleteCat);

app.use('/', router);

app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});
