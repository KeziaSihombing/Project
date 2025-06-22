const express = require('express');
const router = express.Router();
const diaryController = require('../controllers/diaryController');

router.get('/', diaryController.getAllDiaries);
router.post('/', diaryController.createDiary);
router.get('/:id', diaryController.getDiaryById);
router.delete('/:id', diaryController.deleteDiary);

module.exports = router;
