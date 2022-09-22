<div class="page">
    <div class="page-title blue">
        <h3>
            <?php echo $breadcrumb; ?>
        </h3>
       
    </div>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Welcome to the Administrator's Panel</h3>
                    </div>
                    <div class="panel-body container-fluid">
                        <div class="blockquote gray">
                            <h3>Hello,
                                <?php echo $admin->admin_nama; ?>
                            </h3>
                            <p>This information is for administrators or staff to run the data within the system.</p>
	<!-- <div style="margin-top: 20px;" class='onesignal-customlink-container'></div> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-3 col-xs-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>
                                    <?php echo $jml_data_transaksi_masuk ?>
                                </h3>
                                <p>Incoming Goods</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-archive"></i>
                            </div>
                            <a href="<?php echo site_url();?>website/masuk" class="small-box-footer">
                            View Incoming Goods
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-xs-6">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>
                                    <?php echo $jml_data_transaksi_keluar ?>
                                </h3>
                                <p>Outgoing Goods</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-archive"></i>
                            </div>
                            <a href="<?php echo site_url();?>website/keluar" class="small-box-footer">
                            View Outgoing Goods
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-3 col-xs-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    <?php $query = $this->db->query('SELECT * FROM supplier'); echo $query->num_rows();?>
                                </h3>
                                <p>Suppliers</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-th-large"></i>
                            </div>
                            <a href="<?php echo site_url();?>website/supplier" class="small-box-footer">
                            View Suppliers Info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-3 col-xs-6">
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>
                                    <?php $query = $this->db->query('SELECT * FROM customer'); echo $query->num_rows();?>
                                </h3>
                                <p>Customers</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <a href="<?php echo site_url();?>website/customer" class="small-box-footer">
                            View Customers Info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>