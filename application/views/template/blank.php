<?php echo $this->load->view("template/head");?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!-- nav bar -->
<?php echo $this->load->view("template/navbar");?>

<!-- side bar -->
<?php echo $this->load->view("template/sidebar");?>
  
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


     <!-- Isi -->

    </section>
  </div>
  <!-- footer -->
  <?php echo $this->load->view("template/footer");?>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


</body>
</html>
