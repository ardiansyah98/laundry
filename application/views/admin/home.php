<!DOCTYPE html>
<html>
<head>
	<title>Masuk Admin</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-admin.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-slider.css');?>">
	<link href="<?php echo base_url('assets/vendor/metisMenu/metisMenu.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/datatables-plugins/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/datatables-responsive/dataTables.responsive.css')?>" rel="stylesheet">

    <style type="text/css">
    	textarea{
    		resize: vertical;
    	}
    </style>

</head>
<body>
<nav class="navbar navbar-inverse" style="border-radius: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Admin Rumah Makan</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
    <li><a href="<?php echo site_url('Restoran/home/')?>" target="_blank" ><span class="fa fa-eye"></span> Lihat</a></li>
      <li><a href="<?php echo site_url('Admin/logout/')?>"><span class="fa fa-sign-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>

<section class="container">
	<div class="row" style="margin-left: 0px;">
		<ul class="nav nav-tabs">
            <li class="active"><a href="#restoran" data-toggle="tab">Restoran</a>
            </li>
            <li><a href="#kategori" data-toggle="tab">Kategori</a>
            </li>
            <li><a href="#menu" data-toggle="tab">Menu</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
        <div class="gap"></div>

            <div class="tab-pane fade in active" id="restoran">
            <div class="row">
            	<div class="col-md-8">
	                <div class="panel panel-default">
						<div class="panel-heading">List Restoran</div>
							<div class="panel-body">
					            <table width="100%" class="table table-striped table-bordered table-hover" id="table-restoran">
					                <thead>
					                    <tr>
					                        <th>No</th>
					                        <th>Nama</th>
					                        <th>Kategori</th>
					                        <th>Jumlah Menu</th>
					                        <th>Rating</th>
					                        <th>Keterangan</th>
					                        <th>foto</th>
					                        <th>Action</th>
					                    </tr>
					                </thead>
					                <tbody>
					                <?php foreach($restoran as $no => $r) :?>
					                	<?php $arary_res=json_encode($r);?>
					                    <tr class="odd gradeX" id="<?php echo $r->id_restoran?>">
					                        <td><?php echo $r->id_restoran ?></td>
					                        <td><?php echo $r->nama_restoran; ?></td>
					                        <td><?php echo $kat[$r->kategori]; ?></td>
					                        <td class="center"><?php echo $jum_menu[$r->id_restoran]?></td>
					                        <td class="center"><?php echo $r->rating/2; ?></td>
					                        <td><a href=""><?php echo substr($r->keterangan, 0,20).'.....'; ?></a></td>
					                        <td class="center">
					                        	<a href=""  data-toggle="modal" data-target="#modal-foto" onclick="foto_restoran('<?php echo $r->foto?>')" class="btn btn-default"><span class="fa fa-eye"></span></a>
				                        	</td>
					                        <td>
					                        	<a href="#" class="btn btn-default" onclick='edit_restoran(<?php echo $arary_res?>)' data-toggle="modal" data-target="#modal-restoran"><span class="fa fa-edit" ></span></a>
					                        	<a href="" data-toggle="modal" data-target="#modal-hapus-restoran" class="btn btn-default" onclick="hapus_restoran('<?php echo $r->id_restoran?>','<?php echo $r->nama_restoran?>')"><span class="fa fa-trash"></span></a>
					                        </td>
					                    </tr>
					                <?php endforeach; ?>
					                </tbody>
					            </table>
					            <button class="btn btn-primary btn-block">Tambah</button>

					        </div>
				       </div>
				    </div>

				    <div class="col-md-4">
	            		<div class="panel panel-default">
	            			<div class="panel-heading">Tambah Restoran</div>
	            			<div class="panel-body">
	            				<form action="<?php echo site_url('Admin/tambah_restoran/')?>" class="form-daftar table" name="regis" method="post" role="form" enctype="multipart/form-data">
	            					<div class="form-group">
										<label>Id Restoran</label>
										<input type="text" name="id_restoran" class="form-control"  required>
										<p><?php echo form_error('id_restoran');?></p>
									</div>
									<div class="form-group">
										<label>Nama Restoran</label>
										<input type="text" name="nama_restoran" class="form-control"  required>
										<p><?php echo form_error('nama_restoran');?></p>
									</div>
									<div class="form-group input-group">
										<label>Kategori</label>
										<select name="kategori_restoran" class="form-control">
											<?php foreach ($kategori as  $o ) :?>
												<option value="<?php echo $o->id_kategori;?>"><?php echo $o->nama_kategori;?></option>
											<?php endforeach; ?>
										</select>
										
									</div>
									<div class="form-group">
										<label>Rating</label><br>
										<input id="rating" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="5" data-slider-step="0.5" data-slider-value="5" name="rating"/>
									</div>
									<div class="form-group">
										<label>Keterangan Restoran</label>
										<textarea class="form-control" name="keterangan_restoran" id="keterangan-restoran" required ></textarea>
										<p><?php echo form_error('keterangan_restoran');?></p>
									</div>
									<div class="form-group">
										<label>Foto Restoran</label>
										<input type="file" name="foto_restoran" class="form-control" id="foto-restoran" required  >
										<p><?php if($error_restoran!=''){echo $error_restoran;} ?></p>
										<img id="view-restoran"  alt="your image" style="max-width: 100%;max-height: 200px;" />
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-block" type="submit">Tambah</button>
									</div>
								</form>
	            			</div>
	            		</div>
	            	</div>
	            	
			    </div>
            </div>

            <div class="tab-pane fade" id="menu">
                <div class="row">
            	<div class="col-md-8">
	                <div class="panel panel-default">
						<div class="panel-heading">List Menu</div>
							<div class="panel-body">
					            <table width="100%" class="table table-striped table-bordered table-hover" id="table-menu">
					                <thead>
					                    <tr>
					                        <th>Id</th>
					                        <th>Nama</th>
					                        <th>Kategori</th>
					                        <th>Restoran</th>
					                        <th>Keterangan</th>
					                        <th>foto</th>
					                        <th>Action</th>
					                    </tr>
					                </thead>
					                <tbody>
					                <?php foreach($menu as $n => $m) :?>
					                	<?php $arary_men=json_encode($m);?>
					                    <tr class="odd gradeX">
					                        <td><?php echo $m->id_menu ?></td>
					                        <td><?php echo $m->nama_menu; ?></td>
					                        <td><?php echo $kat[$m->kategori]; ?></td>
					                        <td><?php echo $res[$m->restoran]; ?></td>
					                        <td><a href=""><?php echo substr($m->keterangan, 0,20).'.....'; ?></a></td>
					                        <td class="center"><a href="" data-toggle="modal" data-target="#modal-foto" onclick="foto_menu('<?php echo $m->foto; ?>')" class="btn btn-default"><span class="fa fa-eye"></span></a>
					                        </td>
					                        <td>
					                        	<a href="#" class="btn btn-default" onclick='edit_menu(<?php echo $arary_men?>)' data-toggle="modal" data-target="#modal-menu"><span class="fa fa-edit" ></span></a>
					                        	<a href="" data-toggle="modal" data-target="#modal-hapus-menu" class="btn btn-default" onclick="hapus_menu('<?php echo $m->id_menu?>','<?php echo $m->nama_menu?>')"><span class="fa fa-trash"></span></a>
					                        </td>
					                    </tr>
					                <?php endforeach; ?>
					                </tbody>
					            </table>
					            <button class="btn btn-primary btn-block">Tambah</button>
					        </div>
				       </div>
				    </div>
				    <div class="col-md-4">
	            		<div class="panel panel-default">
	            			<div class="panel-heading">Tambah Menu</div>
	            			<div class="panel-body">
	            				<form action="<?php echo site_url('Admin/tambah_menu/')?>" class="form-daftar table" name="regis" method="post" role="form" enctype="multipart/form-data">
	            				<div class="form-group">
										<label>Id Menu</label>
										<input type="text" name="id_menu" class="form-control" required>
										<p><?php echo form_error('id_menu');?></p>
									</div>
									<div class="form-group">
										<label>Nama Menu</label>
										<input type="text" name="nama_menu" class="form-control" required>
										<p><?php echo form_error('nama_menu');?></p>
									</div>
									<div class="form-group">
										<label>Kategori</label>
										<select name="kategori_menu" class="form-control">
										<?php foreach ($kategori as $op) :?>
											<option value="<?php echo $o->id_kategori;?>"><?php echo $op->nama_kategori; ?></option>
										<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label>Restoran</label>
										<select name="restoran_menu" class="form-control">
										<?php foreach ($restoran as $re) :?>
											<option value="<?php echo $re->id_restoran;?>"><?php echo $re->nama_restoran; ?></option>
										<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label>Keterangan Menu</label>
										<textarea class="form-control" name="keterangan_menu" id="keterangan-menu" required></textarea>
										<p><?php echo form_error('keterangan_menu');?></p>
									</div>
									<div class="form-group">
										<label>Foto Restoran</label>
										<input type="file" name="foto_menu" class="form-control" id="foto-menu" required>
										<p><?php if($error_menu!=''){echo $error_menu;} ?></p>
										<img id="view-menu"  alt="your image" style="max-width: 100%;max-height: 200px;" />
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-block" type="submit">Tambah</button>
									</div>
								</form>
	            			</div>
	            		</div>
	            	</div>
	            	
			    </div>
            </div>
            <div class="tab-pane fade" id="kategori">
            	<div class="row">
            		<div class="col-md-8">
		                <div class="panel panel-default">
							<div class="panel-heading">List Restoran</div>
								<div class="panel-body">
						            <table width="100%" class="table table-striped table-bordered table-hover" id="table-kategori">
						                <thead>
						                    <tr>
						                        <th>Id</th>
						                        <th>Kategori</th>
						                        <th>Action</th>
						                    </tr>
						                </thead>
						                <tbody>
						                <?php foreach ($kategori as $no => $k):?>
						                    <tr class="odd gradeX">
						                        <td><?php echo $k->id_kategori ?></td>
						                        <td><?php echo $k->nama_kategori ?></td>
						                        <td>
						                        	<a href="#" class="btn btn-default" onclick='edit_kategori("<?php echo $k->id_kategori ?>","<?php echo $k->nama_kategori ?>")' data-toggle="modal" data-target="#modal-kategori"><span class="fa fa-edit" ></span></a>
						                        	</span></a>
						                        </td>
						                    </tr>
						                 <?php endforeach; ?>
						                </tbody>
						            </table>
						            <button class="btn btn-primary btn-block">Tambah</button>
						        </div>
					       </div>
					    </div>
					<div class="col-md-4">
						<div class="panel panel-default">
	            			<div class="panel-heading">Tambah Restoran</div>
	            			<div class="panel-body">
	            				<form action="<?php echo site_url('Admin/tambah_kategori/')?>" class="form-daftar table" name="regis" method="post" role="form" enctype="multipart/form-data">
	            					<div class="form-group">
										<label>Id Kategori</label>
										<input type="text" name="id_kategori" class="form-control"  required>
										<p><?php echo form_error('id_kategori');?></p>
									</div>
									<div class="form-group">
										<label>Nama Kategori</label>
										<input type="text" name="nama_kategori" class="form-control"  required>
										<p><?php echo form_error('nama_kategori');?></p>
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-block" type="submit">Tambah</button>
									</div>
								</form>
	            			</div>
	            		</div>
					</div>
				</div>

            </div>


        </div>

		
	</div>
