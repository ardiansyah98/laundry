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
        <div class="col-xs-8 ">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">List User</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
            
            <div class="row">
              <div class="col-md-12">
                <table id="table_pengeluaran" class="table table-hover table-bordered" cellspacing="0">
                    <thead>
                          <tr>
                              <th >No</th>
                              <th >Username</th>
                              <th >Status</th>
                              <th>Hapus</th>
                          </tr>
                      </thead>
                      <tbody id="table_kios_tbody">
                        <?php foreach ($users as $no => $row) :?>
                          <tr>
                            <td><?php echo $no+1 ?></td>
                            <td><?php echo $row->username ?></td>
                              <td><label class="label label-success"><?php echo $row->status?></label>
                              </td>
                              <td>
                                <button class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#myModal" onclick="hapus(this)"><span class="fa  fa-trash" > Hapus</span></button>
                              </td>
                          </tr>
                        <?php endforeach?>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
        </div>
      
      <div class="col-md-4">
        <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Tambah User</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" method="post" action="<?php echo site_url('Mkios/tambah_akun/')?>">
                <div class="box-body">
                  <div class="form-group">
                    <label for="pengeluaran">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nama" onkeypress='return event.charCode != 32' pattern="[A-Za-z]{3,}" title="minimal 3 huruf" onblur="checkuser(this)" required>
                    <p id="notif" style="color: red">username sudah ada</p>
                  </div>
                  <div class="form-group">
                    <label for="tanggal">Password</label>
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control" id="pass" name="password" placeholder="Password" required 
                    pattern="[A-Za-z1-9]{6,}" title="minimal 6 huruf" onkeypress='return event.charCode != 32'>
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-info btn-flat" onclick="userpass()" >Copy</button>
                          </span>
                    </div>
                    
                  </div>
                 
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" id="tambah">Tambah</button>
                </div>
              </form>
            </div>
          </div>


     <!-- Isi -->

     <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <h3>Anda yakin ingin menghapus <strong><span id="nama"></span></strong></h3>
          </div>
          <div class="modal-footer">
            <a href="#" id="hapus-btn" class="btn btn-danger" style="float: left;">Hapus</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>

    </section>
  </div>
  <!-- footer -->
   <?php $this->load->view("template/footer");?>


  <div class="control-sidebar-bg"></div>

  <?php $this->load->view("template/jsfile");?>
  <script>
    $("#notif").hide();
    function userpass(){
      var input=$("#username").val();
      $("#pass").val(input);
    }

    function hapus(id){
      var row=id.parentElement.parentElement.parentElement;
      var nama=row.getElementsByTagName('td')[1].innerHTML;
      $("#nama").html(nama);
      var link="<?php echo site_url()?>Mkios/hapus-akun/"+nama;
      $("#hapus-btn").attr("href",link);
    }

    function checkuser(id){
      var user=id.value;
      var link="<?php echo site_url()?>User/check_user/";
      $.get(link,{username:user},function(data){
        if(data=="true"){
          $("#notif").show();
          $("#tambah").attr('disabled',"true");
        }else{
          $("#notif").hide();
          $("#tambah").removeAttr('disabled');
        }
      });
    }
    
   


  </script>
</div>
<!-- ./wrapper -->


</body>
</html>
