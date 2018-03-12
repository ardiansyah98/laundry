<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<!-- <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/img/logo_sm.png" />
	 -->
	 <title>KSS Laundry</title>
	<style>
		body {
			background-color: #b6b7ba;
		}

		.wrap {
			width:300px;
			height: auto;
			margin: auto;
			margin-top: 20%;
		}

		.avatar {
			margin-bottom:10px;
			margin-left: 7px;
		}
		
		.wrap input {
			border: none;
			background: #fff;
			display: block;
			height: 50px;
			outline: none;
			font-size: 15px;
			width: calc(100% - 24px) ;
			margin: auto;			
			padding: 6px 12px 6px 12px;
		}



		.wrap input[type="text"] {
			border-radius: 7px 7px 7px 7px ;
		}


		.wrap button {
			width: 100%;
			border-radius: 7px;
			background: #b6ee65;
			text-decoration: center;
			color: #51771a;
		  	margin-top:10px;
			padding-top: 14px;
			padding-bottom: 14px;
			outline: none;
			font-size: 18px;	
			cursor:pointer;
		}

		select {
			width: 100%;
			border-radius: 4px;
			border:none;
			margin-top: 10px;
			padding: 10px;
			font-size: 14px;
		}
	</style>
</head>
<body>
	<div class="wrap">
		<div class="avatar">
      		<!-- <img src="<?php echo base_url('assets/img/logo_sm.png');?>"> -->
		</div>
		<form action="<?php echo base_url('index.php/cek/aksi_cek'); ?>" method="post">
			<input type="text" placeholder="Kode Transaksi" name="kode_transaksi" required>

			<button type="submit">Cek</button>

		</form>
	</div>
</body>
</html>