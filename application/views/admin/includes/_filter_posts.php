<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $rolelogin = $this->auth_model->get_role_id_bylogin(); ?>
<div class="row table-filter-container">
    <div class="col-sm-12">
        <?php echo form_open($form_action, ['method' => 'GET']); ?>
		
        <div class="item-table-filter" style="width: 70px; min-width: 70px;">
            <label><?php echo trans("show"); ?></label>
            <select name="show" class="form-control">
                <option value="15" <?php echo ($this->input->get('show', true) == '15') ? 'selected' : ''; ?>>15</option>
                <option value="30" <?php echo ($this->input->get('show', true) == '30') ? 'selected' : ''; ?>>30</option>
                <option value="60" <?php echo ($this->input->get('show', true) == '60') ? 'selected' : ''; ?>>60</option>
                <option value="100" <?php echo ($this->input->get('show', true) == '100') ? 'selected' : ''; ?>>100</option>
			</select>
		</div>
		
		<?php if (is_admin()): ?>
			<?php if ($form_action==admin_url() . "posts_in" || $form_action==admin_url() . "reports_in" || $form_action==admin_url() . "posts_out" || $form_action==admin_url() . "reports_out"): ?>
				<div class="item-table-filter">
					<label><?php echo trans("corps"); ?></label>
					<select id="corps" name="corpnya" class="form-control" onchange="get_dept_by_corp(this.value);get_users_by_corp(this.value);">
						<option value=""><?php echo trans("all"); ?></option>
						<?php foreach ($corps_post as $corp): ?>
						<option value="<?php echo $corp->id; ?>"
						<?php echo ($this->input->get('corpnya', true) == $corp->id) ? 'selected' : ''; ?>>
							<?php echo html_escape($corp->name);?>
						</option>
						<?php endforeach; ?>
					</select>
				</div>
			<?php endif; ?>
			<?php if ($form_action==admin_url() . "posts_in" || $form_action==admin_url() . "reports_in"): ?>
				<div class="item-table-filter">
					<label><?php echo trans("assign_to_dept"); ?></label>
					<select id="roles" name="role" class="form-control">
						<option value=""><?php echo trans("all"); ?></option>
						<?php foreach ($role_post_in as $rolenya): ?>
						<option value="<?php echo $rolenya->id; ?>"
						<?php echo ($this->input->get('role', true) == $rolenya->id) ? 'selected' : ''; ?>>
							<?php echo html_escape($rolenya->role_name);?>
						</option>
						<?php endforeach; ?>
					</select>
				</div>
			<?php endif; ?>
			
			<?php if ($form_action==admin_url() . "posts_out" || $form_action==admin_url() . "reports_out"): ?>
				<div class="item-table-filter">
						<label class="control-label"><?php echo trans('departments'); ?></label>
						<select id="departments" name="department" class="form-control">
							<option value=""><?php echo trans("all"); ?></option>
							<?php
							if (!empty($this->input->get('corpnya', true))):
								$deptnya = helper_get_dept_by_corp($this->input->get('corpnya', true));
								if (!empty($deptnya)) {
									foreach ($deptnya as $item): ?>
										<option value="<?php echo $item->id; ?>" <?php echo ($this->input->get('department', true) == $item->id) ? 'selected' : ''; ?>><?php echo $item->name; ?></option>
									<?php endforeach;
								}
							endif;
							?>
						</select>
				</div> 
			<?php endif; ?>
        <?php endif; ?> <!-- is_admin() -->
		<?php if ($rolelogin == '7' || $rolelogin == '8'): ?>
			<?php if ($form_action==admin_url() . "posts_in" || $form_action==admin_url() . "reports_in"): ?>
				<div class="item-table-filter">
					<label><?php echo trans("assign_to_dept"); ?></label>
					<select id="roles" name="role" class="form-control">
						<option value=""><?php echo trans("all"); ?></option>
						<?php foreach ($role_post_in as $rolenya): ?>
						<option value="<?php echo $rolenya->id; ?>"
						<?php echo ($this->input->get('role', true) == $rolenya->id) ? 'selected' : ''; ?>>
							<?php echo html_escape($rolenya->role_name);?>
						</option>
						<?php endforeach; ?>
					</select>
				</div>
			<?php endif; ?>
		
			<?php if ($form_action==admin_url() . "posts_out" || $form_action==admin_url() . "reports_out"): ?>
				<?php if (is_admin()): ?>
						<div class="item-table-filter">
							<div class="form-group">
								<label class="control-label"><?php echo trans('departments'); ?></label>
								<select id="departments" name="department" class="form-control">
								<option value=""><?php echo trans("all"); ?></option>
								<?php foreach ($dep as $dept): ?>
								<option value="<?php echo $dept->id; ?>"
								<?php echo ($this->input->get('department', true) == $dept->id) ? 'selected' : ''; ?>>
									<?php echo html_escape($dept->name);?>
								</option>
								<?php endforeach; ?>
								</select>
							</div>
						</div> 
					<?php else:	?>			
						<div class="item-table-filter">
							<label class="control-label"><?php echo trans('departments'); ?></label>
							<select name="department" class="form-control">
								<option value=""><?php echo trans("all"); ?></option>
								<?php foreach ($dep as $author): ?>
								<option value="<?php echo $author->id; ?>"
								<?php echo ($this->input->get('department', true) == $author->id) ? 'selected' : ''; ?>>
									<?php echo html_escape($author->name);?>
								</option>
								<?php endforeach; ?>
							</select>
						</div>
				<?php endif; ?>
			<?php endif; ?>
        <?php endif; ?> <!-- $rolelogin == '7' || $rolelogin == '8' -->
				
        <?php //if (check_user_permission('manage_all_posts')): ?> <!-- SUPAYA ADA FILTER CREATED BY DI USER BIASA -->
			<?php if (is_admin()): ?>
				<div class="item-table-filter">
					<label><?php echo trans("post_created"); ?></label>
					<select id="usernya" name="user" class="form-control">
						<option value=""><?php echo trans("all"); ?></option>
						<?php
							if (!empty($this->input->get('corpnya', true))):
								$usere = helper_get_user_by_corp($this->input->get('corpnya', true));
								if (!empty($usere)) {
									foreach ($usere as $item): ?>
										<option value="<?php echo $item->id; ?>" <?php echo ($this->input->get('user', true) == $item->id) ? 'selected' : ''; ?>><?php echo $item->first_name; ?> &nbsp <?php echo $item->last_name; ?></option>
									<?php endforeach;
								}
							endif;
						?>
					</select>
				</div>
				<?php else:	?>			
				<div class="item-table-filter">
					<label><?php echo trans("post_created"); ?></label>
					<?php if ($form_action==admin_url() . "posts_out" || $form_action==admin_url() . "reports_out"): ?>
						<select name="user" class="form-control">
							<option value=""><?php echo trans("all"); ?></option>
							<?php foreach ($authors_only_dept as $author_dept): ?>
							<option value="<?php echo $author_dept->id; ?>"
							<?php echo ($this->input->get('user', true) == $author_dept->id) ? 'selected' : ''; ?>>
								<?php echo html_escape($author_dept->first_name);?> &nbsp <?php echo html_escape($author_dept->last_name); ?>
							</option>
							<?php endforeach; ?>
						</select>	
					<?php else:	?>
						<select name="user" class="form-control">
							<option value=""><?php echo trans("all"); ?></option>
							<?php foreach ($authors as $authors): ?>
							<option value="<?php echo $authors->id; ?>"
							<?php echo ($this->input->get('user', true) == $authors->id) ? 'selected' : ''; ?>>
								<?php echo html_escape($authors->first_name);?> &nbsp <?php echo html_escape($authors->last_name); ?>
							</option>
							<?php endforeach; ?>
						</select>
					<?php endif; ?>
				</div>
        	<?php endif; ?>
		<?php //endif; ?>

        <div class="item-table-filter">
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
		
		<div class="item-table-filter">
			<label><?php echo trans('report_choose_date'); ?></label>
			 <select name="dateChoice" class="form-control" >
				<option value="created_at" <?php echo ($this->input->get('dateChoice', true) == 'created_at') ? 'selected': ''; ?>>Created Date</option>
				<option value="edited_at" <?php echo ($this->input->get('dateChoice', true) == 'edited_at') ? 'selected': ''; ?>>Replied Date</option>
			</select>
		</div>
		
		
		<div class="item-table-filter">
			<label><?php echo trans('reports2_tgl_awal'); ?></label>
			<input type="text" name="tglAwal" class="form-control form-input" value="<?php echo html_escape($this->input->get('tglAwal', true)); ?>" placeholder="<?php echo trans("report_format_date"); ?>">
		</div>
		<div class="item-table-filter">
			<label><?php echo trans('reports2_tgl_akhir'); ?></label>
			<input type="text" name="tglAkhir" class="form-control form-input" value="<?php echo html_escape($this->input->get('tglAkhir', true)); ?>" placeholder="<?php echo trans("report_format_date"); ?>">
		</div>
		
        <div class="item-table-filter">
            <label><?php echo trans("search"); ?></label>
            <input name="q" class="form-control" placeholder="<?php echo trans("search") ?>" type="search" value="<?php echo html_escape($this->input->get('q', true)); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
		</div>
		
        <div class="item-table-filter md-top-10" style="width: 65px; min-width: 65px;">
            <label style="display: block">&nbsp;</label>
            <button type="submit" class="btn bg-purple"><?php echo trans("filter"); ?></button>
		</div>
        <?php echo form_close(); ?>
	</div>
</div>