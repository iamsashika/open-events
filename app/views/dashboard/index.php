<?php

$user = $_SESSION['user'] ?? null;

if (!$user) {
    header('Location: ' . url('auth/login'));
    exit;
}

$role = $user['role'];

if ($role === 'admin') {
    header('Location: ' . url('dashboard/admin'));
    exit;
} elseif ($role === 'organizer') {
    header('Location: ' . url('dashboard/organizer'));
    exit;
} elseif ($role === 'attendee') {
    header('Location: ' . url('dashboard/attendee'));
    exit;
}
