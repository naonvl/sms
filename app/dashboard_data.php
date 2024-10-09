<div class="page-content">
	<div class="row">
		
		<div class="col-sm-6">
			<h3 class="row header smaller lighter blue">
				<span class="col-xs-3"> Informasi</span><!-- /.col -->

				<span class="col-xs-6">
					<span class="pull-right inline">
						<?php 
							if($_SESSION["tipe_user"] == "Siswa") {
						?>		
						
							<span class="col-xs-6"> Informasi</span><!-- /.col -->
						<?php		
							}
						?>
						<!--<span class="grey smaller-80 bolder">style:</span>

						<span class="btn-toolbar inline middle no-margin">
							<span id="accordion-style" data-toggle="buttons" class="btn-group no-margin">
								<label class="btn btn-xs btn-yellow active">
									<input type="radio" value="1" />
									1
								</label>

								<label class="btn btn-xs btn-yellow">
									<input type="radio" value="2" />
									2
								</label>
							</span>
						</span>-->
					</span>
				</span><!-- /.col -->
			</h3>

			<div id="accordion" class="accordion-style1 panel-group">
				
				<?php /*if(allow_reminder("1", "") == 1) { ?>				
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseppk">
									<i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
									<?php $tanggal_ppk = date("d-m-Y") ?>
									&nbsp;Daftar Guru PPK Tanggal <?php echo $tanggal_ppk ?>
								</a>
							</h4>
						</div>

						<div class="panel-collapse collapse in" id="collapseppk">
							<div class="panel-body">
								
								<div class="row">
									<div class="col-xs-12">
										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
					                                    <th><?php if($_SESSION['bahasa']==1) { echo 'NIP'; } else { echo 'NIP'; } ?></th>
					                                    <th><?php if($_SESSION['bahasa']==1) { echo 'Nama'; } else { echo 'Nama'; } ?></th>
														<th><?php if($_SESSION['bahasa']==1) { echo '-'; } else { echo '-'; } ?></th>    												
													</tr>
												</thead>

												<tbody>
					                                <?php			
														$i = 0;
														$dari_jam = "05:00";
														$tanggal_jam = date("Y-m-d") . $dari_jam;  //"2018-10-24 06:00";
														$tanggal_jam = date("Y-m-d H:i", strtotime($tanggal_jam));
														
														$smp_jam = "07:00";
														$smp_tanggal_jam = date("Y-m-d") . $smp_jam; //"2018-10-24 07:00";
														$smp_tanggal_jam = date("Y-m-d H:i", strtotime($smp_tanggal_jam));
														
					            						$sql=$selectview->dashboard_presensi_general_ppk($tanggal_jam, $smp_tanggal_jam);
											            while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
					            						
					            						$i++;
					            							
					            							//if($row_delivery_order->qty > 0) {
													?>
					                                            
					                                        <tr>
					                                            <td><?php echo $row_delivery_order->nip ?></td>
					                                            <td><?php echo $row_delivery_order->nama ?></td>
																<td><?php echo date("d-m-Y H:i", strtotime($row_delivery_order->tanggal)) ?></td>
															</tr>
					                                    
				                                    <?php
															//}
				                                        }
				                                    ?>
					                                    
												</tbody>
											</table>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
					
				<?php }*/ ?>
				
				
				<?php /*if(allow_reminder("2", "") == 1) { ?>
				
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									<i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
									&nbsp;Siswa Belum Bayar
								</a>
							</h4>
						</div>

						<div class="panel-collapse collapse" id="collapseOne">
							<div class="panel-body">
								
								<div class="row">
									<div class="col-xs-12">
										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
					                                    <th><?php if($_SESSION['bahasa']==1) { echo 'NIS'; } else { echo 'NIS'; } ?></th>
					                                    <th><?php if($_SESSION['bahasa']==1) { echo 'Nama'; } else { echo 'Nama'; } ?></th>
														<th><?php if($_SESSION['bahasa']==1) { echo 'Amount'; } else { echo 'Sisa Bayar'; } ?></th>    												
													</tr>
												</thead>

												<tbody>
					                                <?php			
														$i = 0;
					            						$sql=$selectview->list_dashboard_receipt_outstanding("SMA");
											            while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
					            						
					            						$i++;
					            							
					            							//if($row_delivery_order->qty > 0) {
													?>
					                                            
					                                        <tr>
					                                            <td><?php echo $row_delivery_order->nis ?></td>
					                                            <td><?php echo $row_delivery_order->nama ?></td>
																<td align="right"><?php echo number_format($row_delivery_order->sisa,0,'.',',') ?></td>
															</tr>
					                                    
				                                    <?php
															//}
				                                        }
				                                    ?>
					                                    
												</tbody>
											</table>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
					
				<?php }*/ ?>
				
				
				<?php if(allow_reminder("3", "") == 1) { ?>
				
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
									&nbsp;Siswa Absen <?= $tanggal_ppk ?>
								</a>
							</h4>
						</div>

						<div class="panel-collapse collapse" id="collapseTwo">
							<div class="panel-body">
								
								<div class="row">
										<div class="col-xs-12">
											<div class="clearfix">
												<div class="pull-right tableTools-container"></div>
											</div>
											<!-- div.dataTables_borderWrap -->
											<div>
												<table id="dynamic-table" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>No.</th>
						                                    <th><?php if($_SESSION['bahasa']==1) { echo 'NIS'; } else { echo 'NIS'; } ?></th>
						                                    <th><?php if($_SESSION['bahasa']==1) { echo 'Nama'; } else { echo 'Nama'; } ?></th>
															<th><?php if($_SESSION['bahasa']==1) { echo 'Absent Type'; } else { echo 'Jenis Absen'; } ?></th>
														</tr>
													</thead>

													<tbody>
						                                <?php			
															$i = 0;
															$dari_jam = "05:00";
															$tanggal_jam = date("Y-m-d") . $dari_jam;  //"2018-10-24 06:00";
															$tanggal_jam = date("Y-m-d H:i", strtotime($tanggal_jam));
															
															$smp_jam = "06:30";
															$smp_tanggal_jam = date("Y-m-d") . $smp_jam; //"2018-10-24 07:00";
															$smp_tanggal_jam = date("Y-m-d H:i", strtotime($smp_tanggal_jam));
						            						$sql=$selectview->list_dashboard_presensi_harian_siswa("", $tanggal_jam, $smp_tanggal_jam);
												            while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
						            						
						            						$i++;
						            							
						            							$absen = "";
						            							if($row_delivery_order->hadir==0) {
							            							if($row_delivery_order->ijin>0) {
							            								$absen = "Izin";
							            							} 
							            							if($row_delivery_order->sakit>0) {
							            								$absen = "Sakit";
							            							} 
							            							if($row_delivery_order->alpa>0) {
							            								$absen = "Alpa";
							            							} 
							            						} else {
							            							$absen = "Terlambat"." ".date('d-m-Y H:i', strtotime($row_delivery_order->ts));
							            						}
														?>
						                                            
						                                        <tr>
						                                        	<td align="center"><?= $i ?></td>
						                                            <td><?php echo $row_delivery_order->nis ?></td>
						                                            <td><?php echo $row_delivery_order->nama ?></td>
																	<td><?php echo $absen ?></td>
																</tr>
						                                    
					                                    <?php
																//}
					                                        }
					                                    ?>
						                                    
													</tbody>
												</table>
											</div>
										</div>
									</div>
									
							</div>
						</div>
					</div>
				<?php } ?>

				<?php if(allow_reminder("4", "") == 1) { ?>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
								<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
								<?php $tanggal_hadir = date("d-m-Y") ?>
								&nbsp;Kehadiran Guru Tanggal <?php echo $tanggal_hadir ?>
							</a>
						</h4>
					</div>

					<div class="panel-collapse collapse" id="collapseThree">
						<div class="panel-body">
							
							<div class="row">
								<div class="col-xs-12">
									<div class="clearfix">
										<div class="pull-right tableTools-container"></div>
									</div>
									<!-- div.dataTables_borderWrap -->
									<div>
										<table id="dynamic-table" class="table table-striped table-bordered table-hover" style="font-size: 11px">
											<thead>
												<tr>
													<th>No.</th>
				                                    <th><?php if($_SESSION['bahasa']==1) { echo 'NIP'; } else { echo 'NIP'; } ?></th>
				                                    <th><?php if($_SESSION['bahasa']==1) { echo 'Nama'; } else { echo 'Nama'; } ?></th>
													<th><?php if($_SESSION['bahasa']==1) { echo 'Date'; } else { echo 'Tanggal dan Jam'; } ?></th>
												</tr>
											</thead>

											<tbody>
				                                <?php			
													$i = 0;
													$tanggal_jam = date("Y-m-d");
													$smp_tanggal_jam = date("Y-m-d");

				            						$sql=$selectview->list_dashboard_presensi_harian_guru("", $tanggal_jam, $smp_tanggal_jam);
										            while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
				            						
				            						$i++;
				            							
				            							//if($row_delivery_order->qty > 0) {
												?>
				                                            
				                                        <tr>
				                                        	<td align="center"><?= $i ?></td>
				                                            <td><?php echo $row_delivery_order->nip ?></td>
				                                            <td><?php echo $row_delivery_order->nama ?></td>
															<td><?php echo date('d-m-Y H:i:s', strtotime($row_delivery_order->dlu)) ?></td>
														</tr>
				                                    
			                                    <?php
														//}
			                                        }
			                                    ?>
				                                    
											</tbody>
										</table>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
				<?php } ?>
			</div>
		</div><!-- /.col -->
		
		
		<div class="col-sm-6">
			<h3 class="header smaller lighter green">&nbsp;</h3>

			<div id="accordion" class="accordion-style1 panel-group">

				<?php if(allow_reminder("9", "") == 1) { ?>				
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapsepiket">
									<i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
									<?php $tanggal_piket = date("d-m-Y") ?>
									&nbsp;Daftar Guru Piket Tanggal <?php echo $tanggal_piket ?>
								</a>
							</h4>
						</div>

						<div class="panel-collapse collapse in" id="collapsepiket">
							<div class="panel-body">
								
								<div class="row">
									<div class="col-xs-12">
										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
					                                    <th><?php if($_SESSION['bahasa']==1) { echo 'NIP'; } else { echo 'NIP'; } ?></th>
					                                    <th><?php if($_SESSION['bahasa']==1) { echo 'Nama'; } else { echo 'Nama'; } ?></th>
														<th><?php if($_SESSION['bahasa']==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th>    												
													</tr>
												</thead>

												<tbody>
					                                <?php			
														$i = 0;
														$dari_jam = "05:00";
														$tanggal_jam = date("Y-m-d") . $dari_jam;  //"2018-10-24 06:00";
														$tanggal_jam = date("Y-m-d H:i", strtotime($tanggal_jam));
														
														$smp_jam = "07:00";
														$smp_tanggal_jam = date("Y-m-d") . $smp_jam; //"2018-10-24 07:00";
														$smp_tanggal_jam = date("Y-m-d H:i", strtotime($smp_tanggal_jam));
														
					            						$sql=$selectview->dashboard_presensi_general_piket($tanggal_jam, $smp_tanggal_jam);
											            while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
					            						
					            						$i++;
					            							
					            							//if($row_delivery_order->qty > 0) {
													?>
					                                            
					                                        <tr>
					                                            <td><?php echo $row_delivery_order->nip ?></td>
					                                            <td><?php echo $row_delivery_order->nama ?></td>
																<td><?php echo date("d-m-Y H:i", strtotime($row_delivery_order->tanggal)) ?></td>
															</tr>
					                                    
				                                    <?php
															//}
				                                        }
				                                    ?>
					                                    
												</tbody>
											</table>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
					
				<?php } ?>

				<?php if(allow_reminder("8", "") == 1) { ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapselambat">
									<i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
									<?php $tanggal_lambat = date("d-m-Y") ?>
									&nbsp;Daftar Siswa Terlambat Tanggal <?php echo $tanggal_lambat ?>
								</a>
							</h4>
						</div>

						<div class="panel-collapse collapse in" id="collapselambat">
							<div class="panel-body">
								
								<div class="row">
									<div class="col-xs-12">
										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover" style="font-size: 11px">
												<thead>
													<tr>
														<th><?php if($_SESSION['bahasa']==1) { echo 'Nomor'; } else { echo 'No'; } ?></th> 
														<th><?php if($_SESSION['bahasa']==1) { echo 'Date'; } else { echo 'Tanggal'; } ?></th> 
					                                    <th><?php if($_SESSION['bahasa']==1) { echo 'NIS'; } else { echo 'NIS'; } ?></th>
					                                    <th><?php if($_SESSION['bahasa']==1) { echo 'Name'; } else { echo 'Nama'; } ?></th>
					                                    <th><?php if($_SESSION['bahasa']==1) { echo 'Class'; } else { echo 'Kelas'; } ?></th>
														<th><?php if($_SESSION['bahasa']==1) { echo 'Description'; } else { echo 'Ket.'; } ?></th>   												
													</tr>
												</thead>

												<tbody>
					                                <?php			
														/*$i = 0;
														$tanggal_jam = date("Y-m-d");
														
														$smp_tanggal_jam = date("Y-m-d");
														
					            						$sql=$selectview->dashboard_siswa_terlambat($tanggal_jam, $smp_tanggal_jam);
											            while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
					            						
					            						$i++;*/
					            							
					            							//if($row_delivery_order->qty > 0) {
													?>
					                                            
					                                        <!-- <tr>
					                                        	<td><?php echo $i ?></td>
					                                        	<td><?php echo date("d-m-Y", strtotime($row_delivery_order->tanggal)).' '.$row_delivery_order->jam ?></td>
					                                            <td><?php echo $row_delivery_order->nis ?></td>
					                                            <td><?php echo $row_delivery_order->nama_siswa ?></td>
					                                            <td><?php echo $row_delivery_order->tingkat.' / '.$row_delivery_order->kelas ?></td>
															</tr> -->
					                                    
				                                    <?php
															//}
				                                        //}
				                                    ?>



				                                    <?php			
															$i = 0;
															$dari_jam = "05:00";
															$tanggal_jam = date("Y-m-d") . $dari_jam;  //"2018-10-24 06:00";
															$tanggal_jam = date("Y-m-d H:i", strtotime($tanggal_jam));
															
															$smp_jam = "06:30";
															$smp_tanggal_jam = date("Y-m-d") . $smp_jam; //"2018-10-24 07:00";
															$smp_tanggal_jam = date("Y-m-d H:i", strtotime($smp_tanggal_jam));
						            						$sql=$selectview->list_dashboard_terlambat_siswa("", $tanggal_jam, $smp_tanggal_jam);
												            while($row_delivery_order=$sql->fetch(PDO::FETCH_OBJ)){
						            						
						            						$i++;
						            							
						            							$absen = "";
						            							if($row_delivery_order->hadir>0) {
							            							$absen = "Terlambat"." ".date('d-m-Y H:i', strtotime($row_delivery_order->ts));
							            						}
														?>
						                                            
						                                        <tr>
						                                        	<td><?php echo $i ?></td>
					                                        		<td><?php echo date("d-m-Y H:i", strtotime($row_delivery_order->ts))?></td>
						                                            <td><?php echo $row_delivery_order->nis ?></td>
						                                            <td><?php echo $row_delivery_order->nama ?></td>
						                                            <td><?php echo $row_delivery_order->tingkat.' / '.$row_delivery_order->kelas ?></td>
																	<td><?php echo $absen ?></td>
																</tr>
						                                    
					                                    <?php
																//}
					                                        }
					                                    ?>
					                                    
												</tbody>
											</table>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				<?php } ?>

			</div>

		</div><!-- /.col -->
		
		
	</div><!-- /.row -->
</div>	

