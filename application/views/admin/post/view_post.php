<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-sm-12">
        <!-- form start -->
        <div class="row">
            <div class="col-sm-12 form-header">
                <h1 class="form-title"><?php echo trans('update_article_view'); ?></h1>
               <!-- <a href="<?php //echo admin_url(); ?>posts" class="btn btn-success btn-add-new pull-right">
                    <i class="fa fa-bars"></i>
                    <?php //echo trans('posts'); ?>
				</a> -->
			</div>
		</div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-post">
                    <div class="form-post-left">
                        <?php $this->load->view("admin/includes/_form_view_post_left", ['show_content_field' => true]); ?>
						
					</div>
                    <div class="form-post-right">
					
						 <div class="row">
							<div class="col-sm-12">
						<?php $this->load->view('admin/includes/_post_image_view_box'); ?>
						
						</div>	
						<?php if ($post->post_type == "post" || $post->post_type == "post"): ?>
						<div class="col-sm-12">
						<div class="box">
							<div class="box-header with-border">
								<div class="left">
									<h3 class="box-title"><?php echo trans('additional_images'); ?></h3>
								</div>
							</div><!-- /.box-header -->
							<div class="box-body">
								<div class="form-group m0">
									<!-- <label class="control-label"><?php //echo trans('additional_images'); ?></label>
										<div class="row">
										<div class="col-sm-12">
										<a class='btn btn-sm bg-purple' data-toggle="modal" data-target="#image_file_manager" onclick="$('#selected_image_type').val('additional_image');">
										<?php //echo trans('select_image'); ?>
										</a>
										</div>
									</div> -->
								</div>
								
								<div class="form-group m0">
									<div class="row">
										<div class="col-sm-12 m-b-15">
											<div class="additional-image-list">
												<?php $additional_images = get_post_additional_images($post->id); ?>
												<?php if (!empty($additional_images)): ?>
												<?php foreach ($additional_images as $image): ?>
												<div class="additional-item additional-item-<?php echo $image->id; ?>">
													<img class="img-additional" src="<?php echo base_url() . $image->image_default; ?>" alt="">
													<!--<a class="btn btn-danger btn-sm btn-delete-additional-image-database" data-value="<?php echo $image->id; ?>">
														<i class="fa fa-times"></i>
													</a>-->
												</div>
												<?php endforeach; ?>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
						
						<?php endif; ?>
                        
					</div>
					
				</div>
				<div class="form-post-right-right">
					<div class="row">
                            <?php //if (check_user_permission('manage_all_posts')): ?>
							<div class="col-sm-12">
								<div class="box">
									<div class="box-header with-border">
										<div class="left">
											<h3 class="box-title"><?php echo trans('wo_information'); ?></h3>
										</div>
									</div> <!-- /.box-header -->
									<div class="box-body">
										<div class="form-group">
											<label><?php echo trans("post_created"); ?></label>
											<input type="hidden" name="user_id" value="<?php echo html_escape($post->user_id); ?>">
											<select name="user_id_" class="form-control" disabled>
												<?php foreach ($users as $user): ?>
												<option value="<?php echo $user->id; ?>" <?php echo ($post->user_id == $user->id) ? 'selected' : ''; ?>><?php echo $user->first_name; ?>&nbsp;<?php echo $user->last_name; ?>&nbsp;(<?php echo $user->role; ?>)</option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group">
											<label><?php echo trans("post_assign_dept"); ?></label>
											<input type="hidden" name="role_id" value="<?php echo html_escape($post->role_id); ?>">
											<select name="role_id" class="form-control" disabled>
												<?php foreach ($depts as $dept): ?>
												<option value="<?php echo $dept->id; ?>" <?php echo ($post->role_id == $dept->id) ? 'selected' : ''; ?>><?php echo $dept->role_name; ?>&nbsp;</option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group">
											<?php //$this->load->view('admin/includes/_sidebar_language_categories_view'); ?>
										</div>
										<div class="form-group">
											<?php $this->load->view('admin/includes/_sidebar_language_locations_view'); ?>
										</div>
									</div>
								</div>
							</div>
                            <?php //else: ?>
							<!--<input type="hidden" name="user_id" value="<?php //echo $post->user_id; ?>">-->
                            <?php //endif; ?>
                            <!-- HISTORY -->
							<div class="col-sm-12">
								<div class="card-deck mb-3 ">
									<div class="card mb-4 shadow-sm">
										<div class="card-header text-center">
											<h4 class="my-0 font-weight-normal">History</h4>
										</div>
										
										<div class="card-body">
										<?php foreach ($history as $hst): ?>
											<?php $ygedit = get_user($hst->edited_by);?>
											<?php $ygDiAssign = get_user($hst->assign_to);?>
											<h3 class="card-title">
												<?php if ($hst->edited_at == null && $hst->edited_by == null && $hst->assign_to == null): ?>
													<?php echo 'Wo Created'; ?>
												<?php else: ?>
													<?php //echo 'Assigned to ' . $hst->assign_to . ',by ' . $hst->edited_by; ?>
													<?php echo 'Replied by ' . html_escape($ygedit->first_name) . ' ' . html_escape($ygedit->last_name); ?>
													<?php echo 'Assigned to ' . html_escape($ygDiAssign->first_name) . ' ' . html_escape($ygDiAssign->last_name); ?>
												<?php endif; ?>
												</h3>
											<ul class="list-unstyled mt-3 mb-4">
				     
												<li>
												<?php if (!$hst->edited_at == null && !$hst->edited_by == null && !$hst->assign_to == null): ?>
													Edited on : <?php echo $hst->edited_at; ?>
												<?php else: ?>
													<?php echo 'Created on : ' .$hst->created_at; ?>
												<?php endif; ?>
													</li>
													<li>
													
													Note : <?php echo $hst->summary; ?>
													
													</li>
												<li>status : <?php echo $hst->cats; ?></li>
											</ul>
											<?php endforeach; ?>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view("admin/includes/_file_manager_image"); ?>
<?php $this->load->view("admin/includes/_file_manager_ckeditor"); ?>


