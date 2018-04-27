<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/adminlte/dist/img/user2-160x160.jpg')?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
    <!--   <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <hr>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="<?php if($this->uri->segment(2)=="Home" || $this->uri->segment(2)=="" ){echo "active";}?>">
          <a href="<?php echo site_url('Mkios/Home/')?>" >
            <i class="fa  fa-line-chart"></i> <span>Home </span>
          </a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="list_transaksi"  ){echo "active";}?>">
          <a href="<?php echo site_url('Kios/list_transaksi/')?>" >
            <i class="fa  fa-check-square-o"></i> <span>Transaksi</span>
          </a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="pengeluaran" ){echo "active";}?>">
          <a href="<?php echo site_url('Mkios/pengeluaran/')?>" >
            <i class="fa  fa-money"></i> <span>Pengeluaran</span>
          </a>
        </li>
        <li class="<?php if($this->uri->segment(2)=="list_akun" ){echo "active";}?>">
          <a href="<?php echo site_url('Mkios/list_akun/')?>" >
            <i class="fa  fa-users" aria-hidden="true"></i> <span>Akun</span>
          </a>
        </li>
   
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>