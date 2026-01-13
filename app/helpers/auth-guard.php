<?php


function authorize($requiredRole)
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . url('auth/login'));
        exit;
    }

    $userRole = $_SESSION['user']['role'];

    if ($userRole !== $requiredRole) {
        header('HTTP/1.1 403 Forbidden');
        echo "403 Forbidden - You do not have permission to access this page.";
        exit;
    }
}
