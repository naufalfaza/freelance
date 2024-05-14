<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_data");
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $sessionRole = $this->session->userdata("role");
        $sessionLogin = $this->session->userdata("logged_in");
        if ($sessionLogin == true && $sessionRole == 2) {
            $data = array(
                "title" => "Home Page",
                "pages" => "home"
            );
            $this->load->view('structures/headerUser', $data);
            $this->load->view('structures/navbarUser');
            $this->load->view('structures/sidebarUser');
            $this->load->view('user/home');
            $this->load->view('structures/footer');
        } else {
            $data = array(
                "title" => "Home Page",
                "pages" => "home",
                "data" => "disabled"
            );
            $this->load->view('structures/headerUser', $data);
            $this->load->view('structures/navbarUser');
            $this->load->view('structures/sidebarUser');
            $this->load->view('user/home');
            $this->load->view('structures/footer');
            // redirect(base_url("/Auth"));
        }
    }

    public function pages()
    {
        $pages = base64_decode($this->input->get("p"));
        $data = array(
            "title" => ucwords($pages) . " Page",
            "pages" => $pages
        );
        $this->load->view('structures/header', $data);
        $this->load->view('structures/navbar');
        $this->load->view('structures/sidebar');
        $this->load->view('home/' . $pages);
        $this->load->view('structures/footer');
    }
}
