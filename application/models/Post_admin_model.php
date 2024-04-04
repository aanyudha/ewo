<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Post_admin_model extends CI_Model
	{
		
		//input values
		public function input_values()
		{
			$data = array(
            'lang_id' => $this->input->post('lang_id', true),
            'title' => trim($this->input->post('title', true)),
            'summary' => $this->input->post('summary', true),
            'category_id' => $this->input->post('category_id', true),
			'location_id' => $this->input->post('location_id', true),
            'sublocation_id' => $this->input->post('sublocation_id', true),
			'role_id' => $this->input->post('role_id', true),
            'visibility' => $this->input->post('visibility', true),
            'image_description' => $this->input->post('image_description', true),
			);
			return $data;
		}
		
		//input values 2
		public function input_values2($post)
		{
			$data2 = array(
            'lang_id' => $post->lang_id,
            'title' => $post->title,
            'summary' => $post->summary,
            'category_id' => $post->category_id,
			'location_id' => $post->location_id,
            'sublocation_id' => $post->sublocation_id,
            'image_big' => $post->image_big,
            'image_default' => $post->image_default,
            'image_slider' => $post->image_slider,
            'image_mid' => $post->image_mid,
            'image_small' => $post->image_small,
            'image_mime' => $post->image_mime,
            'is_scheduled' => 0,
            'intervale' => 0,
            'visibility' => $post->visibility,
            'post_type' => $post->post_type,
            'video_path' => $post->video_path,
            'image_url' =>$post->image_url,
            'video_embed_code' => $post->video_embed_code,
            'dept_id' => 0,
			'corp_id' => $post->corp_id,
            'user_id' => $post->user_id,
			'role_id' => $post->role_id,
			'assign_to' => $post->assign_to,
			'status' => $post->status,
			'image_description' => $post->image_description,
			'edited_by' => $post->edited_by,
			'edited_at' => $post->edited_at,
            'created_at' => $post->created_at,
			);
			return $data2;
		}
		
		//add post
		public function add_post($post_type)
		{
			$data = $this->set_data2($post_type);
			$is_scheduled = $this->input->post('scheduled_post', true);
			$date_published = $this->input->post('date_published', true);
			$corp_id = $this->input->post('corp_id', true);
			$dept_id = $this->input->post('dept_id', true);
			
			$data['is_scheduled'] = 0;
			if ($is_scheduled) {
				$data["is_scheduled"] = 1;
				$data['intervale'] = $this->input->post('intervale', true);
			}
			
			if (!empty($date_published)) {
				$data["created_at"] = $date_published;
				} else {
				$data['created_at'] = date('Y-m-d H:i:s');
			}
		
			$data["post_type"] = $post_type;
			if (!is_admin()) {
				$data['corp_id'] = user()->corp_id;
				}else{
				$data['corp_id'] = $corp_id;
			}
			if (!is_admin()) {
					if ($is_scheduled) {
						$data['dept_id'] = '0';
					}else{
						$data['dept_id'] = user()->dept_id;
					}
				}else{
				$data['dept_id'] = $dept_id;
			}
			$data['user_id'] = user()->id;
			$data['status'] = $this->input->post('status', true);
			
			//add post image
			$data["image_big"] = "";
			$data["image_default"] = "";
			$data["image_slider"] = "";
			$data["image_mid"] = "";
			$data["image_small"] = "";
			$data["image_mime"] = "jpg";
			$data["image_url"] = "";
			$image = $this->file_model->get_image($this->input->post('post_image_id', true));
			if (!empty($image)) {
				$data["image_big"] = $image->image_big;
				$data["image_default"] = $image->image_default;
				$data["image_slider"] = $image->image_slider;
				$data["image_mid"] = $image->image_mid;
				$data["image_small"] = $image->image_small;
				$data["image_mime"] = $image->image_mime;
			}
			if (!empty($this->input->post('image_url', true))) {
				$data["image_url"] = $this->input->post('image_url', true);
			}
			return $this->db->insert('posts', $data);
			
		}
		
		//add post logs
		public function add_post_logs($post_type,$post_id)
		{
			$data = $this->set_data2($post_type);
			$is_scheduled = $this->input->post('scheduled_post', true);
			$date_published = $this->input->post('date_published', true);
			$corp_id = $this->input->post('corp_id', true);
			$dept_id = $this->input->post('dept_id', true);
			
			$data['is_scheduled'] = 0;
			if ($is_scheduled) {
				$data["is_scheduled"] = 1;
				$data['intervale'] = $this->input->post('intervale', true);
			}
			
			if (!empty($date_published)) {
				$data["created_at"] = $date_published;
				} else {
				$data['created_at'] = date('Y-m-d H:i:s');
			}
			
			$data["post_type"] = $post_type;
			$data["post_id"] = $post_id;
			if (!is_admin()) {
				$data['corp_id'] = user()->corp_id;
				}else{
				$data['corp_id'] = $corp_id;
			}
			if (!is_admin()) {
					if ($is_scheduled) {
						$data['dept_id'] = '0';
					}else{
						$data['dept_id'] = user()->dept_id;
					}
				}else{
				$data['dept_id'] = $dept_id;
			}
			$data['user_id'] = user()->id;
			$data['status'] = $this->input->post('status', true);
			
			//add post image
			$data["image_big"] = "";
			$data["image_default"] = "";
			$data["image_slider"] = "";
			$data["image_mid"] = "";
			$data["image_small"] = "";
			$data["image_mime"] = "jpg";
			$data["image_url"] = "";
			$image = $this->file_model->get_image($this->input->post('post_image_id', true));
			if (!empty($image)) {
				$data["image_big"] = $image->image_big;
				$data["image_default"] = $image->image_default;
				$data["image_slider"] = $image->image_slider;
				$data["image_mid"] = $image->image_mid;
				$data["image_small"] = $image->image_small;
				$data["image_mime"] = $image->image_mime;
			}
			if (!empty($this->input->post('image_url', true))) {
				$data["image_url"] = $this->input->post('image_url', true);
			}
			
			return $this->db->insert('posts_logs', $data);
			
		}
		
		//update post
		public function update_post($id, $post_type)
		{
			$data = $this->set_data($post_type);
			$data["created_at"] = $this->input->post('date_published', true);
			$data["dept_id"] = $this->input->post('dept_id', true);
			$data["corp_id"] = $this->input->post('corp_id', true);
			$data["user_id"] = $this->input->post('user_id', true);
			$data["role_id"] = $this->input->post('role_id', true);
			$data["assign_to"] = $this->input->post('assign_to', true);
			$data["edited_by"] = $this->auth_model->get_user_id();
			$data["edited_at"] = date('Y-m-d H:i:s');
			
			$data['is_scheduled'] = $this->input->post('scheduled_post', true);
			if (empty($data['is_scheduled'])) {
				$data['is_scheduled'] = 0;
			}
			
			$publish = $this->input->post('publish', true);
			if (!empty($publish) && $publish == 1) {
				$data["status"] = 1;
			}
			
			//update post image
			$image = $this->file_model->get_image($this->input->post('post_image_id', true));
			if (!empty($image)) {
				$data["image_big"] = $image->image_big;
				$data["image_default"] = $image->image_default;
				$data["image_slider"] = $image->image_slider;
				$data["image_mid"] = $image->image_mid;
				$data["image_small"] = $image->image_small;
				$data["image_mime"] = $image->image_mime;
			}
			
			$data["image_url"] = $this->input->post('image_url', true);
			if (!empty($data["image_url"])) {
				$data["image_big"] = "";
				$data["image_default"] = "";
				$data["image_slider"] = "";
				$data["image_mid"] = "";
				$data["image_small"] = "";
				$data["image_mime"] = "jpg";
			}
			
			$this->db->where('id', $id);
			return $this->db->update('posts', $data);
		}
		
		//update post untuk logs
		public function update_post_logs($id, $post_type)
		{
			$data = $this->set_data($post_type);
			//$data['created_at'] = date('Y-m-d H:i:s');
			
			$data["created_at"] = $this->input->post('date_published', true);
			$data["dept_id"] = $this->input->post('dept_id', true);
			$data["corp_id"] = $this->input->post('corp_id', true);
			$data["user_id"] = $this->input->post('user_id', true);
			$data["role_id"] = $this->input->post('role_id', true);
			$data["assign_to"] = $this->input->post('assign_to', true);
			$data["summary"] = $this->input->post('summary_edit', true);
			$data["post_id"] = $id;
			$data["edited_by"] = $this->auth_model->get_user_id();
			$data["edited_at"] = date('Y-m-d H:i:s');
			
			$data['is_scheduled'] = $this->input->post('scheduled_post', true);
			if (empty($data['is_scheduled'])) {
				$data['is_scheduled'] = 0;
			}
			
			$publish = $this->input->post('publish', true);
			if (!empty($publish) && $publish == 1) {
				$data["status"] = 1;
			}
			
			//update post image
			$image = $this->file_model->get_image($this->input->post('post_image_id', true));
			if (!empty($image)) {
				$data["image_big"] = $image->image_big;
				$data["image_default"] = $image->image_default;
				$data["image_slider"] = $image->image_slider;
				$data["image_mid"] = $image->image_mid;
				$data["image_small"] = $image->image_small;
				$data["image_mime"] = $image->image_mime;
			}
			
			$data["image_url"] = $this->input->post('image_url', true);
			if (!empty($data["image_url"])) {
				$data["image_big"] = "";
				$data["image_default"] = "";
				$data["image_slider"] = "";
				$data["image_mid"] = "";
				$data["image_small"] = "";
				$data["image_mime"] = "jpg";
			}
			return $this->db->insert('posts_logs', $data);
		}
		//set post data
		public function set_data2($post_type)
		{
			$data = $this->input_values();
			return $data;
		}
		//set post data
		public function set_data($post_type)
		{
			$data = $this->input_values();
			
			/*if (!isset($data['is_featured'])) {
				$data['is_featured'] = 0;
				}
				if (!isset($data['is_breaking'])) {
				$data['is_breaking'] = 0;
				}
				if (!isset($data['is_slider'])) {
				$data['is_slider'] = 0;
				}
				if (!isset($data['is_recommended'])) {
				$data['is_recommended'] = 0;
				}
				if (!isset($data['need_auth'])) {
				$data['need_auth'] = 0;
				}
				if (!isset($data['show_right_column'])) {
				$data['show_right_column'] = 0;
			}
			
			if (empty($data["title_slug"])) {
				//slug for title
				$data["title_slug"] = str_slug(trim($data["title"]));
				} else {
				$data["title_slug"] = str_slug(trim($data["title_slug"]));
			}
			if ($post_type == "video") {
				$data["video_embed_code"] = $this->input->post('video_embed_code', true);
				$data['video_path'] = $this->input->post('video_path', true);
			}*/
			
			return $data;
		}
		
		
		//update slug
		public function update_slug($id)
		{
			$post = $this->get_post($id);
			//$slug = $post->title_slug;
			$new_slug = $post->title_slug;
			//check page
			//$page = $this->page_model->get_page($slug);
			//if (!empty($page)) {
			//	$new_slug = $slug . "-" . $post->id;
			//}
			//if ($this->check_is_slug_unique($slug, $id) == true) {
			//	$new_slug = $slug . "-" . $post->id;
			//}
			//$data = array(
            //'title_slug' => $new_slug
			//);
			$this->db->where('id', $id);
			return $this->db->update('posts', $data);
		}
		
		//check slug
		public function check_is_slug_unique($slug, $id)
		{
			$this->db->where('posts.title_slug', $slug);
			$this->db->where('posts.id !=', $id);
			$query = $this->db->get('posts');
			if ($query->num_rows() > 0) {
				return true;
				} else {
				return false;
			}
		}
		
		//check post exists
		public function check_is_post_exists($title, $title_hash)
		{
			$this->db->where('posts.title', $title);
			$this->db->or_where('posts.title_hash', $title_hash);
			$query = $this->db->get('posts');
			if ($query->num_rows() > 0) {
				return true;
				} else {
				return false;
			}
		}
		//==== UNTUK COUNT DI HOME ====
		//get post
		public function get_post($id)
		{
			$this->db->where('posts.id', $id);
			$query = $this->db->get('posts');
			return $query->row();
		}
		
		//get posts count
		public function get_posts_count()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if (!check_user_permission('manage_all_posts')) {
				$this->db->where('posts.user_id', user()->id);
				$this->db->where('posts.corp_id', $corplogin);
				}elseif ( $idlogin != '1' && $rolelogin != '4' && $rolelogin != '7'){//nek dudu admin dab, admin ki bebas :)
				$this->db->where('posts.corp_id', $corplogin);
				$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
				$this->db->where($where);
				}elseif($rolelogin == '7'){
				$this->db->where('posts.corp_id', $corplogin);
			}
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get pending posts count
		public function get_pending_posts_count()
		{
			if (!check_user_permission('manage_all_posts')) {
				$this->db->where('posts.user_id', user()->id);
			}
			
			$this->db->where('posts.visibility', 0);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get drafts count
		public function get_drafts_count()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if (!check_user_permission('manage_all_posts')) {
				$this->db->where('posts.user_id', user()->id);
				$this->db->where('posts.corp_id', $corplogin);
				}elseif ( $idlogin != '1' && $rolelogin != '4' && $rolelogin != '7'){//nek dudu admin dab, admin ki bebas :)
				$this->db->where('posts.corp_id', $corplogin);
				$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
				$this->db->where($where);
				}elseif($rolelogin == '7'){
				$this->db->where('posts.corp_id', $corplogin);
			}
			
			$this->db->where('posts.status', 0);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get scheduled posts count
		public function get_scheduled_posts_count()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if (!check_user_permission('manage_all_posts')) {
				$this->db->where('posts.user_id', user()->id);
				$this->db->where('posts.corp_id', $corplogin);
				}elseif ( $idlogin != '1' && $rolelogin != '4' && $rolelogin != '7'){//nek dudu admin dab, admin ki bebas :)
				$this->db->where('posts.corp_id', $corplogin);
				$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
				$this->db->where($where);
				}elseif($rolelogin == '7'){
				$this->db->where('posts.corp_id', $corplogin);
			}
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 1);
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		// ======= INCOMING WO COUNT ======= //
		//get WO count by category
		public function get_posts_count_new()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if($rolelogin == '1' ){//adminstrator
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$rolenya = $this->input->get('role', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){ //admin corp
					$this->db->where('posts.corp_id', $corplogin);
					$rolenya = $this->input->get('role', true);
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.role_id='$rolelogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.user_id='$idlogin' AND posts.role_id='$rolelogin' AND posts.dept_id='$deptlogin')"; //artinya, tidak mungkin ada untuk user biasa
					$this->db->where($where);
					//var_dump('3');
				}
			$this->db->where('posts.category_id', 1);
			
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get WO count by category
		public function get_posts_count_pending()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if($rolelogin == '1' ){//adminstrator
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$rolenya = $this->input->get('role', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){ //admin corp
					$this->db->where('posts.corp_id', $corplogin);
					$rolenya = $this->input->get('role', true);
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.role_id='$rolelogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.user_id='$idlogin' AND posts.role_id='$rolelogin' AND posts.dept_id='$deptlogin')"; //artinya, tidak mungkin ada untuk user biasa
					$this->db->where($where);
					//var_dump('3');
				}
			
			$this->db->where('posts.category_id', 5);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get WO count by category
		public function get_posts_count_waiting()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if($rolelogin == '1' ){//adminstrator
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$rolenya = $this->input->get('role', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){ //admin corp
					$this->db->where('posts.corp_id', $corplogin);
					$rolenya = $this->input->get('role', true);
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.role_id='$rolelogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.user_id='$idlogin' AND posts.role_id='$rolelogin' AND posts.dept_id='$deptlogin')"; //artinya, tidak mungkin ada untuk user biasa
					$this->db->where($where);
					//var_dump('3');
				}
			
			$this->db->where('posts.category_id', 3);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get WO count by category
		public function get_posts_count_closed()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if($rolelogin == '1' ){//adminstrator
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$rolenya = $this->input->get('role', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){ //admin corp
					$this->db->where('posts.corp_id', $corplogin);
					$rolenya = $this->input->get('role', true);
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.role_id='$rolelogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.user_id='$idlogin' AND posts.role_id='$rolelogin' AND posts.dept_id='$deptlogin')"; //artinya, tidak mungkin ada untuk user biasa
					$this->db->where($where);
					//var_dump('3');
				}
			
			$this->db->where('posts.category_id', 4);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get WO count by category
		public function get_posts_count_progress()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if($rolelogin == '1' ){//adminstrator
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$rolenya = $this->input->get('role', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){ //admin corp
					$this->db->where('posts.corp_id', $corplogin);
					$rolenya = $this->input->get('role', true);
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.role_id='$rolelogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.user_id='$idlogin' AND posts.role_id='$rolelogin' AND posts.dept_id='$deptlogin')"; //artinya, tidak mungkin ada untuk user biasa
					$this->db->where($where);
					//var_dump('3');
				}
			
			$this->db->where('posts.category_id', 2);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get WO count by category
		public function get_post_count_notyetassigned()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if (!check_user_permission('manage_all_posts')) {
				$this->db->where('posts.user_id', user()->id);
				$this->db->where('posts.corp_id', $corplogin);
				}elseif ( $idlogin != '1' && $rolelogin != '4' && $rolelogin != '7'){//nek dudu admin dab, admin ki bebas :)
				$this->db->where('posts.corp_id', $corplogin);
				$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
				$this->db->where($where);
				}elseif($rolelogin == '7'){
				$this->db->where('posts.corp_id', $corplogin);
			}
			
			$this->db->where('posts.assign_to', NULL);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//reopen count
		public function get_post_count_reopen()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if($rolelogin == '1' ){//adminstrator
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$rolenya = $this->input->get('role', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){ //admin corp
					$this->db->where('posts.corp_id', $corplogin);
					$rolenya = $this->input->get('role', true);
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.role_id='$rolelogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.user_id='$idlogin' AND posts.role_id='$rolelogin' AND posts.dept_id='$deptlogin')"; //artinya, tidak mungkin ada untuk user biasa
					$this->db->where($where);
					//var_dump('3');
				}
			
			$this->db->where('posts.category_id', 6);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		//BASED ON ROLE
		//NEW
		public function get_posts_count_new_eng()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();

					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.role_id='3')";
					$this->db->where($where);
					//var_dump('2');
				
			$this->db->where('posts.category_id', 1);
			
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			$query = $this->db->get('posts');
			return $query->num_rows();
		}

		public function get_posts_count_new_it()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();

					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.role_id='5')";
					$this->db->where($where);
					//var_dump('2');
				
			$this->db->where('posts.category_id', 1);
			
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			$query = $this->db->get('posts');
			return $query->num_rows();
		}

		public function get_posts_count_new_hk()
		{
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->db->where('posts.corp_id', $corplogin);
			$where = "(posts.role_id='6')";
			$this->db->where($where);
			//var_dump('2');
			$this->db->where('posts.category_id', 1);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		//PENDING
		public function get_posts_count_pending_it()
		{
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->db->where('posts.corp_id', $corplogin);
			$this->db->where('posts.role_id', 5);
			$this->db->where('posts.category_id', 5);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		public function get_posts_count_pending_hk()
		{
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->db->where('posts.corp_id', $corplogin);
			$this->db->where('posts.role_id', 6);
			$this->db->where('posts.category_id', 5);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		public function get_posts_count_pending_eng()
		{
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->db->where('posts.corp_id', $corplogin);
			$this->db->where('posts.role_id', 3);
			$this->db->where('posts.category_id', 5);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		//CLOSED
		public function get_posts_count_closed_it()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->db->where('posts.corp_id', $corplogin);
			$this->db->where('posts.role_id', 5);			
			$this->db->where('posts.category_id', 4);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		public function get_posts_count_closed_hk()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->db->where('posts.corp_id', $corplogin);
			$this->db->where('posts.role_id', 6);			
			$this->db->where('posts.category_id', 4);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		public function get_posts_count_closed_eng()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->db->where('posts.corp_id', $corplogin);
			$this->db->where('posts.role_id', 3);			
			$this->db->where('posts.category_id', 4);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		//PROGRESS
		public function get_posts_count_progress_it()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
					$this->db->where('posts.corp_id', $corplogin);
					$this->db->where('posts.role_id', 5);
			$this->db->where('posts.category_id', 2);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		public function get_posts_count_progress_hk()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
					$this->db->where('posts.corp_id', $corplogin);
					$this->db->where('posts.role_id', 6);
			$this->db->where('posts.category_id', 2);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		public function get_posts_count_progress_eng()
		{
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
					$this->db->where('posts.corp_id', $corplogin);
					$this->db->where('posts.role_id', 3);
			$this->db->where('posts.category_id', 2);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		//WAITING
		public function get_posts_count_waiting_it()
		{
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->db->where('posts.corp_id', $corplogin);
			$this->db->where('posts.role_id', 3);
			$this->db->where('posts.category_id', 3);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		public function get_posts_count_waiting_hk()
		{
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->db->where('posts.corp_id', $corplogin);
			$this->db->where('posts.role_id', 6);
			$this->db->where('posts.category_id', 3);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		public function get_posts_count_waiting_eng()
		{
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->db->where('posts.corp_id', $corplogin);
			$this->db->where('posts.role_id', 3);
			$this->db->where('posts.category_id', 3);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		// ======= OUTGOING WO COUNT ======= //
		//get WO count by category
		public function get_posts_out_count_new()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if($rolelogin == '1'){ //adminstrator 
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$deptnya = $this->input->get('department', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){//admin corp
					$this->db->where('posts.corp_id', $corplogin);
					$deptnya = $this->input->get('department', true);
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' AND posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('3');
				}
			$this->db->where('posts.category_id', 1);
			
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get WO count by category
		public function get_posts_out_count_pending()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if($rolelogin == '1'){ //adminstrator 
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$deptnya = $this->input->get('department', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){//admin corp
					$this->db->where('posts.corp_id', $corplogin);
					$deptnya = $this->input->get('department', true);
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' AND posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('3');
				}
			
			$this->db->where('posts.category_id', 5);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get WO count by category
		public function get_posts_out_count_waiting()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if($rolelogin == '1'){ //adminstrator 
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$deptnya = $this->input->get('department', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){//admin corp
					$this->db->where('posts.corp_id', $corplogin);
					$deptnya = $this->input->get('department', true);
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' AND posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('3');
				}
			
			$this->db->where('posts.category_id', 3);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get WO count by category
		public function get_posts_out_count_closed()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if($rolelogin == '1'){ //adminstrator 
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$deptnya = $this->input->get('department', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){//admin corp
					$this->db->where('posts.corp_id', $corplogin);
					$deptnya = $this->input->get('department', true);
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' AND posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('3');
				}
			
			$this->db->where('posts.category_id', 4);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get WO count by category
		public function get_posts_out_count_progress()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if($rolelogin == '1'){ //adminstrator 
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$deptnya = $this->input->get('department', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){//admin corp
					$this->db->where('posts.corp_id', $corplogin);
					$deptnya = $this->input->get('department', true);
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' AND posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('3');
				}
			
			$this->db->where('posts.category_id', 2);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get WO count by category
		public function get_post_out_count_notyetassigned()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if (!check_user_permission('manage_all_posts')) {
				$this->db->where('posts.user_id', user()->id);
				$this->db->where('posts.corp_id', $corplogin);
				}elseif ( $idlogin != '1' && $rolelogin != '4' && $rolelogin != '7'){//nek dudu admin dab, admin ki bebas :)
				$this->db->where('posts.corp_id', $corplogin);
				$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
				$this->db->where($where);
				}elseif($rolelogin == '7'){
				$this->db->where('posts.corp_id', $corplogin);
			}
			
			$this->db->where('posts.assign_to', NULL);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//reopen count
		public function get_post_out_count_reopen()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			if($rolelogin == '1'){ //adminstrator 
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$deptnya = $this->input->get('department', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){//admin corp
					$this->db->where('posts.corp_id', $corplogin);
					$deptnya = $this->input->get('department', true);
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' AND posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('3');
				}
			
			$this->db->where('posts.category_id', 6);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//filter by values
		public function filter_posts()
		{
			$data = array(
            'lang_id' => $this->input->get('lang_id', true),
            'post_type' => $this->input->get('post_type', true),
            'user' => $this->input->get('user', true),
            'category' => $this->input->get('category', true),
            'dateChoice' => $this->input->get('dateChoice', true),
            'tglAwal' => $this->input->get('tglAwal', true),
            'tglAkhir' => $this->input->get('tglAkhir', true),
            'subcategory' => $this->input->get('subcategory', true),
            'q' => $this->input->get('q', true),
			);
			
			$data['q'] = trim($data['q']);
			$data['user_id'] = "";
			
			/*if (check_user_permission('manage_all_posts')) {
				if (!empty($data['user'])) {
					$data['user_id'] = $data['user'];
				}
				} else {
				$data['user_id'] = user()->id;
			}*/

			//JIKA USER SAJA TETEP BISA LIHAT SATU DEPT
			$data['user_id'] = $data['user'];
			
			if (!empty($data['lang_id'])) {
				$this->db->where('posts.lang_id', $data['lang_id']);
			}
			if (!empty($data['post_type'])) {
				$this->db->where('posts.post_type', $data['post_type']);
			}
			
			if (!empty($data['category'])) {
				$this->db->where('posts.category_id', $data['category']);
			}

			if (!empty($data['dateChoice']) && !empty($data['tglAwal']) && !empty($data['tglAkhir'])) {
				if ($data['dateChoice']=='created_at') {
					$this->db->where('created_at BETWEEN "'. date('Y-m-d', strtotime($data['tglAwal'])). '" and "'. date('Y-m-d', strtotime($data['tglAkhir'])).'"');
					}elseif($data['dateChoice']=='edited_at') {
					$this->db->where('edited_at BETWEEN "'. date('Y-m-d', strtotime($data['tglAwal'])). '" and "'. date('Y-m-d', strtotime($data['tglAkhir'])).'"');
				}
			}
			
			if (!empty($data['q'])) {
				$this->db->like('posts.title', $data['q']);
			}
			
			if (!empty($data['user_id'])) {
				$this->db->where('posts.user_id', $data['user_id']);
			}
		}
		
		//filter by list
		public function filter_posts_list($list)
		{
			if (!empty($list)) {
				if ($list == "slider_posts") {
					$this->db->where('posts.is_slider', 1);
				}
				if ($list == "featured_posts") {
					$this->db->where('posts.is_featured', 1);
				}
				if ($list == "breaking_news") {
					$this->db->where('posts.is_breaking', 1);
				}
				if ($list == "recommended_posts") {
					$this->db->where('posts.is_recommended', 1);
				}
			}
		}
		
		//get paginated posts
		public function get_paginated_posts($per_page, $offset, $list)
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->filter_posts();
			$this->filter_posts_list($list);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
			if ( $idlogin != '1' && $rolelogin != '7'){//nek dudu admin dab, admin ki bebas :)
				$this->db->where('posts.corp_id', $corplogin);
				//$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
				$where = "(posts.role_id='$rolelogin')";
				$this->db->where($where);
			}
			if($rolelogin == '7'){
				$this->db->where('posts.corp_id', $corplogin);
				//$this->db->where('posts.dept_id', $deptlogin);
				$where = "(posts.role_id='$rolelogin')";
				$this->db->where($where);
			}
			$this->db->order_by('posts.category_id', 'ASC');
			$this->db->order_by('posts.created_at', 'DESC');
			
			$this->db->limit($per_page, $offset);
			$query = $this->db->get('posts');
			return $query->result();
		}
		
		//get paginated posts count
		public function get_paginated_posts_count($list)
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->filter_posts();
			$this->filter_posts_list($list);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			if ( $idlogin != '1' && $rolelogin != '7'){//nek dudu admin dab, admin ki bebas :)
				$this->db->where('posts.corp_id', $corplogin);
				//$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
				$where = "(posts.role_id='$rolelogin')";
				$this->db->where($where);
			}
			if($rolelogin == '7'){
				$this->db->where('posts.corp_id', $corplogin);
				$this->db->where('posts.dept_id', $deptlogin);
			}
			$this->db->order_by('posts.category_id', 'ASC');
			$this->db->order_by('posts.created_at', 'DESC');
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		// untuk INCOMING WO
		//get paginated posts
		public function get_paginated_posts_in($per_page, $offset, $list)
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->filter_posts();
			$this->filter_posts_list($list);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
				if($rolelogin == '1' ){//administrator
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$rolenya = $this->input->get('role', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){ //admin corp atau GM
					$this->db->where('posts.corp_id', $corplogin);
					$rolenya = $this->input->get('role', true);
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.role_id='$rolelogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.user_id='$idlogin' AND posts.role_id='$rolelogin' AND posts.dept_id='$deptlogin')"; //artinya, tidak mungkin ada untuk user biasa
					$this->db->where($where);
					//var_dump('3');
				}
			
			$this->db->order_by('posts.category_id', 'ASC');
			$this->db->order_by('posts.created_at', 'DESC');
			
			$this->db->limit($per_page, $offset);
			$query = $this->db->get('posts');
			return $query->result();
		}
		
		//get paginated posts count
		public function get_paginated_posts_in_count($list)
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->filter_posts();
			$this->filter_posts_list($list);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
				if($rolelogin == '1' ){//adminstrator
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$rolenya = $this->input->get('role', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){ //admin corp atau GM
					$this->db->where('posts.corp_id', $corplogin);
					$rolenya = $this->input->get('role', true);
					if (!empty($rolenya)) {
					$this->db->where('posts.role_id', $rolenya);
					//var_dump('rolenya = '.$rolenya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.role_id='$rolelogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					$where = "(posts.user_id='$idlogin' AND posts.role_id='$rolelogin' AND posts.dept_id='$deptlogin')"; //artinya, tidak mungkin ada untuk user biasa
					$this->db->where($where);
					//var_dump('3');
				}
			$this->db->order_by('posts.category_id', 'ASC');
			$this->db->order_by('posts.created_at', 'DESC');
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		// untuk OUTGOING WO
		//get paginated posts
		public function get_paginated_posts_out($per_page, $offset, $list)
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->filter_posts();
			$this->filter_posts_list($list);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
				if($rolelogin == '1'){ //adminstrator 
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$deptnya = $this->input->get('department', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){//admin corp atau GM
					$this->db->where('posts.corp_id', $corplogin);
					$deptnya = $this->input->get('department', true);
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' AND posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('3');
				}
			
			$this->db->order_by('posts.category_id', 'ASC');
			$this->db->order_by('posts.created_at', 'DESC');
			
			$this->db->limit($per_page, $offset);
			$query = $this->db->get('posts');
			return $query->result();
		}
		
		//get paginated posts count
		public function get_paginated_posts_out_count($list)
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->filter_posts();
			$this->filter_posts_list($list);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			
				if($rolelogin == '1'){ //adminstrator 
					//loss doll
					$corpnya = $this->input->get('corpnya', true);
					$deptnya = $this->input->get('department', true);
					if (!empty($corpnya)) {
					$this->db->where('posts.corp_id', $corpnya);
					//var_dump('asd = '.$corpnya);
					}
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
				}elseif($rolelogin == '7' || $rolelogin == '8'){//admin corp atau GM
					$this->db->where('posts.corp_id', $corplogin);
					$deptnya = $this->input->get('department', true);
					if (!empty($deptnya)) {
					$this->db->where('posts.dept_id', $deptnya);
					//var_dump('rolenya = '.$deptnya);
					}
					//var_dump('1');
				}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('2');
				}elseif($rolelogin == '4'){//user biasa
					$this->db->where('posts.corp_id', $corplogin);
					//$where = "(posts.user_id='$idlogin' AND posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
					$this->db->where($where);
					//var_dump('3');
				}
			
			$this->db->order_by('posts.category_id', 'ASC');
			$this->db->order_by('posts.created_at', 'DESC');
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get paginated pending posts
		public function get_paginated_pending_posts($per_page, $offset)
		{
			$this->filter_posts();
			$this->db->where('posts.visibility', 0);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			$this->db->order_by('posts.created_at', 'DESC');
			$this->db->limit($per_page, $offset);
			$query = $this->db->get('posts');
			return $query->result();
		}
		
		//get paginated pending posts count
		public function get_paginated_pending_posts_count()
		{
			$this->filter_posts();
			$this->db->where('posts.visibility', 0);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get paginated scheduled posts
		public function get_paginated_scheduled_posts($per_page, $offset)
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->filter_posts();
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 1);
			if ( $idlogin != '1' && $rolelogin != '7'){//nek dudu admin dab, admin ki bebas :)
				$this->db->where('posts.corp_id', $corplogin);
				$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
				$this->db->where($where);
			}
			if($rolelogin == '7' || $rolelogin == '8'){
				$this->db->where('posts.corp_id', $corplogin);
			}
			$this->db->order_by('posts.created_at', 'DESC');
			$this->db->limit($per_page, $offset);
			$query = $this->db->get('posts');
			return $query->result();
		}
		
		//get paginated scheduled posts count
		public function get_paginated_scheduled_posts_count()
		{
			$idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->filter_posts();
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 1);
			if ( $idlogin != '1' && $rolelogin != '7'){//nek dudu admin dab, admin ki bebas :)
				$this->db->where('posts.corp_id', $corplogin);
				$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
				$this->db->where($where);
			}
			if($rolelogin == '7' || $rolelogin == '8'){
				$this->db->where('posts.corp_id', $corplogin);
			}
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get paginated drafts
		public function get_paginated_drafts($per_page, $offset)
		{
		    $idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->filter_posts();
			$this->db->where('posts.status !=', 1);
			if($rolelogin == '1'){ //adminstrator 
				//loss doll
				$corpnya = $this->input->get('corpnya', true);
				$deptnya = $this->input->get('department', true);
				if (!empty($corpnya)) {
				$this->db->where('posts.corp_id', $corpnya);
				//var_dump('asd = '.$corpnya);
				}
				if (!empty($deptnya)) {
				$this->db->where('posts.dept_id', $deptnya);
				//var_dump('rolenya = '.$deptnya);
				}
			}elseif($rolelogin == '7' || $rolelogin == '8'){//admin corp atau GM
				$this->db->where('posts.corp_id', $corplogin);
				$deptnya = $this->input->get('department', true);
				if (!empty($deptnya)) {
				$this->db->where('posts.dept_id', $deptnya);
				//var_dump('rolenya = '.$deptnya);
				}
				//var_dump('1');
			}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
				$this->db->where('posts.corp_id', $corplogin);
				//$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
				$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
				$this->db->where($where);
				//var_dump('2');
			}elseif($rolelogin == '4'){//user biasa
				$this->db->where('posts.corp_id', $corplogin);
				//$where = "(posts.user_id='$idlogin' AND posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
				$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
				$this->db->where($where);
				//var_dump('3');
			}
			$this->db->order_by('posts.created_at', 'DESC');
			$this->db->limit($per_page, $offset);
			$query = $this->db->get('posts');
			return $query->result();
		}
		
		//get paginated drafts count
		public function get_paginated_drafts_count()
		{
		    $idlogin = $this->auth_model->get_user_id();
			$rolelogin = $this->auth_model->get_role_id_bylogin();
			$deptlogin = $this->auth_model->get_dept_id_bylogin();
			$corplogin = $this->auth_model->get_corp_id_by_user_login();
			$this->filter_posts();
			$this->db->where('posts.status !=', 1);
			if($rolelogin == '1'){ //adminstrator 
				//loss doll
				$corpnya = $this->input->get('corpnya', true);
				$deptnya = $this->input->get('department', true);
				if (!empty($corpnya)) {
				$this->db->where('posts.corp_id', $corpnya);
				//var_dump('asd = '.$corpnya);
				}
				if (!empty($deptnya)) {
				$this->db->where('posts.dept_id', $deptnya);
				//var_dump('rolenya = '.$deptnya);
				}
			}elseif($rolelogin == '7' || $rolelogin == '8'){//admin corp atau GM
				$this->db->where('posts.corp_id', $corplogin);
				$deptnya = $this->input->get('department', true);
				if (!empty($deptnya)) {
				$this->db->where('posts.dept_id', $deptnya);
				//var_dump('rolenya = '.$deptnya);
				}
				//var_dump('1');
			}elseif($rolelogin == '3' || $rolelogin == '5' || $rolelogin == '6'){ //IT,ENG,HK
				$this->db->where('posts.corp_id', $corplogin);
				//$where = "(posts.user_id='$idlogin' OR posts.role_id='$rolelogin' OR posts.dept_id='$deptlogin')";
				$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
				$this->db->where($where);
				//var_dump('2');
			}elseif($rolelogin == '4'){//user biasa
				$this->db->where('posts.corp_id', $corplogin);
				//$where = "(posts.user_id='$idlogin' AND posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
				$where = "(posts.role_id<>'$rolelogin' AND posts.dept_id='$deptlogin')";
				$this->db->where($where);
				//var_dump('3');
			}
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get post count by category
		public function get_post_count_by_category($category_id)
		{
			$category = $this->category_model->get_category($category_id);
			if ($category->parent_id == 0) {
				$this->db->where('posts.category_id', $category_id);
				$this->db->where('posts.visibility', 1);
				$this->db->where('posts.status', 1);
				$this->db->where('posts.is_scheduled', 0);
				$query = $this->db->get('posts');
				return $query->num_rows();
				} else {
				$this->db->where('posts.visibility', 1);
				$this->db->where('posts.status', 1);
				$this->db->where('posts.is_scheduled', 0);
				$query = $this->db->get('posts');
				return $query->num_rows();
			}
		}
		
		//get post count by department
		public function get_post_count_by_department($department_id)
		{
			$department = $this->department_model->get_department($department_id);
			if ($department->parent_id == 0) {
				$this->db->where('posts.dept_id', $department_id);
				$this->db->where('posts.visibility', 1);
				$this->db->where('posts.status', 1);
				$this->db->where('posts.is_scheduled', 0);
				$query = $this->db->get('posts');
				return $query->num_rows();
				} else {
				$this->db->where('posts.subdepartment_id', $department_id);
				$this->db->where('posts.visibility', 1);
				$this->db->where('posts.status', 1);
				$this->db->where('posts.is_scheduled', 0);
				$query = $this->db->get('posts');
				return $query->num_rows();
			}
		}
		
		//get post count by location
		public function get_post_count_by_location($location_id)
		{
			$location = $this->location_model->get_location($location_id);
			if ($location->parent_id == 0) {
				$this->db->where('posts.location_id', $location_id);
				$this->db->where('posts.visibility', 1);
				$this->db->where('posts.status', 1);
				$this->db->where('posts.is_scheduled', 0);
				$query = $this->db->get('posts');
				return $query->num_rows();
				} else {
				$this->db->where('posts.sublocation_id', $location_id);
				$this->db->where('posts.visibility', 1);
				$this->db->where('posts.status', 1);
				$this->db->where('posts.is_scheduled', 0);
				$query = $this->db->get('posts');
				return $query->num_rows();
			}
		}
		
		//get feed posts count
		public function get_feed_posts_count($feed_id)
		{
			$this->db->where('feed_id', $feed_id);
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			$query = $this->db->get('posts');
			return $query->num_rows();
		}
		
		//get posts by feed id
		public function get_posts_by_feed_id($feed_id)
		{
			$this->db->where('posts.feed_id', $feed_id);
			$query = $this->db->get('posts');
			return $query->result();
		}
		
		//get sitemap posts
		public function get_sitemap_posts()
		{
			$this->db->where('posts.visibility', 1);
			$this->db->where('posts.status', 1);
			$this->db->where('posts.is_scheduled', 0);
			$this->db->order_by('posts.created_at', 'DESC');
			$query = $this->db->get('posts');
			return $query->result();
		}
		
		//add or remove post from slider
		public function post_add_remove_slider($id)
		{
			//get post
			$post = $this->get_post($id);
			
			if (!empty($post)) {
				$result = "";
				if ($post->is_slider == 1) {
					//remove from slider
					$data = array(
					'is_slider' => 0,
					);
					$result = "removed";
					} else {
					//add to slider
					$data = array(
					'is_slider' => 1,
					);
					$result = "added";
				}
				
				$this->db->where('id', $id);
				$this->db->update('posts', $data);
				return $result;
			}
		}
		
		//add or remove post from featured
		public function post_add_remove_featured($id)
		{
			//get post
			$post = $this->get_post($id);
			
			if (!empty($post)) {
				$result = "";
				if ($post->is_featured == 1) {
					//remove from featured
					$data = array(
					'is_featured' => 0,
					);
					$result = "removed";
					} else {
					//add to featured
					$data = array(
					'is_featured' => 1,
					);
					$result = "added";
				}
				
				$this->db->where('id', $id);
				$this->db->update('posts', $data);
				return $result;
			}
		}
		
		//add or remove post from breaking
		public function post_add_remove_breaking($id)
		{
			//get post
			$post = $this->get_post($id);
			
			if (!empty($post)) {
				$result = "";
				if ($post->is_breaking == 1) {
					//remove from breaking
					$data = array(
					'is_breaking' => 0,
					);
					$result = "removed";
					} else {
					//add to breaking
					$data = array(
					'is_breaking' => 1,
					);
					$result = "added";
				}
				
				$this->db->where('id', $id);
				$this->db->update('posts', $data);
				return $result;
			}
		}
		
		//approve post
		public function approve_post($id)
		{
			
			$data = array(
			'visibility' => 1,
			);
			
			$this->db->where('id', $id);
			return $this->db->update('posts', $data);
		}
		
		//publish post
		public function publish_post($id)
		{
			$sql = "UPDATE posts SET created_at = CURRENT_TIMESTAMP() , posts.is_scheduled = 0 WHERE id = ?";
			return $this->db->query($sql, array($id));
		}
		
		public function check_scheduled_posts2()
		{
			//$date = date('Y-m-d H:i:s');
			$date = date('Y-m-d');
			$sql = "SELECT * FROM `posts` WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND DAY(created_at) = DAY(CURRENT_DATE()) AND is_scheduled=1";
			$query = $this->db->query($sql);
			$posts = $query->result();
			if (!empty($posts)) {
				foreach ($posts as $post) {
					if ($post->created_at <= $date) {
						//$sql = "UPDATE posts SET created_at = DATE_ADD(created_at, INTERVAL 1 YEAR) WHERE id = ?";
						$data = array(
						//'created_at' => DATE_ADD(created_at, INTERVAL 1 YEAR),
						'created_at' => 'DATE_ADD (created_at, INTERVAL 1 YEAR)',
						);
						$this->db->where('id', $post->id);
						$this->db->update('posts', $data);
					}
				}
				reset_cache_data_on_change();
				
				echo "All scheduled posts have been checked.";
				} else {
				echo "There are no scheduled posts.";
			}
		}
		
		//check scheduled posts
		public function check_scheduled_posts()
		{
			//SELECT * FROM `posts` WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND DAY(created_at) = DAY(CURRENT_DATE())
			//SELECT * FROM `posts` WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND DAY(created_at) = DAY(CURRENT_DATE()) AND is_scheduled=1;
			//$this->db->where('posts.created_at <= CURRENT_TIMESTAMP()');
			$this->db->where('MONTH(created_at) = MONTH(CURRENT_DATE())');
			$this->db->where('DAY(created_at) = DAY(CURRENT_DATE())');
			$this->db->where('posts.is_scheduled', 1);
			$query = $this->db->get('posts');
			$posts = $query->result();
			return $posts;
		}
		
		//scheduled posts
		public function scheduled_posts_insert_posts($post)
		{
			$data2 = $this->input_values2($post);
			if ($this->db->insert('posts', $data2)) {
				$last_id = $this->db->insert_id();
				//untuk logs
				$this->scheduled_posts_insert_posts_logs($post,$last_id);
				//untuk publish scheduled wo lagi
				//$varCek=$this->check_scheduled_posts_return_id_awal();
				//$this->update_sch_wo($post,$varCek);
				echo "UWES.";
				}else {
				echo "DURUNG.";
			}
		}
		
		//untuk logs
		public function scheduled_posts_insert_posts_logs($post,$last_id)
		{
			$sql = "INSERT INTO posts_logs (post_id,lang_id,title,summary,category_id,location_id,sublocation_id,image_big,image_default,image_slider,image_mid,image_small,image_mime,
			is_scheduled,intervale,visibility,post_type,video_path,image_url,video_embed_code,dept_id,corp_id,user_id,role_id,assign_to,status,image_description,edited_by,edited_at,created_at)  
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			return $this->db->query($sql, array($last_id,$post->lang_id,$post->title,$post->summary,$post->category_id,
			$post->location_id, $post->sublocation_id, $post->image_big, $post->image_default, $post->image_slider, $post->image_mid, $post->image_small, $post->image_mime,
			0,0,$post->visibility, $post->post_type, $post->video_path, $post->image_url, $post->video_embed_code,$post->dept_id, $post->corp_id, $post->user_id,
			$post->role_id, $post->assign_to, $post->status, $post->image_description, $post->edited_by, $post->edited_at, $post->created_at));
		}
		
		//untuk menjaga agar scheduled wo tetep ada
		public function update_sch_wo($intervale,$last_id_hasil_awal){
			//$sql = "UPDATE posts SET created_at = CURRENT_TIMESTAMP() , posts.is_scheduled = 0 WHERE id = ?";
			$sql = "UPDATE posts SET created_at = DATE_ADD(created_at, INTERVAL ? DAY) WHERE id = ?";
			return $this->db->query($sql, array($intervale,$last_id_hasil_awal));
			reset_cache_data_on_change();
		}
		
		//publish draft
		public function publish_draft($id)
		{
			$data = array(
			'status' => 1,
			);
			
			$this->db->where('id', $id);
			return $this->db->update('posts', $data);
		}
		
		//add or remove post from recommended
		public function post_add_remove_recommended($id)
		{
			//get post
			$post = $this->get_post($id);
			
			if (!empty($post)) {
				$result = "";
				if ($post->is_recommended == 1) {
					//remove from recommended
					$data = array(
					'is_recommended' => 0,
					);
					$result = "removed";
					} else {
					//add to recommended
					$data = array(
					'is_recommended' => 1,
					);
					$result = "added";
				}
				
				$this->db->where('id', $id);
				$this->db->update('posts', $data);
				return $result;
			}
		}
		
		//save feaured post order
		public function save_featured_post_order($id, $order)
		{
			//get post
			$post = $this->get_post($id);
			
			if (!empty($post)):
			$data = array(
			'featured_order' => $order,
			);
			$this->db->where('id', $id);
			$this->db->update('posts', $data);
			endif;
		}
		
		//save home slider post order
		public function save_home_slider_post_order($id, $order)
		{
			//get post
			$post = $this->get_post($id);
			
			if (!empty($post)):
			$data = array(
			'slider_order' => $order,
			);
			$this->db->where('id', $id);
			$this->db->update('posts', $data);
			endif;
		}
		
		//post bulk options
		public function post_bulk_options($operation, $post_ids)
		{
			$data = array();
			if ($operation == 'add_slider') {
				$data['is_slider'] = 1;
				} elseif ($operation == 'remove_slider') {
				$data['is_slider'] = 0;
				} elseif ($operation == 'add_featured') {
				$data['is_featured'] = 1;
				} elseif ($operation == 'remove_featured') {
				$data['is_featured'] = 0;
				} elseif ($operation == 'add_breaking') {
				$data['is_breaking'] = 1;
				} elseif ($operation == 'remove_breaking') {
				$data['is_breaking'] = 0;
				} elseif ($operation == 'add_recommended') {
				$data['is_recommended'] = 1;
				} elseif ($operation == 'remove_recommended') {
				$data['is_recommended'] = 0;
				} elseif ($operation == 'publish_scheduled') {
				$data['is_scheduled'] = 0;
				} elseif ($operation == 'approve') {
				$data['visibility'] = 1;
				} elseif ($operation == 'publish_draft') {
				$data['status'] = 1;
			}
			
			if (!empty($post_ids)) {
				foreach ($post_ids as $id) {
					$post = $this->get_post($id);
					if (!empty($post)) {
						$this->db->where('id', $id);
						$this->db->update('posts', $data);
					}
				}
			}
		}
		
		//delete post
		public function delete_post($id)
		{
			$post = $this->get_post($id);
			
			if (!empty($post)):
			
			//delete additional images
			$this->post_file_model->delete_post_additional_images($id);
			//delete audios
			$this->post_file_model->delete_post_audios($id);
			//delete gallery post items
			if ($post->post_type == "gallery_post") {
				$this->post_gallery_model->delete_gallery_post_items($id);
			}
			
			$this->db->where('id', $id);
			return $this->db->delete('posts');
			else:
			return false;
			endif;
		}
		
		//delete multi post
		public function delete_multi_posts($post_ids)
		{
			if (!empty($post_ids)) {
				foreach ($post_ids as $id) {
					$post = $this->get_post($id);
					
					if (!empty($post)) {
						
						//delete post tags
						$this->tag_model->delete_post_tags($id);
						//delete gallery post items
						if ($post->post_type == "gallery_post") {
							$this->post_gallery_model->delete_gallery_post_items($id);
						}
						
						$this->db->where('id', $id);
						$this->db->delete('posts');
					}
				}
			}
			
		}
		//untuk cek null
		public function cek_null($id)
		{
			
			$where = "(posts_logs.assign_to is NULL AND posts_logs.edited_by is NULL AND posts_logs.edited_at is NULL)";
			$this->db->where($where);
			$this->db->where('post_id', $id);
			$this->db->order_by('posts_logs.edited_at', 'DESC');
			$query = $this->db->get('posts_logs');
			if ($query->num_rows() > 0) {
				return true;
				} else {
				return false;
			}
		}
		//untuk history
		public function get_posts_history($id)
		{
			//echo $id;
			if ($this->cek_null($id) == false) {
				//echo 'false';
				$this->db->join('users', 'posts_logs.edited_by = users.id');
				$this->db->join('categories', 'posts_logs.category_id = categories.id');
				$this->db->select('posts_logs.*,categories.name as cats,users.username as usersnya');
				}else {
				//echo 'true';
				$this->db->join('categories', 'posts_logs.category_id = categories.id');
				$this->db->select('posts_logs.*,categories.name as cats');
			}
			$this->db->where('post_id', $id);
			$this->db->order_by('posts_logs.edited_at', 'DESC');
			$query = $this->db->get('posts_logs');
			return $query->result();
			/*if ($this->cek_null($id) == false) {
				$this->db->join('users', 'posts_logs.edited_by = users.id');
				$this->db->join('categories', 'posts_logs.category_id = categories.id');
				}else{
				$this->db->join('categories', 'posts_logs.category_id = categories.id');
				}
				
				if ($this->cek_null($id) == false) {
				$this->db->select('posts_logs.*,categories.name as cats,users.username as usersnya');
				}else{
				$this->db->select('posts_logs.*,categories.name as cats');
				}
				
				$this->db->where('post_id', $id);
				$this->db->order_by('posts_logs.edited_at', 'DESC');
				$query = $this->db->get('posts_logs');
			return $query->result();*/
		}
		//error 404
		public function error_404()
		{
			$data['title'] = "Error 404";
			$data['description'] = "Error 404";
			$data['keywords'] = "error,404";
			
			$this->load->view('partials/_header', $data);
			$this->load->view('errors/error_404');
			$this->load->view('partials/_footer');
		}
	}															