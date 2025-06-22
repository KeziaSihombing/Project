<?php

class DiaryModel extends Model {

    function insert($data, $file) {
        $title = $data['title'];
        $date = $data['date'];
        $content = $data['content'];
        $id_cat = $data['id_cat'];

        $img_name = $file['diary_image']['name'];
        $tmp = $file['diary_image']['tmp_name'];
        move_uploaded_file($tmp, "uploads/$img_name");

        $sql = "INSERT INTO diary (title, date, content, diary_image, id_cat)
                VALUES ('$title', '$date', '$content', '$img_name', $id_cat)";
        return $this->db->query($sql);
    }

    function getByUser($id_user) {
        $sql = "SELECT diary.*, cat.name AS cat_name
                FROM diary 
                JOIN cat ON diary.id_cat = cat.id_cat
                WHERE cat.id_user = $id_user
                ORDER BY diary.date DESC";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function getById($id) {
        $sql = "SELECT diary.*, cat.name AS cat_name 
                FROM diary 
                JOIN cat ON diary.id_cat = cat.id_cat 
                WHERE id_diary = $id LIMIT 1";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }

    function delete($id) {
        $sql = "DELETE FROM diary WHERE id_diary = $id";
        return $this->db->query($sql);
    }
}
