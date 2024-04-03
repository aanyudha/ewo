<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Corp_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'name' => $this->input->post('name', true),
            'corp_code' => $this->input->post('corp_code', true),
            'status' => $this->input->post('status', true),
            'corp_order' => $this->input->post('corp_order', true),
        );
        return $data;
    }

    //add corp
    public function add_corp()
    {
        $data = $this->input_values();

        $data['created_at'] = date('Y-m-d H:i:s');

        return $this->db->insert('corps', $data);
    }


    //get corp
    public function get_corp($id)
    {
        $id = sql_escape_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('corps');
        return $query->row();
    }

    //get all top corps
    public function get_all_corps()
    {
        $this->db->order_by('corp_order');
        $query = $this->db->get('corps');
        return $query->result();
    }

    //get corps
    public function get_corps()
    {
        $this->db->order_by('corp_order');
        $query = $this->db->get('corps');
        return $query->result();
    }

    //get top corps
    public function get_top_corps()
    {
        $this->db->where('corps.lang_id', $this->selected_lang->id);
        $this->db->order_by('corp_order');
        $query = $this->db->get('corps');
        return $query->result();
    }
	
    //get top corps
    public function get_top_corps_by_lang($lang_id)
    {
        $lang_id = sql_escape_number($lang_id);
        $this->db->where('corps.lang_id', $lang_id);
        $this->db->order_by('corp_order');
        $query = $this->db->get('corps');
        return $query->result();
    }

    //get all top corps
    public function get_all_top_corps()
    {
        $query = $this->db->get('corps');
        return $query->result();
    }


    //get sitemap corps
    public function get_sitemap_corps()
    {
        $this->db->order_by('corp_order');
        $query = $this->db->get('corps');
        return $query->result();
    }

    //get corp count
    public function get_corp_count()
    {
        $query = $this->db->get('corps');
        return $query->num_rows();
    }

    //update corp
    public function update_corp($id)
    {
        $id = sql_escape_number($id);
        $data = $this->input_values();

      /*  if (empty($data["name_slug"])) {
            //slug for title
            $data["name_slug"] = str_slug(trim($data["name"]));
        } else {
            $data["name_slug"] = str_slug(trim($data["name_slug"]));
        } 

        $corp = helper_get_corp($id);
        //check if parent
        if ($corp->parent_id == 0) {
            $this->update_subcorps_color($id, $data["color"]);
        } else {
            $corp = helper_get_corp($data["parent_id"]);
            if ($corp) {
                $data["color"] = $corp->color;
            } else {
                $data["color"] = "#0a0a0a";
            }
        }*/

        $this->db->where('id', $id);
        return $this->db->update('corps', $data);
    }

    //update subcorp
    public function update_subcorp($id)
    {
        $id = sql_escape_number($id);
        $data = $this->input_values();

        if (empty($data["name_slug"])) {
            //slug for title
            $data["name_slug"] = str_slug(trim($data["name"]));
        } else {
            $data["name_slug"] = str_slug(trim($data["name_slug"]));
        }

        $this->db->where('id', $id);
        return $this->db->update('corps', $data);
    }

    //update subcorp color
    public function update_subcorps_color($parent_id, $color)
    {
        $parent_id = sql_escape_number($parent_id);
        $corps = $this->get_subcorps_by_parent_id($parent_id);
        if (!empty($corps)) {
            foreach ($corps as $item) {
                $data = array(
                    'color' => $color,
                );
                $this->db->where('parent_id', $parent_id);
                return $this->db->update('corps', $data);
            }
        }
    }

    //delete corp
    public function delete_corp($id)
    {
        $id = sql_escape_number($id);
        $corp = $this->get_corp($id);

        if (!empty($corp)) {
            $this->db->where('id', $id);
            return $this->db->delete('corps');
        } else {
            return false;
        }
    }
	
	//get corp for header
    public function get_corp_for_header()
    {
		if(!is_admin()){
		$corplogin = $this->auth_model->get_corp_id_by_user_login();
        $this->db->where('id', $corplogin);
        $query = $this->db->get('corps');
        return $query->row()->name;
		}
    }
	
	public function get_corp_for_table()
    {
		if(!is_admin()){
		$corplogin = $this->auth_model->get_corp_id_by_user_login();
        $this->db->where('id', $corplogin);
        $query = $this->db->get('corps');
        return $query;
		}
    }

}