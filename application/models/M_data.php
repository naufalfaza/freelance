<?php

class M_data extends CI_Model
{
    // CEK
    function cekUser($username)
    {
        $this->db->select("*");
        $this->db->from("tbl_user");
        $this->db->where("username='$username'");
        return $this->db->get();
    }
    // END CEK

    // DATA USER
    function dataUkuran()
    {
        $this->db->select("*");
        $this->db->from("tbl_ukuran");
        return $this->db->get();
    }

    function dataAtk()
    {
        $this->db->select("*");
        $this->db->from("tbl_barang");
        $this->db->where("jenis='ATK'");
        return $this->db->get();
    }

    function dataFrame()
    {
        $this->db->select("*");
        $this->db->from("tbl_barang");
        $this->db->where("jenis='FRAME'");
        return $this->db->get();
    }

    function dataTerlaris()
    {
        $this->db->select("*");
        $this->db->from("tbl_barang");
        $this->db->limit(6);
        return $this->db->get();
    }

    function dataKeranjang($id_user)
    {
        $this->db->select("*");
        $this->db->from("tbl_keranjang");
        $this->db->where("id_user='$id_user'");
        return $this->db->get();
    }

    function dataJmlKeranjang($id_user)
    {
        $this->db->select("COUNT(id_keranjang) as jumlah");
        $this->db->from("tbl_keranjang");
        $this->db->where("id_user='$id_user'");
        return $this->db->get();
    }

    function dataBank()
    {
        $this->db->select("*");
        $this->db->from("tbl_rekening");
        return $this->db->get();
    }

    function dataRekening($bank)
    {
        $this->db->select("*");
        $this->db->from("tbl_rekening");
        $this->db->where("id_rekening='$bank'");

        return $this->db->get();
    }

    function dataTransaksiProses($id_user)
    {
        $this->db->select("*");
        $this->db->from("tbl_transaksi");
        $this->db->where("id_user='$id_user' AND status='PEN'");
        $this->db->order_by("record", "DESC");
        return $this->db->get();
    }

    function dataTransaksiSelesai($id_user)
    {
        $this->db->select("*");
        $this->db->from("tbl_transaksi");
        $this->db->where("id_user='$id_user' AND status='APP'");
        return $this->db->get();
    }

    function dataTransaksiBatal($id_user)
    {
        $this->db->select("*");
        $this->db->from("tbl_transaksi");
        $this->db->where("id_user='$id_user' AND status='REJ'");
        return $this->db->get();
    }
    // DATA USER END

    // DATA ADMIN
    function dataPengguna()
    {
        $this->db->select("*");
        $this->db->from("tbl_user");
        return $this->db->get();
    }

    function dataBarang()
    {
        $this->db->select("*");
        $this->db->from("tbl_barang");
        $this->db->order_by("record", "desc");
        return $this->db->get();
    }
    // DATA ADMIN END

    // CRUD
    function getWhere($table, $data)
    {
        return $this->db->get_where($table, $data);
    }

    function inputData($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    function updateData($table, $data, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function deleteData($table, $where)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    // CRUD END

    // GENERATE
    function generateIdUser()
    {
        $this->db->select("(SELECT MAX(id_user) FROM tbl_user WHERE id_user LIKE 'USR-%') AS id", FALSE);
        $query = $this->db->get();
        $row = $query->row();
        $id = (int) substr($row->id, 4, 4);
        $id++;
        return $new = "USR-" . sprintf("%04s", $id);
    }

    function generateIdCetak()
    {
        $this->db->select("(SELECT MAX(id_cetak) FROM tbl_cetak WHERE id_cetak LIKE 'CTK-%') AS id", FALSE);
        $query = $this->db->get();
        $row = $query->row();
        $id = (int) substr($row->id, 4, 4);
        $id++;
        return $new = "CTK-" . sprintf("%04s", $id);
    }

    function generateIdKeranjang()
    {
        $this->db->select("(SELECT MAX(id_keranjang) FROM tbl_keranjang WHERE id_keranjang LIKE 'KRJ-%') AS id", FALSE);
        $query = $this->db->get();
        $row = $query->row();
        $id = (int) substr($row->id, 4, 4);
        $id++;
        return $new = "KRJ-" . sprintf("%04s", $id);
    }

    function generateIdTransaksi()
    {
        $date = date("ymd");
        $this->db->select("(SELECT MAX(id_transaksi) FROM tbl_transaksi WHERE id_transaksi LIKE 'TRS-$date%') AS id", FALSE);
        $query = $this->db->get();
        $row = $query->row();
        $id = (int) substr($row->id, 8, 4);
        $id++;
        return $new = "TRS-$date" . sprintf("%04s", $id);
    }

    function generateIdBarang()
    {
        $this->db->select("(SELECT MAX(id_barang) FROM tbl_barang WHERE id_barang LIKE 'BRG-%') AS id", FALSE);
        $query = $this->db->get();
        $row = $query->row();
        $id = (int) substr($row->id, 4, 4);
        $id++;
        return $new = "BRG-" . sprintf("%04s", $id);
    }
    // GENERATE END
}
