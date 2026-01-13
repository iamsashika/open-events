<?php
// app/controllers/AuthController.php
require_once '../app/services/MailService.php';

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }


    public function register()
    {
        if ($this->isPost()) {
            $this->handleRegister();
            return;
        }

        $this->view('auth/register');
    }

    public function login()
    {
        if ($this->isPost()) {
            return $this->handleLogin();
        }

        $this->view('auth/login');
    }

    public function verifyEmail()
    {;
        if ($this->isPost()) {
            $this->handleVerifyEmail();
            return;
        }

        return $this->view('auth/verify-email');
    }

    public function resetPassword()
    {
        $this->view('auth/reset-password');
    }

    public function resetPasswordRequest()
    {
        if ($this->isPost()) {
            $this->handleResetPasswordRequest();
            return;
        }

        $this->view('auth/reset-password-request');
    }

    public function logout()
    {
        session_start();
        session_destroy();
        $this->redirect('auth/login');
    }


    public function handleRegister()
    {
        $data = [
            'first_name' => trim($_POST['first_name']),
            'last_name' => trim($_POST['last_name']),
            'email' => trim($_POST['email']),
            'password_hash' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'role' => 'attendee'
        ];

        if ($this->userModel->findByEmail($data['email'])) {
            flash_set('registeration-error', 'Email already registered');
            $this->redirect('auth/register');
            exit;
        }

        $code = random_int(100000, 999999);
        $expires = date('Y-m-d H:i:s', strtotime('+5 minutes'));

        $data['verification_code'] = $code;


        $this->userModel->create($data);

        MailService::sendVerificationCode($data['email'], $code);

        flash_set('registration-success', 'Verification code sent to your email');

        $this->redirect('auth/verify-email?email=' . urlencode($data['email']));
    }


    public function handleVerifyEmail()
    {


        $code = $_POST['code'];
        $email = $_GET['email'];

        $user = $this->userModel->findByEmail($email);

        if (!$user) {
            flash_set('verification-error', 'User not found');
            // $this->redirect('auth/verify-email');
            return;
        }

        if ($user['verification_code'] !== $code) {
            flash_set('verification-error', 'Invalid verification code');
            // $this->redirect('auth/verify-email');
            return;
        }


        if ($this->userModel->verifyEmail($email)) {
            flash_set('verification-success', 'Email verified. You can login.');
            $this->redirect('auth/login');
        } else {
            flash_set('verification-error', 'Invalid or expired code');
            // $this->redirect('auth/verify-email');
        }
    }


    public function handleLogin()
    {


        $email = trim($_POST['email']);
        $password = $_POST['password'];



        $user = $this->userModel->findByEmail($email);



        if (!$user || !password_verify($password, $user['password_hash'])) {
            flash_set('login-error', 'Invalid email or password');
            $this->redirect('auth/login');
            return;
        }


        if ($user['status'] !== 'active') {
            flash_set('login-error', 'Please verify your email before logging in.');
            $this->redirect('auth/login');
            return;
        }


        // distroy previous session and start a new one
        session_destroy();
        session_start();
        session_regenerate_id(true);


        $_SESSION['user'] = $user;

        flash_set('login-success', 'Login successful');
        echo "login successful";

        $this->redirect('dashboard/index');
    }

    public function handleResetPasswordRequest()
    {
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+10 minutes'));

        $this->userModel->setResetToken($_POST['email'], $token, $expires);

        MailService::sendPasswordReset($_POST['email'], "https://yourdomain.com/auth/reset-password?code=$token");

        flash_set('reset-success', 'Password reset link sent to your email.');

        exit;
    }

    public function handleResetPassword()
    {
        $code = $_POST['code'];
        $email = trim($_POST['email']);
        $newPassword = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

        if (!$this->userModel->isValidResetToken($email, $code)) {
            flash_set('reset-error', 'Invalid or expired reset token.');
            $this->redirect('auth/reset-password?token=' . urlencode($code));
            return;
        }


        if ($this->userModel->resetPassword($email, $code, $newPassword)) {
            flash_set('reset-success', 'Password has been reset. You can now login.');
            $this->redirect('auth/login');
        } else {
            flash_set('reset-error', 'Invalid token or email.');
            $this->redirect('auth/reset-password?token=' . urlencode($code));
        }
    }
}
