<!-- ================================================== VIEW ================================================== -->
<?php if ($action == 'view' || empty($action)){ ?>
<!-- ================================================== END VIEW ================================================== -->

<!-- ================================================== EDIT ================================================== -->
<?php } elseif ($action == 'edit') { ?>
<div class="page">
	<div class="page-title blue">
		<h3>
			<?php echo $breadcrumb; ?>
		</h3>
		<p>Information About
			<?php echo $breadcrumb; ?>
		</p>
	</div>
	<div class="page-content container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h5 class="panel-title">Edit System Identity</h5>
					</div>
					<!-- ========== Flashdata ========== -->
					<?php if ($this->session->flashdata('success') || $this->session->flashdata('warning') || $this->session->flashdata('error')) { ?>
					<?php if ($this->session->flashdata('success')) { ?>
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check sign"></i>
						<?php echo $this->session->flashdata('success'); ?>
					</div>
					<?php } else if ($this->session->flashdata('warning')) { ?>
					<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check sign"></i>
						<?php echo $this->session->flashdata('warning'); ?>
					</div>
					<?php } else { ?>
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-warning sign"></i>
						<?php echo $this->session->flashdata('error'); ?>
					</div>
					<?php } ?>
					<?php } ?>
					<!-- ========== End Flashdata ========== -->
					<div class="panel-body container-fluid">
						<form action="<?php echo site_url();?>website/identitas/edit/<?php echo $identitas_id;?>" method="post" enctype="multipart/form-data"
						id="exampleStandardForm" autocomplete="off">
							<input type="hidden" name="identitas_id" value="<?php echo $identitas_id;?>" />
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Website Name</label>
								<input type="text" class="form-control input-sm" id="identitas_website" name="identitas_website" placeholder="Enter Website Name"
								value="<?php echo $identitas_website;?>" required />
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Website Description</label>
								<input type="text" class="form-control input-sm" id="identitas_deskripsi" name="identitas_deskripsi" placeholder="Enter Website Description"
								value="<?php echo $identitas_deskripsi;?>" required />
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Keyword Website</label>
								<input type="text" class="form-control input-sm" id="identitas_keyword" name="identitas_keyword" placeholder="Enter Keyword Website"
								value="<?php echo $identitas_keyword;?>" required />
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Email Website</label>
								<input type="text" class="form-control input-sm" id="identitas_email" name="identitas_email" placeholder="Enter Email Website"
								value="<?php echo $identitas_email;?>" required />
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Facebook URL</label>
								<input type="text" class="form-control input-sm" id="identitas_fb" name="identitas_fb" placeholder="Enter Facebook URL"
								value="<?php echo $identitas_fb;?>" required />
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Twitter URL</label>
								<input type="text" class="form-control input-sm" id="identitas_tw" name="identitas_tw" placeholder="Enter Twitter URL"
								value="<?php echo $identitas_tw;?>" required />
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Google Plus URL</label>
								<input type="text" class="form-control input-sm" id="identitas_gp" name="identitas_gp" placeholder="Enter Google Plus URL"
								value="<?php echo $identitas_gp;?>" required />
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Youtube</label>
								<input type="text" class="form-control input-sm" id="identitas_yb" name="identitas_yb" placeholder="Enter Channel Link"
								value="<?php echo $identitas_yb;?>" required />
							</div>
							<?php if ($identitas_favicon){?>
							<div for="identitas_favicon" class="control-label" style="font-weight:500">Favicon</div>
							<img src="<?php echo base_url(); ?>assets/<?php echo $identitas_favicon; ?>" style="width:50px;" />
							<div style="margin-bottom: 20px !important;margin-top: 20px !important;font-weight:500">
								<label class="control-label" for="inputText" style="font-weight:500">Change Favicon</label>
								<input type="file" class="form-control btn-sm input-sm" size="100" name="identitas_favicon" id="identitas_favicon" value="<?php echo $identitas_favicon; ?>">
							</div>
							<?php } else {?>
							<div style="margin-bottom: 20px !important;margin-top: 20px !important">
								<label class="control-label" for="inputText" style="font-weight:500">Favicon</label>
								<input type="file" class="form-control btn-sm input-sm" size="100" name="identitas_favicon" id="identitas_favicon" value="<?php echo $identitas_favicon; ?>">
							</div>
							<?php } ?>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Created</label>
								<input type="text" disabled class="form-control input-sm" id="identitas_created" name="identitas_created" value="<?php echo $identitas_created;?>"
								/>
							</div>
							<div class="form-group form-material">
								<label class="control-label" for="inputText">Last Changed</label>
								<input type="text" disabled class="form-control input-sm" id="identitas_updated" name="identitas_updated" value="<?php echo $identitas_updated;?>"
								/>
							</div>
							<div class='button center'>
								<input class="btn btn-success btn-sm" type="submit" name="simpan" value="Add Data" id="validateButton2">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!-- ================================================== END EDIT ================================================== -->
