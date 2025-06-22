const express = require('express');
const app = express();
const userRoutes = require('./routes/userRoutes');
const catRoutes = require('./routes/catRoutes');
const diaryRoutes = require('./routes/diaryRoutes');
const cors = require('cors');

app.use(cors());
app.use(express.json());
app.use('/api/users', userRoutes);
app.use('/api/cats', catRoutes);
app.use('/api/diaries', diaryRoutes);

const PORT = 3000;
app.listen(PORT, () => {
  console.log(`API running on http://localhost:${PORT}`);
});
