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
<?php $this->load->view("kios/sidebar-kios");?>
  
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
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Data Laundry</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo site_url('Kios/input_transaksi/')?>" onsubmit="return form_validate()">
              <div class="box-body" style="padding: 20px 30px">

                <div class="row" id="data_pelanggan">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama</label>
                      <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="Nama Pelanggan"  required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputPassword1">No tlp</label>
                      <input type="phone" class="form-control" id="tlp" name="tlp" placeholder="No Tlp" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Tangal Masuk:</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" name="tanggal"  id="tanggal" required>
                      </div>
                    </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-striped" >
                    <thead>
                      <th>No</th>
                      <th>Jenis Cucian</th>
                      <th>Jumlah Cucian</th>
                      <th>Harga Satuan</th>
                      <th>Jumlah Harga</th>
                      <th>Hapus</th>
                    </thead>
                    <tbody id="list">

                      
                      <tr id="input">
                        <td>0</td>
                        <td>
                          <select class="form-control select2" id="input_cucian" style="width: 100%;">
                            <?php foreach ($pilihan_cucian as $option) :?>
                            <option><?php echo $option->nama?></option>
                            <?php endforeach?>
                          </select>
                        </td>
                        <td><input type="number" class="form-control" id="input_jumlah" min="1" placeholder="Jumlah Cucian"></td>
                        <td><p>--</p></td>
                        <td><p>--</p></td>
                        <td><a href="#list_cucian" class="btn btn-flat btn-info" onclick="tambah_cucian()">Tambah Cucian</a></td>
                      </tr>

                      
                    </tbody>
                  </table>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Total Harga</label>
                    <div class="input-group">
                      <div class="input-group-addon">Rp</div>
                      <input type="text" class="form-control" id="total_harga" placeholder="Total Harga" readonly style="font-size: 20px;font-weight: bold;">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                    <input  class="btn btn-flat btn-success btn-lg" type="submit" role="button" style="float: right;" value="Selesai" >
                </div>
              </div>

            </div>
            </form>
          </div>
        </div>
      </div>
     <!-- Isi -->




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
  var list=1;
  $(".select2").select2();

$("#tanggal").datepicker({
  "setDate": new Date(),
  "autoclose" : true,
  "format":"yyyy-mm-dd",
  "timePicker": true
  // "use24hours": true
});
  var data=<?php echo json_encode((array)$pilihan_cucian,JSON_PRETTY_PRINT)?>;

  var input_jenis=document.getElementsByName("jenis_cucian[]");
  var input_jumlah=document.getElementsByName("jumlah_cucian[]");
  var harga_total=[];

function tambah_cucian(){
  var jenis_cucian=$("#input_cucian").val();
  var jumlah_cucian=$("#input_jumlah").val();
  if(jumlah_cucian>0){
    var field=document.getElementById("field");
    var copy=field.cloneNode(true);
    var input=copy.getElementsByTagName("input");
    // var text=copy.getElementById("harga_satuan");
    var text=copy.getElementsByTagName("p");
    
    input[0].value = jenis_cucian;
    input[1].value = jumlah_cucian;
    for (var i = 0; i < data.length; i++) {
      if(data[i].nama == jenis_cucian){
        text[0].innerHTML=data[i].harga;
        text[1].innerHTML=data[i].harga*jumlah_cucian;
        harga_total[harga_total.length]=data[i].harga*jumlah_cucian;
      }
    }
    var target=document.getElementById("list");
    var template=document.getElementById("input");
    target.insertBefore(copy,template);
    reNumber();
    total_harga();
  }
}

function total_harga(){
  var name=document.getElementsByName("jumlah_harga[]");
  var total=0;
  for (var i = 0; i < name.length; i++) {
    if(name[i].innerHTML!="--"){
      total+=parseInt(name[i].innerHTML);
    }
    // alert(name[i].innerHTML);
  }

  $("#total_harga").val(total);
}



function hapus_cucian(node){
  var list=document.getElementById("list");
  var row=node.parentElement.parentElement;
  list.removeChild(row);

}

function reNumber(){
  var no=1;
  var target=document.getElementById("list");
  var number=target.getElementsByTagName("tr");
  for (var i = 0; i < number.length; i++) {
    number[i].cells[0].innerHTML=no;
    // alert(number[i].cells.length);
    no++;
  }
  // alert(number.length);
}





function form_validate(){
  var form=document.getElementById("list");
  var input=form.getElementsByTagName("tr");
  
  if(input.length>1){
    return true;
  }else{
    alert("masukan jenis cucian dan jumlahnya");
    return false;
  }
  
}
// });
</script>


<!-- template row table -->
     <div class="sr-only">
      <table>
        <tr id="field">
          <td class="nomer_table">1</td>
          <td><input type="text" class="form-control" name="jenis_cucian[]" id="jenis_cucian" placeholder="Jumlah Cucian" readonly></td>
          <td><input type="number" class="form-control" name="jumlah_cucian[]" id="jumlah_cucian"  placeholder="Jumlah Cucian" readonly></td>
          <td><p id="harga_satuan">--</p></td>
          <td><p name="jumlah_harga[]">--</p></td>
          <td><a href="#list_cucian" class="btn btn-flat btn-danger" onclick="hapus_cucian(this)">Hapus Cucian</a></td>
        </tr>
      </table>
    </div>

    <!-- sampe sini -->

</body>
</html>
