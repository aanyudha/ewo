<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--<div class="box">-->
   <!-- <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?php echo trans('location'); ?></h3>
        </div>
    </div> /.box-header -->
    <!--<div class="box-body">-->
        <!--<div class="form-group">
            <label><?php //echo trans("language"); ?></label>
            <select name="lang_id" class="form-control" onchange="get_top_locations_by_lang(this.value);">
                <?php //foreach ($languages as $language): ?>
                    <option value="<?php //echo $language->id; ?>" <?php //echo ($site_lang->id == $language->id) ? 'selected' : ''; ?>><?php //echo $language->name; ?></option>-->
                    <input type="hidden" name="lang_id" value="1" >
                <!--<?php //endforeach; ?>
            </select>
        </div> -->
         <div class="form-group">
            <label class="control-label"><?php echo trans('location'); ?></label>
            <select id="locations" name="location_id" class="form-control" onchange="get_sub_locations(this.value);" required>
                <option value=""><?php echo trans('select_location'); ?></option>
                <?php foreach ($top_locations as $item): ?>
                    <?php if ($item->id == old('location_id')): ?>
                        <option value="<?php echo html_escape($item->id); ?>"
                                selected><?php echo html_escape($item->name); ?></option>
                    <?php else: ?>
                        <option value="<?php echo html_escape($item->id); ?>"><?php echo html_escape($item->name); ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo trans('sublocation'); ?></label>
            <select id="sublocations" name="sublocation_id" class="form-control" required>
                <option value="0"><?php echo trans('select_location'); ?></option>
            </select>
        </div>
   <!-- </div>
</div>-->





