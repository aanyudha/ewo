<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-12">
        <!-- form start -->
        <?php echo form_open_multipart('post_controller/add_post_post'); ?>
        <input type="hidden" name="post_type" value="post">
        <div class="row">
            <div class="col-sm-12 form-header">
                <h1 class="form-title"><?php echo trans('add_article'); ?></h1>
              <!--  <a href="<?php //echo admin_url(); ?>posts?lang_id=<?php //echo $general_settings->site_lang; ?>"
				class="btn btn-success btn-add-new pull-right">
                    <i class="fa fa-bars"></i>
                    <?php //echo trans('posts'); ?>
				</a> -->
			</div>
		</div>
        <div class="row">
            <div class="col-sm-10">
                <div class="form-post">
                    <div class="form-post-left">
                        <?php $this->load->view("admin/includes/_form_add_post_left", ['show_content_field' => true]); ?>
						<?php //$this->load->view('admin/includes/_sidebar_language_locations'); ?>
						<?php $this->load->view('admin/includes/_post_image_upload_box'); ?>
						<div class="box">      
						</div>	
					</div>
                    <div class="form-post-right">
                        <div class="row">
							<!--<div class="col-sm-12">
								<div class="box">
									<div class="box-header with-border">
										<div class="left">
											<h3 class="box-title"><?php //echo trans('assign_to_role'); ?></h3>
										</div>
									</div><!-- /.box-header 
									<div class="box-body">
										<div class="form-group">
											<label><?php /*echo trans("assign_to_role"); ?></label>
											<select id="role" name="role_id" class="form-control" required>
												<option value=""><?php echo trans('assign_to_role'); ?></option>
												<?php foreach ($roles as $role): ?>
											<?php if ($role->id == old('role_id')): ?>
												<option value="<?php echo html_escape($role->id); ?>"selected>
												<?php echo html_escape($role->role_name); ?></option>
											<?php else: ?>
												<option value="<?php echo html_escape($role->id); ?>"><?php echo html_escape($role->role_name); ?></option>	
											<?php endif; ?>
												<?php endforeach; */?>
											</select>
										</div>
									</div>
								</div>
							</div>-->
                            <div class="col-sm-12">
                                <?php $this->load->view('admin/includes/_sidebar_language_categories'); ?>
							</div> 
							
                            <div class="col-sm-12">
                                <?php $this->load->view('admin/includes/_post_publish_box', ['post_type' => 'article']); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php echo form_close(); ?><!-- form end -->
	</div>
</div>

<?php $this->load->view("admin/includes/_file_manager_image"); ?>
<?php $this->load->view("admin/includes/_file_manager_ckeditor"); ?>

