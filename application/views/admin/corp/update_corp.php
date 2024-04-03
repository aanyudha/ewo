<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-lg-5 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo trans("update_corp"); ?></h3>
            </div>
            <!-- /.box-header -->

            <!-- form start -->
            <?php echo form_open('corp_controller/update_corp_post'); ?>

            <input type="hidden" name="id" value="<?php echo html_escape($corp->id); ?>">
            <input type="hidden" name="parent_id" value="0">
            <input type="hidden" name="redirect_url" value="<?php echo html_escape($this->input->get('redirect_url')); ?>">

            <div class="box-body">

                <!-- include message block -->
                <?php $this->load->view('admin/includes/_messages'); ?>

                <div class="form-group">
                    <label><?php echo trans("corp_name"); ?></label>
                    <input type="text" class="form-control" name="name" placeholder="<?php echo trans("corp_name"); ?>"
                           value="<?php echo html_escape($corp->name); ?>" maxlength="200" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?> required>
                </div>

               <div class="form-group">
                    <label><?php echo trans("corp_code"); ?></label>
                    <input type="text" class="form-control" name="corp_code" placeholder="<?php echo trans("corp_code"); ?>"
                           value="<?php echo html_escape($corp->corp_code); ?>" maxlength="200" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?> required>
                </div>

                <div class="form-group">
                    <label><?php echo trans('corp_order'); ?></label>
                    <input type="number" class="form-control" name="corp_order" placeholder="<?php echo trans('corp_order'); ?>"
                           value="<?php echo html_escape($corp->corp_order); ?>" min="1" <?php echo ($rtl == true) ? 'dir="rtl"' : ''; ?> required>
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
