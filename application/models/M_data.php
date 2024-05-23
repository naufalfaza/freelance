<?php

class M_data extends CI_Model
{
    function cekUser($username)
    {
        $this->db->select("*");
        $this->db->from("tbl_user");
        $this->db->where("username='$username'");
        return $this->db->get();
    }

    // DATA
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
    // DATA END


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

    function hapus_data($table, $where)
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
    // GENERATE END
}
