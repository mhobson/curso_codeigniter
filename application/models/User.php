<?php

class User extends CI_Model
{
    // insert into database
    public function new_user($data)
    {
        $this->db->insert('users', $data);
    }

    // get cities from state
    public function get_cities($id_state)
    {
        $this->db->where('id_state', $id_state);
        $data = $this->db->get('cities')->result();

        return $data;
    }

    // get selected user
    public function get_user($encode)
    {
        $this->db->where('encode', $encode);
        $result = $this->db->get('users')->result();

        return $result;
    }
}
