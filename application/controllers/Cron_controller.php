<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_controller extends Home_Core_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Check Scheduled Posts
     */
    public function check_scheduled_posts()
    {
        $ini = $this->post_admin_model->check_scheduled_posts();
		if (!empty($ini)) {
				foreach ($ini as $post) {
					$this->post_admin_model->scheduled_posts_insert_posts($post);
					//untuk publish scheduled wo lagi
					$this->post_admin_model->update_sch_wo($post->published_at,$post->intervale,$post->id);
				}
		}
    }

}
