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
            password: 'rahasia',
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

const getAllDiaries = async(req, res) => {    
    try{
        const token = req.body.token;
        const decoded = jwt.verify(token, 'catcarepass');
        const userId = decoded.id;

        const db = await mysql.createConnection({
            host: 'localhost',
            user: 'root',
            password: 'rahasia',
            database: 'catcare'
        });
        const sql = "SELECT diary.date, cat.name, cat.cat_img FROM diary INNER JOIN cat ON diary.id_cat = cat.id_cat where cat.id_user = ?";
        const [rows] = await db.execute(sql, [userId]);
        db.end();

        if(rows.length==0){
            return res.status(401).json({message: 'User Have Not Make any Diary Yet'});
        }
        res.status(200).json({rows});
        
    }catch(error){
        res.status(409).json({error});
    }
} 
router.get('/getAllDiaries', getAllDiaries);


app.use('/', router);

app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
})
