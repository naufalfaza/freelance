<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Owner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_data");
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $this->load->view('welcome_message');
    }
}
