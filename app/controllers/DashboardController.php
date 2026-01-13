<?php

class DashboardController extends Controller
{
    public function __construct()
    {
        // if (!isset($_SESSION['user'])) {
        //     $this->redirect('auth/login');
        //     exit;
        // }
    }

    public function index()
    {
        $role = $_SESSION['user']['role'];
        $this->view('dashboard/index');

        // $this->redirect('dashboard');

        exit;

        // switch ($role) {
        //     case 'admin':
        //         $this->redirect('dashboard/admin');
        //         break;

        //     case 'organizer':
        //         $this->redirect('dashboard/organizer');
        //         break;

        //     case 'attendee':
        //         $this->redirect('dashboard/attendee');
        //         break;

        //     default:
        //         echo "Invalid role";
        // }
        // exit;
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
