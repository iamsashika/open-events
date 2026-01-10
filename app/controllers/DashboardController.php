<?php

class DashboardController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /auth/login');
            exit;
        }
    }

    public function index()
    {
        $role = $_SESSION['user']['role'];

        switch ($role) {
            case 'admin':
                header('Location: /dashboard/admin');
                break;

            case 'organizer':
                header('Location: /dashboard/organizer');
                break;

            case 'attendee':
                header('Location: /dashboard/attendee');
                break;

            default:
                echo "Invalid role";
        }
        exit;
    }

    public function admin()
    {
        $this->authorize('admin');
        $this->view('dashboard/admin/index');
    }

    public function organizer()
    {
        $this->authorize('organizer');
        $this->view('dashboard/organizer/index');
    }

    public function attendee()
    {
        $this->authorize('attendee');
        $this->view('dashboard/attendee/index');
    }

    private function authorize($role)
    {
        if ($_SESSION['user']['role'] !== $role) {
            http_response_code(403);
            echo "Access Denied";
            exit;
        }
    }
}
