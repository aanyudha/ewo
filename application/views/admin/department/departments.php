<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-5 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("add_department"); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('department_controller/add_department_post'); ?>

            <input type="hidden" name="parent_id" value="0">

            <div class="box-body">

                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages_form'); ?>

               <!-- <div class="form-group">
                    <label><?php //echo trans("language"); ?></label>
                    <select name="lang_id" class="form-control">
                        <?php //foreach ($languages as $language): ?>-->
						<input type="hidden" name="lang_id" value="1" ><!--
                            <option value="<?php //echo $language->id; ?>" <?php //echo ($site_lang->id == $language->id) ? 'selected' : ''; ?>><?php // echo $language->name; ?></option>
                        <?php //endforeach; ?>
                    </select>
                </div> -->
				
				<?php if (is_admin()) { ?>
				<div class="form-group">
                    <label><?php echo trans('corp_name'); ?></label>
                    <select id="locations" class="form-control" name="corp_id" required>
                        <option value=""><?php echo trans('select'); ?></option>
                        <?php foreach ($corps as $item): ?>
                            <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
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
                           value="<?php echo old('name'); ?>" maxlength="200" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?> required>
                </div>
				
				<!--<div class="form-group">
                    <label class="control-label"><?php echo trans('visibility_cat'); ?></label>
					--><input type="hidden" name="visibility_cat" value="1" ><!--
                    <input type="text" class="form-control" name="visibility_cat"
                           placeholder="<?php //echo trans('visibility_cat'); ?> " value="<?php //echo old('visibility_cat'); ?>" <?php //echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>-->

                <!--<div class="form-group">
                    <label class="control-label"><?php echo trans("slug"); ?>
                        <small>(<?php echo trans("slug_exp"); ?>)</small>
                    </label>
                    <input type="text" class="form-control" name="name_slug" placeholder="<?php echo trans("slug"); ?>"
                           value="<?php echo old('name_slug'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('description'); ?> (<?php echo trans('meta_tag'); ?>)</label>
                    <input type="text" class="form-control" name="description"
                           placeholder="<?php echo trans('description'); ?> (<?php echo trans('meta_tag'); ?>)" value="<?php echo old('description'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>

                <div class="form-group">
                    <label class="control-label"><?php echo trans('keywords'); ?> (<?php echo trans('meta_tag'); ?>)</label>
                    <input type="text" class="form-control" name="keywords"
                           placeholder="<?php echo trans('keywords'); ?> (<?php echo trans('meta_tag'); ?>)" value="<?php echo old('keywords'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?>>
                </div>-->

                <!-- Color Picker -->
                <div class="form-group">
                    <label><?php echo trans('color'); ?></label>
                    <div class="input-group my-colorpicker">
                        <input type="text" class="form-control" name="color" maxlength="200" placeholder="<?php echo trans('color'); ?>" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?> required>
                        <div class="input-group-addon">
                            <i></i>
                        </div>
                    </div><!-- /.input group -->
                </div><!-- /.form group -->

               <div class="form-group">
                    <label><?php echo trans('order'); ?></label>
                    <input type="number" class="form-control" name="department_order" placeholder="<?php echo trans('order'); ?>"
                           value="1" min="1" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?> required>
                </div>
            </div>


            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><?php echo trans('add_department'); ?></button>
            </div>
            <!-- /.box-footer -->
            <?php echo form_close(); ?><!-- form end -->
        </div>
        <!-- /.box -->
    </div>


    <div class="col-lg-7 col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="pull-left">
                    <h3 class="box-title"><?php echo trans('departments'); ?></h3>
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
                            <table class="table table-bordered table-striped dataTable" id="cs_datatable_lang" role="grid"
                                   aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th width="20"><?php echo trans('id'); ?></th>
                                    <th><?php echo trans('department_name'); ?></th>
									 <th><?php echo trans('corp_name'); ?></th>
                                    <!--<th><?php //echo trans('language'); ?></th> -->
                                    <th><?php echo trans('order_1'); ?></th>
                                    <th><?php echo trans('color'); ?></th>
                                    <th class="max-width-120"><?php echo trans('options'); ?></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($departments as $item): ?>
                                    <tr>
                                        <td><?php echo html_escape($item->id); ?></td>
                                        <td><?php echo html_escape($item->name); ?></td>
										<td>
											<?php $corp = get_corp_table($item->corp_id);
                                            if (!empty($corp)) {
                                                echo html_escape($corp->name);
                                            } ?>
										</td>
                                        <!--<td>
                                            <?php
                                            /*$lang = get_language($item->lang_id);
                                            if (!empty($lang)) {
                                                echo html_escape($lang->name);
                                            }*/
                                            ?>
                                        </td>-->
                                        <td><?php echo html_escape($item->department_order); ?></td>
                                        <td>
                                            <div style="width: 60px; height: 30px; background-color:<?php echo html_escape($item->color); ?> ;"></div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn bg-purple dropdown-toggle btn-select-option"
                                                        type="button"
                                                        data-toggle="dropdown"><?php echo trans('select_an_option'); ?>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu options-dropdown">
                                                    <li>
                                                        <a href="<?php echo admin_url(); ?>update-department/<?php echo html_escape($item->id); ?>"><i class="fa fa-edit option-icon"></i><?php echo trans('edit'); ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="delete_item('department_controller/delete_department_post','<?php echo $item->id; ?>','<?php echo trans("confirm_department"); ?>');"><i class="fa fa-trash option-icon"></i><?php echo trans('delete'); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div>
    </div>
</div>
