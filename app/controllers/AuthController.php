<?php
// app/controllers/AuthController.php

class AuthController extends Controller
{
    public function register()
    {
        $this->view('auth/register');
    }

    public function login()
    {
        $this->view('auth/login');
    }

    public function resetPassword()
    {
        $this->view('auth/reset-password');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /auth/register');
            exit;
        }

        $userModel = $this->model('User');

        $data = [
            'name'     => trim($_POST['name']),
            'email'    => trim($_POST['email']),
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'role'     => 'attendee'
        ];

        $userModel->create($data);

        header('Location: /auth/login');
    }

    public function authenticate()
    {
        $userModel = $this->model('User');

        $user = $userModel->findByEmail($_POST['email']);

        if ($user && password_verify($_POST['password'], $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = $user;

            header('Location: /dashboard');
        } else {
            echo "Invalid credentials";
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /auth/login');
    }
}
