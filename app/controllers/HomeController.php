<?php
// app/controllers/HomeController.php
class HomeController extends Controller {
  
    public function index() {
        $userModel = $this->model('User');
        $users = $userModel->getAllUsers();

        $data = [
            'title' => 'PHP MVC with PDO',
            'users' => $users
        ];

        echo "in home controller";

        $this->view('home', $data);
    }
}
