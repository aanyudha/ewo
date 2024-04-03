<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-5 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("update_department"); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('department_controller/update_department_post'); ?>

            <input type="hidden" name="id" value="<?php echo html_escape($department->id); ?>">
            <input type="hidden" name="parent_id" value="0">
            <input type="hidden" name="redirect_url" value="<?php echo html_escape($this->input->get('redirect_url')); ?>">

            <div class="box-body">

                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

               <!-- <div class="form-group">
                    <label><?php //echo trans("language"); ?></label>-->
					<input type="hidden" name="lang_id" value="1" ><!--
                    <select name="lang_id" class="form-control">
                        <?php //foreach ($languages as $language): ?>
                            <option value="<?php //echo $language->id; ?>" <?php //echo ($department->lang_id == $language->id) ? 'selected' : ''; ?>><?php //echo $language->name; ?></option>
                        <?php //endforeach; ?>
                    </select>
                </div> -->
				
				<?php if (is_admin()) { ?>
				<div class="form-group">
                    <label><?php echo trans('corp_name'); ?></label>
                    <select id="departments" class="form-control" name="corp_id" required>
                        <?php foreach ($corps as $item): ?>
							<?php if ($item->id == $department->corp_id): ?>
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

                <div class="form-group">
                    <label><?php echo trans("department_name"); ?></label>
                    <input type="text" class="form-control" name="name" placeholder="<?php echo trans("department_name"); ?>"
                           value="<?php echo html_escape($department->name); ?>" maxlength="200" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?> required>
                </div>

              <!--  <div class="form-group">
                    <label class="control-label"><?php echo trans("slug"); ?>
                        <small>(<?php echo trans("slug_exp"); ?>)</small>
                    </label>
                    <input type="text" class="form-control" name="name_slug" placeholder="<?php echo trans("slug"); ?>"
                           value="<?php echo html_escape($department->name_slug); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('description'); ?> (<?php echo trans('meta_tag'); ?>)</label>
                    <input type="text" class="form-control" name="description"
                           placeholder="<?php echo trans('description'); ?> (<?php echo trans('meta_tag'); ?>)" value="<?php echo html_escape($department->description); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('keywords'); ?> (<?php echo trans('meta_tag'); ?>)</label>
                    <input type="text" class="form-control" name="keywords"
                           placeholder="<?php echo trans('keywords'); ?> (<?php echo trans('meta_tag'); ?>)" value="<?php echo html_escape($department->keywords); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <!-- Color Picker -->
                <div class="form-group">
                    <label><?php echo trans('color'); ?></label>
                    <div class="input-group my-colorpicker">
                        <input type="text" class="form-control" name="color" maxlength="200" value="<?php echo html_escape($department->color); ?>" placeholder="<?php echo trans('color'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>
                               required>
                        <div class="input-group-addon">
                            <i></i>
                        </div>
                    </div><!-- /.input group -->
                </div><!-- /.form group -->

                <div class="form-group">
                    <label><?php echo trans('order'); ?></label>
                    <input type="number" class="form-control" name="department_order" placeholder="<?php echo trans('order'); ?>"
                           value="<?php echo html_escape($department->department_order); ?>" min="1" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?> required>
                </div>

               <!-- <div class="form-group">
                    <div class="row">
                        <div class="col-sm-5 col-xs-12">
                            <label><?php echo trans('show_on_menu'); ?></label>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12 col-option">
                            <input type="radio" id="rb_show_on_menu_1" name="show_on_menu" value="1" class="square-purple" <?php echo ($department->show_on_menu == '1') ? 'checked' : ''; ?>>
                            <label for="rb_show_on_menu_1" class="cursor-pointer"><?php echo trans('yes'); ?></label>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12 col-option">
                            <input type="radio" id="rb_show_on_menu_2" name="show_on_menu" value="0" class="square-purple" <?php echo ($department->show_on_menu != '1') ? 'checked' : ''; ?>>
                            <label for="rb_show_on_menu_2" class="cursor-pointer"><?php echo trans('no'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-5 col-xs-12">
                            <label><?php echo trans('show_at_homepage'); ?></label>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12 col-option">
                            <input type="radio" id="rb_show_at_homepage_1" name="show_at_homepage" value="1" class="square-purple" <?php echo ($department->show_at_homepage == '1') ? 'checked' : ''; ?>>
                            <label for="rb_show_at_homepage_1" class="cursor-pointer"><?php echo trans('yes'); ?></label>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12 col-option">
                            <input type="radio" id="rb_show_at_homepage_2" name="show_at_homepage" value="0" class="square-purple" <?php echo ($department->show_at_homepage != '1') ? 'checked' : ''; ?>>
                            <label for="rb_show_at_homepage_2" class="cursor-pointer"><?php echo trans('no'); ?></label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label><?php echo trans('department_block_style'); ?></label>

                    <div class="row m-b-15 m-t-15">
                        <div class="department-block-box">
                            <div class="col-sm-12 text-center m-b-15">
                                <input type="radio" name="block_type" value="block-1" class="square-purple" <?php echo ($department->block_type == 'block-1') ? 'checked' : ''; ?>>
                            </div>
                            <img src="<?php echo base_url(); ?>assets/admin/img/block-1.png" alt="" class="img-responsive cat-block-img">
                        </div>
                        <div class="department-block-box">
                            <div class="col-sm-12 text-center m-b-15">
                                <input type="radio" name="block_type" value="block-2" class="square-purple" <?php echo ($department->block_type == 'block-2') ? 'checked' : ''; ?>>
                            </div>
                            <img src="<?php echo base_url(); ?>assets/admin/img/block-2.png" alt="" class="img-responsive cat-block-img">
                        </div>

                        <div class="department-block-box">
                            <div class="col-sm-12 text-center m-b-15">
                                <input type="radio" name="block_type" value="block-3" class="square-purple" <?php echo ($department->block_type == 'block-3') ? 'checked' : ''; ?>>
                            </div>
                            <img src="<?php echo base_url(); ?>assets/admin/img/block-3.png" alt="" class="img-responsive cat-block-img">
                        </div>
                        <div class="department-block-box">
                            <div class="col-sm-12 text-center m-b-15">
                                <input type="radio" name="block_type" value="block-4" class="square-purple" <?php echo ($department->block_type == 'block-4') ? 'checked' : ''; ?>>
                            </div>
                            <img src="<?php echo base_url(); ?>assets/admin/img/block-4.png" alt="" class="img-responsive cat-block-img">
                        </div>
                        <div class="department-block-box">
                            <div class="col-sm-12 text-center m-b-15">
                                <input type="radio" name="block_type" value="block-5" class="square-purple" <?php echo ($department->block_type == 'block-5') ? 'checked' : ''; ?>>
                            </div>
                            <img src="<?php echo base_url(); ?>assets/admin/img/block-5.png" alt="" class="img-responsive cat-block-img">
                        </div>
                    </div>

                </div>


            </div>


            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('save_changes'); ?> </button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>

</div>
