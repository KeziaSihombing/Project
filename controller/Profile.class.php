<?php
class Profile extends Controller {
    
    function index() {
        try { 
            $catModel = $this->loadModel('Cat');
            $userModel = $this->loadModel('User');
             
            $user = $userModel->getDefaultUser();
            $cats = $catModel->getAllCats($user['id_user']);
            
            $this->loadView('profil.php', [
                'cats' => $cats,
                'user' => $user
            ]);
            
        } catch (Exception $e) { 
            error_log("Error in Profile::index: " . $e->getMessage());
            $this->loadView('profil.php', [
                'cats' => [],
                'user' => null,
                'error' => 'Maaf, data tidak dapat diambil. Silakan coba lagi nanti.'
            ]);
        }
    }
    
    function addKucing() {
        $userModel = $this->loadModel('User');
        $user = $userModel->getDefaultUser();
        $this->loadView('addKucing.php', ['id_user' => $user['id_user']]);
    }
    
    function saveKucing() {
        try {
            $catModel = $this->loadModel('Cat');
            
            $data = [
                'name' => $_POST['name'] ?? '',
                'breed' => $_POST['jenis'] ?? '',
                'age' => $_POST['umur'] ?? 0,
                'weight' => $_POST['berat'] ?? 0.0,
                'cat_img' => $_POST['cat_img'] ?? 'img/defaultimage.png',
                'id_user' => $_POST['id_user'] ?? 1
            ];
            
            if (empty($data['name']) || empty($data['breed']) || $data['age'] <= 0 || $data['weight'] <= 0) {
                header('location:index.php?c=Profile&m=addKucing&error=missing');
                exit;
            }
            
            if (!empty($data['cat_img']) && !preg_match('/\.(jpg|png)$/i', $data['cat_img'])) {
                header('location:index.php?c=Profile&m=addKucing&error=invalid_image');
                exit;
            }
            
            $result = $catModel->addCat($data);
            
            if ($result) {
                header('location:index.php?c=Profile&m=index&success=add');
            } else {
                header('location:index.php?c=Profile&m=index&error=add');
            }
            
        } catch (Exception $e) {
            header('location:index.php?c=Profile&m=index&error=database');
        }
        
        exit;
    }
    
    function editKucing() {
        $id = $_GET['id'] ?? 0;
        
        try {
            $catModel = $this->loadModel('Cat');
            $userModel = $this->loadModel('User');
            $cat = $catModel->getCatById($id);
            $user = $userModel->getDefaultUser();
            
            if ($cat) {
                $this->loadView('editKucing.php', [
                    'cat' => $cat,
                    'id_user' => $user['id_user']
                ]);
            } else {
                header('location:index.php?c=Profile&m=index&error=notfound');
                exit;
            }
            
        } catch (Exception $e) { 
            error_log("Error in Profile::editKucing: " . $e->getMessage());
            header('location:index.php?c=Profile&m=index&error=database');
            exit;
        }
    }
    
    function updateKucing() {
        try {
            $catModel = $this->loadModel('Cat');
            
            $id = $_POST['id'] ?? 0;
            $data = [
                'name' => $_POST['name'] ?? '',
                'breed' => $_POST['jenis'] ?? '',
                'age' => $_POST['umur'] ?? 0,
                'weight' => $_POST['berat'] ?? 0.0,
                'cat_img' => $_POST['cat_img'] ?? 'img/defaultimage.png',
                'id_user' => $_POST['id_user'] ?? 1
            ];
            
            if (empty($data['name']) || empty($data['breed']) || $data['age'] <= 0 || $data['weight'] <= 0) {
                header('location:index.php?c=Profile&m=editKucing&id=' . $id . '&error=missing');
                exit;
            }
            
            if (!empty($data['cat_img']) && !preg_match('/\.(jpg|png)$/i', $data['cat_img'])) {
                header('location:index.php?c=Profile&m=editKucing&id=' . $id . '&error=invalid_image');
                exit;
            }
            
            $result = $catModel->updateCat($id, $data);
            
            if ($result) {
                header('location:index.php?c=Profile&m=index&success=update');
            } else {
                header('location:index.php?c=Profile&m=index&error=update');
            }
            
        } catch (Exception $e) {
            header('location:index.php?c=Profile&m=index&error=database');
        }
        
        exit;
    }
    
    function deleteKucing() {
        try {
            $catModel = $this->loadModel('Cat');
            $id = $_GET['id'] ?? 0;
            
            if ($catModel->catExists($id)) {
                $result = $catModel->deleteCat($id);
                
                if ($result) {
                    header('location:index.php?c=Profile&m=index&success=delete');
                } else {
                    header('location:index.php?c=Profile&m=index&error=delete');
                }
            } else {
                header('location:index.php?c=Profile&m=index&error=notfound');
            }
            
        } catch (Exception $e) {
            header('location:index.php?c=Profile&m=index&error=database');
        }
        
        exit;
    }

    function editProfile() {
        try {
            $userModel = $this->loadModel('User');
            $user = $userModel->getDefaultUser();
            
            if ($user) {
                $this->loadView('editProfile.php', [
                    'user' => $user
                ]);
            } else {
                header('location:index.php?c=Profile&m=index&error=notfound');
                exit;
            }
            
        } catch (Exception $e) {
            error_log("Error in Profile::editProfile: " . $e->getMessage());
            header('location:index.php?c=Profile&m=index&error=database');
            exit;
        }
    }

    function updateProfile() {
        try {
            $userModel = $this->loadModel('User');
            
            $id = $_POST['id_user'] ?? 0;
            $data = [
                'name' => $_POST['name'] ?? '',
                'bio' => $_POST['bio'] ?? '',
                'profile_img' => $_POST['profile_img'] ?? 'img/defaultimage.png'
            ];
            
            if (empty($data['name'])) {
                header('location:index.php?c=Profile&m=editProfile&error=missing');
                exit;
            }
            
            if (!empty($data['profile_img']) && !preg_match('/\.(jpg|png)$/i', $data['profile_img'])) {
                header('location:index.php?c=Profile&m=editProfile&error=invalid_image');
                exit;
            }
            
            $result = $userModel->updateUser($id, $data);
            
            if ($result) {
                header('location:index.php?c=Profile&m=index&success=update_profile');
            } else {
                header('location:index.php?c=Profile&m=index&error=update_profile');
            }
            
        } catch (Exception $e) {
            header('location:index.php?c=Profile&m=index&error=database');
        }
        
        exit;
    }
}