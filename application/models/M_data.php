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

    function generateIdUser()
    {
        $this->db->select("(SELECT MAX(id_user) FROM tbl_user WHERE id_user LIKE 'USR-%') AS id", FALSE);
        $query = $this->db->get();
        $row = $query->row();
        $id = (int) substr($row->id, 4, 4);
        $id++;
        return $new = "USR-" . sprintf("%04s", $id);
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
}
