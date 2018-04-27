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
<?php $this->load->view("kios/sidebar-mkios");?>
  
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <!-- heading -->

      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <br>
      <section class="content">

      <div class="row">
        <div class="col-xs-12 ">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">List Pengeluaran</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Filter</label>
                      <div class="col-sm-4">
                      <select class="form-control" id="filter-bulan">
                        <option value="all">All</option>
                        <option value="1">Januari</option>
                        <option value="2">Febuari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <table id="table_pengeluaran" class="table table-hover table-bordered" cellspacing="0">
                    <thead>
                          <tr>
                              <th >No</th>
                              <th >Nama Peneluaran</th>
                              <th >Tanggal</th>
                              <th >Harga</th>
                              <th >Ketrangan</th>
                          </tr>
                      </thead>
                      <tbody id="table_kios_tbody">
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
        </div>
      </div>

      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Pengeluaran</h3>

             
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo site_url('Mkios/input_pengeluaran/')?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="pengeluaran">Pengeluaran</label>
                  <input type="text" class="form-control" id="pengeluaran" name="pengeluaran" placeholder="Nama Pengeluaran"  required>
                </div>
                <div class="form-group">
                      <label>Tangal Masuk:</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="tanggal"  id="tanggal" required>
                      </div>
                    </div>
                <div class="form-group">
                  <label for="tanggal">Jumlah</label>
                  <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Pengeluaran (Rp)" required>
                </div>
                <div class="form-group">
                  <label for="tanggal">Keterangan</label>
                  <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" rows="3"></textarea>
                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
              </div>
            </form>
          </div>


     <!-- Isi -->

    </section>
  </div>
  <!-- footer -->
   <?php $this->load->view("template/footer");?>


  <div class="control-sidebar-bg"></div>

  <?php $this->load->view("template/jsfile");?>
  <script >

    $("#tanggal").datetimepicker({
      format:"Y-MM-DD HH:mm",
      showTodayButton:true
    });
    // $("#table_pengeluaran").DataTable();
    var filter="all";

    var pengeluaran=$("#table_pengeluaran").DataTable({
      'paging'      : true,
      "order"       : [[ 2, "desc" ]],
      'autoWidth'   : false,
      'ajax'        : {
                      "url"     : "<?php echo site_url()?>Mkios/list_pengeluaran",
                      "data"    :{filter:filter},
                      "dataSrc" : "",
                      "mDataProp": "",   
                      },
      'columns'    :[
        {"data":"id_pengeluaran"},
        {"data":"nama_pengeluaran"},
        {"data":"tanggal"},
        {"data":"jumlah_pengeluaran"},
        {"data":"keterangan"}
      ]
     
    });

    $("#filter-bulan").change(function(){
      var select=$("#filter-bulan").val();
      // alert(select);
      filter=select;
      alert(pengeluaran.ajax.data);
      pengeluaran.ajax.reload();
    });


  </script>
</div>
<!-- ./wrapper -->


</body>
</html>
