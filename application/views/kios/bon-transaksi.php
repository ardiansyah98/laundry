<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>laundry | Dashboard</title>

<!-- head css + js -->
<?php $this->load->view("template/head");?>
<style type="text/css">
  .table-mini td{
    padding: 2px 8px !important;
  }
</style>

</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">
  
  <!-- nav bar -->
<?php $this->load->view("template/navbar");?>

<!-- side bar -->
<?php $this->load->view("kios/sidebar-kios");?>
  
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <!-- heading -->

      <h1>
        Dashboard
        <small>Input Cucian</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
     <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-ticket"></i><?php echo $paket->kode_paket?>;
            <small class="pull-right">tanggal: 2/10/2014</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Pelanggan
          <h4><strong><?php echo $paket->nama_pelanggan?></strong></h4>
              <h4><?php echo $paket->tlp_pelanggan?> (No. Tlp)</h4>
              <h4><?php echo $paket->tgl_masuk?> (Tgl Masuk)</h4>
        </div>
     

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Nama Cucian</th>
              <th>Jumlah Cucian</th>
              <th>Harga Satuan</th>
              <th>Diskon</th>
              <th>Jumlah Harga</th>
              <th>Tanggal Dibayar</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($cucian as $no => $row) : ?>
            <tr>
              <td><?php echo $no+1 ?></td>
              <td><?php echo $row->nama?></td>
              <td><?php echo $row->berat?></td>
              <td>Rp.<?php echo number_format($row->harga)?></td>
              <td>Rp.<?php echo number_format($row->jumlah_diskon)?></td>
              <td>Rp.<?php echo number_format($row->jumlah_harga)?></td>
              <td><?php echo $row->tgl_bayar?></td>
              <td><?php echo $row->status_cucian?>;</td>
              <td>
                <div class="btn-group">
                  
              <!--       <button type="button" class="btn btn-warning btn-sm " <?php if($row->status_cucian!="Selesai")echo 'disabled'?> data-toggle="modal" data-target="#ambil"><i class="fa fa-money"></i> Strika</button> -->               
                    <button type="button" class="btn btn-danger btn-sm " <?php if($row->status_cucian != "Selesai")echo 'disabled'?> data-toggle="modal" data-target="#ambil"><i class="fa fa-money" ></i> Ambil</button>
                  
                  
                    <button type="button" class="btn btn-success btn-sm " <?php if($row->status_pembayaran != 'Belum'){echo 'disabled';} ?> data-toggle="modal" data-target="#bayar" id="<?php echo $row->id_transaksi?>" onclick="bayar_satu(this.id)" ><i class="fa fa-money"></i> Bayar</button>
                  
                </div>
              </td>
            </tr>
          <?php endforeach ?>
            </tbody>
          </table>
        </div>
        
        <div class="col-xs-5 col-xs-offset-6">
          <hr>
          <strong>
            <h4>
              <table class="table table-striped table-mini">
                <tr>
                  <td>Total Harga :</td>
                  <td>Rp.<?php echo number_format($paket->harga)?></td>
                </tr>
                <tr>
                  <td>Sudah Dibayar :</td>
                  <td>Rp.<?php echo number_format($paket->sudah_dibayar)?></td>
                </tr>
                <tr>
                  <td>Belum Dibayar :</td>
                  <td><span id="belum-dibayar">Rp.<?php echo number_format($paket->harga-$paket->sudah_dibayar)?></span></td>
                </tr>
              </table>
            </h4>
          </strong>
          
          
        </div>

        <!-- /.col -->
      </div>
      <!-- /.row -->

    
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-md-12" style="padding-right: 30px">
          <hr>
          <!-- <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> -->
          <div class="btn-group pull-right">
              <button type="button" class="btn btn-danger btn-lg " data-toggle="modal" data-target="#ambil" id="<?php echo $paket->kode_paket?>" onclick="ambil_semua(this.id)" <?php if($paket->status_pengambilan_paket != "Sudah")echo 'disabled'?> ><i class="fa fa-money"></i> Ambil Semua</button>
            
        
                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#bayar" id="<?php echo $paket->kode_paket?>" onclick="bayar_semua(this.id)" <?php if($paket->status_pembayaran_paket != "Sudah")echo 'disabled'?>><i class="fa fa-money"></i> Bayar Semua</button>
              
          </div>
         <!--  <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button> -->
        </div>
      </div>
    </section>


    <div class="modal  fade" id="bayar">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <h4>Jumlah Yang Harus Dibayarkan <strong id="modal-harga"></strong></h4>
            <h5>kasir : <?php echo $user->username;?></h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left " data-dismiss="modal">Batal</button>
            <a type="button" class="btn btn-success" href="" id="modal-btn-bayar" >Bayar</a>
          </div>
        </div>
      </div>
    </div>

    <div class="modal  fade" id="ambil">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <h4>Ambil Cucian <strong id="modal-ambil"></strong></h4>
            <h5>kasir : <?php echo $user->username;?></h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left " data-dismiss="modal">Batal</button>
            <a type="button" class="btn btn-success" href="" id="modal-btn-ambil" >Ambil</a>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- footer -->
  <?php $this->load->view("template/footer");?>

  <div class="control-sidebar-bg"></div>
</div>

<?php $this->load->view("template/jsfile");?>
<!-- ./wrapper -->

<!-- script tambahan -->
<script>
  var data_cucian=<?php echo json_encode((array)$cucian,JSON_PRETTY_PRINT)?>;

  function bayar_satu(id){
    for (var i = 0; i < data_cucian.length; i++) {
      if(data_cucian[i].id_transaksi==id){
        var link="<?php echo site_url()?>"+"Kios/pembayaran_transaksi/single-"+id;
        $("#modal-harga").html("Rp."+data_cucian[i].harga*data_cucian[i].berat);
        $("#modal-btn-bayar").attr("href",link);
      }
    }
  }

  function bayar_semua(id){
        var link="<?php echo site_url()?>"+"Kios/pembayaran_transaksi/all-"+id;
        var sisa=$("#belum-dibayar").text();
        $("#modal-harga").html(sisa);
        $("#modal-btn-bayar").attr("href",link);
  }

  function ambil_satu(id){
    for (var i = 0; i < data_cucian.length; i++) {
      if(data_cucian[i].id_transaksi==id){
        var link="<?php echo site_url()?>"+"Kios/ambil_transaksi/single-"+id;
        $("#modal-ambil").html("Rp."+data_cucian[i].nama+" Sejumlah "+data_cucian[i].berat);
        $("#modal-btn-ambil").attr("href",link);
      }
    }
  }

  function ambil_semua(id){
        var link="<?php echo site_url()?>"+"Kios/ambil_transaksi/all-"+id;
        var cucian="";
        for (var i = 0; i < data_cucian.length; i++) {
          if(data_cucian.status_cucian!="Diambil"){
            cucian=cucian+data_cucian[i].nama+",";
          }
        }
        $("#modal-ambil").html(cucian);
        $("#modal-btn-ambil").attr("href",link);
  }



</script>




</body>
</html>
