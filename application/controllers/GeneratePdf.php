<?php class GeneratePdf extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("M_data");
        $this->load->library('pdfgenerator');
        date_default_timezone_set('Asia/Jakarta');
    }

    function index()
    {
        $data['title'] = "Print Invoice";
        $file_pdf = $data['title'];
        $paper = 'A4';
        $orientation = "potrait";
        $html = $this->load->view('user/print_invoice', $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
