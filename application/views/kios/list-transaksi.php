<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>laundry | Dashboard</title>

<!-- head css + js -->
<?php $this->load->view("template/head");?>

<style>
  #table_kios{
    cursor:pointer;
  }
</style>

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

      <!-- <h1>
        Dashboard
        <small>Daftar Cucian</small>
      </h1> -->
      <ol class="breadcrumb">
        <li><a><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active">List Transaksi</li>
      </ol>
    </section>

    <section style="margin-top: 2%" class="content">
      <div class="row">
        <div class="col-xs-12 ">
          <div class="box">
            <div class="box-body">
              <table id="table_kios" class="table table-hover table-bordered" cellspacing="0">
                  <thead>
                        <tr>
                            <th >No</th>
                            <th >Id Paket</th>
                            <th >Kode Paket</th>
                            <th >Nama Pelanggan</th>
                            <th >Tlp Pelanggan</th>
                            <th >Harga</th>
                            <th >Tgl Masuk</th>
                            <th >Status Pembayaran Paket</th>
                            <th >Status Pengambilan Paket</th>
                        </tr>
                    </thead>
                    <tbody id="table_kios_tbody">
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
    var table = $('#table_kios').DataTable({
          "sScrollX": "100%",
          "autoWidth": false,
          "processing": true, 
          "serverSide": true, 
          "order": [], 

          "ajax": {
              "url": "<?php echo site_url('Pkios/ajax_list')?>",
              "type": "POST"
          },

          "columnDefs": [
          { 
              "targets": [0], 
              "orderable": false, 
          }, 
          { 
              "targets": [1],
              "visible": false,
          },
          ],
    });

    $('#table_kios_tbody').on('click', 'tr', function () 
    {
        var data = table.row( this ).data();
        var link="<?php echo site_url()?>"+"Pkios/transaksi/"+data[1];
        // alert(link);
        window.document.location = link;
    });
  })
</script>

</body>
</html>
