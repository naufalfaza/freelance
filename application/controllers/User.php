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
        } else if ($sessionLogin == true && $sessionRole == 1) {
            redirect(base_url("/Admin"));
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
                $btn = '<a href="' . base_url("/User/deleteKeranjang?id=" . $dt->id_keranjang) . '" class="btn btn-danger"><i class="bi bi-trash"></i></a>';
            } else {
                $barang = $this->M_data->getWhere("tbl_barang", array("id_barang" => $dt->pesanan))->row();
                $link =  base_url("/assets/img/barang/" . $barang->image);
                $image = '<img src="' . $link . '" width="60%">';
                $nm = $barang->nm_barang;
                $harga = $barang->harga;
                $qty = $dt->qty;
                $total = $qty * $harga;
                $btn = '<a href="' . base_url("/User/deleteKeranjang?id=" . $dt->id_keranjang) . '" class="btn btn-danger"><i class="bi bi-trash"></i></a>';
            }
            array_push($array["data"], array($no++, $image, $nm, "Rp. " . number_format($harga, 0, ',', '.'), $qty, "Rp. " . number_format($total, 0, ',', '.'), $btn));
        }
        echo json_encode($array);
    }

    public function deleteKeranjang()
    {
        $id = $this->input->get("id");
        $this->M_data->deleteData("tbl_keranjang", array("id_keranjang" => $id));

        $this->session->set_flashdata("success", '<script>Swal.fire({icon: "success",title: "Berhasil!",showConfirmButton: false,timer: 1500,})</script>');

        redirect(base_url("/User/pages?p=" . base64_encode("keranjang")));
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
                $barang = $this->M_data->getWhere("tbl_barang", array("id_barang" => $dt->pesanan))->row();
                $harga = $barang->harga;
                $qty = $dt->qty;
                $total += $qty * $harga;
            }
        }
        $res = array(
            "total" => number_format($total, 0, ',', '.')
        );
        echo json_encode($res);
    }

    public function getRekening()
    {
        $bank = $this->input->post("bank");
        $get = $this->M_data->dataRekening($bank)->row();
        $res = array(
            "rekening" => $get->no_rekening . " - " . $get->atas_nama
        );
        echo json_encode($res);
    }

    public function inputBarang()
    {
        $id_barang = $this->input->post("id_barang");
        $qtyBrg = $this->input->post("qtyBrg");
        $data = array(
            "id_keranjang" => $this->M_data->generateIdKeranjang(),
            "id_user" => $this->input->post("id_user"),
            "pesanan" => $id_barang,
            "qty" => $qtyBrg,
            "record" => date("Y-m-d H:i:s")
        );
        $this->M_data->inputData("tbl_keranjang", $data);

        $this->session->set_flashdata("success", '<script>Swal.fire({icon: "success",title: "Berhasil!",showConfirmButton: false,timer: 1500,})</script>');

        redirect(base_url("/User"));
    }


    public function inputTransaksi()
    {
        $id_user = $this->input->post("id_userr");
        $metode = $this->input->post("metode");
        $bank = $this->input->post("bank");
        $total = $this->input->post("totalll");
        $id_transaksi = $this->M_data->generateIdTransaksi();
        $status = "PEN";
        $record = date("Y-m-d H:i:s");

        $config['upload_path'] = FCPATH . "/assets/img/bukti_tf";
        $config['allowed_types'] = "jpg|jpeg|png";
        $config['overwrite'] = true;
        $config['max_size'] = 5120; // 5MB
        $config['max_width'] = 1080;
        $config['max_height'] = 1080;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("bukti")) {
            $res = array(
                "status" => false,
                "message" => $this->upload->display_errors()
            );
        } else {
            $data = $this->upload->data();
            $getPesanan = $this->M_data->dataKeranjang($id_user)->result();
            $pesanan = array();
            foreach ($getPesanan as $dt) {
                array_push($pesanan, array(
                    "pesanan" => $dt->pesanan,
                    "qty" => $dt->qty
                ));
            }

            $data = array(
                "id_transaksi" => $id_transaksi,
                "id_user" => $id_user,
                "pesanan" => json_encode($pesanan),
                "total" => $total,
                "metode" => $metode,
                "id_rekening" => $bank,
                "bukti" => $data['file_name'],
                "status" => $status,
                "record" => $record
            );

            $this->M_data->inputData("tbl_transaksi", $data);

            foreach ($getPesanan as $dt) {
                $this->M_data->deleteData("tbl_keranjang", array("id_keranjang" => $dt->id_keranjang));
            }

            $res = array(
                "status" => true,
                "message" => "Berhasil!"
            );
        }
        echo json_encode($res);
    }

    public function getTransaksiProses()
    {
        $id_user = $this->session->userdata("id_user");
        $array["data"] = array();
        $get = $this->M_data->dataTransaksiProses($id_user)->result();
        $no = 1;
        foreach ($get as $dt) {
            $pesanan = json_decode($dt->pesanan, TRUE);
            $items = [];
            foreach ($pesanan as $item) {
                if (substr($item['pesanan'], 0, 3) == "CTK") {
                    $cetak = $this->M_data->getWhere("tbl_cetak", array("id_cetak" => $item['pesanan']))->row();
                    $ukuran = $this->M_data->getWhere("tbl_ukuran", array("id_ukuran" => $cetak->id_ukuran))->row();
                    $nm_pesanan = "Cetak Foto - " . $ukuran->ukuran;
                    $link =  base_url("/assets/img/cetak/" . $cetak->image);
                    $image = '<img src="' . $link . '" width="20%" style="float: left; padding-right: 10px;">';
                } else {
                    $barang = $this->M_data->getWhere("tbl_barang", array("id_barang" => $item['pesanan']))->row();
                    $nm_pesanan = $barang->nm_barang;
                    $link =  base_url("/assets/img/barang/" . $barang->image);
                    $image = '<img src="' . $link . '" width="20%" style="float: left; padding-right: 10px;">';
                }
                $items[] = '<li>' . $image . '<h6><b>' . $nm_pesanan . '</b><br> x' . $item['qty'] . '</h6></li><br><br><br>';
            }
            if ($dt->status == "PEN") {
                $span = '<span class="badge bg-warning text-dark">Pesanan Diproses</span>';
            } else if ($dt->status == "APP") {
                $span = '<span class="badge bg-success">Pesanan Selesai</span>';
            } else {
                $span = '<span class="badge bg-danger">Pesanan Dibatalkan</span>';
            }
            $btn = '<button type="button" class="btn btn-primary"><i class="bi bi-file-earmark-fill"></i></button>&nbsp;<a href="https://wa.me/" target="_blank" class="btn btn-success"><i class="bi bi-whatsapp"></i></a>';
            array_push($array["data"], array($no++, $dt->id_transaksi, date("d-m-Y", strtotime($dt->record)), "<ol>" . implode("\n", $items) . "</ol>", "<b>Rp. " . $dt->total . "</b>", $span, $btn));
        }
        echo json_encode($array);
    }

    public function getTransaksiSelesai()
    {
        $id_user = $this->session->userdata("id_user");
        $array["data"] = array();
        $get = $this->M_data->dataTransaksiSelesai($id_user)->result();
        $no = 1;
        foreach ($get as $dt) {
            $pesanan = json_decode($dt->pesanan, TRUE);
            $items = [];
            foreach ($pesanan as $item) {
                if (substr($item['pesanan'], 0, 3) == "CTK") {
                    $cetak = $this->M_data->getWhere("tbl_cetak", array("id_cetak" => $item['pesanan']))->row();
                    $ukuran = $this->M_data->getWhere("tbl_ukuran", array("id_ukuran" => $cetak->id_ukuran))->row();
                    $nm_pesanan = "Cetak Foto - " . $ukuran->ukuran;
                    $link =  base_url("/assets/img/cetak/" . $cetak->image);
                    $image = '<img src="' . $link . '" width="20%" style="float: left; padding-right: 10px;">';
                } else {
                    $barang = $this->M_data->getWhere("tbl_barang", array("id_barang" => $item['pesanan']))->row();
                    $nm_pesanan = $barang->nm_barang;
                    $link =  base_url("/assets/img/barang/" . $barang->image);
                    $image = '<img src="' . $link . '" width="20%" style="float: left; padding-right: 10px;">';
                }
                $items[] = '<li>' . $image . '<h6><b>' . $nm_pesanan . '</b><br> x' . $item['qty'] . '</h6></li><br><br><br>';
            }
            if ($dt->status == "PEN") {
                $span = '<span class="badge bg-warning text-dark">Pesanan Diproses</span>';
            } else if ($dt->status == "APP") {
                $span = '<span class="badge bg-success">Pesanan Selesai</span>';
            } else {
                $span = '<span class="badge bg-danger">Pesanan Dibatalkan</span>';
            }
            $btn = '<button type="button" class="btn btn-primary"><i class="bi bi-file-earmark-fill"></i></button>';
            array_push($array["data"], array($no++, $dt->id_transaksi, date("d-m-Y", strtotime($dt->record)), "<ol>" . implode("\n", $items) . "</ol>", "<b>Rp. " . $dt->total . "</b>", $span, $btn));
        }
        echo json_encode($array);
    }

    public function getTransaksiBatal()
    {
        $id_user = $this->session->userdata("id_user");
        $array["data"] = array();
        $get = $this->M_data->dataTransaksiBatal($id_user)->result();
        $no = 1;
        foreach ($get as $dt) {
            $pesanan = json_decode($dt->pesanan, TRUE);
            $items = [];
            foreach ($pesanan as $item) {
                if (substr($item['pesanan'], 0, 3) == "CTK") {
                    $cetak = $this->M_data->getWhere("tbl_cetak", array("id_cetak" => $item['pesanan']))->row();
                    $ukuran = $this->M_data->getWhere("tbl_ukuran", array("id_ukuran" => $cetak->id_ukuran))->row();
                    $nm_pesanan = "Cetak Foto - " . $ukuran->ukuran;
                    $link =  base_url("/assets/img/cetak/" . $cetak->image);
                    $image = '<img src="' . $link . '" width="20%" style="float: left; padding-right: 10px;">';
                } else {
                    $barang = $this->M_data->getWhere("tbl_barang", array("id_barang" => $item['pesanan']))->row();
                    $nm_pesanan = $barang->nm_barang;
                    $link =  base_url("/assets/img/barang/" . $barang->image);
                    $image = '<img src="' . $link . '" width="20%" style="float: left; padding-right: 10px;">';
                }
                $items[] = '<li>' . $image . '<h6><b>' . $nm_pesanan . '</b><br> x' . $item['qty'] . '</h6></li><br><br><br>';
            }
            if ($dt->status == "PEN") {
                $span = '<span class="badge bg-warning text-dark">Pesanan Diproses</span>';
            } else if ($dt->status == "APP") {
                $span = '<span class="badge bg-success">Pesanan Selesai</span>';
            } else {
                $span = '<span class="badge bg-danger">Pesanan Dibatalkan</span>';
            }
            array_push($array["data"], array($no++, $dt->id_transaksi, date("d-m-Y", strtotime($dt->record)), "<ol>" . implode("\n", $items) . "</ol>", "<b>Rp. " . $dt->total . "</b>", $span, $dt->keterangan));
        }
        echo json_encode($array);
    }
}
