<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-8">
        <div class="box box-primary">

            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?php echo trans('update_profile'); ?></h3>
                </div>
            </div><!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open_multipart('admin_controller/edit_user_post'); ?>

            <input type="hidden" name="id" value="<?php echo html_escape($user->id); ?>">

            <div class="box-body">
                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <div class="form-group">
                    <?php $role = $this->auth_model->get_role_by_key($user->role);
                    if (!empty($role)):
                       // if ($user->role == "moderator"):?>
                            <!--<label class="label bg-olive"><?php //echo $role->role_name; ?></label>-->
                        <?php if ($user->role == "author"): ?>
                            <label class="label label-warning"><?php echo $role->role_name; ?></label>
							<?php elseif ($user->role == "author1"): ?>
                            <label class="label label-warning"><?php echo $role->role_name; ?></label>
							<?php elseif ($user->role == "author2"): ?>
                            <label class="label label-warning"><?php echo $role->role_name; ?></label>
							<?php elseif ($user->role == "author3"): ?>
                            <label class="label label-warning"><?php echo $role->role_name; ?></label>
                        <?php elseif ($user->role == "user"): ?>
                            <label class="label label-default"><?php echo $role->role_name; ?></label>
                        <?php endif;
                    endif; ?>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 col-profile">
                            <img src="<?php echo html_escape(get_user_avatar($user)); ?>" alt="avatar" class="thumbnail img-responsive img-update">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-profile">
                            <p>
                                <a class="btn btn-success btn-sm btn-file-upload">
                                    <?php echo trans('change_avatar'); ?>
                                    <input name="file" size="40" accept=".png, .jpg, .jpeg" onchange="$('#upload-file-info').html($(this).val().replace(/.*[\/\\]/, ''));" type="file">
                                </a>
                            </p>
                            <p class='label label-info' id="upload-file-info"></p>
                        </div>
                    </div>
                </div>
				<?php if (is_admin()) { ?>
					<div class="form-group">
                    <label><?php echo trans('corp_name'); ?></label>
                    <select id="corps" class="form-control" name="corp_id" onchange="get_department_by_corp(this.value);" required>
                        <?php foreach ($corps as $item): ?>
							<?php if ($item->id == $user->corp_id): ?>
                        <option value="<?php echo html_escape($item->id); ?>" selected><?php echo html_escape($item->name); ?></option>
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
				<?php if (user()->role == 'admin' || user()->role == 'author3' ){ ?>
				<div class="form-group">
                    <label><?php echo trans('department_name'); ?></label>
                    <select id="depts" class="form-control" name="dept_id" required>
					<option value="0"><?php echo trans('select_dept'); ?></option>
                        <?php foreach ($depts as $ite): ?>
							<?php if ($ite->id == $user->dept_id): ?>
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
                    <label><?php echo trans('first_name'); ?></label>
                    <input type="text" class="form-control form-input"
                           name="first_name" placeholder="<?php echo trans('first_name'); ?>"
                           value="<?php echo html_escape($user->first_name); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>
				<div class="form-group">
                    <label><?php echo trans('last_name'); ?></label>
                    <input type="text" class="form-control form-input"
                           name="last_name" placeholder="<?php echo trans('last_name'); ?>"
                           value="<?php echo html_escape($user->last_name); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

				<div class="form-group">
                    <label><?php echo trans('email'); ?></label>
                    <input type="email" class="form-control form-input"
                           name="email" placeholder="<?php echo trans('email'); ?>"
                           value="<?php echo html_escape($user->email); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <!--<div class="form-group">
                    <label><?php //echo trans('username'); ?></label>
                    <input type="text" class="form-control form-input"
                           name="username" placeholder="<?php //echo trans('username'); ?>"
                           value="<?php //echo html_escape($user->username); ?>" <?php //echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>-->

                <!--<div class="form-group">
                    <label><?php //echo trans('slug'); ?></label>-->
                    <input type="hidden" class="form-control form-input"
                           name="slug" placeholder="<?php echo trans('slug'); ?>"
                           value="<?php echo html_escape($user->slug); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>><!--
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('about_me'); ?></label>
                    <textarea class="form-control text-area"
                              name="about_me" placeholder="<?php echo trans('about_me'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>><?php echo html_escape($user->about_me); ?></textarea>
                </div>

               <div class="form-group">
                    <label><?php //echo trans('social_accounts'); ?></label>
                    <input type="text" class="form-control form-input" name="facebook_url"
                           placeholder="Facebook <?php /*echo trans('url'); ?>" value="<?php echo html_escape($user->facebook_url); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control form-input"
                           name="twitter_url" placeholder="Twitter <?php echo trans('url'); ?>"
                           value="<?php echo html_escape($user->twitter_url); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control form-input" name="instagram_url" placeholder="Instagram <?php echo trans('url'); ?>"
                           value="<?php echo html_escape($user->instagram_url); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control form-input" name="pinterest_url" placeholder="Pinterest <?php echo trans('url'); ?>"
                           value="<?php echo html_escape($user->pinterest_url); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control form-input" name="linkedin_url" placeholder="LinkedIn <?php echo trans('url'); ?>"
                           value="<?php echo html_escape($user->linkedin_url); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control form-input" name="vk_url"
                           placeholder="VK <?php echo trans('url'); ?>" value="<?php echo html_escape($user->vk_url); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-input" name="youtube_url"
                           placeholder="Youtube <?php echo trans('url'); ?>" value="<?php echo html_escape($user->youtube_url); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; */?>>
                </div>-->

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
    </div>
</div>