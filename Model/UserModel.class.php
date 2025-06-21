<?php
class UserModel extends Model {
    function getUserByUsername($username) {
        $sql = "SELECT * FROM users WHERE name = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
