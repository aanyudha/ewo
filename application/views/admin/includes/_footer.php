<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<footer id="footer" class="main-footer">
    <div class="pull-right hidden-xs">
        <strong style="font-weight: 600;"><?php echo $settings->copyright; ?>&nbsp;</strong>
	</div>
    <b>Version</b> <a href="#" data-toggle="modal" data-target="#versionCheck">1.8.2</a>
</footer>
</div><!-- ./wrapper -->
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/admin/js/adminlte.min.js"></script>
<!-- DataTables js -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<?php if (isset($checking_only_reports)): ?>
<!-- DataTables 2 js -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/data_tables_2/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/data_tables_2/dataTables.buttons.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/admin/plugins/data_tables_2/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/data_tables_2/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/data_tables_2/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/data_tables_2/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/data_tables_2/buttons.print.min.js"></script>
<?php endif; ?>
<!-- Lazy Load js -->
<script src="<?php echo base_url(); ?>assets/admin/js/lazysizes.min.js"></script>
<!-- iCheck js -->
<script src="<?php echo base_url(); ?>assets/vendor/icheck/icheck.min.js"></script>
<!-- Ckeditor js -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/ckeditor/ckeditor.js"></script>
<!-- Pace -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/pace/pace.min.js"></script>
<!-- File Manager -->
<script src="<?php echo base_url(); ?>assets/admin/plugins/file-manager/file-manager.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/plugins/tagsinput/jquery.tagsinput.min.js"></script>
	<!-- Bootstrap Toggle js -->
	<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap-toggle.min.js"></script>
	<!-- Plugins js -->
	<script src="<?php echo base_url(); ?>assets/admin/js/plugins.js"></script>
	<!-- Color Picker js -->
	<script src="<?php echo base_url(); ?>assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
	<!-- Datepicker js -->
	<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-datetimepicker/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
	<!-- Custom js -->
	<script src="<?php echo base_url(); ?>assets/admin/js/custom-1.6.min.js"></script>
	<!-- Custom magnific UNTUK pop up di wo list-->
	<script src="<?php echo base_url(); ?>assets/admin/js/magnific.js"></script>
	<script src="<?php echo base_url(); ?>assets/admin/js/custom-magnific.js"></script>
	<!-- for POP UP -->
    <script>
		$(document).ready(function(t) {
			t(".image-popup").magnificPopup({
				type: "image",
				titleSrc: function(t) {
					return t.el.attr("title") + "<small></small>"
				},
				image: {
					verticalFit: !0
				},
				gallery: {
					enabled: !0,
					navigateByImgClick: !0,
					preload: [0, 1]
				},
				removalDelay: 100,
				fixedContentPos: !0
			})
		}); 
	</script>
	<!-- for table report 'copy', 'csv', 'excel', 'pdf', 'print' -->
    <script>
		$(document).ready(function() {
			$('#example').DataTable( {
				dom: 'Bfrtip',
				"paging":   false,
				"info":     false,
				"ordering": false,
				"searching": false,
				buttons: [
				'excel'
				]
			} );
		} );
	</script>
	<!-- Ckeditor -->
	<script>
		var ckEditor = document.getElementById('ckEditor');
		if (ckEditor != undefined && ckEditor != null) {
			CKEDITOR.replace('ckEditor', {
				language: 'en',
				filebrowserBrowseUrl: 'path',
				removeButtons: 'Save',
				allowedContent: true,
				extraPlugins: 'videoembed,oembed'
			});
		}
		
		function selectFile(fileUrl) {
			window.opener.CKEDITOR.tools.callFunction(1, fileUrl);
		}
		
		CKEDITOR.on('dialogDefinition', function (ev) {
			var editor = ev.editor;
			var dialogDefinition = ev.data.definition;
			
			// This function will be called when the user will pick a file in file manager
			var cleanUpFuncRef = CKEDITOR.tools.addFunction(function (a) {
				$('#ck_file_manager').modal('hide');
				CKEDITOR.tools.callFunction(1, a, "");
			});
			var tabCount = dialogDefinition.contents.length;
			for (var i = 0; i < tabCount; i++) {
				var browseButton = dialogDefinition.contents[i].get('browse');
				if (browseButton !== null) {
					browseButton.onClick = function (dialog, i) {
						editor._.filebrowserSe = this;
						var iframe = $('#ck_file_manager').find('iframe').attr({
							src: editor.config.filebrowserBrowseUrl + '&CKEditor=body&CKEditorFuncNum=' + cleanUpFuncRef + '&langCode=en'
						});
						$('#ck_file_manager').appendTo('body').modal('show');
					}
				}
			}
		});
		CKEDITOR.on('instanceReady', function (evt) {
			$(document).on('click', '.btn_ck_add_image', function () {
				if (evt.editor.name != undefined) {
					evt.editor.execCommand('image');
				}
			});
			$(document).on('click', '.btn_ck_embed_media', function () {
				if (evt.editor.name != undefined) {
					evt.editor.execCommand('oembed');
				}
			});
			$(document).on('click', '.btn_ck_add_video', function () {
				if (evt.editor.name != undefined) {
					evt.editor.execCommand('videoembed');
				}
			});
			$(document).on('click', '.btn_ck_add_iframe', function () {
				if (evt.editor.name != undefined) {
					evt.editor.execCommand('iframe');
				}
			});
		});
	</script>
	
	<script>
		function mBalik() {
			window.history.back();
		}
	</script>
	
	<?php if ($site_lang->text_direction == "rtl"): ?>
    <script type="text/javascript">
        jQuery(function () {
            if (typeof (CKEDITOR) != "undefined") {
                CKEDITOR.config.contentsLangDirection = 'rtl';
			}
		});
	</script>
	<?php endif; ?>
	<style>.cke_button__iframe {display: none !important;}</style>
	
	<?php if (isset($lang_search_column)): ?>
    <script>
        var table = $('#cs_datatable_lang').DataTable({
            dom: 'l<"#table_dropdown">frtip',
            "order": [[0, "desc"]],
            "aLengthMenu": [[15, 30, 60, 100], [15, 30, 60, 100, "All"]]
		});
        //insert a label
        $('<label class="table-label"><label/>').text('Language').appendTo('#table_dropdown');
		
        //insert the select and some options
        $select = $('<select class="form-control input-sm"><select/>').appendTo('#table_dropdown');
		
        $('<option/>').val('').text('<?php echo trans("all"); ?>').appendTo($select);
        <?php foreach ($languages as $lang): ?>
        $('<option/>').val('<?php echo $lang->name; ?>').text('<?php echo $lang->name; ?>').appendTo($select);
        <?php endforeach; ?>
		
		
        $("#table_dropdown select").change(function () {
            table.column(<?php echo $lang_search_column; ?>).search($(this).val()).draw();
		});
	</script>
	<?php endif; ?>
	
	<div id="versionCheck" class="modal fade" role="dialog">
		<div class="modal-dialog">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Change Log</h4>
				</div>

				<div class="modal-body">
					<div class="form-group">
						
						<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css" integrity="sha256-nwNjrH7J9zS/Ti4twtWX7OsC5QdQHCIKTv5cLMsGo68=" crossorigin="anonymous" />
						<div class="container">
							<div class="row justify-content-center">
								<div class="col-lg-8 col-md-10 col-12">
									
									<h5 class="mt-4"> <span class="p-2 bg-light shadow rounded text-success"> Version 1.8.2</span> - 29-04-2020</h5>
									<ul class="list-unstyled mt-3">
										<li class="text-muted ml-3"><i class="mdi mdi-circle-medium mr-2"></i>Add Incoming and Outgoing WO</li>
										<li class="text-muted ml-3"><i class="mdi mdi-circle-medium mr-2"></i>Fixed some security issues</li>
										<li class="text-muted ml-3"><i class="mdi mdi-circle-medium mr-2"></i>Fixed some save issues</li>
									</ul>
									
									<h5 class="mt-4"> <span class="p-2 bg-light shadow rounded text-success"> Version 1.7.2</span> - 22-04-2020</h5>
									<ul class="list-unstyled mt-3">
										<li class="text-muted ml-3"><i class="mdi mdi-circle-medium mr-2"></i>Report XLS added</li>
										<li class="text-muted ml-3"><i class="mdi mdi-circle-medium mr-2"></i>Left menu without sub menu : remove tree view</li>
										<li class="text-muted ml-3"><i class="mdi mdi-circle-medium mr-2"></i>Fixed some responsive issues</li>
										<li class="text-muted ml-3"><i class="mdi mdi-circle-medium mr-2"></i>Change summary to description on wo list and report</li>
										<li class="text-muted ml-3"><i class="mdi mdi-circle-medium mr-2"></i>Add description on wo list</li>
										<li class="text-muted ml-3"><i class="mdi mdi-circle-medium mr-2"></i>Add / on location on wo list and report</li>
										<li class="text-muted ml-3"><i class="mdi mdi-circle-medium mr-2"></i>Update change log</li>
										<li class="text-muted ml-3"><i class="mdi mdi-circle-medium mr-2"></i>Add Cancel button on reply WO</li>
									</ul>
								</div><!--end col-->
							</div><!--end row-->
						</div>
						
						
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo trans('close'); ?></button>
				</div>
			</div>
			
		</div>
	</div>
	
</body>
</html>

