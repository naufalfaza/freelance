<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_data");
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $sessionLogin = $this->session->userdata("logged_in");
        if ($sessionLogin == true) {
            $data = array(
                "title" => "Dashboard Page",
                "pages" => "dashboard"
            );
            $this->load->view('structures/header', $data);
            $this->load->view('structures/navbar');
            $this->load->view('structures/sidebar');
            $this->load->view('pages/dashboard');
            $this->load->view('structures/footer');
        } else {
            redirect(base_url("/Auth"));
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
        $this->load->view('pages/' . $pages);
        $this->load->view('structures/footer');
    }
}
