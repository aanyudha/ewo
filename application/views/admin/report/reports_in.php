<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo $title; ?></h3>
		</div>
        <div class="right">  
			<!-- not use -->
		</div>
	</div><!-- /.box-header -->
	
	<div class="box-body">
		<div class="row">
			<div class="col-sm-12">
				<div class="table-responsive">
					<!-- untuk yg JRXML -->
					<!--<div> 	
						<ul>
							<!-- <li><a href="<?php echo admin_url(); ?>reportsbycreatedate"> <?php //echo trans("reports"); ?></a></li>-->
						<!--	<li><a href="#" data-toggle="modal" data-target="#myModalReport1"><?php //echo trans("report_createddate"); ?></a></li>
							<li><a href="#" data-toggle="modal" data-target="#myModalReport2"><?php //echo trans("report_replieddate"); ?></a></li>
							
						</ul>
					</div>  -->
					<!-- untuk yg tabel -->
					<table id="example" class="table table-bordered table-striped" role="grid">
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
								<th><?php echo trans('date_replied'); ?></th>
								<th><?php echo trans('date_added'); ?></th>
								<th><?php echo trans('image_added'); ?></th>
							</tr>
						</thead>
						<tbody>
							
							<?php foreach ($reports_in as $item): ?>
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
									<strong><?php echo html_escape($author->first_name);?>&nbsp;<?php  echo html_escape($author->last_name); ?>&nbsp;(<?php echo $author->role; ?>)</strong> 
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
									<?php if ($item->edited_at == null): ?>
									<td><?php echo $item->edited_at; ?></td>
									<?php else: ?>
									<td><?php echo formatted_date($item->edited_at); ?></td>
									<?php endif; ?>
									<td><?php echo formatted_date($item->created_at); ?></td>
									<td>
                                    <div class="post-image">
                                        <img src="<?php echo $img_bg_sm; ?>" data-src="<?php echo get_post_image($item, "small"); ?>" alt="" class="lazyload img-responsive"/>
                                    </div>
                                </td>
									
								</tr>
								<?php endforeach; ?>
								
							</tbody>
						</table>
						<?php if (empty($reports_in)): ?>
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
		</div>
	</div><!-- /.box-body -->
</div>

<!-- MODAL UNTUK INPUT FILTER REPORT 1-->
<div id="myModalReport1" class="modal fade" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><?php echo trans('report_createddate'); ?></h4>
			</div>
			<?php echo form_open('report_controller/reports1_XLS',array('target'=>'_blank')); ?>
			<div class="modal-body">
				<div class="form-group">
					
					<div class="form-group">
						<label><?php echo trans("reports2_tgl_awal"); ?></label>
						<input type="text" name="tglAwal" class="form-control form-input" value="<?php echo old("reports2_tgl_awal"); ?>" placeholder="<?php echo trans("reports2_tgl_awal"); ?>" required>
					</div>
					
					<div class="form-group">
						<label><?php echo trans("reports2_tgl_akhir"); ?></label>
						<input type="text" name="tglAkhir" class="form-control form-input" value="<?php echo old("reports2_tgl_akhir"); ?>" placeholder="<?php echo trans("reports2_tgl_akhir"); ?>" required>
					</div>
					
					<div class="form-group">
						<label><?php echo trans('category'); ?></label>
						<select id="categories" name="category" class="form-control" onchange="get_sub_categories(this.value);">
							<option value=""><?php echo trans("all"); ?></option>
							<?php if (!empty($this->input->get('lang_id', true))) {
								$categories = $this->category_model->get_top_categories_by_lang($this->input->get('lang_id', true));
								} else {
								$categories = $this->category_model->get_all_top_categories();
							} ?>
							<?php foreach ($categories as $item): ?>
							<option value="<?php echo $item->id; ?>" <?php echo ($this->input->get('category', true) == $item->id) ? 'selected' : ''; ?>>
								<?php echo html_escape($item->name); ?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success"><?php echo trans('save_to_xls'); ?></button>
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('close'); ?></button>
			</div>
			
			<?php echo form_close(); ?><!-- form end -->
			</div>
			
		</div>
	</div>
	
	<!-- MODAL UNTUK INPUT FILTER REPORT 2-->
	<div id="myModalReport2" class="modal fade" role="dialog">
		<div class="modal-dialog">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><?php echo trans('report_replieddate'); ?></h4>
				</div>
				<?php echo form_open('report_controller/reports2_XLS',array('target'=>'_blank')); ?>
				<div class="modal-body">
					<div class="form-group">
						
						<div class="form-group">
							<label><?php echo trans("reports2_tgl_awal"); ?></label>
							<input type="text" name="tglAwal" class="form-control form-input" value="<?php echo old("reports2_tgl_awal"); ?>" placeholder="<?php echo trans("reports2_tgl_awal"); ?>" required>
						</div>
						
						<div class="form-group">
							<label><?php echo trans("reports2_tgl_akhir"); ?></label>
							<input type="text" name="tglAkhir" class="form-control form-input" value="<?php echo old("reports2_tgl_akhir"); ?>" placeholder="<?php echo trans("reports2_tgl_akhir"); ?>" required>
						</div>
						
						<div class="form-group">
							<label><?php echo trans('category'); ?></label>
							<select id="categories" name="category" class="form-control" onchange="get_sub_categories(this.value);">
								<option value=""><?php echo trans("all"); ?></option>
								<?php if (!empty($this->input->get('lang_id', true))) {
									$categories = $this->category_model->get_top_categories_by_lang($this->input->get('lang_id', true));
									} else {
									$categories = $this->category_model->get_all_top_categories();
								} ?>
								<?php foreach ($categories as $item): ?>
								<option value="<?php echo $item->id; ?>" <?php echo ($this->input->get('category', true) == $item->id) ? 'selected' : ''; ?>>
									<?php echo html_escape($item->name); ?>
								</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success"><?php echo trans('save_to_xls'); ?></button>
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('close'); ?></button>
				</div>
				
				<?php echo form_close(); ?><!-- form end -->
			</div>
			
		</div>
	</div>	
	
