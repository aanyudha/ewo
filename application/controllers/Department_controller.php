<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department_controller extends Admin_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * departments
     */
    public function departments()
    {
        check_permission('departments');
        $data['title'] = trans("departments");
        $data['departments'] = $this->department_model->get_all_departments();
		$data['corps'] = $this->corp_model->get_all_corps();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/department/departments', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add department Post
     */
    public function add_department_post()
    {
        check_permission('departments');
        //validate inputs
        $this->form_validation->set_rules('name', trans("department_name"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('color', trans("department_color"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('visibility_cat', trans("department_visibility"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->department_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->department_model->add_department()) {
                //last id
                $last_id = $this->db->insert_id();

                //update slug
                $this->department_model->update_slug($last_id);

                $this->session->set_flashdata('success_form', trans("department") . " " . trans("msg_suc_added"));
                reset_cache_data_on_change();
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->department_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update department
     */
    public function update_department($id)
    {
        check_permission('departments');
        $data['title'] = trans("update_department");
        //get department
        $data['department'] = $this->department_model->get_department($id);
		$data['corps'] = $this->corp_model->get_all_corps();

        if (empty($data['department'])) {
            redirect($this->agent->referrer());
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/department/update_department', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update department Post
     */
    public function update_department_post()
    {
        check_permission('departments');
        //validate inputs
        $this->form_validation->set_rules('name', trans("department_name"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('color', trans("department_color"), 'required|xss_clean|max_length[200]');
		
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->department_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //department id
            $id = $this->input->post('id', true);
            $redirect_url = $this->input->post('redirect_url', true);
            if ($this->department_model->update_department($id)) {

                //update slug
                $this->department_model->update_slug($id);
                $this->session->set_flashdata('success', trans("department") . " " . trans("msg_suc_updated"));
                reset_cache_data_on_change();
                if (!empty($redirect_url)) {
                    redirect($redirect_url);
                } else {
                    redirect(admin_url() . 'departments');
                }

            } else {
                $this->session->set_flashdata('form_data', $this->department_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete department Post
     */
    public function delete_department_post()
    {
        if (!check_user_permission('departments')) {
            exit();
        }
        $id = $this->input->post('id', true);
        //check subdepartments
        if (count($this->department_model->get_subdepartments_by_parent_id($id)) > 0) {
            $this->session->set_flashdata('error', trans("msg_delete_subdepartments"));
            exit();
        }
        //check posts
        if ($this->post_admin_model->get_post_count_by_department($id) > 0) {
            $this->session->set_flashdata('error', trans("msg_delete_posts_department"));
            exit();
        }

        if ($this->department_model->delete_department($id)) {
            $this->session->set_flashdata('success', trans("department") . " " . trans("msg_suc_deleted"));
            reset_cache_data_on_change();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }


    /**
     * Subdepartments
     */
    public function subdepartments()
    {
        check_permission('departments');
        $data['title'] = trans("subdepartments");
        $data['departments'] = $this->department_model->get_all_subdepartments();
        $data['top_departments'] = $this->department_model->get_top_departments_by_lang($this->selected_lang->id);
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/department/subdepartments', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add Subdepartment Post
     */
    public function add_subdepartment_post()
    {
        check_permission('departments');
        //validate inputs
        $this->form_validation->set_rules('name', trans("department_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->department_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->department_model->add_subdepartment()) {
                $this->session->set_flashdata('success_form', trans("department") . " " . trans("msg_suc_added"));
                reset_cache_data_on_change();
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->department_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Subdepartment
     */
    public function update_subdepartment($id)
    {
        check_permission('departments');
        $data['title'] = trans("update_subdepartment");
        //get department
        $data['department'] = $this->department_model->get_department($id);

        if (empty($data['department'])) {
            redirect($this->agent->referrer());
        }

        $data['top_departments'] = $this->department_model->get_top_departments_by_lang($data['department']->lang_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/department/update_subdepartment', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Subdepartment Post
     */
    public function update_subdepartment_post()
    {
        check_permission('departments');
        //validate inputs
        $this->form_validation->set_rules('name', trans("department_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->department_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //department id
            $id = $this->input->post('id', true);
            if ($this->department_model->update_department($id)) {
                $this->session->set_flashdata('success', trans("department") . " " . trans("msg_suc_updated"));
                reset_cache_data_on_change();
                redirect(admin_url() . 'subdepartments');
            } else {
                $this->session->set_flashdata('form_data', $this->department_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    //get departments by language
    public function get_top_departments_by_lang()
    {
        $lang_id = $this->input->post('lang_id', true);
        if (!empty($lang_id)):
            $departments = $this->department_model->get_top_departments_by_lang($lang_id);
            foreach ($departments as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }


    //get subdepartments
    public function get_sub_departments()
    {
        $id = $this->input->post('parent_id', true);
        if (!empty($id)):
            $subdepartments = $this->department_model->get_subdepartments_by_parent_id($id);
            foreach ($subdepartments as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }


    /**
     * Gallery departments
     */
    public function gallery_departments()
    {
        check_permission('gallery');
        $data['title'] = trans("gallery_departments");
        $data['departments'] = $this->gallery_department_model->get_all_departments();
        $data['albums'] = $this->gallery_department_model->get_albums_by_selected_lang();
        $data['lang_search_column'] = 3;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/gallery/departments', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add Gallery department Post
     */
    public function add_gallery_department_post()
    {
        check_permission('gallery');
        //validate inputs
        $this->form_validation->set_rules('name', trans("department_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_department_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->gallery_department_model->add()) {
                $this->session->set_flashdata('success_form', trans("department") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_department_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Gallery department
     */
    public function update_gallery_department($id)
    {
        check_permission('gallery');
        $data['title'] = trans("update_department");
        //get department
        $data['department'] = $this->gallery_department_model->get_department($id);

        if (empty($data['department'])) {
            redirect($this->agent->referrer());
        }
        $data['albums'] = $this->gallery_department_model->get_albums_by_lang($data['department']->lang_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/gallery/update_department', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Gallery department Post
     */
    public function update_gallery_department_post()
    {
        check_permission('gallery');
        //validate inputs
        $this->form_validation->set_rules('name', trans("department_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_department_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //department id
            $id = $this->input->post('id', true);
            if ($this->gallery_department_model->update($id)) {
                $this->session->set_flashdata('success', trans("department") . " " . trans("msg_suc_updated"));
                redirect(admin_url() . 'gallery-departments');
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_department_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete Gallery department Post
     */
    public function delete_gallery_department_post()
    {
        if (!check_user_permission('gallery')) {
            exit();
        }
        $id = $this->input->post('id', true);
        //check if department has posts
        if ($this->gallery_model->get_department_image_count($id) > 0) {
            $this->session->set_flashdata('error', trans("msg_delete_images"));
            exit();
        }

        if ($this->gallery_department_model->delete($id)) {
            $this->session->set_flashdata('success', trans("department") . " " . trans("msg_suc_deleted"));
            exit();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            exit();
        }
    }

    //get departments by lang
    public function gallery_departments_by_lang()
    {
        $lang_id = $this->input->post('lang_id', true);
        if (!empty($lang_id)):
            $departments = $this->gallery_department_model->get_departments_by_lang($lang_id);
            foreach ($departments as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }

    //get departments by album
    public function gallery_departments_by_album()
    {
        $department_id = $this->input->post('department_id', true);
        if (!empty($department_id)):
            $departments = $this->gallery_department_model->get_departments_by_album($department_id);
            foreach ($departments as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }
	
	//get departments by corp
    public function get_department_by_corp()
    {
        $id = $this->input->post('corp_id', true);
		echo $id;
        if (!empty($id)):
            $departments = $this->department_model->get_departments_by_corp_id($id);
            foreach ($departments as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }

}