</section>

<div class="modal fade" id="modal-foto" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content modal-menu">
        <div class="modal-body foto">
        <center><img src='' class="img-respnsive" style="max-width: 100%;" id="img-modal"></center>
        </div>
          </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modal-restoran" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span class="fa fa-times"></span></button>
          <h4 class="modal-title">Edit Restoran</h4>
        </div>
        <div class="modal-body">
	        <div class="row">
	        	<div class="col-md-12">
		        	<form action="<?php echo site_url('Admin/ubah_restoran/')?>" class="form-daftar table" name="regis" method="post" role="form" enctype="multipart/form-data">
					<input type="text" name="edit_id_restoran" id="edit_id_restoran" class="form-control sr-only" required value="">
						<div class="form-group">
							<label>Nama Restoran</label>
							<input type="text" name="edit_nama_restoran" id="edit_nama_restoran" class="form-control" required value="">
							<p><?php echo form_error('nama_restoran');?></p>
						</div>
						<div class="row">
						<div class="col-md-6">
							<label>Kategori</label>
								<div class="form-group ">
									<select name="edit_kategori_restoran" id="edit_kategori_restoran" class="form-control">
									</select>
								</div>
							</div>
							<div class="col-md-6">
								
									<label>Rating</label><br>
									<div class="form-group input-group">
									<input id="edit_rating" name="edit_rating" class="form-control" />
									<span class="input-group-addon">/5
			                        </span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Keterangan Restoran</label>
							<textarea class="form-control" name="edit_keterangan_restoran" id="edit_keterangan_restoran" required ></textarea>
							<p><?php echo form_error('keterangan_restoran');?></p>
						</div>
						<div class="form-group">
							<div id='upload-restoran'>
								<label>Foto Restoran</label>
								<input type="file" name="edit_foto_restoran" id="edit-foto-restoran"  >
								<p><?php if($error_restoran!=''){echo $error_restoran;} ?></p>
							</div>
							<img id="edit-view-restoran"  alt="your image" style="max-width: 100%;max-height: 200px;" />
							<div class="checkbox">
                                <label>
                                    <input type="checkbox" value="ubah" id="ubah-restoran" name="ubah_restoran">Ubah Gambar
                                </label>
                            </div>

						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-block" type="submit">Ubah</button>
						</div>
					</form>	
				</div>	        	
	        </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>


