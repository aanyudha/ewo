<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model
{
	
	public function abc($id)
    {
		$id = sql_escape_number($id);
		$pwd = $this->input->post('password', true);
        $this->load->library('bcrypt');
        $data = array(
                'password' => $this->bcrypt->hash_password($pwd)
            );
            $this->db->where('id', $id);
            return $this->db->update('users', $data);
       
    }
    

}