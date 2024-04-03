<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location_model extends CI_Model
{
    //input values
    public function input_values()
    {
        $data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'name' => $this->input->post('name', true),
            'name_slug' => $this->input->post('name_slug', true),
            'parent_id' => $this->input->post('parent_id', true),
            'color' => $this->input->post('color', true),
            'location_order' => $this->input->post('location_order', true),
            'corp_id' => $this->input->post('corp_id', true),
        );
        return $data;
    }

    //add location
    public function add_location()
    {
        $data = $this->input_values();

        if (empty($data["name_slug"])) {
            //slug for title
            $data["name_slug"] = str_slug(trim($data["name"]));
        } else {
            $data["name_slug"] = str_slug(trim($data["name_slug"]));
        }
        $data['created_at'] = date('Y-m-d H:i:s');

        return $this->db->insert('locations', $data);
    }

    //add sublocation
    public function add_sublocation()
    {
        $data = $this->input_values();

        $location = helper_get_location($data["parent_id"]);

        if ($location) {
            $data["color"] = $location->color;
        } else {
            $data["color"] = "#0a0a0a";
        }

        if (empty($data["name_slug"])) {
            //slug for title
            $data["name_slug"] = str_slug(trim($data["name"]));
        } else {
            $data["name_slug"] = str_slug(trim($data["name_slug"]));
        }
        $data['created_at'] = date('Y-m-d H:i:s');

        return $this->db->insert('locations', $data);
    }

    //update slug
    public function update_slug($id)
    {
        $id = sql_escape_number($id);
        $location = $this->get_location($id);

        if (empty($location->name_slug) || $location->name_slug == "-") {
            $data = array(
                'name_slug' => $location->id
            );
            $this->db->where('id', $id);
            $this->db->update('locations', $data);
        } else {
            if ($this->check_is_slug_unique($location->name_slug, $id) == true) {
                $data = array(
                    'name_slug' => $location->name_slug . "-" . $location->id
                );

                $this->db->where('id', $id);
                $this->db->update('locations', $data);
            }
        }
    }

    //check slug
    public function check_is_slug_unique($slug, $id)
    {
        $id = sql_escape_number($id);
        $slug = sql_escape_str($slug);
        $this->db->where('locations.name_slug', $slug);
        $this->db->where('locations.id !=', $id);
        $query = $this->db->get('locations');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    //get location
    public function get_location($id)
    {
        $id = sql_escape_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('locations');
        return $query->row();
    }

    //get location by slug
    public function get_location_by_slug($slug)
    {
        $slug = sql_escape_str($slug);
        $this->db->where('name_slug', $slug);
        $query = $this->db->get('locations');
        return $query->row();
    }

    //check location slug
    public function check_location_slug($slug, $id)
    {
        $id = sql_escape_number($id);
        $slug = sql_escape_str($slug);
        $this->db->where('name_slug', $slug);
        $this->db->where('id !=', $id);
        $query = $this->db->get('locations');
        return $query->row();
    }

    //get all top locations
    public function get_all_locations()
    {
		$corplogin = $this->auth_model->get_corp_id_by_user_login(); 
		if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		}
        $this->db->where('parent_id', 0);
        $this->db->order_by('location_order');
        $query = $this->db->get('locations');
        return $query->result();
    }

    //get locations
    public function get_locations()
    {
		$corplogin = $this->auth_model->get_corp_id_by_user_login();
        if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		}
        $this->db->order_by('location_order');
        $query = $this->db->get('locations');
        return $query->result();
    }

    //get top locations
    public function get_top_locations()
    {
		$corplogin = $this->auth_model->get_corp_id_by_user_login();
        if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		}
        $this->db->where('locations.lang_id', $this->selected_lang->id);
        $this->db->where('parent_id', 0);
        $this->db->order_by('location_order');
        $query = $this->db->get('locations');
        return $query->result();
    }
	
    //get top locations
    public function get_top_locations_by_lang($lang_id)
    {
        $lang_id = sql_escape_number($lang_id);
		$corplogin = $this->auth_model->get_corp_id_by_user_login();
        if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		}
        $this->db->where('locations.lang_id', $lang_id);
        $this->db->where('parent_id', 0);
        $this->db->order_by('location_order');
        $query = $this->db->get('locations');
        return $query->result();
    }

    //get sublocations
    public function get_sublocations()
    {
		$corplogin = $this->auth_model->get_corp_id_by_user_login();
        if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		}
        $this->db->where('locations.lang_id', $this->selected_lang->id);
        $this->db->where('parent_id !=', 0);
        $this->db->order_by('location_order');
        $query = $this->db->get('locations');
        return $query->result();
    }

    //get all top locations
    public function get_all_top_locations()
    {
		$corplogin = $this->auth_model->get_corp_id_by_user_login();
        if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		}
        $this->db->where('parent_id', 0);
        $query = $this->db->get('locations');
        return $query->result();
    }
	
	//get parent id by location on corp
	public function get_parent_id_by_loc_corp()
    {
		$corplogin = $this->auth_model->get_corp_id_by_user_login(); 
		if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		}
        //$this->db->where('parent_id', 0);
        $this->db->order_by('location_order');
        $query = $this->db->get('locations');
        return $query->row()->id;
    }
	
    //get all sublocations
    public function get_all_sublocations()
    {
		if (!is_admin()) {
		$corplogin = $this->auth_model->get_corp_id_by_user_login(); 
		$sql = "SELECT * FROM locations WHERE parent_id IN (SELECT id FROM locations WHERE corp_id = ?)";
        $query = $this->db->query($sql, array($corplogin));
		}else{
        $this->db->where('parent_id !=', 0);
        $this->db->order_by('location_order');
		 $query = $this->db->get('locations');
		}
        return $query->result();
    }

    //get sublocations by id
    public function get_sublocations_by_parent_id($parent_id)
    {
        $parent_id = sql_escape_number($parent_id);
        $this->db->where('parent_id', $parent_id);
        $query = $this->db->get('locations');
        return $query->result();
    }

    //get sitemap locations
    public function get_sitemap_locations()
    {
        $this->db->order_by('location_order');
        $query = $this->db->get('locations');
        return $query->result();
    }

    //get location count
    public function get_location_count()
    {
		$corplogin = $this->auth_model->get_corp_id_by_user_login();
        if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		}
        $query = $this->db->get('locations');
        return $query->num_rows();
    }

    //update location
    public function update_location($id)
    {
        $id = sql_escape_number($id);
        $data = $this->input_values();

        if (empty($data["name_slug"])) {
            //slug for title
            $data["name_slug"] = str_slug(trim($data["name"]));
        } else {
            $data["name_slug"] = str_slug(trim($data["name_slug"]));
        }

        $location = helper_get_location($id);
        //check if parent
        if ($location->parent_id == 0) {
            $this->update_sublocations_color($id, $data["color"]);
        } else {
            $location = helper_get_location($data["parent_id"]);
            if ($location) {
                $data["color"] = $location->color;
            } else {
                $data["color"] = "#0a0a0a";
            }
        }

        $this->db->where('id', $id);
        return $this->db->update('locations', $data);
    }

    //update sublocation
    public function update_sublocation($id)
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
        return $this->db->update('locations', $data);
    }

    //update sublocation color
    public function update_sublocations_color($parent_id, $color)
    {
        $parent_id = sql_escape_number($parent_id);
        $locations = $this->get_sublocations_by_parent_id($parent_id);
        if (!empty($locations)) {
            foreach ($locations as $item) {
                $data = array(
                    'color' => $color,
                );
                $this->db->where('parent_id', $parent_id);
                return $this->db->update('locations', $data);
            }
        }
    }

    //delete location
    public function delete_location($id)
    {
        $id = sql_escape_number($id);
        $location = $this->get_location($id);

        if (!empty($location)) {
            $this->db->where('id', $id);
            return $this->db->delete('locations');
        } else {
            return false;
        }
    }
	
	
	//get locations by corp
    public function get_locations_by_corp_id($corp_id)
    {
        $corp_id = sql_escape_number($corp_id);
        $this->db->where('corp_id', $corp_id);
        $this->db->where('parent_id', '0');
        $query = $this->db->get('locations');
        return $query->result();
    }

}