<div class="modal fade" id="modal-menu" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span class="fa fa-times"></span></button>
          <h4 class="modal-title">Edit Menu</h4>
        </div>
        <div class="modal-body">
	        <div class="row">
	        	<div class="col-md-12">
		        	<form action="<?php echo site_url('Admin/ubah_menu/')?>" class="form-daftar table" name="regis" method="post" role="form" enctype="multipart/form-data">
					<input type="text" name="edit_id_menu" id="edit_id_menu" class="form-control sr-only" required value="">
						<div class="form-group">
							<label>Nama menu</label>
							<input type="text" name="edit_nama_menu" id="edit_nama_menu" class="form-control" required value="">
							<p><?php echo form_error('nama_menu');?></p>
						</div>
						<div class="row">
						<div class="col-md-6">
							<div class="form-group input-group">
								<label>Kategori</label>
								<select name="edit_kategori_menu" id="edit_kategori_menu" class="form-control">
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Restoran</label><br>
									<select name="edit_restoran_menu" id="edit_restoran_menu" class="form-control">
								</select>
							</div>
						</div>
						</div>
						<div class="form-group">
							<label>Keterangan menu</label>
							<textarea class="form-control" name="edit_keterangan_menu" id="edit_keterangan_menu" required ></textarea>
							<p><?php echo form_error('keterangan_menu');?></p>
						</div>
						<div class="form-group">
							<div id='upload-menu'>
								<label>Foto menu</label>
								<input type="file" name="edit_foto_menu" id="edit-foto-menu"  >
								<p><?php if($error_menu!=''){echo $error_menu;} ?></p>
							</div>
							<img id="edit-view-menu"  alt="your image" style="max-width: 100%;max-height: 200px;" />
							<div class="checkbox">
                                <label>
                                    <input type="checkbox" value="ubah" id="ubah-menu" name="ubah_menu">Ubah Gambar
                                </label>
                            </div>

						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-block" type="submit">Ubah</button>
						</div>
					</form>	
				</div>	        	
	        </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modal-hapus-restoran" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span class="fa fa-times"></span></button>
          <h4 class="modal-title">Hapus Restoran</h4>
        </div>
        <div class="modal-body">
	        <div class="row">
	        	<div class="col-md-12">
	        		<h3>Anda Yakin Ingin Menghapus Restoran <span id='hapus-restoran'></span> ?</h3>
		        	<form action="<?php echo site_url('Admin/hapus_restoran/')?>" class="form-daftar table" name="regis" method="post" role="form" enctype="multipart/form-data">
						<div class="form-group">
							<input type="text" name="hapus_id_restoran" id="hapus_id_restoran" class="form-control sr-only"  value="" readonly required>
						</div>
						<div class="form-group">
                            <label></label>
                            <label class="radio-inline">
                                <input type="radio" name="pilihan_hapus_restoran" id="optionsRadiosInline1" value="restoran" required>Hapus Restoran Saja
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="pilihan_hapus_restoran" id="optionsRadiosInline2" value="allmenu" >Hapus Restoran Dan Menunya
                            </label>
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-block" type="submit">Hapus</button>
						</div>
					</form>	
				</div>	        	
	        </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modal-hapus-menu" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span class="fa fa-times"></span></button>
          <h4 class="modal-title">Hapus Menu</h4>
        </div>
        <div class="modal-body">
	        <div class="row">
	        	<div class="col-md-12">
	        		<h3>Anda Yakin Ingin Menghapus Menu  <span id='hapus-menu'></span> ?</h3>
		        	<form action="<?php echo site_url('Admin/hapus_menu/')?>" class="form-daftar table" name="regis" method="post" role="form" enctype="multipart/form-data">
						<div class="form-group">
							<input type="text" name="hapus_id_menu" id="hapus_id_menu" class="form-control sr-only"  value="" readonly required>
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-block" type="submit">Hapus</button>
						</div>
					</form>	
				</div>	        	
	        </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modal-kategori" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span class="fa fa-times"></span></button>
          <h4 class="modal-title">Edit Kategori</h4>
        </div>
        <div class="modal-body">
	        <div class="row">
	        	<div class="col-md-12">
		        	<form action="<?php echo site_url('Admin/edit_kategori/')?>" class="form-daftar table" name="regis" method="post" role="form" enctype="multipart/form-data">
						<div class="form-group">
							<input type="text" name="edit_id_kategori" id="edit_id_kategori" class="form-control sr-only"  value="" required>
							<label>Nama Kategori</label>
							<input type="text" name="edit_nama_kategori" id="edit_nama_kategori" class="form-control "  value="" required>
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-block" type="submit">Edit</button>
						</div>
					</form>	
				</div>	        	
	        </div>
          </div>
          <div class="modal-footer">
          	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>





