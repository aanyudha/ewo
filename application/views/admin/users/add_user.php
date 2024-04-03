<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("add_user"); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('admin_controller/add_user_post'); ?>

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>
				
				<?php if (is_admin()) { ?>
					<div class="form-group">
                    <label><?php echo trans('corp_name'); ?></label>
                    <select id="corps" class="form-control" name="corp_id" onchange="get_department_by_corp(this.value);" required>
                        <option value=""><?php echo trans('select'); ?></option>
                        <?php foreach ($corps as $item): ?>
                            <!--<option value="<?php //echo $item->id; ?>"><?php //echo $item->name; ?></option> -->
						<?php if ($item->id == old('corp_id')): ?>
                        <option value="<?php echo html_escape($item->id); ?>"
                                selected><?php echo html_escape($item->name); ?></option>
						<?php else: ?>
                        <option value="<?php echo html_escape($item->id); ?>"><?php echo html_escape($item->name); ?></option>
						<?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
				<?php } else { ?>
				<?php $corplogin = $this->auth_model->get_corp_id_by_user_login(); ?>
				<input type="hidden" name="corp_id" value="<?php echo html_escape($corplogin); ?>" >
				<?php } ?>
				
				<?php //if (is_admin()) { ?>
				<?php if (user()->role == 'admin' || user()->role == 'author3'){ ?>
					<div class="form-group">
                    <label><?php echo trans('department_name'); ?></label>
                    <select id="depts" class="form-control" name="dept_id" required>
					<option value="0"><?php echo trans('select_dept'); ?></option>
                        <?php foreach ($depts as $ite): ?>
							<?php if ($ite->id == user()->dept_id): ?>
                        <option value="<?php echo html_escape($ite->id); ?>" selected><?php echo html_escape($ite->name); ?></option>
                    <?php else: ?>
                        <option value="<?php echo html_escape($ite->id); ?>"><?php echo html_escape($ite->name); ?></option>
                    <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
				<?php } else { ?>
				<?php $deptlogin = $this->auth_model->get_dept_id_bylogin(); ?>
				<input type="hidden" name="dept_id" value="<?php echo html_escape($deptlogin); ?>" >
				<?php } ?>
				
				<div class="form-group">
                    <label><?php echo trans("first_name"); ?></label>
                    <input type="text" name="first_name" class="form-control auth-form-input" placeholder="<?php echo trans("first_name"); ?>" value="<?php echo old("first_name"); ?>" required>
                </div>
				<div class="form-group">
                    <label><?php echo trans("last_name"); ?></label>
                    <input type="text" name="last_name" class="form-control auth-form-input" placeholder="<?php echo trans("last_name"); ?>" value="<?php echo old("last_name"); ?>" required>
                </div>
                <!--<div class="form-group">
                    <label><?php //echo trans("username"); ?></label>
                    <input type="text" name="username" class="form-control auth-form-input" placeholder="<?php //echo trans("username"); ?>" value="<?php //echo old("username"); ?>" required>
                </div>-->
                <div class="form-group">
                    <label><?php echo trans("email"); ?></label>
                    <input type="email" name="email" class="form-control auth-form-input" placeholder="<?php echo trans("email"); ?>" value="<?php echo old("email"); ?>" required>
                </div>
                <div class="form-group">
                    <label><?php echo trans("form_password"); ?></label>
                    <input type="password" name="password" class="form-control auth-form-input" placeholder="<?php echo trans("form_password"); ?>" value="<?php echo old("password"); ?>" required>
                </div>
                <div class="form-group">
                    <label><?php echo trans("role"); ?></label>
                    <select name="role" class="form-control">
                        <?php foreach ($roles as $role): ?>
                            <option value="<?php echo $role->id; ?>"><?php echo $role->role_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
				
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('add_user'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>
</div>
