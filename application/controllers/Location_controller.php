<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location_controller extends Admin_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * locations
     */
    public function locations()
    {
        check_permission('locations');
        $data['title'] = trans("locations");
        $data['locations'] = $this->location_model->get_all_locations();
        $data['corps'] = $this->corp_model->get_all_corps();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/location/locations', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add location Post
     */
    public function add_location_post()
    {
        check_permission('locations');
        //validate inputs
		if (is_admin()) {
        //$this->form_validation->set_rules('corp_name', trans("corp_name"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('name', trans("location_name"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('color', trans("location_color"), 'required|xss_clean|max_length[200]');
		}else{
		$this->form_validation->set_rules('name', trans("location_name"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('color', trans("location_color"), 'required|xss_clean|max_length[200]');
		}

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->location_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->location_model->add_location()) {
                //last id
                $last_id = $this->db->insert_id();

                //update slug
                $this->location_model->update_slug($last_id);

                $this->session->set_flashdata('success_form', trans("location") . " " . trans("msg_suc_added"));
                reset_cache_data_on_change();
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->location_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update location
     */
    public function update_location($id)
    {
        check_permission('locations');
        $data['title'] = trans("update_location");
        //get location
        $data['location'] = $this->location_model->get_location($id);
		$data['corps'] = $this->corp_model->get_all_corps();

        if (empty($data['location'])) {
            redirect($this->agent->referrer());
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/location/update_location', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update location Post
     */
    public function update_location_post()
    {
        check_permission('locations');
        //validate inputs
        $this->form_validation->set_rules('name', trans("location_name"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('color', trans("location_color"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->location_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //location id
            $id = $this->input->post('id', true);
            $redirect_url = $this->input->post('redirect_url', true);
            if ($this->location_model->update_location($id)) {

                //update slug
                $this->location_model->update_slug($id);
                $this->session->set_flashdata('success', trans("location") . " " . trans("msg_suc_updated"));
                reset_cache_data_on_change();
                if (!empty($redirect_url)) {
                    redirect($redirect_url);
                } else {
                    redirect(admin_url() . 'locations');
                }

            } else {
                $this->session->set_flashdata('form_data', $this->location_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete location Post
     */
    public function delete_location_post()
    {
        if (!check_user_permission('locations')) {
            exit();
        }
        $id = $this->input->post('id', true);
        //check sublocations
        if (count($this->location_model->get_sublocations_by_parent_id($id)) > 0) {
            $this->session->set_flashdata('error', trans("msg_delete_sublocations"));
            exit();
        }
        //check posts
        if ($this->post_admin_model->get_post_count_by_location($id) > 0) {
            $this->session->set_flashdata('error', trans("msg_delete_posts_location"));
            exit();
        }

        if ($this->location_model->delete_location($id)) {
            $this->session->set_flashdata('success', trans("location") . " " . trans("msg_suc_deleted"));
            reset_cache_data_on_change();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }


    /**
     * Sublocations
     */
    public function sublocations()
    {
        check_permission('locations');
        $data['title'] = trans("sublocations");
        $data['locations'] = $this->location_model->get_all_sublocations();
        $data['top_locations'] = $this->location_model->get_top_locations_by_lang($this->selected_lang->id);
		$data['corps'] = $this->corp_model->get_all_corps();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/location/sublocations', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add Sublocation Post
     */
    public function add_sublocation_post()
    {
        check_permission('locations');
        //validate inputs
        $this->form_validation->set_rules('name', trans("location_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->location_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->location_model->add_sublocation()) {
                $this->session->set_flashdata('success_form', trans("location") . " " . trans("msg_suc_added"));
                reset_cache_data_on_change();
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->location_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Sublocation
     */
    public function update_sublocation($id)
    {
        check_permission('locations');
        $data['title'] = trans("update_sublocation");
        //get location
        $data['location'] = $this->location_model->get_location($id);

        if (empty($data['location'])) {
            redirect($this->agent->referrer());
        }

        $data['top_locations'] = $this->location_model->get_top_locations_by_lang($data['location']->lang_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/location/update_sublocation', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Sublocation Post
     */
    public function update_sublocation_post()
    {
        check_permission('locations');
        //validate inputs
        $this->form_validation->set_rules('name', trans("location_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->location_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //location id
            $id = $this->input->post('id', true);
            if ($this->location_model->update_location($id)) {
                $this->session->set_flashdata('success', trans("location") . " " . trans("msg_suc_updated"));
                reset_cache_data_on_change();
                redirect(admin_url() . 'sublocations');
            } else {
                $this->session->set_flashdata('form_data', $this->location_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    //get locations by language
    public function get_top_locations_by_lang()
    {
        $lang_id = $this->input->post('lang_id', true);
        if (!empty($lang_id)):
            $locations = $this->location_model->get_top_locations_by_lang($lang_id);
            foreach ($locations as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }


    //get sublocations
    public function get_sub_locations()
    {
        $id = $this->input->post('parent_id', true);
        if (!empty($id)):
            $sublocations = $this->location_model->get_sublocations_by_parent_id($id);
            foreach ($sublocations as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }


    /**
     * Gallery locations
     */
    public function gallery_locations()
    {
        check_permission('gallery');
        $data['title'] = trans("gallery_locations");
        $data['locations'] = $this->gallery_location_model->get_all_locations();
        $data['albums'] = $this->gallery_location_model->get_albums_by_selected_lang();
        $data['lang_search_column'] = 3;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/gallery/locations', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add Gallery location Post
     */
    public function add_gallery_location_post()
    {
        check_permission('gallery');
        //validate inputs
        $this->form_validation->set_rules('name', trans("location_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_location_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->gallery_location_model->add()) {
                $this->session->set_flashdata('success_form', trans("location") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_location_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Gallery location
     */
    public function update_gallery_location($id)
    {
        check_permission('gallery');
        $data['title'] = trans("update_location");
        //get location
        $data['location'] = $this->gallery_location_model->get_location($id);

        if (empty($data['location'])) {
            redirect($this->agent->referrer());
        }
        $data['albums'] = $this->gallery_location_model->get_albums_by_lang($data['location']->lang_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/gallery/update_location', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Gallery location Post
     */
    public function update_gallery_location_post()
    {
        check_permission('gallery');
        //validate inputs
        $this->form_validation->set_rules('name', trans("location_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_location_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //location id
            $id = $this->input->post('id', true);
            if ($this->gallery_location_model->update($id)) {
                $this->session->set_flashdata('success', trans("location") . " " . trans("msg_suc_updated"));
                redirect(admin_url() . 'gallery-locations');
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_location_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete Gallery location Post
     */
    public function delete_gallery_location_post()
    {
        if (!check_user_permission('gallery')) {
            exit();
        }
        $id = $this->input->post('id', true);
        //check if location has posts
        if ($this->gallery_model->get_location_image_count($id) > 0) {
            $this->session->set_flashdata('error', trans("msg_delete_images"));
            exit();
        }

        if ($this->gallery_location_model->delete($id)) {
            $this->session->set_flashdata('success', trans("location") . " " . trans("msg_suc_deleted"));
            exit();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            exit();
        }
    }

    //get locations by lang
    public function gallery_locations_by_lang()
    {
        $lang_id = $this->input->post('lang_id', true);
        if (!empty($lang_id)):
            $locations = $this->gallery_location_model->get_locations_by_lang($lang_id);
            foreach ($locations as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }

    //get locations by album
    public function gallery_locations_by_album()
    {
        $location_id = $this->input->post('location_id', true);
        if (!empty($location_id)):
            $locations = $this->gallery_location_model->get_locations_by_album($location_id);
            foreach ($locations as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }
	
	//get location by corp
    public function get_location_by_corp()
    {
        $id = $this->input->post('corp_id', true);
		echo $id;
        if (!empty($id)):
            $locations = $this->location_model->get_locations_by_corp_id($id);
            foreach ($locations as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }

}
