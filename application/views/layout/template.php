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

			body{
				font-size: 14px
			}

			.ganti-pass input{
				background: #fff;
				display: block;
				height: 40px;
				outline: none;
				font-size: 15px;
				padding: 6px 12px 6px 12px;

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


		<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.4.min.js"></script>

		<!--[if IE]>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

		<!-- <![endif]-->

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

<!-- Bootstrap modal -->
<div class="modal fade" id="cucian_modal_form" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form">
                    <input type="hidden" value="" name="kode_transaksi"/> 
                    <div class="form-body">
                        <div class="form-group">
                        	<center>
                        		<table style="text-align:center" width="85%">
	                        		<tr>
	                        			<td>
	                            			<label>Status Cucian</label></td>
	                        			<td>
	                        				<select name="status_cucian">
			                                	<option value="Diterima">Diterima</option>
			                                	<option value="Proses">Proses</option>
			                                	<option value="Selesai">Selesai</option>
			                                	<option value="Diambil">Diambil</option>
			                                </select>
			                            </td>
	                        		</tr>
	                        	</table>
                        	</center>
                            <div class="col-md-12">
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="bayar_modal_form" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form2">
                    <input type="hidden" value="" name="kode_transaksi"/> 
                    <div class="form-body">
                        <div class="form-group">
                        	<center>
                        		<table style="text-align:center" width="85%">
	                        		<tr>
	                        			<td>
	                            			<label>Status Pembayaran</label></td>
	                        			<td>
	                        				<select name="status_pembayaran">
			                                	<option value="Belum">Belum</option>
			                                	<option value="Sudah">Sudah</option>
			                                </select>
			                            </td>
	                        		</tr>
	                        	</table>
                        	</center>
                            <div class="col-md-12">
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="tambah_modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form3">
                    <div class="form-body">
                        <div class="form-group ">
                            <center>
                            	<table style="width:90%" class="table" cellspacing="0">
                            		<tr>
                            			<td>
                            				Kode Transaksi
                            			</td>
                            			<td>
                            				&nbsp;&nbsp;&nbsp;
                            			</td>
                            			<td>
                            				<input name="kode_transaksi" type="text" readonly value="">
                            			</td>
                            		</tr>
                            		<tr>
                            			<td>
                            				Nama Customer
                            			</td>
                            			<td>
                            				&nbsp;&nbsp;&nbsp;
                            			</td>
                            			<td>
                            				<input name="nama_customer" type="text" value="">
                            			</td>
                            		</tr>
                            		<tr>
                            			<td>
                            				Paket Cucian
                            			</td>
                            			<td>
                            				&nbsp;&nbsp;&nbsp;
                            			</td>
                            			<td>
                            				<select name="id_paket" id="id_paket">
                            					<option>Pilih Paket</option>
                            					<?php foreach($paket->result() as $row):?>
						                    		<option value="<?php echo $row->id_paket;?>">
						                    			<?php echo $row->nama_paket;?>		
						                    		</option>
						                    	<?php endforeach;?>
                            				</select>
                            			</td>
                            		</tr>
                            		<tr>
                            			<td>
                            				Harga Per Kg
                            			</td>
                            			<td>
                            				&nbsp;&nbsp;&nbsp;
                            			</td>
                            			<td>
                            				<input name="harga_paket" id="harga_paket" type="text" readonly value="0">
                            			</td>
                            		</tr>
                            		<tr>
                            			<td>
                            				Berat (kg)
                            			</td>
                            			<td>
                            				&nbsp;&nbsp;&nbsp;
                            			</td>
                            			<td>
                            				<input name="berat" type="text" value="">
                            			</td>
                            		</tr>
                            		<tr>
                            			<td>
                            				Diskon
                            			</td>
                            			<td>
                            				&nbsp;&nbsp;&nbsp;
                            			</td>
                            			<td>
                            				<input name="diskon" type="text" value="">
                            			</td>
                            		</tr>
                            		<tr>
                            			<td>
                            				Kasir
                            			</td>
                            			<td>
                            				&nbsp;&nbsp;&nbsp;
                            			</td>
                            			<td>
                            				<input name="kasir" type="text" readonly value="">
                            			</td>
                            		</tr>
                            		<tr>
                            			<td>
                            				Cabang
                            			</td>
                            			<td>
                            				&nbsp;&nbsp;&nbsp;
                            			</td>
                            			<td>
                            				<select name="cabang">
                            					<?php 
                            					?>
                            				</select>
                            			</td>
                            		</tr>
                            		<tr>
                            			<td>
                            				Bayar Sekarang
                            			</td>
                            			<td>
                            				&nbsp;&nbsp;&nbsp;
                            			</td>
                            			<td>
                            				<select name="bayar">
                            					<option value="Sudah">Ya</option>
                            					<option value="Belum" selected>Tidak</option>
                            				</select>
                            			</td>
                            		</tr>
                            		<tr>
                            			<td>
                            				
                            			</td>
                            			<td>
                            				
                            			</td>
                            			<td>
                            			</td>
                            		</tr>
                            	</table>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<script type="text/javascript">
			var table;
			var save_method;

			$(document).ready(function() {

			    //datatables
			    table = $('#table_kasir').DataTable({ 
					"sScrollX": "100%",
					"sScrollXInner": "190%",
			        "processing": true, //Feature control the processing indicator.
			        "serverSide": true, //Feature control DataTables' server-side processing mode.
			        "order": [], //Initial no order.

			        // Load data for the table's content from an Ajax source
			        "ajax": {
			            "url": "<?php echo site_url('kasir/ajax_list')?>",
			            "type": "POST"
			        },

			        //Set column definition initialisation properties.
			        "columnDefs": [
			        { 
			            "targets": [14,15], //first column / numbering column
			            "orderable": false, //set not orderable
			        },
			        ],

			    });

			    $('#id_paket').change(function(){
					var id=$(this).val();
					$.ajax({
						url : "<?php echo base_url();?>index.php/kasir/get_harga_paket",
						method : "POST",
						data : {id_paket: id},
						async : false,
				        dataType : 'json',
						success: function(data){
				            var i;
				            for(i=0; i<data.length; i++){
				                $('#harga_paket').val(data[i].harga);
				            }
				            
							
						}
					});
				});

			});

			function tambah_transaksi()
			{
			    save_method = 'add';
			    $('#form3')[0].reset(); // reset form on modals
			    $('.form-group').removeClass('has-error'); // clear error class
			    $('.help-block').empty(); // clear error string
			    $('#tambah_modal_form').modal('show'); // show bootstrap modal
			    $('.modal-title').text('Tambah Transaksi'); // Set Title to Bootstrap modal title

			    var now = new Date();
			    var x = now.getFullYear()+''+(now.getMonth()+1)+''+now.getDate()+''+now.getHours()+''+now.getMinutes()+''+now.getMilliseconds();
			    $('[name="kode_transaksi"]').val(x);
			}

			function edit_status_cucian(id)
			{
			    save_method = 'update_cucian';
			    $('#form')[0].reset(); // reset form on modals
			    $('.form-group').removeClass('has-error'); // clear error class
			    $('.help-block').empty(); // clear error string

			    //Ajax Load data from ajax
			    $.ajax({
			        url : "<?php echo site_url('kasir/ajax_edit/')?>/" + id,
			        type: "GET",
			        dataType: "JSON",
			        success: function(data)
			        {
			        	$('[name="kode_transaksi"]').val(data.kode_transaksi);
			            $('[name="status_cucian"]').val(data.status_cucian);
			            $('#cucian_modal_form').modal('show'); // show bootstrap modal when complete loaded
			            $('.modal-title').text('Status Cucian'); // Set title to Bootstrap modal title

			        },
			        error: function (jqXHR, textStatus, errorThrown)
			        {
			            alert('Error get data from ajax');
			        }
			    });
			}

			function edit_status_pembayaran(id)
			{
			    save_method = 'update_pembayaran';
			    $('#form2')[0].reset(); // reset form on modals
			    $('.form-group').removeClass('has-error'); // clear error class
			    $('.help-block').empty(); // clear error string

			    //Ajax Load data from ajax
			    $.ajax({
			        url : "<?php echo site_url('kasir/ajax_edit/')?>/" + id,
			        type: "GET",
			        dataType: "JSON",
			        success: function(data)
			        {
			        	$('[name="kode_transaksi"]').val(data.kode_transaksi);
			            $('[name="status_pembayaran"]').val(data.status_pembayaran);
			            $('#bayar_modal_form').modal('show'); // show bootstrap modal when complete loaded
			            $('.modal-title').text('Status Pembayaran'); // Set title to Bootstrap modal title

			        },
			        error: function (jqXHR, textStatus, errorThrown)
			        {
			            alert('Error get data from ajax');
			        }
			    });
			}

			function reload_table()
			{
			    table.ajax.reload(null,false); //reload datatable ajax 
			}

			function save()
			{
			    $('#btnSave').text('Saving...'); //change button text
			    $('#btnSave').attr('disabled',true); //set button disable 
			    var url;
			    if(save_method=="update_cucian")
			    	url = "<?php echo site_url('kasir/ajax_update_cucian')?>";
			    else if(save_method=="update_pembayaran")
			    	url = "<?php echo site_url('kasir/ajax_update_pembayaran')?>";

			    // ajax adding data to database
			    var data_serialize;
			    if(save_method=="update_cucian")
			    	data_serialize = $('#form').serialize();
			    else if(save_method=="update_pembayaran")
			    	data_serialize = $('#form2').serialize();

			    $.ajax({
			        url : url,
			        type: "POST",
			        data: data_serialize,
			        dataType: "JSON",
			        success: function(data)
			        {

			            if(data.status) //if success close modal and reload ajax table
			            {
			            	if(save_method=="update_cucian")
			            		$('#cucian_modal_form').modal('hide');
						    else if(save_method=="update_pembayaran")
						    	$('#bayar_modal_form').modal('hide');
			                
			                reload_table();
			            }

			            $('#btnSave').text('Save'); //change button text
			            $('#btnSave').attr('disabled',false); //set button enable 


			        },
			        error: function (jqXHR, textStatus, errorThrown)
			        {
			            alert('Error adding / update data');
			            $('#btnSave').text('Save'); //change button text
			            $('#btnSave').attr('disabled',false); //set button enable 

			        }
			    });
			}

			function delete_transaksi(id)
			{
			    if(confirm('Are you sure delete this data?'))
			    {
			        // ajax delete data to database
			        $.ajax({
			            url : "<?php echo site_url('kasir/ajax_delete')?>/"+id,
			            type: "POST",
			            dataType: "JSON",
			            success: function(data)
			            {
			                //if success reload ajax table
			                reload_table();
			            },
			            error: function (jqXHR, textStatus, errorThrown)
			            {
			                alert('Error deleting data');
			            }
			        });

			    }
			}

		</script>


	</body>
</html>
