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
        $sessionRole = $this->session->userdata("role");
        $sessionLogin = $this->session->userdata("logged_in");
        if ($sessionLogin == true && $sessionRole == 1) {
            $data = array(
                "title" => "Dashboard Page",
                "pages" => "dashboard"
            );
            $this->load->view('structures/header', $data);
            $this->load->view('structures/navbar');
            $this->load->view('structures/sidebar');
            $this->load->view('admin/dashboard');
            $this->load->view('structures/footer');
        } else {
            redirect(base_url("/Auth"));
        }
    }

    public function pages()
    {
        $pages = base64_decode($this->input->get("p"));
        $data = array(
            "title" => ucwords(str_replace("_", " ", $pages)) . " Page",
            "pages" => $pages
        );
        $this->load->view('structures/header', $data);
        $this->load->view('structures/navbar');
        $this->load->view('structures/sidebar');
        $this->load->view('admin/' . $pages);
        $this->load->view('structures/footer');
    }

    public function getDataPengguna()
    {

        $get = $this->M_data->dataPengguna()->result();
        $array["data"] = array();
        $no = 1;
        foreach ($get as $dt) {

            // Kondisi Role
            if ($dt->id_role == 1) {
                $role = "<span class='badge bg-success'>Admin</span>";
            } else if ($dt->id_role == 2) {
                $role = "<span class='badge bg-primary'>User</span>";
            } else {
                $role = "<span class='badge bg-warning'>Owner</span>";
            }

            // Kondisi Status
            if ($dt->status == "ON") {
                $status = "<span class='badge bg-success'>ON</span>";
            } elseif ($dt->status == "PEN") {
                $status = "<span class='badge bg-warning'>PENDING</span>";
            } else {
                $status = "<span class='badge bg-danger'>OFF</span>";
            }
            $btn = '<button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#basicModal' . $dt->id_user . '">
                <i class="bi bi-info-circle"></i> Detail
            </button>
            <div class="modal fade" id="basicModal' . $dt->id_user . '" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><b>Detail Akun</b></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <form action="' . base_url("Admin/updatePengguna") . '" method="POST" enctype="multipart/form-data">
                                    <div class="col-lg-12">
                                        <div class="form-group row">
                                            <label class="col-lg-4" style="text-align: left;">Nama Lengkap</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" name="nama" id="nama" value="' . $dt->nama . '" disabled>
                                            </div>
                                            <div class="col-lg-12"><br></div>
                                            <label class="col-lg-4" style="text-align: left;">Email</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" name="email" id="email" value="' . $dt->email . '" disabled>
                                            </div>
                                            <div class="col-lg-12"><br></div>
                                            <label class="col-lg-4" style="text-align: left;">No Telepon</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" name="no_telp" id="no_telp" value="' . $dt->no_telp . '" disabled>
                                            </div>
                                            <div class="col-lg-12"><br></div>
                                            <label class="col-lg-4" style="text-align: left;">Username</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" name="username" id="username" value="' . $dt->username . '" disabled>
                                            </div>
                                            <div class="col-lg-12"><br></div>
                                            <label class="col-lg-4" style="text-align: left;">Password</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" name="password" id="password" value="' . $dt->password .
                '" disabled>
                                            </div>
                                            <div class="col-lg-12"><br></div>
                                            <label class="col-lg-4" style="text-align: left;">Role</label>
                                            <div class="col-lg-8">
                                                <select class="form-select" id="id_role" name="id_role">';
            if ($dt->id_role == 1) {
                $a = "selected";
                $b = "";
                $c = "";
            } else if ($dt->id_role == 2) {
                $a = "";
                $b = "selected";
                $c = "";
            } else {
                $a = "";
                $b = "";
                $c = "selected";
            }
            $btn .= '<option value="1" ' . $a . '>Admin</option>
                                                    <option value="2" ' . $b . '>User</option>
                                                    <option value="3" ' . $c . '>Owner</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-12"><br></div>
                                            <label class="col-lg-4" style="text-align: left;">Status</label>
                                            <div class="col-lg-8">
                                                <select class="form-select" id="status" name="status">';
            if ($dt->status == "ON") {
                $a = "selected";
                $b = "";
                $c = "";
            } else if ($dt->status == "OFF") {
                $a = "";
                $b = "selected";
                $c = "";
            } else {
                $a = "";
                $b = "";
                $c = "selected";
            }
            $btn .= '<option value="ON" ' . $a . '>ON</option>
                                                    <option value="PEN" ' . $c . '>PENDING</option>
                                                    <option value="OFF" ' . $b . '>OFF</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                                <input type="hidden" class="form-control" name="id_user" id="id_user" value="' . $dt->id_user . '">
                                            </div>
                                            <div class="col-lg-12">
                                                <button type="submit" class="btn btn-outline-primary col-12"><i class="bi bi-save me-1"></i> Simpan Perubahan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            array_push(
                $array["data"],
                array(
                    $no++,
                    $dt->username,
                    "<b>$dt->nama</b>",
                    $role,
                    $status,
                    $btn
                )
            );
        }
        echo json_encode($array);
    }

    public function updatePengguna()
    {
        $id_user = $this->input->post("id_user");
        $id_role = $this->input->post("id_role");
        $status = $this->input->post("status");
        $update = array("id_role" => $id_role, "status" => $status);
        $where = array("id_user" => $id_user);
        $this->M_data->updateData("tbl_user", $update, $where);
        $this->session->set_flashdata("alert", '<script>$(document).ready(function(){Swal.fire({icon: "success",title: "Berhasil Dirubah!",showConfirmButton: false,timer: 1500,});});</script>');
        redirect(base_url("Admin/pages?p=" . base64_encode("data_pengguna")));
    }

    public function getDataBarang()
    {

        $get = $this->M_data->dataBarang()->result();
        $array["data"] = array();
        $no = 1;
        foreach ($get as $dt) {

            $link =  base_url("/assets/img/barang/" . $dt->image);
            $image = '<img src="' . $link . '" width="60%">';

            array_push(
                $array["data"],
                array(
                    $no++,
                    $image,
                    $dt->nm_barang,
                    "<b>$dt->jenis</b>",
                    "Rp. " . rupiah($dt->harga),
                    $dt->stok . " " . $dt->satuan,
                    '<button type="button" class="btn btn-outline-info">
                        <i class="bi bi-info-circle"></i> Detail
                    </button>'
                )
            );
        }
        echo json_encode($array);
    }

    public function inputDataBarang()
    {
        $id_barang                  = $this->M_data->generateIdBarang();
        $filename                   = $id_barang . ".jpg";
        $config['upload_path']      = FCPATH . "/assets/img/barang";
        $config['allowed_types']    = "jpg|jpeg|png";
        $config['overwrite']        = true;
        $config['max_size']         = 5120; // 5MB
        $config['max_width']        = 2000;
        $config['max_height']       = 2000;
        $config['file_name']        = $filename;


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("foto")) {
            $res = array(
                "status" => false,
                "message" => $this->upload->display_errors()
            );
        } else {
            $data = $this->upload->data();
            $id_barang = $this->M_data->generateIdBarang();
            $data = array(
                "id_barang" => $id_barang,
                "nm_barang" => $this->input->post('nm_barang'),
                "jenis" => $this->input->post('jenis'),
                "harga" => $this->input->post('harga'),
                "diskon" => $this->input->post('diskon'),
                "stok" => $this->input->post('stok'),
                "satuan" => $this->input->post('satuan'),
                "image" => $filename,
                "deskripsi" => $this->input->post('deskripsi'),
                "record" => date("Y-m-d H:i:s")
            );
            $this->M_data->inputData("tbl_barang", $data);

            $res = array(
                "status" => true,
                "message" => "Berhasil!"
            );
        }
        echo json_encode($res);
    }

    public function getTransaksiProsesAll()
    {
        $array["data"] = array();
        $get = $this->M_data->dataTransaksiProsesAll()->result();
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
                    $download = '<a href="' . $link . '" download> Download Foto</a>';
                } else {
                    $barang = $this->M_data->getWhere("tbl_barang", array("id_barang" => $item['pesanan']))->row();
                    $nm_pesanan = $barang->nm_barang;
                    $link =  base_url("/assets/img/barang/" . $barang->image);
                    $image = '<img src="' . $link . '" width="20%" style="float: left; padding-right: 10px;">';
                    $download = '';
                }
                $items[] = '<li>' . $image . '<h6 style="text-align: left;"><b>' . $nm_pesanan . '</b><br> x' . $item['qty'] . '<br>' . $download . '</h6></li><br><br><br>';
            }
            if ($dt->status == "PEN") {
                $span = '<span class="badge bg-warning text-dark">Pesanan Diproses</span>';
            } else if ($dt->status == "APP") {
                $span = '<span class="badge bg-success">Pesanan Selesai</span>';
            } else {
                $span = '<span class="badge bg-danger">Pesanan Dibatalkan</span>';
            }
            $btn = '<button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#basicModal' . $dt->id_transaksi . '">
                <i class="bi bi-info-circle"></i>
            </button>
            <div class="modal fade" id="basicModal' . $dt->id_transaksi . '" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><b>Detail Transaksi - </b><small>' . $dt->id_transaksi . '</small></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <form action="' . base_url("Admin/updateTransaksi") . '" method="POST" enctype="multipart/form-data">
                                    <div class="col-lg-12">
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <h4>Foto Bukti</h4><hr> 
                                                <div class="form-group row">
                                                    <img src="' . base_url("/assets/img/bukti_tf/" . $dt->bukti) . '" width="100%">
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <h4>Info Pembeli</h4><hr> 
                                                <div class="form-group row">
                                                    <label class="col-lg-4" style="text-align: left;">Nama Lengkap</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" value="' . $dt->nama . '" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12"><br></div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4" style="text-align: left;">Email</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" value="' . $dt->email . '" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12"><br></div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4" style="text-align: left;">No Telepon</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" value="' . $dt->no_telp . '" disabled>
                                                    </div>
                                                </div>
                                                <hr><h4>Info Pesanan</h4><hr> 
                                                <div class="form-group row">
                                                    ' . "<ol>" . implode("\n", $items) . "</ol>" . '
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <label class="col-lg-4" style="text-align: left;">Keterangan</label>
                                                    <div class="col-lg-8">
                                                        <textarea class="form-control" placeholder="..." name="keterangan"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                                <input type="hidden" class="form-control" name="id_transaksi" id="id_transaksi" value="' . $dt->id_transaksi . '">
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <button type="submit" name="btnSubmit" value="APP" class="btn btn-outline-success col-6"><i class="bi bi-check me-1"></i> Selesaikan Pesanan</button>
                                                    <button type="submit" name="btnSubmit" value="REJ" class="btn btn-outline-danger col-6"><i class="bi bi-x me-1"></i> Batalkan Pesanan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            array_push($array["data"], array($no++, $dt->id_transaksi, date("d-m-Y", strtotime($dt->record)), "<b>$dt->nama</b>", "<b>Rp. " . $dt->total . "</b>", $span, $btn));
        }
        echo json_encode($array);
    }

    public function getTransaksiSelesaiAll()
    {
        $array["data"] = array();
        $get = $this->M_data->dataTransaksiSelesaiAll()->result();
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
                    $download = '<a href="' . $link . '" download> Download Foto</a>';
                } else {
                    $barang = $this->M_data->getWhere("tbl_barang", array("id_barang" => $item['pesanan']))->row();
                    $nm_pesanan = $barang->nm_barang;
                    $link =  base_url("/assets/img/barang/" . $barang->image);
                    $image = '<img src="' . $link . '" width="20%" style="float: left; padding-right: 10px;">';
                    $download = '';
                }
                $items[] = '<li>' . $image . '<h6 style="text-align: left;"><b>' . $nm_pesanan . '</b><br> x' . $item['qty'] . '<br>' . $download . '</h6></li><br><br><br>';
            }
            if ($dt->status == "PEN") {
                $span = '<span class="badge bg-warning text-dark">Pesanan Diproses</span>';
            } else if ($dt->status == "APP") {
                $span = '<span class="badge bg-success">Pesanan Selesai</span>';
            } else {
                $span = '<span class="badge bg-danger">Pesanan Dibatalkan</span>';
            }
            $btn = '<button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#basicModal' . $dt->id_transaksi . '">
                <i class="bi bi-info-circle"></i>
            </button>
            <div class="modal fade" id="basicModal' . $dt->id_transaksi . '" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><b>Detail Transaksi - </b><small>' . $dt->id_transaksi . '</small></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <form action="' . base_url("Admin/updateTransaksi") . '" method="POST" enctype="multipart/form-data">
                                    <div class="col-lg-12">
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <h4>Foto Bukti</h4><hr> 
                                                <div class="form-group row">
                                                    <img src="' . base_url("/assets/img/bukti_tf/" . $dt->bukti) . '" width="100%">
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <h4>Info Pembeli</h4><hr> 
                                                <div class="form-group row">
                                                    <label class="col-lg-4" style="text-align: left;">Nama Lengkap</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" value="' . $dt->nama . '" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12"><br></div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4" style="text-align: left;">Email</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" value="' . $dt->email . '" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12"><br></div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4" style="text-align: left;">No Telepon</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" value="' . $dt->no_telp . '" disabled>
                                                    </div>
                                                </div>
                                                <hr><h4>Info Pesanan</h4><hr> 
                                                <div class="form-group row">
                                                    ' . "<ol>" . implode("\n", $items) . "</ol>" . '
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <label class="col-lg-4" style="text-align: left;">Keterangan</label>
                                                    <div class="col-lg-8">
                                                        <textarea class="form-control" name="keterangan">' . $dt->keterangan . '</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                                <input type="hidden" class="form-control" name="id_transaksi" id="id_transaksi" value="' . $dt->id_transaksi . '">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            array_push($array["data"], array($no++, $dt->id_transaksi, date("d-m-Y", strtotime($dt->record)), "<b>$dt->nama</b>", "<b>Rp. " . $dt->total . "</b>", $span, $btn));
        }
        echo json_encode($array);
    }

    public function getTransaksiBatalAll()
    {
        $array["data"] = array();
        $get = $this->M_data->dataTransaksiBatalAll()->result();
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
                    $download = '<a href="' . $link . '" download> Download Foto</a>';
                } else {
                    $barang = $this->M_data->getWhere("tbl_barang", array("id_barang" => $item['pesanan']))->row();
                    $nm_pesanan = $barang->nm_barang;
                    $link =  base_url("/assets/img/barang/" . $barang->image);
                    $image = '<img src="' . $link . '" width="20%" style="float: left; padding-right: 10px;">';
                    $download = '';
                }
                $items[] = '<li>' . $image . '<h6 style="text-align: left;"><b>' . $nm_pesanan . '</b><br> x' . $item['qty'] . '<br>' . $download . '</h6></li><br><br><br>';
            }
            if ($dt->status == "PEN") {
                $span = '<span class="badge bg-warning text-dark">Pesanan Diproses</span>';
            } else if ($dt->status == "APP") {
                $span = '<span class="badge bg-success">Pesanan Selesai</span>';
            } else {
                $span = '<span class="badge bg-danger">Pesanan Dibatalkan</span>';
            }
            $btn = '<button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#basicModal' . $dt->id_transaksi . '">
                <i class="bi bi-info-circle"></i>
            </button>
            <div class="modal fade" id="basicModal' . $dt->id_transaksi . '" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><b>Detail Transaksi - </b><small>' . $dt->id_transaksi . '</small></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <form action="' . base_url("Admin/updateTransaksi") . '" method="POST" enctype="multipart/form-data">
                                    <div class="col-lg-12">
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <h4>Foto Bukti</h4><hr> 
                                                <div class="form-group row">
                                                    <img src="' . base_url("/assets/img/bukti_tf/" . $dt->bukti) . '" width="100%">
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <h4>Info Pembeli</h4><hr> 
                                                <div class="form-group row">
                                                    <label class="col-lg-4" style="text-align: left;">Nama Lengkap</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" value="' . $dt->nama . '" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12"><br></div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4" style="text-align: left;">Email</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" value="' . $dt->email . '" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12"><br></div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4" style="text-align: left;">No Telepon</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" class="form-control" value="' . $dt->no_telp . '" disabled>
                                                    </div>
                                                </div>
                                                <hr><h4>Info Pesanan</h4><hr> 
                                                <div class="form-group row">
                                                    ' . "<ol>" . implode("\n", $items) . "</ol>" . '
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <label class="col-lg-4" style="text-align: left;">Keterangan</label>
                                                    <div class="col-lg-8">
                                                        <textarea class="form-control" placeholder="..." name="keterangan"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <hr>
                                                <input type="hidden" class="form-control" name="id_transaksi" id="id_transaksi" value="' . $dt->id_transaksi . '">
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <button type="submit" name="btnSubmit" value="APP" class="btn btn-outline-success col-6"><i class="bi bi-check me-1"></i> Selesaikan Pesanan</button>
                                                    <button type="submit" name="btnSubmit" value="REJ" class="btn btn-outline-danger col-6"><i class="bi bi-x me-1"></i> Batalkan Pesanan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            array_push($array["data"], array($no++, $dt->id_transaksi, date("d-m-Y", strtotime($dt->record)), "<b>$dt->nama</b>", "<b>Rp. " . $dt->total . "</b>", $span, $dt->keterangan));
        }
        echo json_encode($array);
    }

    public function updateTransaksi()
    {
        $id_transaksi = $this->input->post("id_transaksi");
        $keterangan = $this->input->post("keterangan");
        $btn = $this->input->post("btnSubmit");
        if ($btn == "APP") {
            $status = "APP";
        } else {
            $status = "REJ";
        }
        $update = array("status" => $status, "keterangan" => $keterangan);
        $where = array("id_transaksi" => $id_transaksi);
        $this->M_data->updateData("tbl_transaksi", $update, $where);
        $this->session->set_flashdata("alert", '<script>$(document).ready(function(){Swal.fire({icon: "success",title: "Berhasil Dirubah!",showConfirmButton: false,timer: 1500,});});</script>');
        redirect(base_url("Admin/pages?p=" . base64_encode("transaksi")));
    }
}
