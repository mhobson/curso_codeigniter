<?php

class User extends CI_Model
{
    // insert into database
    public function new_user($data)
    {
        $this->db->insert('users', $data);
    }
}
