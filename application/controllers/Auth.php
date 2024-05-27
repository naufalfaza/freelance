<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
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
        if ($sessionLogin == false) {
            $data = array(
                "title" => "Login Page",
                "pages" => "login"
            );
            $this->load->view('structures/header', $data);
            $this->load->view('login/login');
            $this->load->view('structures/footer');
        } else {
            if ($sessionRole == 1) {
                redirect(base_url("/Admin"));
            } else if ($sessionRole == 2) {
                redirect(base_url("/User"));
            }
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
        $this->load->view('login/' . $pages);
        $this->load->view('structures/footer');
    }

    public function authLogin()
    {
        $username = $this->input->post("user");
        $password = $this->input->post("pass");

        $cekUser = $this->M_data->cekUser($username);
        if ($username != null && $password != null) {
            if ($cekUser->num_rows() == 1) {
                $getData = $cekUser->row();
                if ($getData->status == "PEN" || $getData->status == "OFF") {
                    $data = array(
                        "status" => false,
                        "message" => "Akun sedang diperiksa, coba lagi nanti!"
                    );
                } else {
                    if (password_verify($password, $getData->password)) {
                        $sessionData = array(
                            'id_user'  => $getData->id_user,
                            'name'     => $getData->nama,
                            'role' => $getData->id_role,
                            'logged_in' => true
                        );

                        $this->session->set_userdata($sessionData);

                        if ($getData->id_role == 1) {
                            $data = array(
                                "status" => true,
                                "message" => "Berhasil login!",
                                "link" => "/Admin"
                            );
                        } else if ($getData->id_role == 2) {
                            $data = array(
                                "status" => true,
                                "message" => "Berhasil login!",
                                "link" => "/User"
                            );
                        }
                    } else {
                        $data = array(
                            "status" => false,
                            "message" => "Password salah!"
                        );
                    }
                }
            } else {
                $data = array(
                    "status" => false,
                    "message" => "Akun tidak dikenali!"
                );
            }
        } else {
            $data = array(
                "status" => false,
                "message" => "Silahkan isi form dengan benar!"
            );
        }
        echo json_encode($data);
    }

    public function authRegis()
    {
        $name = $this->input->post("name");
        $no_telp = $this->input->post("no_telp");
        $email = $this->input->post("email");
        $username = $this->input->post("user");
        $password = $this->input->post("pass");

        $record = date("Y-m-d H:i:s");

        if ($name != null && $email != null && $username != null && $password != null) {
            $insertData = array(
                "id_user" => $this->M_data->generateIdUser(),
                "nama" => $name,
                "email" => $email,
                "no_telp" => $no_telp,
                "username" => $username,
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "id_role" => 2,
                "status" => "PEN",
                "record" => $record
            );

            $this->M_data->inputData("tbl_user", $insertData);

            $res = array(
                "status" => true,
                "message" => "Registrasi berhasil!"
            );
        } else {
            $res = array(
                "status" => false,
                "message" => "Silahkan isi form dengan benar!"
            );
        }

        echo json_encode($res);
    }

    public function authLogout()
    {
        $this->session->sess_destroy();
        redirect(base_url("/User"));
    }
}
