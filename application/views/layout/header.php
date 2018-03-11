		<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							KSS Laundry
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
									<?php echo $nama; ?>
								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#modal-change" data-toggle="modal">
										<i class="ace-icon fa fa-cog"></i>
										Ganti Password
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="<?php echo base_url();?>index.php/login/logout">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->

			<div id="modal-change" class="modal fade" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3 class="smaller lighter blue no-margin">Ganti Password</h3>
						</div>
						<form action="<?php echo base_url('index.php/monitoring/change_password'); ?>" method="post">
							<div class="modal-body">
								<center>
								<table style="width:90%">
									<tr>
										<td style="width:35%; margin-right: 3%">Password Lama</td>
										<td style="width:65%">
											<input style="width:100%" type="password" placeholder="Password Lama" name="password_lama">
											<span class="help-inline">
											</span></td>
									</tr>
									<tr><td>&nbsp;</td><td></td><td>&nbsp;</td></tr>
									<tr>
										<td>Password Baru</td>
										<td><input style="width:100%" type="password" placeholder="Password Baru" name="password_baru"></td>
									</tr>
								
									<tr><td>&nbsp;</td><td></td><td>&nbsp;</td></tr>
									<tr>
										<td>Konfirmasi Password Baru</td>
										<td><input style="width:100%" type="password" placeholder="Konfirmasi Password Baru" name="konfirmasi_password_baru"></td>
									</tr>
								</table>
								</center>
							</div>

							<div class="modal-footer">
								<input type="submit" value="OK" class="btn btn-md btn-success pull-right" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>