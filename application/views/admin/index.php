<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $rolelogin = $this->auth_model->get_role_id_bylogin(); ?>
<?php if (check_user_permission('admin_panel')): ?>
	<!-- ================= POST IN ================= -->
    <!-- ================= ADMIN ================= -->
    <?php if (is_admin()): ?>

         <!-- ON PROGRESS -->

         <div class="row">
                <div class="col-sm-3 col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="left">
                                <h3 class="box-title"><?php echo trans('corps'); ?></h3>
                            </div>
                        </div><!-- /.box-header with-border -->
                            <div class="box-body"><!-- Small boxes (Stat box) -->
                                <select id="corps" class="form-control" name="corp_id" onchange="get_location_by_corp(this.value);" required>
                                    <option value=""><?php echo trans('select'); ?></option>
                                    <?php foreach ($corps as $item): ?>
                                        <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                                    <?php endforeach; ?>
                                 </select>
                            </div><!-- /.box-body -->
                    </div> <!-- box-primary -->
                </div><!-- col-sm-3 col-xs-12 -->
	    </div> <!-- row -->

    <!-- === ENG === -->
    <div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="box box-primary">
                <div class="box-header with-border">
                    <div class="left">
                        <h3 class="box-title"><?php echo trans('-eng'); ?></h3>
                    </div>
                </div><!-- /.box-header with-border -->
                    <div class="box-body"><!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count" id="aan"><?php echo $post_out_count_new; ?></h3>
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("new_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("new"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_pending; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("pending_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("pending"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a> -->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_waiting; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("waiting_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("waiting"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_progress; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("progress_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("progress"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-success">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_closed; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("closed_posts"); ?></p>
                                        </a>-->
                                        <p><?php echo trans("closed"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
            </div> <!-- box-primary -->
		</div><!-- col-sm-12 col-xs-12 -->
	</div> <!-- row -->
    <!-- === ENG END === -->

    <!-- === HK === -->
    <div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="box box-primary">
                <div class="box-header with-border">
                    <div class="left">
                        <h3 class="box-title"><?php echo trans('-hk'); ?></h3>
                    </div>
                </div><!-- /.box-header with-border -->
                    <div class="box-body"><!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_new; ?></h3>
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("new_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("new"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_pending; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("pending_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("pending"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a> -->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_waiting; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("waiting_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("waiting"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_progress; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("progress_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("progress"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-success">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_closed; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("closed_posts"); ?></p>
                                        </a>-->
                                        <p><?php echo trans("closed"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
            </div> <!-- box-primary -->
		</div><!-- col-sm-12 col-xs-12 -->
	</div> <!-- row -->
    <!-- === HK END === -->

    <!-- === IT === -->
    <div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="box box-primary">
                <div class="box-header with-border">
                    <div class="left">
                        <h3 class="box-title"><?php echo trans('-it'); ?></h3>
                    </div>
                </div><!-- /.box-header with-border -->
                    <div class="box-body"><!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_new; ?></h3>
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("new_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("new"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_pending; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("pending_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("pending"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a> -->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_waiting; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("waiting_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("waiting"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_progress; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("progress_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("progress"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-success">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_closed; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("closed_posts"); ?></p>
                                        </a>-->
                                        <p><?php echo trans("closed"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                        
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
            </div> <!-- box-primary -->
		</div><!-- col-sm-12 col-xs-12 -->
	</div> <!-- row -->
    <!-- === IT END === -->
    <!-- ================= Admin Corp dan GM ================= -->
    <?php elseif ($rolelogin == '7' || $rolelogin == '8'): ?>
    <!-- Role id 7 dan 8 HANYA MENAMPILKAN INCOMING SAJA -->
    <!-- === ENG === -->
    <div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="box box-primary">
                <div class="box-header with-border">
                    <div class="left">
                        <h3 class="box-title"><?php echo trans('-eng'); ?></h3>
                    </div>
                </div><!-- /.box-header with-border -->
                    <div class="box-body"><!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_count_new_eng; ?></h3>
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("new_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("new"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_count_pending_eng; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("pending_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("pending"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a> -->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_count_waiting_eng; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("waiting_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("waiting"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_count_progress_eng; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("progress_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("progress"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-success">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_count_closed_eng; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("closed_posts"); ?></p>
                                        </a>-->
                                        <p><?php echo trans("closed"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
            </div> <!-- box-primary -->
		</div><!-- col-sm-12 col-xs-12 -->
	</div> <!-- row -->
    <!-- === ENG END === -->

    <!-- === HK === -->
    <div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="box box-primary">
                <div class="box-header with-border">
                    <div class="left">
                        <h3 class="box-title"><?php echo trans('-hk'); ?></h3>
                    </div>
                </div><!-- /.box-header with-border -->
                    <div class="box-body"><!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_count_new_hk; ?></h3>
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("new_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("new"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_count_pending_hk; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("pending_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("pending"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a> -->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_count_waiting_hk; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("waiting_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("waiting"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_count_progress_hk; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("progress_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("progress"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-success">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_count_closed_hk; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("closed_posts"); ?></p>
                                        </a>-->
                                        <p><?php echo trans("closed"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
            </div> <!-- box-primary -->
		</div><!-- col-sm-12 col-xs-12 -->
	</div> <!-- row -->
    <!-- === HK END === -->

    <!-- === IT === -->
    <div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="box box-primary">
                <div class="box-header with-border">
                    <div class="left">
                        <h3 class="box-title"><?php echo trans('-it'); ?></h3>
                    </div>
                </div><!-- /.box-header with-border -->
                    <div class="box-body"><!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_count_new_it; ?></h3>
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("new_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("new"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_count_pending_it; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("pending_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("pending"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a> -->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_count_waiting_it; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("waiting_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("waiting"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_count_progress_it; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("progress_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("progress"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-success">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_count_closed_it; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("closed_posts"); ?></p>
                                        </a>-->
                                        <p><?php echo trans("closed"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
            </div> <!-- box-primary -->
		</div><!-- col-sm-12 col-xs-12 -->
	</div> <!-- row -->
    <!-- === IT END === -->
     <!-- ================= Selain ADMIN, Admin Corp dan GM ================= -->
    <?php else : ?>
        <div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="box box-primary">
                <div class="box-header with-border">
                    <div class="left">
                        <h3 class="box-title"><?php echo trans('posts_in'); ?></h3>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body"><!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box admin-small-box bg-danger">
                                <div class="inner">
                                    <h3 class="increase-count"><?php echo $post_count_new; ?></h3>
                            <!--     <a href="<?php echo admin_url(); ?>posts">
                                        <p><?php echo trans("new_posts"); ?></p>
                                    </a>-->
                                    <p><?php echo trans("new"); ?></p>
                                </div>
                                <div class="icon">
                                <!-- <a href="<?php echo admin_url(); ?>posts">
                                        <i class="fa fa-low-vision"></i>
                                    </a>-->
                                    <i class="fa fa-low-vision"></i>
                                </div>
                            </div> 
                        </div>
                        
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box admin-small-box bg-danger">
                                <div class="inner">
                                    <h3 class="increase-count"><?php echo $post_count_pending; ?></h3>
                                <!--  <a href="<?php echo admin_url(); ?>posts">
                                        <p><?php echo trans("pending_posts"); ?></p>
                                    </a>-->
                                    <p><?php echo trans("pending"); ?></p>
                                </div>
                                <div class="icon">
                                <!--    <a href="<?php echo admin_url(); ?>posts">
                                        <i class="fa fa-low-vision"></i>
                                    </a>-->
                                    <i class="fa fa-low-vision"></i>
                                </div>
                            </div> 
                        </div>
                        
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box admin-small-box bg-danger">
                                <div class="inner">
                                    <h3 class="increase-count"><?php echo $post_count_waiting; ?></h3>
                                <!--  <a href="<?php echo admin_url(); ?>posts">
                                        <p><?php echo trans("waiting"); ?></p>
                                    </a>-->
                                    <p><?php echo trans("waiting"); ?></p>
                                </div>
                                <div class="icon">
                                <!--   <a href="<?php echo admin_url(); ?>posts">
                                        <i class="fa fa-low-vision"></i>
                                    </a>-->
                                    <i class="fa fa-low-vision"></i>
                                </div>
                            </div> 
                        </div>
                        
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box admin-small-box bg-danger">
                                <div class="inner">
                                    <h3 class="increase-count"><?php echo $post_count_progress; ?></h3>
                                <!--     <a href="<?php echo admin_url(); ?>posts">
                                        <p><?php echo trans("progress_posts"); ?></p>
                                    </a> -->
                                    <p><?php echo trans("progress"); ?></p>
                                </div>
                                <div class="icon">
                                <!--   <a href="<?php echo admin_url(); ?>posts">
                                        <i class="fa fa-low-vision"></i>
                                    </a> -->
                                    <i class="fa fa-low-vision"></i>
                                </div>
                            </div> 
                        </div>
                        
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box admin-small-box bg-success">
                                <div class="inner">
                                    <h3 class="increase-count"><?php echo $post_count_closed; ?></h3>
                                <!--   <a href="<?php echo admin_url(); ?>posts">
                                        <p><?php echo trans("closed_posts"); ?></p>
                                    </a> -->
                                    <p><?php echo trans("closed"); ?></p>
                                </div>
                                <div class="icon">
                                <!--    <a href="<?php echo admin_url(); ?>posts">
                                        <i class="fa fa-low-vision"></i>
                                    </a> -->
                                    <i class="fa fa-low-vision"></i>
                                </div>
                            </div> 
                        </div>
                    </div><!-- /.row -->
                </div><!-- box-body -->
		    </div> <!-- box-primary -->
		</div> <!-- col-sm-12 col-xs-12 -->
	</div> <!-- row -->
    <?php endif; ?>
	

	<!-- ================= POST OUT ================= -->
    <?php if (is_admin() || $rolelogin == '7' || $rolelogin == '8'): ?>
        <!-- TIDAK PAKAI -->
    <?php else : ?>
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="box box-primary">
                <div class="box-header with-border">
                    <div class="left">
                        <h3 class="box-title"><?php echo trans('posts_out'); ?></h3>
                    </div>
                </div><!-- /.box-header with-border -->
                    <div class="box-body"><!-- Small boxes (Stat box) -->
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_new; ?></h3>
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("new_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("new"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_pending; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("pending_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("pending"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a> -->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_waiting; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("waiting_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("waiting"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-danger">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_progress; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("progress_posts"); ?></p>
                                        </a> -->
                                        <p><?php echo trans("progress"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="col-lg-3 col-xs-6">
                                <!-- small box -->
                                <div class="small-box admin-small-box bg-success">
                                    <div class="inner">
                                        <h3 class="increase-count"><?php echo $post_out_count_closed; ?></h3>
                                    <!--  <a href="<?php echo admin_url(); ?>posts">
                                            <p><?php echo trans("closed_posts"); ?></p>
                                        </a>-->
                                        <p><?php echo trans("closed"); ?></p>
                                    </div>
                                    <div class="icon">
                                    <!-- <a href="<?php echo admin_url(); ?>posts">
                                            <i class="fa fa-low-vision"></i>
                                        </a>-->
                                        <i class="fa fa-low-vision"></i>
                                    </div>
                                </div> 
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
            </div> <!-- box-primary -->
		</div><!-- col-sm-12 col-xs-12 -->
	</div> <!-- row -->
    <?php endif; ?>
<?php endif; ?>