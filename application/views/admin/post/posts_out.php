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
                <div class="table-responsive">
				<table class="table table-bordered table-striped" role="grid">
					<?php $this->load->view('admin/includes/_filter_posts'); ?>
					<thead>
						<tr role="row">
							<th width="20"><?php echo trans('id'); ?></th>
							<th><?php echo trans('wo_tittle'); ?></th>
							<th><?php echo trans('wo_summary'); ?></th>
							<th><?php echo trans('category'); ?></th>
							<th><?php echo trans('loca_sub'); ?></th>
							<th><?php echo trans('department_name'); ?></th>
							<th><?php echo trans('author_view'); ?></th>
							<th><?php echo trans('assign_to_dept'); ?></th>
							<th><?php echo trans('assign_to_'); ?></th>
							<th><?php echo trans('date_added'); ?></th>
							<th><?php echo trans('image_added'); ?></th>
							<th style="min-width: 180px;"><?php echo trans('options'); ?></th>
						</tr>
					</thead>
					<tbody>
						
						<?php foreach ($posts_out as $item): ?>
						<tr>
							<td><?php echo html_escape($item->id); ?></td>
							<td>
								
								<?php echo html_escape($item->title); ?>
							</td>
							<td>
								
								<?php echo html_escape($item->summary); ?>
							</td>
							<td>
								<?php $category = helper_get_category($item->category_id);
								if (!empty($category)): ?>
								<label class="category-label m-r-5 label-table" style="background-color: <?php echo html_escape($category->color); ?>!important;">
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

											<button class="btn bg-purple dropdown-toggle btn-select-option"
											type="button"
											data-toggle="dropdown"><?php echo trans('select_an_option'); ?>
												<span class="caret"></span>
											</button>

										
											<ul class="dropdown-menu options-dropdown">
													<li>
														<a href="<?php echo admin_url(); ?>view-post/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('logsnya'); ?></a>
													</li>
											</ul>
										</div>
										
										<?php echo form_close(); ?><!-- form end -->
									</td>
							</tr>
							<?php endforeach; ?>
							
						</tbody>
				</table>
				</div>
				<?php if (empty($posts_out)): ?>
					<p class="text-center">
						<?php echo trans("no_records_found"); ?>
					</p>
					<?php endif; ?>
					<div class="col-sm-12 table-ft">
						<div class="row">
							<div class="pull-right">
								<?php echo $this->pagination->create_links(); ?>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div><!-- /.box-body -->
</div><!-- class="box" -->
