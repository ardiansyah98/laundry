<!DOCTYPE html>
<html>
<head>
	<title>Restoran</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css');?>">
<style type="text/css">
	.login{
		color: #ec3253;
		font-family: geometri;
		font-size: 1.2em;
		position: fixed;
		top: 0px;
		left: 0px;
		padding: 5px;
		background-color: white;
	}
	.login:hover{
		color: white;
		background-color: #ec3253;
	}
</style>
</head>
<body>
<section class="container-fluid header" style="background-image: url(<?php echo base_url('assets/image/rm.png')?>);">
<!-- 	<div class="header" style="background-image: url(<?php echo base_url('assets/image/rm.png')?>);">
	</div> -->
	<a href="<?php echo site_url('Admin/login/');?>" class="login"><span class="fa fa-user">Login</span></a>
</section>
<section class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="row">
				<div class="nama-rumah-makan">
					<div class="row">
						<div class="col-md-8 col-xs-6">
							<h2><span>List</span></h2>
						</div>
						<div class="col-md-4 col-xs-6">
							<span style="float: right;display: inline;">
								<select class="form-control" id="filter" onchange="filter()">
				                    <option value="semua">Semua</option>
				                    <?php foreach ($kategori as $k) :?>
				                        <option class="kategori" value="<?php echo $k->id_kategori?>"><?php echo $k->nama_kategori?></option>
				                    <?php endforeach; ?>
				                    </select>
							</span>
						</div>
					</div>
				</div>
				<div class="gap"></div>
				<?php foreach($list_restoran as $list) : ?>
					<div class="col-xs-6  col-md-4 col-xl-4 list <?php echo $list->kategori?>" name="restoran" id="list_<?php echo $list->id_restoran;?>" >
			          <figure class="mbr-figure" style="margin-bottom: 10px;">
			               <div class="detail-info" style='background-image: url(<?php echo base_url("assets/image/restoran/$list->foto")?>)'>
			              </div>
			              <a id="<?php echo $list->id_restoran;?>" onclick="detail(this.id);" style="cursor:pointer">
			                <figcaption class="mbr-figure-caption mbr-figure-caption-over ">
			                    <div class="row detail-img"><?php echo $list->nama_restoran ?></div>
			                </figcaption>
			              </a>
			          </figure>
			        </div>
			     <?php endforeach; ?>
		        <div class="col-xs-6 col-md-8 col-xl-8" id="detail-restoran">
		        </div>
			</div>
			<div class="gap"></div>
			<div class="row">
				<div class="nama-rumah-makan">
					<div class="row">
						<div class="col-md-8 col-xs-6">
							<h2><span>Menu</span></h2>
						</div>
						<div class="col-md-4 col-xs-6">
							<span style="float: right;display: inline;">
								<select class="form-control" id="filter-menu" onchange="filter_menu()">
				                    </select>
							</span>
						</div>
					</div>
				</div>
					<div class="gap"></div>
					<div id="menu-restoran"></div>			
			</div>
		

		</div>
	</div>
	<div class="modal fade" id="modal-menu" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content modal-menu">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal"><span class="fa fa-times"></span></button>
	          <h4 class="modal-title" id="menu-nama"></h4>
	        </div>
	        <div class="modal-body">
	        <div class="row">
	        	<div class="col-md-6 left">
	        		<img src='' class="img-respnsive" style="max-width: 100%;" id="menu-img">
	        	</div>
	        	<div class="col-md-6 right">
	        		<p id="menu-keterangan">
	        		</p>

	        	</div>
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	          </div>
	      </div>

	    </div>
	  </div>
	
	
</section>
<?php $kat=(array)$kategori?>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/jquery/jquery.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/script.js');?>"></script>
<script>
	var k = <?php echo json_encode($kat,JSON_PRETTY_PRINT)?>;
	var site_url='<?php echo site_url()?>';
	var base_url='<?php echo base_url()?>';
	var arary={su:site_url,bu:base_url,kat:k,inx:'1'};
	parse_variable(arary);
</script>
</body>
</html>