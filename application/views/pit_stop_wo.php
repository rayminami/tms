<body class="skin-blue fixed">
	<style>
		.modal:nth-of-type(even) {
			z-index: 1042 !important;
		}
		.modal-backdrop.in:nth-of-type(even) {
			z-index: 1041 !important;
		}
		.tire-not-exist{
			opacity: 0.33;  /* Opacity for Modern Browsers */
			filter: alpha(opacity=33);  /* Opacity for IE8 and lower */
			zoom: 1;  /* Fix for IE7 */
		}
	</style>
	<script>
		////this is temporary variable for tire details data without ajax/////
		var tire_details = <?php echo json_encode($tire_details);?>;
		var tire_details_update = <?php echo json_encode($tire_details_update);?>;
		var temp_tables=[];
	</script>
	<!-- header logo: style can be found in header.less -->
	<?php 
		$CI = &get_instance(); 
		$CI->load->view('main/main_header');
	?>
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side strech">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div>
					<a id="clock-container">
						<i class="fa fa-calendar"></i>
						<span id="server_time"></span>
					</a>
				</div>
				<h1>
					PIT STOP WORK ORDER
					<small>Control panel</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="MainMenu"><i class="fa fa-wrench"></i> Main Menu</a></li>
					<li><a href="PitStop">Pit Stop</a></li>
					<li class="active">Pit Stop WO</li>
				</ol>
			</section>

			<!-- Main content -->
			<section class="content">
			
				<!-- Loading Modal -->
				<div class="modal fade" id="loadingFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Loading</h4>
					  </div>
					  <div class="modal-body">
						<div class="progress">
						  <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
							<span class="sr-only">45% Complete</span>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
				
				<!-- 
					Thiiiis is FORM MODAL!!
				-->
				<div class="modal fade" id="formModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow-y:auto">
				  <div class="modal-dialog bs-example-modal-lg">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">Modal title</h4>
					  </div>
					  <div class="modal-body">
						...
					  </div>
					  <div class="modal-footer">
						
					  </div>
					</div>
				  </div>
				</div>
				
				<div class="row">
				<form id="pit-stop-wo-form" role="form" action="<?php echo base_url() ?>pitstopwo/setDetails" method="POST">
					<div class="col-lg-12 col-md-12">
						<div class="col-lg-7 col-md-7">
							<div class="box box-warning" style="overflow:auto;">
								<div class="box-body">
									<div class="col-lg-3 col-md-6 col-sm-3 col-ss-6 col-xs-12">
										<div class="form-group">
											<label for="nowo">NO WO</label>
											<input type="text" class="form-control" id="nowo" name="nowo" value="<?php echo $nowo;?>" readonly>
										</div>
									</div>
									
									<div class="col-lg-3 col-md-6 col-sm-3 col-ss-6 col-xs-12">
										<div class="form-group">
											<label for="form_date">Date</label>
											<input type="text" class="form-control" id="form_date" name="tglwo" value="<?php echo $tglwo;?>" readonly>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-3 col-ss-6 col-xs-12">
										<div class="col-xs-5 no-padding">
											<div class="form-group">
												<label for="kilometer">Kilometer</label>
												<input type="text" class="form-control" id="kilometer" name="kilometer" value="<?php echo $kilometer;?>" readonly>
											</div>
										</div>
										<div class="col-xs-1 no-padding">
											<div class="form-group">
												<label for="kilometer">/</label></br>
												<label for="kilometer" class="control-label">/</label>
											</div>
										</div>
										<div class="col-xs-6 no-padding">
											<div class="form-group">
												<label for="kilometer" style="white-space:nowrap;">Kilometer GPS</label>
												<input type="text" class="form-control" id="kilometergps" name="kilometergps" value="<?php echo $kilometergps;?>" readonly>
											</div>
										</div>
									</div>
									<!--<div class="col-lg-3 col-md-6 col-sm-3 col-ss-6 col-xs-12">
										<div class="form-group">
											<label for="kilometer">Kilometer</label>
											<input type="text" class="form-control" id="kilometer" name="kilometer" value="<?php echo $kilometer;?>" readonly>
										</div>
									</div>
									
									<div class="col-lg-3 col-md-6 col-sm-3 col-ss-6 col-xs-12">
										<div class="form-group">
											<label for="kilometer">Kilometer GPS</label>
											<input type="text" class="form-control" id="kilometergps" name="kilometergps" value="<?php echo $kilometergps;?>" readonly>
										</div>
									</div>-->
									
									<div class="col-lg-3 col-md-6 col-sm-3 col-ss-6 col-xs-12">
										<div class="form-group">
											<label for="location">Location</label>
											<input type="text" class="form-control" id="location" name="location" value="<?php echo $location;?>" readonly>
										</div>
									</div>
									<div style="clear:both;"></div>
									
									<!------------------------------------------------------------------------------------
																	START TIRE POSITIONING
									
									-------------------------------------------------------------------------------------->
									
									
									<!----------------------------this is row for tire image-------------------------------------------------------->
									<div class="col-lg-4 col-md-4 col-md-offset-0 col-xs-2 col-xs-offset-1 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">L1</label>
											<div class="img-con">
												<img id="idx_L1" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-xs-4 col-md-offset-0 no-padding col-xs-offset-1 tire-pos">
										<div class="small-box2">
											<label id="show-temp-modal" class="btn btn-warning btn-show-full" value="show_temp" name="show_temp" type="button">Show Temporary</label>
											<label class="btn btn-warning btn-show-little" value="show_temp" name="show_temp" type="button">Show</br>Temp</label>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-md-offset-0 col-xs-2 col-xs-offset-1 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">R1</label>
											<div class="img-con">
												<img id="idx_R1" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div style="clear:both;"></div>
									<!----------------------------this is row for current/update field-------------------------------------------------------->
									<div class="col-lg-4 col-md-4 col-xs-4 no-padding tire-pos">
										<div class="small-box2 form-group">
											<div class="col-lg-8 col-lg-offset-2 col-md-8 col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-ss-10 no-padding">
												<input type="text" class="curr-tire" id="curr_L1" value="<?php echo $tire_details['L1']['tireidset']?>" readonly checked>
											</div>
											<div class="col-lg-8 col-lg-offset-2 col-md-8 col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-ss-10 no-padding">
												<input type="text" class="update-tire updt-tire" id="updt_L1" value="<?php echo $tire_details_update['L1']['tireidset']?>" readonly checked>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-xs-4 no-padding tire-pos">
										
									</div>
									<div class="col-lg-4 col-md-4 col-xs-4 no-padding tire-pos">
										<div class="small-box2 form-group">
											<div class="col-lg-8 col-lg-offset-2 col-md-8 col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-ss-10 no-padding">
												<input type="text" class="curr-tire" id="curr_R1" value="<?php echo $tire_details['R1']['tireidset']?>" readonly checked>
											</div>
											<div class="col-lg-8 col-lg-offset-2 col-md-8 col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-ss-10 no-padding">
												<input type="text" class="update-tire updt-tire" id="updt_R1" value="<?php echo $tire_details_update['R1']['tireidset']?>" readonly checked>
											</div>
										</div>
									</div>
									
									
									<!-- NEXT FIVE TIRE L2O L2I ? R2O R2I-->
									<div style="clear:both;"></div>
									<!----------------------------this is row for tire image-------------------------------------------------------->
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">L2O</label>
											<div class="img-con <?php echo $tire_details['L2O']['tireidset']==""?'tire-not-exist"':"a";?>">
												<img id="idx_L2O" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">L2I</label>
											<div class="img-con">
												<img id="idx_L2I" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-xs-4 no-padding">
										
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">R2I</label>
											<div class="img-con">
												<img id="idx_R2I" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">R2O</label>
											<div class="img-con">
												<img id="idx_R2O" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div style="clear:both;"></div>
									<!----------------------------this is row for current/update field-------------------------------------------------------->
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_L2O" value="<?php echo $tire_details['L2O']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_L2O" value="<?php echo $tire_details_update['L2O']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_L2I" value="<?php echo $tire_details['L2I']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_L2I" value="<?php echo $tire_details_update['L2I']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-xs-4 no-padding">
										
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_R2I" value="<?php echo $tire_details['R2I']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_R2I" value="<?php echo $tire_details_update['R2I']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_R2O" value="<?php echo $tire_details['R2O']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_R2O" value="<?php echo $tire_details_update['R2O']['tireidset']?>" readonly checked>
										</div>
									</div>
									<!-- NEXT FIVE TIRE L3O L3I ? R3O R3I-->
									<div style="clear:both;"></div>
									<!----------------------------this is row for tire image-------------------------------------------------------->
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">L3O</label>
											<div class="img-con">
												<img id="idx_L3O" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">L3I</label>
											<div class="img-con">
												<img id="idx_L3I" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-xs-4 no-padding">
										<div class="small-box2">
											<label for="nowo">S1</label>
											<div class="img-con col-lg-8 col-lg-offset-2 col-md-8 col-xs-11 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-ss-10 no-padding">
												<div>&nbsp </div>
												<img id="idx_S1" src="<?php echo base_url('assets/img/tires.png') ?>" style="max-height:40px;margin-bottom:2%;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">R3I</label>
											<div class="img-con">
												<img id="idx_R3I" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">R3O</label>
											<div class="img-con">
												<img id="idx_R3O" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<!----------------------------this is row for current/update field-------------------------------------------------------->
									
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_L3O" value="<?php echo $tire_details['L3O']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_L3O" value="<?php echo $tire_details_update['L3O']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_L3I" value="<?php echo $tire_details['L3I']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_L3I" value="<?php echo $tire_details_update['L3I']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-xs-4 no-padding">
										<div class="small-box2 form-group">
											<div class="col-lg-8 col-lg-offset-2 col-md-8 col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-ss-10 no-padding">
												<input type="text" class="curr-tire" id="curr_S1" value="<?php echo $tire_details['S1']['tireidset']?>" readonly checked>
											</div>
											<div class="col-lg-8 col-lg-offset-2 col-md-8 col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-ss-10 no-padding">
												<input type="text" class="update-tire updt-tire" id="updt_S1" value="<?php echo $tire_details_update['S1']['tireidset']?>" readonly checked>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_R3I" value="<?php echo $tire_details['R3I']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_R3I" value="<?php echo $tire_details_update['R3I']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_R3O" value="<?php echo $tire_details['R3O']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_R3O" value="<?php echo $tire_details_update['R3O']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div style="clear:both;"></div>
									<!----------------------------this is row for tire image-------------------------------------------------------->
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">L4O</label>
											<div class="img-con">
												<img id="idx_L4O" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">L4I</label>
											<div class="img-con">
												<img id="idx_L4I" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-xs-4 no-padding">
										<div class="small-box2">
											<label for="nowo">S2</label>
											<div class="img-con col-lg-8 col-lg-offset-2 col-md-8 col-xs-11 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-ss-10 no-padding">
												<div>&nbsp </div>
												<img id="idx_S2" src="<?php echo base_url('assets/img/tires.png') ?>" style="max-height:40px;margin-bottom:2%;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">R4I</label>
											<div class="img-con">
												<img id="idx_R4I" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">R4O</label>
											<div class="img-con">
												<img id="idx_R4O" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<!----------------------------this is row for current/update field-------------------------------------------------------->
									
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_L4O" value="<?php echo $tire_details['L4O']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_L4O" value="<?php echo $tire_details_update['L4O']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_L4I" value="<?php echo $tire_details['L4I']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_L4I" value="<?php echo $tire_details_update['L4I']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-xs-4 no-padding">
										<div class="small-box2 form-group">
											<div class="col-lg-8 col-lg-offset-2 col-md-8 col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-ss-10 no-padding">
												<input type="text" class="curr-tire" id="curr_S2" value="<?php echo $tire_details_update['S2']['tireidset']?>" readonly checked>
											</div>
											<div class="col-lg-8 col-lg-offset-2 col-md-8 col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-ss-10 no-padding">
												<input type="text" class="update-tire updt-tire" id="updt_S2" value="<?php echo $tire_details_update['S2']['tireidset']?>" readonly checked>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_R4I" value="<?php echo $tire_details['R4I']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_R4I" value="<?php echo $tire_details_update['R4I']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_R4O" value="<?php echo $tire_details['R4O']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_R4O" value="<?php echo $tire_details_update['R4O']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div style="clear:both;"></div>
									<!----------------------------this is row for tire image-------------------------------------------------------->
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">L5O</label>
											<div class="img-con">
												<img id="idx_L5O" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">L5I</label>
											<div class="img-con">
												<img id="idx_L5I" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-xs-4 no-padding">
										<div class="small-box2">
											<label for="nowo">S3</label>
											<div class="img-con col-lg-8 col-lg-offset-2 col-md-8 col-xs-11 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-ss-10 no-padding">
												<div>&nbsp </div>
												<img id="idx_S3" src="<?php echo base_url('assets/img/tires.png') ?>" style="max-height:40px;margin-bottom:2%;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">R5I</label>
											<div class="img-con">
												<img id="idx_R5I" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">R5O</label>
											<div class="img-con">
												<img id="idx_R5O" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<!----------------------------this is row for current/update field-------------------------------------------------------->
									
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_L5O" value="<?php echo $tire_details['L5O']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_L5O" value="<?php echo $tire_details_update['L5O']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_L5I" value="<?php echo $tire_details['L5I']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_L5I" value="<?php echo $tire_details_update['L5I']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-xs-4 no-padding">
										<div class="small-box2 form-group">
											<div class="col-lg-8 col-lg-offset-2 col-md-8 col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-ss-10 no-padding">
												<input type="text" class="curr-tire" id="curr_S3" value="<?php echo $tire_details['S3']['tireidset']?>" readonly checked>
											</div>
											<div class="col-lg-8 col-lg-offset-2 col-md-8 col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-ss-10 no-padding">
												<input type="text" class="update-tire updt-tire" id="updt_S3" value="<?php echo $tire_details_update['S3']['tireidset']?>" readonly checked>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_R5I" value="<?php echo $tire_details['R5I']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_R5I" value="<?php echo $tire_details_update['R5I']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_R5O" value="<?php echo $tire_details['R5O']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_R5O" value="<?php echo $tire_details_update['R5O']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div style="clear:both;"></div>
									<!----------------------------this is row for tire image-------------------------------------------------------->
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">L6O</label>
											<div class="img-con">
												<img id="idx_L6O" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">L6I</label>
											<div class="img-con">
												<img id="idx_L6I" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-xs-4 no-padding">

									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">R6I</label>
											<div class="img-con">
												<img id="idx_R6I" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">R6O</label>
											<div class="img-con">
												<img id="idx_R6O" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<!----------------------------this is row for current/update field-------------------------------------------------------->
									
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_L6O" value="<?php echo $tire_details['L6O']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_L6O" value="<?php echo $tire_details_update['L6O']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_L6I" value="<?php echo $tire_details['L6I']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_L6I" value="<?php echo $tire_details_update['L6I']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-xs-4 no-padding">
										
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_R6I" value="<?php echo $tire_details['R6I']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_R6I" value="<?php echo $tire_details_update['R6I']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_R6O" value="<?php echo $tire_details['R6O']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_R6O" value="<?php echo $tire_details_update['R6O']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div style="clear:both;"></div>
									<!----------------------------this is row for tire image-------------------------------------------------------->
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">L7O</label>
											<div class="img-con">
												<img id="idx_L7O" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">L7I</label>
											<div class="img-con">
												<img id="idx_L7I" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-xs-4 no-padding">

									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">R7I</label>
											<div class="img-con">
												<img id="idx_R7I" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2">
											<label for="nowo">R7O</label>
											<div class="img-con">
												<img id="idx_R7O" src="<?php echo base_url('assets/img/tire.png') ?>" style="max-height: 90px;"/>
											</div>
										</div>
									</div>
									<!----------------------------this is row for current/update field-------------------------------------------------------->
									
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_L7O" value="<?php echo $tire_details['L7O']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_L7O" value="<?php echo $tire_details_update['L7O']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_L7I" value="<?php echo $tire_details['L7I']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_L7I" value="<?php echo $tire_details_update['L7I']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-xs-4 no-padding">
										
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_R7I" value="<?php echo $tire_details['R7I']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_R7I" value="<?php echo $tire_details_update['R7I']['tireidset']?>" readonly checked>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-2 no-padding tire-pos">
										<div class="small-box2 form-group">
											<input type="text" class="curr-tire" id="curr_R7O" value="<?php echo $tire_details['R7O']['tireidset']?>" readonly checked>
											<input type="text" class="update-tire updt-tire" id="updt_R7O" value="<?php echo $tire_details_update['R7O']['tireidset']?>" readonly checked>
										</div>
									</div>
								</div>	
								<div style="text-align:center;margin-bottom:20px">
									<button type="button" name="submit" value="SUBMIT" onclick="sentToTempConfirmation(this)" class="btn btn-warning">SUBMIT</button>
									&nbsp&nbsp
									<button type="submit" name="submit" value="EXECUTE" class="btn btn-warning">EXECUTE</button>
								</div>
							</div>
						</div>
						<div class="col-lg-5 col-md-5">
							 <div class="box box-warning" style="overflow:auto;">
								<input type="hidden" name="tire_location_id" id="tire_location_id" value="">
								<input type="hidden" name="act_form" id="act_form" value="">
								<div id="tire-desc-form" class="box-body">
									<h3 class="box-title">Tire Details</h3>
									<div id="tire-master">
										<div class="col-lg-4 col-md-6 col-sm-4 col-ss-6 col-xs-12">
											<div class="form-group">
												<label>TIRE ID :</label>
												<select class="form-control" id="tireidset" name="tireidset">
													<option value="R">Remove</option>
													<option value="tire_1">tire 1</option>
													<option value="tire_2">tire 2</option>
													<option value="tire_3">tire 3</option>
													<option value="tire_4">tire 4</option>
													<option value="tire_5">tire 5</option>
													<option value="tire_6">tire 6</option>
													<option value="tire_7">tire 7</option>
													<option value="tire_8">tire 8</option>
													<option value="tire_9">tire 9</option>
													<option value="tire_10">tire 10</option>
													<option value="tire_11">tire 11</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4 col-md-6 col-sm-4 col-ss-6 col-xs-12">
											<div class="form-group">
												<label for="sidewall">SIDEWALL</label>
												<input type="text" class="form-control" id="sidewall" name="sidewall" readonly>
											</div>
										</div>
										<div class="col-lg-4 col-md-6 col-sm-4 col-ss-6 col-xs-12">
											<div class="form-group">
												<label for="brand">BRAND</label>
												<input type="text" class="form-control" id="brand" name="brand" readonly>
											</div>
										</div>
										<div class="col-lg-4 col-md-6 col-sm-4 col-ss-6 col-xs-12">
											<div class="form-group">
												<label for="type">TYPE</label>
												<input type="text" class="form-control" id="type" name="type" readonly>
											</div>
										</div>
										<div class="col-lg-4 col-md-6 col-sm-4 col-ss-6 col-xs-12">
											<div class="form-group">
												<label for="size">SIZE</label>
												<input type="text" class="form-control" id="size" name="size" readonly>
											</div>
										</div>
										<div class="col-lg-4 col-md-6 col-sm-4 col-ss-6 col-xs-12">
											<div class="form-group">
												<label for="dot">DOT</label>
												<input type="text" class="form-control" id="dot" name="dot" readonly>
											</div>
										</div>
										<div class="col-lg-4 col-md-6 col-sm-4 col-ss-6 col-xs-12">
											<div class="form-group">
												<label for="category">CATEGORY</label>
												<input type="text" class="form-control" id="category" name="category" readonly>
											</div>
										</div>
									</div>
									<!-- UPDATE THE TIRE ID-->
									<div style="clear:both;"></div>
									<h3 class="box-title">Tire Details</h3>
									<div class="col-lg-4 col-md-6 col-sm-4 col-ss-6 col-xs-12">
										<div class="form-group">
											<label for="pressureset[]">Pressure</label>
											<input type="text" class="form-control bfh-number" data-max="200" id="pressureset[]" name="pressureset[]">
										</div>
									</div>
									<div style="clear:both;"></div>
									<div class="col-lg-3 col-md-6 col-sm-3 col-ss-6 col-xs-12">
										<div class="form-group">
											<label for="tdset[]">TD</label>
											<input type="text" class="form-control bfh-number" data-max="20" id="tdset[]" name="tdset[]">
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-3 col-ss-6 col-xs-12">
										<div class="form-group">
											<label for="td2set[]">TD2</label>
											<input type="text" class="form-control bfh-number" data-max="20" id="td2set[]" name="td2set[]">
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-3 col-ss-6 col-xs-12">
										<div class="form-group">
											<label for="td3set[]">TD3</label>
											<input type="text" class="form-control bfh-number" data-max="20" id="td3set[]" name="td3set[]">
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-3 col-ss-6 col-xs-12">
										<div class="form-group">
											<label for="td4set[]">TD4</label>
											<input type="text" class="form-control bfh-number" data-max="20" id="td4set[]" name="td4set[]">
										</div>
									</div>
									<div style="clear:both;"></div>
									<div class="col-lg-3 col-md-6 col-sm-3 col-ss-6 col-xs-12">
										<div class="form-group">
											<div class="form-group">
												<label>TUBE :</label>
												<select class="form-control" name="tubeset[]" id ="tubeset">
													<option value=""></option>
													<option value="Exist">Exist</option>
													<option value="New">New</option>
													<option value="Used">Used</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-3 col-ss-6 col-xs-12">
										<div class="form-group">
											<div class="form-group">
												<label>FLAP :</label>
												<select class="form-control" name="flapset[]" id ="flapset">
													<option value=""></option>
													<option value="Exist">Exist</option>
													<option value="New">New</option>
													<option value="Used">Used</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-3 col-ss-6 col-xs-12">
										<div class="form-group">
											<div class="form-group">
												<label>RIMSET :</label>
												<select class="form-control" name="rimset[]" id ="rimset">
													<option value=""></option>
													<option value="Exist">Exist</option>
													<option value="New">New</option>
													<option value="Used">Used</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-6 col-sm-3 col-ss-6 col-xs-12">
										<div class="form-group">
											<div class="form-group">
												<label>STATUS :</label>
												<select class="form-control" name="rimsetstatus[]" id ="rimsetstatus">
													<option value=""></option>
													<option value="Exist">Exist</option>
													<option value="New">New</option>
													<option value="Used">Used</option>
												</select>
											</div>
										</div>
									</div>
									<div style="clear:both;"></div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-ss-6 col-xs-12">
										<div class="form-group">
											<label>Reason</label>
											<textarea placeholder="Reason" rows="3" maxlength="200" id="reason" name="reasonset[]" class="form-control"></textarea>
										</div>
									</div>
									
								</div>
								<div class="overlay" style="display:none"></div>
								<div class="loading-img" style="display:none"></div>
							</div>
						</div>
					</div>
				</form>
				</div><!-- /.row -->
			</section><!-- /.content -->
		</aside><!-- /.right-side -->
	</div><!-- ./wrapper -->
	<script src="<?php echo base_url('assets/js/bootstrap-formhelpers.js') ?>"></script>
	<script>
		<?php
			foreach($tire_details as $key => $value){
				if(empty($value['tireidset'])||$value['tireidset']=""){
					echo "$('#idx_".$key."').parent().addClass('tire-not-exist');";
				}else{
					echo "$('#idx_".$key."').parent().removeClass('tire-not-exist');";
				}
			}
		?>
		$('.overlay').show();
		$('#tire_location_id').val('');
		//funtion ajax to get the tire details from the server. param = id of the tireset
		function tireDetails(idx,act){
			$("html, body").animate({ scrollTop: $('#tire-desc-form').offset().top }, 1000);
			$('.overlay').show();
			$('.loading-img').show();
			/*
				This is for temporary.
				the tires did not get data from ajax
				uncomment the ajax syntax if you want to use ajax to get the data
			*/
			var data;
			if(act=='CURR'){
				data =tire_details[idx];
				if(data==null || data==undefined || data==''){
					data={};
				}
				data.tire_location_id = idx;
				data.act_form = 'CURR';
			}else if(act=='UPDT'){
				data=tire_details_update[idx];
				if(data==null || data==undefined || data==''){
					data={};
				}
				data.tire_location_id = idx;
				data.act_form = 'UPDT';
				
			}
			setTimeout(function(){
				if(data==null || data==undefined || data==''){
					$(':input:not(:button)', $('#tire-desc-form')).val([]);
					$('.overlay').hide();
					$('.loading-img').hide();
				}else{
					$(':input:not(:button)', $('#tire-desc-form')).val([]);
					$('.overlay').hide();
					$('.loading-img').hide();
					$("#pit-stop-wo-form").values(data);
				}
			}, 1000);
			
			
			///////////////////////////this is for ajax command//////////////////////////////
			//$.ajax({
			//	dataType: "json",
			//	url: '<?php echo base_url() ?>/pitstopwo/getDetails/'+idx,
			//	data: {},
			//	success: function(data){
			//		$(':input:not(:button)', $('#tire-desc-form')).val([]);
			//		$('.overlay').hide();
			//		$('.loading-img').hide();
			//		$("#pit-stop-wo-form").values(data);						
			//	},
			//	error: function(data,statusMsg,errString ){
			//		$(':input:not(:button)', $('#tire-desc-form')).val([]);
			//		$('.loading-img').hide();
			//	}
			//});
			//////////////////////////////////////////////////////////////////////////////////
		}
		
		//function listener to the action when fields is clicked
		$('.curr-tire').click(function(eObj){
			$('#tireidset').attr('disabled','disabled');
			var idx= this.id;
			idx = idx.split('_');
			idx = idx[1];
			tireDetails(idx,'CURR');
		});
		$('.updt-tire').click(function(eObj){
			$('#tireidset').removeAttr('disabled');
			var idx= this.id;
			idx = idx.split('_');
			idx = idx[1];
			tireDetails(idx,'UPDT');
		});
		
		//method to load an ajax form
		function loadForm(url){
			if(url == ''){
				alert('Url not Found');
				return;
			}
			$('#loadingFormModal').modal({
				'backdrop' : 'static',
				'keyboard' :false  
			});

			setTimeout(function(){
				$('#formModal').load(url, {param:temp_tables}, function(){
					 $('#loadingFormModal').modal('hide');
					 $('#formModal').modal();   
				});
			}, 1000);
		}
		$('#show-temp-modal').click(function(){
			loadForm('<?php echo base_url() ?>temptireset');
		});
		$(':input:not(:button)', $('#tire-desc-form')).val([]);
		
		//////////event when tire id selected///////////////
		$('#tireidset').change(function(){
			$('.overlay').show();
			$('.loading-img').show();
			$.ajax({
				dataType: "json",
				url: '<?php echo base_url() ?>pitstopwo/getTires/'+$( this ).val(),
				data: {},
				success: function(data){
					$(':input:not(:button)', $('#tire-master')).val([]);
					$('.overlay').hide();
					$('.loading-img').hide();
					$("#tire-master").values(data);						
				},
				error: function(data,statusMsg,errString ){
					$(':input:not(:button)', $('#tire-master')).val([]);
					$('.overlay').hide();
					$('.loading-img').hide();
				}
			});
		});

		//now this is send to temporary table function
		function sentToTempConfirmation(){
			if(!$('#tire_location_id').val() ) {
				BootstrapDialog.alert({
					title: 'Warning',
					message: 'You have not select tire location!'
				});
				return;
			}
			 BootstrapDialog.show({
				title: 'INFO',
				message: 'Submit This Operation?',
				buttons: [{
					label: 'Cancel',
					action: function(dialog) {
						dialog.close();
						return;
					}
				}, {
					label: 'Yes',
					action: function(dialog) {
						dialog.close();
						$('.overlay').show();
						$('.loading-img').show();
						setTimeout(function(){
							$('.overlay').hide();
							$('.loading-img').hide();
							sendToTemp(dialog);
						}, 1000);
						return;
					}
				}]
			});
		}
		function sendToTemp(){
			var temp_values={};
			var location_id = $('#tire_location_id').val();
			$('#tire-desc-form').find(':input:not(:button)').each(function() {
				temp_values[$(this).attr('name').replace(/[\[\]']+/g,'')]=$(this).val();
			});
			temp_values['tire_location_id']=location_id;
			temp_values['act_form']=$('#act_form').val();
			temp_values['date']=$('#form_date').val();
			temp_values['vehicle']='<?php echo $vehicle;?>';
			temp_values['location']='<?php echo $location;?>';
			temp_values['nowo']=$('#nowo').val();
			if($('#act_form').val()=='UPDT'){
				$('#updt_'+location_id).removeClass('update-tire');
				$('#updt_'+location_id).removeClass('same-tire');
				$('#updt_'+location_id).removeClass('changed-tire');
				$('#updt_'+location_id).removeClass('del-tire');
				if(temp_values['tireidset']=='R'){
					$('#updt_'+location_id).addClass('del-tire');
					temp_values['flag']='R';
				}else if(temp_values['tireidset']==tire_details_update[location_id]['tireidset']){
					$('#updt_'+location_id).addClass('same-tire');
					temp_values['flag']='C';
				}else if(temp_values['tireidset']!=tire_details_update[location_id]['tireidset']){
					$('#updt_'+location_id).addClass('changed-tire');
					temp_values['flag']='I';
				}
				$('#updt_'+location_id).val(temp_values['tireidset']);
				temp_tables.push(temp_values);
			}else{
				var found =0;
				$.each(temp_tables, function( index, value ) {
					if(value['tire_location_id']==location_id && value['act_form']=='CURR'){
						found++;
					}
				});
				if(found > 0){
					BootstrapDialog.alert('Tire set has been checked, you can not submit this tireset anymore!');
					return;
				}
				temp_tables.push(temp_values);
			}
		}
	</script>