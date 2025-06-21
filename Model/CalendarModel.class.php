<?php

class CalendarModel extends Model {
    function getAllDiaries(){
        session_start();
        $sql = "SELECT diary.date, cat.name, cat.cat_img FROM diary INNER JOIN cat ON diary.id_cat = cat.id_cat where cat.id_user = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $_SESSION['id_user']);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}