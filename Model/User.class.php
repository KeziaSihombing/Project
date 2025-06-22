<?php
class User extends Model {
     
    public function getUserById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM users WHERE id_user = $id LIMIT 1";
        $result = $this->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return [
                'id_user' => $row['id_user'],
                'name' => $row['name'],
                'bio' => $row['bio'],
                'profile_img' => $row['profile_img'] ?? 'img/defaultimage.png'
            ];
        }
        
        return null;
    }
     
    public function getDefaultUser() {
        $sql = "SELECT * FROM users ORDER BY id_user ASC LIMIT 1";
        $result = $this->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return [
                'id_user' => $row['id_user'],
                'name' => $row['name'],
                'bio' => $row['bio'],
                'profile_img' => $row['profile_img'] ?? 'img/defaultimage.png'
            ];
        }
         
        return [
            'id_user' => 1,
            'name' => 'Rheza Agung Luckianto',
            'bio' => 'Mahasiswa Sistem Informasi Universitas Brawijaya Pecinta Kucing Malang Raya',
            'profile_img' => 'img/defaultimage.png'
        ];
    }
     
    public function updateUser($id, $data) {
        $id = (int)$id;
        $name = $this->escape($data['name']);
        $bio = $this->escape($data['bio']);
        $profile_img = $this->escape($data['profile_img'] ?? 'img/defaultimage.png');
        
        $sql = "UPDATE users SET name = '$name', bio = '$bio', profile_img = '$profile_img' WHERE id_user = $id";
        
        return $this->query($sql);
    }

    public function addUser($data) {
        $name = $this->escape($data['name']);
        $bio = $this->escape($data['bio']);
        $profile_img = $this->escape($data['profile_img'] ?? 'img/defaultimage.png');
        
        $sql = "INSERT INTO users (name, bio, profile_img) VALUES ('$name', '$bio', '$profile_img')";
        
        if ($this->query($sql)) {
            return $this->mysqli->insert_id;
        }
        
        return false;
    }
}