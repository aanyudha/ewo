<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo $title; ?></h3>
		</div>
        <div class="right">
            <div class="dropdown">
                <button class="btn btn-success btn-add-new dropdown-toggle"
				type="button"
				data-toggle="dropdown"><i class="fa fa-plus"></i><?php echo trans('add_post'); ?>
                    <span class="caret"></span>
				</button>
                <ul class="dropdown-menu" style="left: -20px;">
                    <li><a href="<?php echo admin_url(); ?>add-post"><?php echo trans('add_article'); ?></a></li>
                    <!--<li><a href="<?php /*echo admin_url(); ?>add-ordered-list"><?php echo trans('add_ordered_list'); ?></a></li>
						<li><a href="<?php echo admin_url(); ?>add-gallery"><?php echo trans('add_gallery'); ?></a></li>
						<li><a href="<?php echo admin_url(); ?>add-video"><?php echo trans('add_video'); ?></a></li>
					<li><a href="<?php echo admin_url(); ?>add-audio"><?php echo trans('add_audio'); */?></a></li>-->
				</ul>
			</div>
		</div>
	</div><!-- /.box-header -->
	
    <div class="box-body">
        <div class="row">
            <!-- include message block -->
            <div class="col-sm-12">
                <?php $this->load->view('admin/includes/_messages'); ?>
			</div>
		</div>
        <div class="row">
            <div class="col-sm-12">
                
				<table class="table table-bordered table-striped" role="grid">
					<?php $this->load->view('admin/includes/_filter_posts'); ?>
					<thead>
						<tr role="row">
							<!--<th width="20"><input type="checkbox" class="checkbox-table" id="checkAll"></th>-->
							<th width="20"><?php echo trans('id'); ?></th>
							<th><?php echo trans('wo_tittle'); ?></th>
							<th><?php echo trans('wo_summary'); ?></th>
							<!--<th><?php echo trans('language'); ?></th>
							<th><?php echo trans('post_type'); ?></th>-->
							<th><?php echo trans('category'); ?></th>
							<th><?php echo trans('loca_sub'); ?></th>
							<th><?php echo trans('department_name'); ?></th>
							<th><?php echo trans('author_view'); ?></th>
							<th><?php echo trans('assign_to_dept'); ?></th>
							<th><?php echo trans('assign_to_'); ?></th>
							<!--<th></th>-->
							<?php if ($list_type == "slider_posts"): ?>
							<th><?php echo trans('slider_order'); ?></th>
							<?php endif; ?>
							<?php if ($list_type == "featured_posts"): ?>
							<th><?php echo trans('featured_posts'); ?></th>
							<?php endif; ?>
							<!--  <th><?php echo trans('hit'); ?></th>-->
							<th><?php echo trans('date_added'); ?></th>
							<th><?php echo trans('image_added'); ?></th>
							<th style="min-width: 180px;"><?php echo trans('options'); ?></th>
						</tr>
					</thead>
					<tbody>
						
						<?php foreach ($posts as $item): ?>
						<tr>
							<!--<td><input type="checkbox" name="checkbox-table" class="checkbox-table" value="<?php echo $item->id; ?>"></td>-->
							<td><?php echo html_escape($item->id); ?></td>
							<td>
								
								<?php echo html_escape($item->title); ?>
							</td>
							<td>
								
								<?php echo html_escape($item->summary); ?>
							</td>
							<!--      <td>
								<?php
									$lang = get_language($item->lang_id);
									if (!empty($lang)) {
										echo html_escape($lang->name);
									}
								?>
								</td>
								<td class="td-post-type">
								<?php if ($item->post_type == 'post') {
									echo trans("article");
									} else {
									echo trans($item->post_type);
								} ?>
							</td>-->
							<td>
								<?php $category = helper_get_category($item->category_id);
								if (!empty($category)): ?>
								<label class="category-label m-r-5 label-table" style="background-color: <?php echo html_escape($category->color); ?>!important;">
									<?php echo html_escape($category->name); ?>
								</label>
								<?php endif; ?>
								
								<?php $category = helper_get_category($item->subcategory_id);
								if (!empty($category)): ?>
								<label class="category-label label-table" style="background-color: <?php echo html_escape($category->color); ?>">
									<?php echo html_escape($category->name); ?>
								</label>
								<?php endif; ?>
							</td>
							<td>
								<?php $location = helper_get_location($item->location_id);
								if (!empty($location)): ?>
								<label class="category-label m-r-5 label-table" style="background-color: <?php echo html_escape($location->color); ?>!important;">
									<?php echo html_escape($location->name); ?>
								</label>
								<?php endif; ?>
								/ 
								<?php $location = helper_get_location($item->sublocation_id);
								if (!empty($location)): ?>
								<label class="category-label label-table" style="background-color: <?php echo html_escape($location->color); ?>">
									<?php echo html_escape($location->name); ?>
								</label>
								<?php endif; ?>
							</td>
							<td>
								<?php $dept = helper_get_department($item->dept_id);
								if (!empty($dept)): ?>
								<label class="category-label m-r-5 label-table" style="background-color: <?php echo html_escape($dept->color); ?>!important;">
									<?php echo html_escape($dept->name); ?>
								</label>
								<?php endif; ?>
							</td>
							<td>
								<?php $author = get_user($item->user_id);
								if (!empty($author)): ?>
								<!--<a href="<?php //echo base_url(); ?>profile/<?php // echo html_escape($author->slug); ?>" target="_blank" class="table-user-link">-->
								<strong><?php echo html_escape($author->first_name);?>&nbsp;<?php  echo html_escape($author->last_name); ?>&nbsp;(<?php echo $author->role; ?>)</strong> 
								<!--	</a> -->
								<?php endif; ?>
							</td>
							<td>
								<?php $author_2 = get_dept_role($item->role_id);
								if (!empty($author_2)): ?>
								<strong><?php echo $author_2->role_name; ?></strong>
								<?php endif; ?>
							</td>
							<td>
								<?php $author_3 = get_user($item->assign_to);
								if (!empty($author_3)): ?>
								<strong><?php echo html_escape($author_3->first_name); ?>&nbsp<?php echo html_escape($author_3->last_name); ?></strong>				
									<?php endif; ?>
								</td>
								<!--<td class="td-post-sp">
									<?php /*if ($item->visibility == 1): ?>
										<label class="label label-success label-table"><i class="fa fa-eye"></i></label>
										<?php else: ?>
										<label class="label label-danger label-table"><i class="fa fa-eye"></i></label>
										<?php endif; ?>
										
										<?php if ($item->is_slider): ?>
										<label class="label bg-red label-table"><?php echo trans('slider'); ?></label>
										<?php endif; ?>
										
										<?php if ($item->is_featured): ?>
										<label class="label bg-olive label-table"><?php echo trans('featured'); ?></label>
										<?php endif; ?>
										
										<?php if ($item->is_recommended): ?>
										<label class="label bg-aqua label-table"><?php echo trans('recommended'); ?></label>
										<?php endif; ?>
										
										<?php if ($item->is_breaking): ?>
										<label class="label bg-teal label-table"><?php echo trans('breaking'); ?></label>
										<?php endif; ?>
										
										<?php if ($item->need_auth): ?>
										<label class="label label-warning label-table"><?php echo trans('only_registered'); ?></label>
									<?php endif; */?>
									
									</td>
									<?php /*if ($list_type == "slider_posts"): ?>
										<td style="max-width: 150px;">
										<?php echo form_open('post_controller/home_slider_posts_order_post'); ?>
										<div class="slider-order">
										<div class="slider-order-left">
										<input type="hidden" name="id"
										value="<?php echo html_escape($item->id); ?>">
										<input type="number" name="slider_order" class="form-control"
										value="<?php echo html_escape($item->slider_order); ?>" min="1" max="99999">
										</div>
										<div class="slider-order-right">
										<button type="submit" class="btn btn-sm btn-success"><i
										class="fa fa-check"></i></button>
										</div>
										</div>
										<?php echo form_close(); ?>
										</td>
										<?php endif; ?>
										<?php if ($list_type == "featured_posts"): ?>
										<td style="max-width: 150px;">
										<?php echo form_open('post_controller/featured_posts_order_post'); ?>
										<div class="slider-order">
										<div class="slider-order-left">
										<input type="hidden" name="id"
										value="<?php echo html_escape($item->id); ?>">
										<input type="number" name="featured_order" class="form-control"
										value="<?php echo html_escape($item->featured_order); ?>" min="1" max="99999">
										</div>
										<div class="slider-order-right">
										<button type="submit" class="btn btn-sm btn-success"><i
										class="fa fa-check"></i></button>
										</div>
										</div>
										<?php echo form_close(); ?>
										</td>
										<?php endif; ?>
									<!-- <td><?php echo $item->hit; */?></td> -->
									<td><?php echo formatted_date($item->created_at); ?></td>
									<td>
										<div class="post-image">
											<a class="image-popup-no-margins" href="<?php echo base_url() . $item->image_default; ?>">
												<img src="<?php echo base_url() . html_escape($item->image_small); ?>" data-src="<?php echo base_url() . $item->image_small; ?>" alt="" class="img-responsive">
											</a>
										</div>
									</td>
									<td>
										<!-- form post options -->
										<?php echo form_open('post_controller/post_options_post'); ?>
										<input type="hidden" name="id" value="<?php echo html_escape($item->id); ?>">
										
										<div class="dropdown">
											<?php  if (check_user_permission('manage_all_posts')): ?>
											<?php if ($item->category_id == 4): ?>
											<button class="btn bg-purple dropdown-toggle btn-select-option"
											type="button"
											data-toggle="dropdown"><?php echo trans('select_an_option_closed'); ?>
												<span class="caret"></span>
											</button>
											<?php else: ?>
											<button class="btn bg-purple dropdown-toggle btn-select-option"
											type="button"
											data-toggle="dropdown"><?php echo trans('select_an_option'); ?>
												<span class="caret"></span>
											</button>
											<?php endif; ?>
											<?php else: ?>
											<button class="btn bg-purple dropdown-toggle btn-select-option"
											type="button"
											data-toggle="dropdown"><?php echo trans('select_an_option'); ?>
												<span class="caret"></span>
											</button>
											<?php endif; ?>
											<ul class="dropdown-menu options-dropdown">
												<?php $idloginya = $this->auth_model->get_user_id(); ?>
												<?php $author = get_user($item->user_id); ?>
												<?php $rolenya = get_dept_role($item->role_id);?>
												<?php  if (check_user_permission('manage_all_posts') && ($idloginya != $item->user_id || $idloginya == $item->role_id) || is_admin()): ?>
												<?php if ($item->category_id == 4): ?>
												<li>
													<a href="<?php echo admin_url(); ?>update-post-closed/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('reopen'); ?></a>
												</li>
												<?php else: ?>
												<li>
													<a href="<?php echo admin_url(); ?>update-post/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit_reply'); ?></a>
												</li>
												<?php endif; ?>
												<?php else: ?>
												<?php if ($author->role_id == 1 || $author->role_id == 3 || $author->role_id == 5 || $author->role_id == 6 || $author->role_id == 7): ?>
												<li>
													<a href="<?php echo admin_url(); ?>update-post/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit_reply'); ?></a>
												</li>
												<?php else: ?>
												<li>
													<a href="<?php echo admin_url(); ?>view-post/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('logsnya'); ?></a>
												</li>
												<?php endif; ?>
												<?php endif; ?>
												<?php /* if (check_user_permission('manage_all_posts')): ?>
													<?php if ($item->is_slider == 1): ?>
													<li>
													<button type="submit" name="option" value="add-remove-from-slider" class="btn-list-button">
													<i class="fa fa-times option-icon"></i><?php echo trans('remove_slider'); ?>
													</button>
													</li>
													<?php else: ?>
													<li>
													<button type="submit" name="option" value="add-remove-from-slider" class="btn-list-button">
													<i class="fa fa-plus option-icon"></i><?php echo trans('add_slider'); ?>
													</button>
													</li>
													<?php endif; ?>
													<?php if ($item->is_featured == 1): ?>
													<li>
													<button type="submit" name="option" value="add-remove-from-featured" class="btn-list-button">
													<i class="fa fa-times option-icon"></i><?php echo trans('remove_featured'); ?>
													</button>
													</li>
													<?php else: ?>
													<li>
													<button type="submit" name="option" value="add-remove-from-featured" class="btn-list-button">
													<i class="fa fa-plus option-icon"></i><?php echo trans('add_featured'); ?>
													</button>
													</li>
													<?php endif; ?>
													<?php if ($item->is_breaking == 1): ?>
													<li>
													<button type="submit" name="option" value="add-remove-from-breaking" class="btn-list-button">
													<i class="fa fa-times option-icon"></i><?php echo trans('remove_breaking'); ?>
													</button>
													</li>
													<?php else: ?>
													<li>
													<button type="submit" name="option" value="add-remove-from-breaking" class="btn-list-button">
													<i class="fa fa-plus option-icon"></i><?php echo trans('add_breaking'); ?>
													</button>
													</li>
													<?php endif; ?>
													<?php if ($item->is_recommended == 1): ?>
													<li>
													<button type="submit" name="option" value="add-remove-from-recommended" class="btn-list-button">
													<i class="fa fa-times option-icon"></i><?php echo trans('remove_recommended'); ?>
													</button>
													</li>
													<?php else: ?>
													<li>
													<button type="submit" name="option" value="add-remove-from-recommended" class="btn-list-button">
													<i class="fa fa-plus option-icon"></i><?php echo trans('add_recommended'); ?>
													</button>
													</li>
													<?php endif; ?>
												<?php endif; */?>
												<!--    <li>
													<a href="javascript:void(0)" onclick="delete_item('post_controller/delete_post','<?php //echo $item->id; ?>','<?php //echo trans("confirm_post"); ?>');"><i class="fa fa-trash option-icon"></i><?php //echo trans('delete'); ?></a>
												</li>-->
											</ul>
										</div>
										
										<?php echo form_close(); ?><!-- form end -->
									</td>
							</tr>
							<?php endforeach; ?>
							
						</tbody>
				</table>
					<?php if (empty($posts)): ?>
					<p class="text-center">
						<?php echo trans("no_records_found"); ?>
					</p>
					<?php endif; ?>
					<div class="col-sm-12 table-ft">
						<div class="row">
							
							<div class="pull-right">
								<?php echo $this->pagination->create_links(); ?>
							</div>
							
							<?php if (count($posts) > 0): ?>
							<div class="pull-left bulk-options">
								<button class="btn btn-sm btn-danger btn-table-delete" onclick="delete_selected_posts('<?php echo trans("confirm_posts"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></button>
								<?php if ($list_type != 'slider_posts'): ?>
								<button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('add_slider');"><i class="fa fa-plus option-icon"></i><?php echo trans('add_slider'); ?></button>
								<?php endif; ?>
								<?php if ($list_type != 'featured_posts'): ?>
								<button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('add_featured');"><i class="fa fa-plus option-icon"></i><?php echo trans('add_featured'); ?></button>
								<?php endif; ?>
								<?php if ($list_type != 'breaking_news'): ?>
								<button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('add_breaking');"><i class="fa fa-plus option-icon"></i><?php echo trans('add_breaking'); ?></button>
								<?php endif; ?>
								<?php if ($list_type != 'recommended_posts'): ?>
								<button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('add_recommended');"><i class="fa fa-plus option-icon"></i><?php echo trans('add_recommended'); ?></button>
								<?php endif; ?>
								<button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('remove_slider');"><i class="fa fa-minus option-icon"></i><?php echo trans('remove_slider'); ?></button>
								<button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('remove_featured');"><i class="fa fa-minus option-icon"></i><?php echo trans('remove_featured'); ?></button>
								<button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('remove_breaking');"><i class="fa fa-minus option-icon"></i><?php echo trans('remove_breaking'); ?></button>
								<button class="btn btn-sm btn-default btn-table-delete" onclick="post_bulk_options('remove_recommended');"><i class="fa fa-minus option-icon"></i><?php echo trans('remove_recommended'); ?></button>
							</div>
							<?php endif; ?>
						</div>
					</div>
					
			</div>
		</div>
	</div><!-- /.box-body -->
</div><!-- class="box" -->
