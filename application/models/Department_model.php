<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department_model extends CI_Model
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
            'department_order' => $this->input->post('department_order', true),
            'visibility' => $this->input->post('visibility_cat', true),
			'corp_id' => $this->input->post('corp_id', true),
        );
        return $data;
    }

    //add department
    public function add_department()
    {
        $data = $this->input_values();

        if (empty($data["name_slug"])) {
            //slug for title
            $data["name_slug"] = str_slug(trim($data["name"]));
        } else {
            $data["name_slug"] = str_slug(trim($data["name_slug"]));
        }
        $data['created_at'] = date('Y-m-d H:i:s');

        return $this->db->insert('departments', $data);
    }

    //add subdepartment
    public function add_subdepartment()
    {
        $data = $this->input_values();

        $department = helper_get_department($data["parent_id"]);

        if ($department) {
            $data["color"] = $department->color;
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

        return $this->db->insert('departments', $data);
    }

    //update slug
    public function update_slug($id)
    {
        $id = sql_escape_number($id);
        $department = $this->get_department($id);

        if (empty($department->name_slug) || $department->name_slug == "-") {
            $data = array(
                'name_slug' => $department->id
            );
            $this->db->where('id', $id);
            $this->db->update('departments', $data);
        } else {
            if ($this->check_is_slug_unique($department->name_slug, $id) == true) {
                $data = array(
                    'name_slug' => $department->name_slug . "-" . $department->id
                );

                $this->db->where('id', $id);
                $this->db->update('departments', $data);
            }
        }
    }

    //check slug
    public function check_is_slug_unique($slug, $id)
    {
        $id = sql_escape_number($id);
        $slug = sql_escape_str($slug);
        $this->db->where('departments.name_slug', $slug);
        $this->db->where('departments.id !=', $id);
        $query = $this->db->get('departments');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    //get department
    public function get_department($id)
    {
        $id = sql_escape_number($id);
        $this->db->where('id', $id);
        $query = $this->db->get('departments');
        return $query->row();
    }

    //get department by slug
    public function get_department_by_slug($slug)
    {
        $slug = sql_escape_str($slug);
        $this->db->where('name_slug', $slug);
        $query = $this->db->get('departments');
        return $query->row();
    }

    //check department slug
    public function check_department_slug($slug, $id)
    {
        $id = sql_escape_number($id);
        $slug = sql_escape_str($slug);
        $this->db->where('name_slug', $slug);
        $this->db->where('id !=', $id);
        $query = $this->db->get('departments');
        return $query->row();
    }

    //get all top departments
    public function get_all_departments()
    {
		$corplogin = $this->auth_model->get_corp_id_by_user_login(); 
		$deptlogin = $this->auth_model->get_dept_id_bylogin(); 
		if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		//$this->db->where('dept_id', $deptlogin);
		}
        $this->db->where('parent_id', 0);
        $this->db->order_by('department_order');
        $query = $this->db->get('departments');
        return $query->result();
    }

    //get departments
    public function get_departments()
    {
		$corplogin = $this->auth_model->get_corp_id_by_user_login(); 
		$deptlogin = $this->auth_model->get_dept_id_bylogin(); 
		if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		//$this->db->where('dept_id', $deptlogin);
		}
        $this->db->order_by('department_order');
        $query = $this->db->get('departments');
        return $query->result();
    }

    //get top departments
    public function get_top_departments()
    {
		$corplogin = $this->auth_model->get_corp_id_by_user_login(); 
		$deptlogin = $this->auth_model->get_dept_id_bylogin();
		if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		//$this->db->where('dept_id', $deptlogin);
		}
        $this->db->where('departments.lang_id', $this->selected_lang->id);
        $this->db->where('parent_id', 0);
        $this->db->order_by('department_order');
        $query = $this->db->get('departments');
        return $query->result();
    }
	
	//get top departments khusus new ketika bikin wo awal
    public function get_top_departments_new()
    {
		$corplogin = $this->auth_model->get_corp_id_by_user_login(); 
		$deptlogin = $this->auth_model->get_dept_id_bylogin();
		if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		//$this->db->where('dept_id', $deptlogin);
		}
        $this->db->where('id', 1);
        $this->db->where('departments.lang_id', $this->selected_lang->id);
        $this->db->where('parent_id', 0);
        $this->db->order_by('department_order');
        $query = $this->db->get('departments');
        return $query->result();
    }

    //get top departments
    public function get_top_departments_by_lang($lang_id)
    {
        $lang_id = sql_escape_number($lang_id);
		$corplogin = $this->auth_model->get_corp_id_by_user_login(); 
		$deptlogin = $this->auth_model->get_dept_id_bylogin();
		if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		//$this->db->where('dept_id', $deptlogin);
		}
        $this->db->where('departments.lang_id', $lang_id);
        $this->db->where('departments.visibility', 1);
        $this->db->where('parent_id', 0);
        $this->db->order_by('department_order');
        $query = $this->db->get('departments');
        return $query->result();
    }
	
	//get top departments closed
    public function get_top_departments_closed_by_lang($lang_id)
    {
        $lang_id = sql_escape_number($lang_id);
		$corplogin = $this->auth_model->get_corp_id_by_user_login(); 
		$deptlogin = $this->auth_model->get_dept_id_bylogin();
		if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		//$this->db->where('dept_id', $deptlogin);
		}
        $this->db->where('departments.lang_id', $lang_id);
        $this->db->where('departments.visibility', 0);
        $this->db->where('parent_id', 0);
        $this->db->order_by('department_order');
        $query = $this->db->get('departments');
        return $query->result();
    }

    //get subdepartments
    public function get_subdepartments()
    {
		$corplogin = $this->auth_model->get_corp_id_by_user_login(); 
		if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		}
        $this->db->where('departments.lang_id', $this->selected_lang->id);
        $this->db->where('parent_id !=', 0);
        $this->db->order_by('department_order');
        $query = $this->db->get('departments');
        return $query->result();
    }

    //get all top departments
    public function get_all_top_departments()
    {
		$corplogin = $this->auth_model->get_corp_id_by_user_login(); 
		if (!is_admin()) { 
		$this->db->where('corp_id', $corplogin);
		}
        $this->db->where('parent_id', 0);
        $query = $this->db->get('departments');
        return $query->result();
    }

    //get all subdepartments
    public function get_all_subdepartments()
    {
        $this->db->where('parent_id !=', 0);
        $query = $this->db->get('departments');
        return $query->result();
    }

    //get subdepartments by id
    public function get_subdepartments_by_parent_id($parent_id)
    {
        $parent_id = sql_escape_number($parent_id);
        $this->db->where('parent_id', $parent_id);
        $query = $this->db->get('departments');
        return $query->result();
    }

    //get sitemap departments
    public function get_sitemap_departments()
    {
        $this->db->order_by('department_order');
        $query = $this->db->get('departments');
        return $query->result();
    }

    //get department count
    public function get_department_count()
    {
        $query = $this->db->get('departments');
        return $query->num_rows();
    }

    //update department
    public function update_department($id)
    {
        $id = sql_escape_number($id);
        $data = $this->input_values();

        if (empty($data["name_slug"])) {
            //slug for title
            $data["name_slug"] = str_slug(trim($data["name"]));
        } else {
            $data["name_slug"] = str_slug(trim($data["name_slug"]));
        }

        $department = helper_get_department($id);
        //check if parent
        if ($department->parent_id == 0) {
            $this->update_subdepartments_color($id, $data["color"]);
        } else {
            $department = helper_get_department($data["parent_id"]);
            if ($department) {
                $data["color"] = $department->color;
            } else {
                $data["color"] = "#0a0a0a";
            }
        }

        $this->db->where('id', $id);
        return $this->db->update('departments', $data);
    }

    //update subdepartment
    public function update_subdepartment($id)
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
        return $this->db->update('departments', $data);
    }

    //update subdepartment color
    public function update_subdepartments_color($parent_id, $color)
    {
        $parent_id = sql_escape_number($parent_id);
        $departments = $this->get_subdepartments_by_parent_id($parent_id);
        if (!empty($departments)) {
            foreach ($departments as $item) {
                $data = array(
                    'color' => $color,
                );
                $this->db->where('parent_id', $parent_id);
                return $this->db->update('departments', $data);
            }
        }
    }

    //delete department
    public function delete_department($id)
    {
        $id = sql_escape_number($id);
        $department = $this->get_department($id);

        if (!empty($department)) {
            $this->db->where('id', $id);
            return $this->db->delete('departments');
        } else {
            return false;
        }
    }
	
	//get departments by corp
    public function get_departments_by_corp_id($corp_id)
    {
        $corp_id = sql_escape_number($corp_id);
        $this->db->where('corp_id', $corp_id);
        $query = $this->db->get('departments');
        return $query->result();
    }

}