<script type="text/javascript" src="<?php echo base_url('assets/vendor/jquery/jquery.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/script-admin.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-slider.min.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/metisMenu/metisMenu.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables-plugins/dataTables.bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables-responsive/dataTables.responsive.js')?>"></script>

<script>

	var k = <?php echo json_encode($kat)?>;
	var site_url='<?php echo site_url()?>';
	var base_url='<?php echo base_url()?>';
	var r=<?php echo json_encode($res)?>;
	var arary={su:site_url,bu:base_url,kat:k,res:r,inx:'1'};
	
	parse_variable(arary);

	// $(document).ready(function() {
       
 //    });

    $(document).ready(function() {
    	 $('#table-menu').DataTable({
            responsive: true
        });
        $('#table-restoran').DataTable({
            responsive: true
        });
         $('#table-kategori').DataTable({
            responsive: true
        });
    });


    $('#rating').slider({
	formatter: function(value) {
		return 'Rating: ' + value;
	}
	});

	




	

	$("#foto-restoran").change(function(){
	    readURL(this,'#view-restoran');
	});

	$("#foto-menu").change(function(){
	    readURL(this,'#view-menu');
	});
	$("#edit-foto-restoran").change(function(){
	    readURL(this,'#edit-view-restoran');
	});
	$("#edit-foto-menu").change(function(){
	    readURL(this,'#edit-view-menu');
	});

	
	
    </script>
</body>
</html>
