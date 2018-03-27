<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>laundry | Dashboard</title>

<!-- head css + js -->
<?php $this->load->view("template/head");?>


</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">
  
  <!-- nav bar -->
<?php $this->load->view("template/navbar");?>

<!-- side bar -->
<?php $this->load->view("template/sidebar");?>
  
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <!-- heading -->

      <h1>
        Dashboard
        <small>Daftar Cucian</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12 ">
          <div class="box">
            <div class="box-body">
              <table id="table_pkios" class="table table-striped table-bordered" cellspacing="0">
                  <thead>
                        <tr>
                            <th width="3%">No</th>
                            <th width="5%">Id Transaksi</th>
                            <th width="10%">Id Paket</th>
                            <th width="7%">Jenis Laundry</th>
                            <th width="5%">Berat</th>
                            <th width="5%">Diskon</th>
                            <th width="5%">Id User</th>
                            <th width="8%">Id Cabang</th>
                            <th width="10%">Status Cucian</th>
                            <th width="5%">Tgl Diterima</th>
                            <th width="5%">Tgl Diambil</th>
                            <th width="5%">Status Pembayaran</th>
                            <th width="5%">Tgl Bayar</th>
                            <th width="5%">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>

    </section>
  </div>
  <!-- footer -->
  <?php $this->load->view("template/footer");?>

  <div class="control-sidebar-bg"></div>
</div>

<?php $this->load->view("template/jsfile");?>
<!-- ./wrapper -->

<!-- script tambahan -->
<script>
  $(function () {
    $('#table_pkios').DataTable({
      "sScrollX": "100%",
      "sScrollXInner": "190%",
          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": "<?php echo site_url('Pkios/ajax_list')?>",
              "type": "POST"
          },

          //Set column definition initialisation properties.
          "columnDefs": [
          { 
              "targets": [0], //first column / numbering column
              "orderable": false, //set not orderable
          },
          ],
    });
  })
</script>

</body>
</html>
