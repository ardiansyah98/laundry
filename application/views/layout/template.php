<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $title.' - '.$subtitle;?></title>
		
		<!-- <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/img/logo_sm.png" />
 -->
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url(); ?>assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php echo base_url(); ?>assets/js/html5shiv.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
		<![endif]-->

		<style>
			
			.ganti-pass input{
				background: #fff;
				display: block;
				height: 40px;
				outline: none;
				font-size: 15px;
				padding: 6px 12px 6px 12px;

			}

			.form-wrapper {
				background-color: #f6f6f6;
				background-image: -webkit-gradient(linear, left top, left bottom, from(#f6f6f6), to(#eae8e8));
				background-image: -webkit-linear-gradient(top, #f6f6f6, #eae8e8);
				background-image: -moz-linear-gradient(top, #f6f6f6, #eae8e8);
				background-image: -ms-linear-gradient(top, #f6f6f6, #eae8e8);
				background-image: -o-linear-gradient(top, #f6f6f6, #eae8e8);
				background-image: linear-gradient(top, #f6f6f6, #eae8e8);
				border-color: #dedede #bababa #aaa #bababa;
				border-style: solid;
				border-width: 1px;
				-webkit-border-radius: 10px;
				-moz-border-radius: 10px;
				border-radius: 10px;
				-webkit-box-shadow: 0 3px 3px rgba(255,255,255,.1), 0 3px 0 #bbb, 0 4px 0 #aaa, 0 5px 5px #444;
				-moz-box-shadow: 0 3px 3px rgba(255,255,255,.1), 0 3px 0 #bbb, 0 4px 0 #aaa, 0 5px 5px #444;
				box-shadow: 0 3px 3px rgba(255,255,255,.1), 0 3px 0 #bbb, 0 4px 0 #aaa, 0 5px 5px #444;
				margin: 10% auto;
				overflow: hidden;
				padding: 8px;
				width: 450px;
			}

			.form-wrapper #search {
				border: 1px solid #CCC;
				-webkit-box-shadow: 0 1px 1px #ddd inset, 0 1px 0 #FFF;
				-moz-box-shadow: 0 1px 1px #ddd inset, 0 1px 0 #FFF;
				box-shadow: 0 1px 1px #ddd inset, 0 1px 0 #FFF;
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
			  color: #999;
				float: left;
				font: 16px Lucida Sans, Trebuchet MS, Tahoma, sans-serif;
				height: 42px;
				padding: 10px;
				width: 320px;
			}

			.form-wrapper #search:focus {
				border-color: #aaa;
				-webkit-box-shadow: 0 1px 1px #bbb inset;
				-moz-box-shadow: 0 1px 1px #bbb inset;
				box-shadow: 0 1px 1px #bbb inset;
				outline: 0;
			}

			.form-wrapper #search:-moz-placeholder,
			.form-wrapper #search:-ms-input-placeholder,
			.form-wrapper #search::-webkit-input-placeholder {
				color: #999;
				font-weight: normal;
			}

			.form-wrapper #submit {
				background-color: #0483a0;
				background-image: -webkit-gradient(linear, left top, left bottom, from(#31b2c3), to(#0483a0));
				background-image: -webkit-linear-gradient(top, #31b2c3, #0483a0);
				background-image: -moz-linear-gradient(top, #31b2c3, #0483a0);
				background-image: -ms-linear-gradient(top, #31b2c3, #0483a0);
				background-image: -o-linear-gradient(top, #31b2c3, #0483a0);
				background-image: linear-gradient(top, #31b2c3, #0483a0);
				border: 1px solid #00748f;
				-moz-border-radius: 3px;
				-webkit-border-radius: 3px;
				border-radius: 3px;
				-webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 0 #FFF;
				-moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 0 #FFF;
				box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 0 #FFF;
				color: #fafafa;
				cursor: pointer;
				height: 42px;
				float: right;
				font: 15px Arial, Helvetica;
				padding: 0;
				text-transform: uppercase;
				text-shadow: 0 1px 0 rgba(0, 0 ,0, .3);
				width: 100px;
			}

			.form-wrapper #submit:hover,
			.form-wrapper #submit:focus {
				background-color: #31b2c3;
				background-image: -webkit-gradient(linear, left top, left bottom, from(#0483a0), to(#31b2c3));
				background-image: -webkit-linear-gradient(top, #0483a0, #31b2c3);
				background-image: -moz-linear-gradient(top, #0483a0, #31b2c3);
				background-image: -ms-linear-gradient(top, #0483a0, #31b2c3);
				background-image: -o-linear-gradient(top, #0483a0, #31b2c3);
				background-image: linear-gradient(top, #0483a0, #31b2c3);
			}

			.form-wrapper #submit:active {
				-webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
				-moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
				box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
				outline: 0;
			}

			.form-wrapper #submit::-moz-focus-inner {
				border: 0;
			}

			#tableEdit td {
			  padding-top:5px;
			  padding-bottom:5px;
			  padding-right:5px;   
			}

			#tableEdit td:first-child {
			  padding-left:5px;
			  padding-right:0;
			}

		</style>

	</head>

	<body class="no-skin">
		<?php $this->load->view('layout/header'); ?>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			
			<?php $this->load->view($view_sidebar); ?>

			<?php $this->load->view($view_isi); ?>

			<?php $this->load->view('layout/footer'); ?>
		

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->


		<!--[if IE]>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->


		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>
		<!-- <![endif]-->

		<!--[if IE]>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('/assets/highcharts/highcharts.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('/assets/highcharts/modules/exporting.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('/assets/highcharts/themes/grid.js'); ?>"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
	</body>
</html>
