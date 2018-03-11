<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li class="">
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url();?>index.php/kasir">Home</a>
				</li>
				<li class="">
					Transaksi
				</li>
			</ul><!-- /.breadcrumb -->

		</div>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->

					<button class="btn btn-success" onclick="tambah_transaksi()"><i class="glyphicon glyphicon-plus"></i> Tambah</button>
        			<button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
			        <br>
			        <br>
					<table id="table_kasir" class="table table-striped table-bordered" cellspacing="0">
			            <thead>
			                <tr>
			                    <th width="3%">No</th>
			                    <th width="5%">Kode Transaksi</th>
			                    <th width="10%">Customer</th>
			                    <th width="7%">Nama Paket</th>
			                    <th width="5%">Harga Paket</th>
			                    <th width="5%">Berat (kg)</th>
			                    <th width="5%">Diskon</th>
			                    <th width="8%">Kasir</th>
			                    <th width="10%">Cabang</th>
			                    <th width="5%">Status Cucian</th>
			                    <th width="5%">Diterima</th>
			                    <th width="5%">Diambil</th>
			                    <th width="5%">Status Pembayaran</th>
			                    <th width="5%">Dibayar</th>
			                    <th width="5%">Grand Total</th>
			                    <th width="15%">Aksi</th>
			                </tr>
			            </thead>
			            <tbody>
			            </tbody>
			        </table>
					<!-- PAGE CONTENT ENDS -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->