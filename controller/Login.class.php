<?php
class Login extends Controller {
    function loginPage() {
        $this->loadView('login.php');
    }

    function loginAction() {
        session_start();
        $model = $this->loadModel('UserModel');

        $username = $_POST['username'];

        $user = $model->getUserByUsername($username);

        if ($user) {
            $_SESSION['id_user'] = $user['id_user'];
            header("Location: index.php?c=Calendar&m=landingPage");
        } else {
            echo "Login gagal!";
        }
    }
}
