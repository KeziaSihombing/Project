<?php
class Cat extends Model {

    public function getAllCats($id_user) {
        $id_user = (int)$id_user;
        $sql = "SELECT * FROM cat WHERE id_user = $id_user";
        $result = $this->query($sql);
        $cats = [];
        
        while ($row = $result->fetch_assoc()) {
            $cats[] = [
                'id_cat' => $row['id_cat'],
                'name' => $row['name'],
                'breed' => $row['breed'],
                'age' => $row['age'],
                'weight' => $row['weight'],
                'cat_img' => $row['cat_img'] ?? 'images/defaultimage.png',
                'id_user' => $row['id_user']
            ];
        }
        
        return $cats;
    }
    
    public function getCatById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM cat WHERE id_cat = $id LIMIT 1";
        $result = $this->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return [
                'id_cat' => $row['id_cat'],
                'name' => $row['name'],
                'breed' => $row['breed'],
                'age' => $row['age'],
                'weight' => $row['weight'],
                'cat_img' => $row['cat_img'] ?? 'images/defaultimage.png',
                'id_user' => $row['id_user']
            ];
        }
        
        return null;
    }
    
    public function addCat($data) {
        $name = $this->escape($data['name']);
        $breed = $this->escape($data['breed']);
        $age = (int)$data['age'];
        $weight = (float)$data['weight'];
        $cat_img = $this->escape($data['cat_img'] ?? 'images/defaultimage.png');
        $id_user = (int)$data['id_user'];
        
        $sql = "INSERT INTO cat (name, breed, age, weight, cat_img, id_user) 
                VALUES ('$name', '$breed', $age, $weight, '$cat_img', $id_user)";
        
        return $this->query($sql);
    }
    
    public function updateCat($id, $data) {
        $id = (int)$id;
        $name = $this->escape($data['name']);
        $breed = $this->escape($data['breed']);
        $age = (int)$data['age'];
        $weight = (float)$data['weight'];
        $cat_img = $this->escape($data['cat_img'] ?? 'images/defaultimage.png');
        $id_user = (int)$data['id_user'];
        
        $sql = "UPDATE cat SET 
                name = '$name', 
                breed = '$breed', 
                age = $age, 
                weight = $weight, 
                cat_img = '$cat_img', 
                id_user = $id_user 
                WHERE id_cat = $id";
        
        return $this->query($sql);
    }
    
    public function deleteCat($id) {
        $id = (int)$id;
        $sql = "DELETE FROM cat WHERE id_cat = $id";
        return $this->query($sql);
    }
    
    public function catExists($id) {
        $id = (int)$id;
        $sql = "SELECT id_cat FROM cat WHERE id_cat = $id LIMIT 1";
        $result = $this->query($sql);
        return $result->num_rows > 0;
    }
}