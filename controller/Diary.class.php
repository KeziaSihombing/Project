<?php

class Diary extends Controller {
    function list() {
        session_start();
        $model = $this->loadModel('DiaryModel');
        $data = $model->getByUser($_SESSION['id_user']); 
        $this->loadView('list-diary.php', ['diaries' => $data]);
    }

    function form() {
        session_start();
        $catModel = $this->loadModel('Cat');
        $cats = $catModel->getAllCats($_SESSION['id_user']);
        $this->loadView('form-diary.php', ['cats' => $cats]);
    }

    function save() {
        $model = $this->loadModel('DiaryModel');
        $model->insert($_POST, $_FILES);
        header("Location: index.php?c=Diary&m=list");
    }

    function read() {
        $id = $_GET['id'] ?? 0;
        $model = $this->loadModel('DiaryModel');
        $diary = $model->getById($id);
        $this->loadView('read-diary.php', ['diary' => $diary]);
    }

    function delete() {
        $id = $_GET['id'];
        $model = $this->loadModel('DiaryModel');
        $model->delete($id);
        header("Location: index.php?c=Diary&m=list");
    }
}
