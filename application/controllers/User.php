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
        $this->load->view('structures/headerUser', $data);
        $this->load->view('structures/navbarUser');
        $this->load->view('structures/sidebarUser');
        $this->load->view('user/' . $pages);
        $this->load->view('structures/footer');
    }

    public function getAkun()
    {
        $id_user = $this->input->post("id_user");
        $get = $this->M_data->getWhere("tbl_user", array("id_user" => $id_user))->row();
        $res = array(
            "nama" => $get->nama,
            "email" => $get->email,
            "no_telp" => $get->no_telp,
        );
        echo json_encode($res);
    }

    public function getTotal()
    {
        $qty = $this->input->post("qty");
        $id_ukuran = $this->input->post("id_ukuran");
        $get = $this->M_data->getWhere("tbl_ukuran", array("id_ukuran" => $id_ukuran))->row();
        $total = $qty * $get->harga;
        $res = array(
            "total" => "Rp. " . number_format($total, 0, ',', '.'),
            "totall" => $total,
        );
        echo json_encode($res);
    }

    public function inputCetakFoto()
    {
        $config['upload_path'] = FCPATH . "/assets/img/cetak";
        $config['allowed_types'] = "jpg|jpeg|png";
        $config['overwrite'] = true;
        $config['max_size'] = 5120; // 5MB
        $config['max_width'] = 1080;
        $config['max_height'] = 1080;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("foto")) {
            $res = array(
                "status" => false,
                "message" => $this->upload->display_errors()
            );
        } else {
            $data = $this->upload->data();
            $id_cetak = $this->M_data->generateIdCetak();
            $data1 = array(
                "id_cetak" => $id_cetak,
                "id_user" => $this->input->post("id_user"),
                "id_ukuran" => $this->input->post("ukuran_foto"),
                "image" => $data['file_name'],
                "qty" => $this->input->post("qty"),
                "total" => $this->input->post("totall"),
                "status" => "K",
                "record" => date("Y-m-d H:i:s")
            );
            $this->M_data->inputData("tbl_cetak", $data1);

            $data2 = array(
                "id_keranjang" => $this->M_data->generateIdKeranjang(),
                "id_user" => $this->input->post("id_user"),
                "pesanan" => $id_cetak,
                "qty" => $this->input->post("qty"),
                "record" => date("Y-m-d H:i:s")
            );
            $this->M_data->inputData("tbl_keranjang", $data2);

            $res = array(
                "status" => true,
                "message" => "Berhasil!"
            );
        }
        echo json_encode($res);
    }

    public function getKeranjang()
    {
        $id_user = $this->session->userdata("id_user");
        $get = $this->M_data->dataKeranjang($id_user)->result();
        $array["data"] = array();
        $no = 1;
        foreach ($get as $dt) {
            if (substr($dt->pesanan, 0, 3) == "CTK") {
                $cetak = $this->M_data->getWhere("tbl_cetak", array("id_cetak" => $dt->pesanan))->row();
                $ukuran = $this->M_data->getWhere("tbl_ukuran", array("id_ukuran" => $cetak->id_ukuran))->row();
                $link =  base_url("/assets/img/cetak/" . $cetak->image);
                $image = '<img src="' . $link . '" width="60%">';
                $nm = "Pesanan Cetak Foto - " . $ukuran->ukuran;
                $harga = $ukuran->harga;
                $qty = $cetak->qty;
                $total = $qty * $harga;
                $btn = '<button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>';
            } else {
                $cetak = $this->M_data->getWhere("tbl_cetak", array("id_cetak" => $dt->pesanan))->row();
                $barang = $this->M_data->getWhere("tbl_barang", array("id_barang" => $cetak->id_ukuran))->row();
                $link =  base_url("/assets/img/barang/" . $barang->image);
                $image = '<img src="' . $link . '" width="60%">';
                $nm = $barang->nm_barang;
                $harga = $barang->harga;
                $qty = $cetak->qty;
                $total = $qty * $harga;
                $btn = '<button type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button>';
            }
            array_push($array["data"], array($no++, $image, $nm, "Rp. " . number_format($harga, 0, ',', '.'), $qty, "Rp. " . number_format($total, 0, ',', '.'), $btn));
        }
        echo json_encode($array);
    }

    public function getJmlKeranjang()
    {
        $id_user = $this->session->userdata("id_user");
        $get = $this->M_data->dataJmlKeranjang($id_user)->row()->jumlah;
        $res = array(
            "jumlah" => $get
        );
        echo json_encode($res);
    }

    public function getTotalKeranjang()
    {
        $id_user = $this->session->userdata("id_user");
        $get = $this->M_data->dataKeranjang($id_user)->result();
        $no = 1;
        $total = 0;
        foreach ($get as $dt) {
            if (substr($dt->pesanan, 0, 3) == "CTK") {
                $cetak = $this->M_data->getWhere("tbl_cetak", array("id_cetak" => $dt->pesanan))->row();
                $ukuran = $this->M_data->getWhere("tbl_ukuran", array("id_ukuran" => $cetak->id_ukuran))->row();
                $harga = $ukuran->harga;
                $qty = $cetak->qty;
                $total += $qty * $harga;
            } else {
                $cetak = $this->M_data->getWhere("tbl_cetak", array("id_cetak" => $dt->pesanan))->row();
                $barang = $this->M_data->getWhere("tbl_barang", array("id_barang" => $cetak->id_ukuran))->row();
                $harga = $barang->harga;
                $qty = $cetak->qty;
                $total += $qty * $harga;
            }
        }
        $res = array(
            "total" => number_format($total, 0, ',', '.')
        );
        echo json_encode($res);
    }
}
