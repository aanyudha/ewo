<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Corp_controller extends Admin_Core_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * corps
     */
    public function corps()
    {
        //check_permission('corps');
        $data['title'] = trans("corps");
        $data['corps'] = $this->corp_model->get_all_corps();
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/corp/corps', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add corp Post
     */
    public function add_corp_post()
    {
        check_permission('corps');
        //validate inputs
        $this->form_validation->set_rules('name', trans("corp_name"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('corp_code', trans("corp_code"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->corp_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->corp_model->add_corp()) {
                //last id
                //$last_id = $this->db->insert_id();

                //update slug
                //$this->corp_model->update_slug($last_id);

                $this->session->set_flashdata('success_form', trans("corp") . " " . trans("msg_suc_added"));
                reset_cache_data_on_change();
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->corp_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update corp
     */
    public function update_corp($id)
    {
        check_permission('corps');
        $data['title'] = trans("update_corp");
        //get corp
        $data['corp'] = $this->corp_model->get_corp($id);

        if (empty($data['corp'])) {
            redirect($this->agent->referrer());
        }

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/corp/update_corp', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update corp Post
     */
    public function update_corp_post()
    {
        check_permission('corps');
        //validate inputs
        $this->form_validation->set_rules('name', trans("corp_name"), 'required|xss_clean|max_length[200]');
        $this->form_validation->set_rules('corp_code', trans("corp_code"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->corp_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //corp id
            $id = $this->input->post('id', true);
            $redirect_url = $this->input->post('redirect_url', true);
            if ($this->corp_model->update_corp($id)) {

                //update slug
               // $this->corp_model->update_slug($id);
                $this->session->set_flashdata('success', trans("corp") . " " . trans("msg_suc_updated"));
                reset_cache_data_on_change();
                if (!empty($redirect_url)) {
                    redirect($redirect_url);
                } else {
                    redirect(admin_url() . 'corps');
                }

            } else {
                $this->session->set_flashdata('form_data', $this->corp_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete corp Post
     */
    public function delete_corp_post()
    {
        if (!check_user_permission('corps')) {
            exit();
        }
        $id = $this->input->post('id', true);
        //check subcorps
        if (count($this->corp_model->get_subcorps_by_parent_id($id)) > 0) {
            $this->session->set_flashdata('error', trans("msg_delete_subcorps"));
            exit();
        }
        //check posts
        if ($this->post_admin_model->get_post_count_by_corp($id) > 0) {
            $this->session->set_flashdata('error', trans("msg_delete_posts"));
            exit();
        }

        if ($this->corp_model->delete_corp($id)) {
            $this->session->set_flashdata('success', trans("corp") . " " . trans("msg_suc_deleted"));
            reset_cache_data_on_change();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
        }
    }


    /**
     * Subcorps
     */
    public function subcorps()
    {
        check_permission('corps');
        $data['title'] = trans("subcorps");
        $data['corps'] = $this->corp_model->get_all_subcorps();
        $data['top_corps'] = $this->corp_model->get_top_corps_by_lang($this->selected_lang->id);
        $data['lang_search_column'] = 2;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/corp/subcorps', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add Subcorp Post
     */
    public function add_subcorp_post()
    {
        check_permission('corps');
        //validate inputs
        $this->form_validation->set_rules('name', trans("corp_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->corp_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->corp_model->add_subcorp()) {
                $this->session->set_flashdata('success_form', trans("corp") . " " . trans("msg_suc_added"));
                reset_cache_data_on_change();
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->corp_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Subcorp
     */
    public function update_subcorp($id)
    {
        check_permission('corps');
        $data['title'] = trans("update_subcorp");
        //get corp
        $data['corp'] = $this->corp_model->get_corp($id);

        if (empty($data['corp'])) {
            redirect($this->agent->referrer());
        }

        $data['top_corps'] = $this->corp_model->get_top_corps_by_lang($data['corp']->lang_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/corp/update_subcorp', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Subcorp Post
     */
    public function update_subcorp_post()
    {
        check_permission('corps');
        //validate inputs
        $this->form_validation->set_rules('name', trans("corp_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->corp_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //corp id
            $id = $this->input->post('id', true);
            if ($this->corp_model->update_corp($id)) {
                $this->session->set_flashdata('success', trans("corp") . " " . trans("msg_suc_updated"));
                reset_cache_data_on_change();
                redirect(admin_url() . 'subcorps');
            } else {
                $this->session->set_flashdata('form_data', $this->corp_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }

    //get corps by language
    public function get_top_corps_by_lang()
    {
        $lang_id = $this->input->post('lang_id', true);
        if (!empty($lang_id)):
            $corps = $this->corp_model->get_top_corps_by_lang($lang_id);
            foreach ($corps as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }


    //get subcorps
    public function get_sub_corps()
    {
        $id = $this->input->post('parent_id', true);
        if (!empty($id)):
            $subcorps = $this->corp_model->get_subcorps_by_parent_id($id);
            foreach ($subcorps as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }


    /**
     * Gallery corps
     */
    public function gallery_corps()
    {
        check_permission('gallery');
        $data['title'] = trans("gallery_corps");
        $data['corps'] = $this->gallery_corp_model->get_all_corps();
        $data['albums'] = $this->gallery_corp_model->get_albums_by_selected_lang();
        $data['lang_search_column'] = 3;

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/gallery/corps', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Add Gallery corp Post
     */
    public function add_gallery_corp_post()
    {
        check_permission('gallery');
        //validate inputs
        $this->form_validation->set_rules('name', trans("corp_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors_form', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_corp_model->input_values());
            redirect($this->agent->referrer());
        } else {
            if ($this->gallery_corp_model->add()) {
                $this->session->set_flashdata('success_form', trans("corp") . " " . trans("msg_suc_added"));
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_corp_model->input_values());
                $this->session->set_flashdata('error_form', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Update Gallery corp
     */
    public function update_gallery_corp($id)
    {
        check_permission('gallery');
        $data['title'] = trans("update_corp");
        //get corp
        $data['corp'] = $this->gallery_corp_model->get_corp($id);

        if (empty($data['corp'])) {
            redirect($this->agent->referrer());
        }
        $data['albums'] = $this->gallery_corp_model->get_albums_by_lang($data['corp']->lang_id);

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/gallery/update_corp', $data);
        $this->load->view('admin/includes/_footer');
    }


    /**
     * Update Gallery corp Post
     */
    public function update_gallery_corp_post()
    {
        check_permission('gallery');
        //validate inputs
        $this->form_validation->set_rules('name', trans("corp_name"), 'required|xss_clean|max_length[200]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('errors', validation_errors());
            $this->session->set_flashdata('form_data', $this->gallery_corp_model->input_values());
            redirect($this->agent->referrer());
        } else {
            //corp id
            $id = $this->input->post('id', true);
            if ($this->gallery_corp_model->update($id)) {
                $this->session->set_flashdata('success', trans("corp") . " " . trans("msg_suc_updated"));
                redirect(admin_url() . 'gallery-corps');
            } else {
                $this->session->set_flashdata('form_data', $this->gallery_corp_model->input_values());
                $this->session->set_flashdata('error', trans("msg_error"));
                redirect($this->agent->referrer());
            }
        }
    }


    /**
     * Delete Gallery corp Post
     */
    public function delete_gallery_corp_post()
    {
        if (!check_user_permission('gallery')) {
            exit();
        }
        $id = $this->input->post('id', true);
        //check if corp has posts
        if ($this->gallery_model->get_corp_image_count($id) > 0) {
            $this->session->set_flashdata('error', trans("msg_delete_images"));
            exit();
        }

        if ($this->gallery_corp_model->delete($id)) {
            $this->session->set_flashdata('success', trans("corp") . " " . trans("msg_suc_deleted"));
            exit();
        } else {
            $this->session->set_flashdata('error', trans("msg_error"));
            exit();
        }
    }

    //get corps by lang
    public function gallery_corps_by_lang()
    {
        $lang_id = $this->input->post('lang_id', true);
        if (!empty($lang_id)):
            $corps = $this->gallery_corp_model->get_corps_by_lang($lang_id);
            foreach ($corps as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }

    //get corps by album
    public function gallery_corps_by_album()
    {
        $corp_id = $this->input->post('corp_id', true);
        if (!empty($corp_id)):
            $corps = $this->gallery_corp_model->get_corps_by_album($corp_id);
            foreach ($corps as $item) {
                echo '<option value="' . $item->id . '">' . $item->name . '</option>';
            }
        endif;
    }

}
