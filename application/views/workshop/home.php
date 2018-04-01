<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>laundry | Dashboard</title>

<!-- head css + js -->
<?php $this->load->view("template/head");?>


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  
  <!-- nav bar -->
<?php $this->load->view("template/navbar");?>

<!-- side bar -->
<?php $this->load->view("workshop/sidebar-workshop");?>
  
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <!-- heading -->

      <h1>
        Set Cuci
        <small>WorkShop</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    

     <section class="content">

      <div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-align-center"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Cucian</span>
              <span class="info-box-number" id="cucian" style="font-size: 40px"></span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-orange ">
              <i class="fa fa-firefox fa-spin"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">Di Cuci</span>
              <span class="info-box-number" id="dicuci" style="font-size: 40px"></span>
            </div>
          </div>
        </div>
        

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-flag-checkered"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Selesai</span>
              <span class="info-box-number" id="selesai" style="font-size: 40px"></span>
            </div>
          </div>
        </div>
      </div>


      <!-- express -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-danger ">
            <div class="box-header " >
              <h3 class="box-title">Laundry Express 8 Jam</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="prioritas" class="table table-bordered table-hover">
                <thead>
                <tr>
                 <th>No</th>
                  <th>Kode Paket</th>
                  <th>Kode Cucian</th>
                  <th>Nama Pelanggan</th>
                  <th>Qty</th>
                  <th>Tanggal Masuk</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<!-- 24 jam -->

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-warning collapsed-box">
            <div class="box-header " >
              <h3 class="box-title">Laundry Express 24 Jam</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="express" class="table table-bordered table-hover">
                <thead>
                <tr>
                 <th>No</th>
                  <th>Kode Paket</th>
                  <th>Kode Cucian</th>
                  <th>Nama Pelanggan</th>
                  <th>Qty</th>
                  <th>Tanggal Masuk</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>



<!-- semua -->
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-info collapsed-box">
            <div class="box-header " >
              <h3 class="box-title">Semua</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="semua" class="table table-bordered table-hover">
                <thead>
                <tr>
                 <th>No</th>
                  <th>Kode Paket</th>
                  <th>Kode Cucian</th>
                  <th>Nama Pelanggan</th>
                  <th>Jenis Laundry</th>
                  <th>Qty</th>
                  <th>Tanggal Masuk</th>
                  <th>Aksi</th>
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
<!-- ./wrapper -->
<?php $this->load->view("template/jsfile");?>
<script>

  var prioritas=$("#prioritas").DataTable({
      'paging'      : true,
      "order"       : [[ 2, "asc" ]],
      'autoWidth'   : false,
      'ajax'        : {
                      "url"     : "<?php echo site_url()?>Workshop/spesial_list/Diterima=4",
                      "dataSrc" : "",
                      "mDataProp": "",   
                      },
      'columns'    :[
        {"data":"no"},
        {"data":"kode_paket"},
        {"data":"id_transaksi"},
        {"data":"nama_pelanggan"},
        {"data":"berat"},
        {"data":"tgl_diterima"},
        {"data":""}
      ],
      "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class='btn btn-warning'>Dicuci</button>"
        } ],
    });

var express=$("#express").DataTable({
      'paging'      : true,
      "order"       : [[ 2, "asc" ]],
      'autoWidth'   : false,
      'ajax'        : {
                      "url"     : "<?php echo site_url()?>Workshop/spesial_list/Diterima=5",
                      "dataSrc" : "",
                      "mDataProp": "",   
                      },
      'columns'    :[
        {"data":"no"},
        {"data":"kode_paket"},
        {"data":"id_transaksi"},
        {"data":"nama_pelanggan"},
        {"data":"berat"},
        {"data":"tgl_diterima"},
        {"data":""}
      ],
      "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class='btn btn-warning'>Dicuci</button>"
        } ],
    });

var semua=$("#semua").DataTable({
      'paging'      : true,
      "order"       : [[ 2, "asc" ]],
      'autoWidth'   : false,
      'ajax'        : {
                      "url"     : "<?php echo site_url()?>Workshop/semua_kecuali/Diterima=4-5",
                      "dataSrc" : "",
                      "mDataProp": "",   
                      },
      'columns'    :[
        {"data":"no"},
        {"data":"kode_paket"},
        {"data":"id_transaksi"},
        {"data":"nama_pelanggan"},
        {"data":"nama"},
        {"data":"berat"},
        {"data":"tgl_diterima"},
        {"data":""}
      ],
      "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class='btn btn-warning'>Dicuci</button>"
        } ],
    });

  

  $("#prioritas tbody").on( 'click', 'button', function () {
        var row=$(this).closest("tr");
        var column=row.children("td").eq(2);
        //alert(column.html());
        var link="<?php echo site_url()?>Workshop/set_dicuci/"+column.html();
        $.get(link);
        prioritas.ajax.reload();
        set_jumlah();
    });

  $("#express tbody").on( 'click', 'button', function () {
        var row=$(this).closest("tr");
        var column=row.children("td").eq(2);
        //alert(column.html());
        var link="<?php echo site_url()?>Workshop/set_dicuci/"+column.html();
        $.get(link);
        express.ajax.reload();
        set_jumlah();
    });

  $("#semua tbody").on( 'click', 'button', function () {
        var row=$(this).closest("tr");
        var column=row.children("td").eq(2);
        //alert(column.html());
        var link="<?php echo site_url()?>Workshop/set_dicuci/"+column.html();
        $.get(link);
        semua.ajax.reload();
        set_jumlah();
    });



  set_jumlah();
  function set_jumlah(){
    var link="<?php echo site_url()?>Workshop/jumlah_cucian";
    var data;
    $.get(link,function(result){
      result=JSON.parse(result);
      $("#dicuci").html(result["proses"]);
      $("#cucian").html(result["cucian"]);
      $("#selesai").html(result["selesai"]);
    });
    
  }



</script>
</body>
</html>
