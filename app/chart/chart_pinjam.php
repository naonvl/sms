<div class="col-xs-12">
	<div class="row">
					

		<form role="form" action="" method="post" name="dashboard_sales" id="dashboard_sales" enctype="multipart/form-data">
			<?php
				$tahun 	= $_POST["tahun"];

				if($tahun == "") {
					$tahun = date('Y');
				}
			?>
			
			<table>
				<tr>
					<td style="padding-left: 100px; padding-top: 15px">&nbsp;</td>
					<td align="center" colspan="2" style="font-weight: bold;">Jumlah Peminjam Perpustakaan</td>
				</tr>
				<tr>
					<td style="padding-left: 100px; padding-top: 15px">Tahun&nbsp;</td>
					<!-- <td style="padding-top: 15px">
						<select name="bulan" id="bulan" class="chosen-select form-control" >
							<option value=""></option>
							<php bulan_select($bulan); ?>
						</select>
					</td> -->
					<td style="padding-top: 15px">
						<select name="tahun" id="tahun" class="chosen-select form-control" >
							<option value=""></option>
							<?php tahun_select($tahun); ?>
						</select>
					</td>
					<td style="padding-top: 15px">
						&nbsp;
						<button type="submit" name="submit" id="submit" class="btn btn-white btn-succes btn-bold" value="refresh">
							<i class="ace-icon fa fa-refresh bigger-120 green"></i>
							Refresh
						</button>
					</td>
				</tr>
			</table>

			<script src="app/chart/js/serial.js" type="text/javascript"></script>


			<?php

			$dbpdo = DB::create();

			$data = '';
			$i=0;

			$sqlstr="select a.* from (select '1' kode, 'Januari' name union all
						  select '2' kode, 'Februari' name union all
						  select '3' kode, 'Maret' name union all
						  select '4' kode, 'April' name union all
						  select '5' kode, 'Mei' name union all
						  select '6' kode, 'Juni' name union all
						  select '7' kode, 'Juli' name union all
						  select '8' kode, 'Agustus' name union all
						  select '9' kode, 'September' name union all
						  select '10' kode, 'Oktober' name union all
						  select '11' kode, 'November' name union all
						  select '12' kode, 'Desember' name) a order by cast(a.kode as unsigned)
						";
			$sql1 = $dbpdo->query($sqlstr);
			while ($row_tingkat=$sql1->fetch(PDO::FETCH_OBJ)) {
				$sqlstr2 = "select count(a.replid) count_surat, month(a.tglpinjam), a.tglpinjam from pinjam a  group by month(a.tglpinjam) having year(a.tglpinjam)='$tahun' and month(a.tglpinjam)='$row_tingkat->kode'";
				$sql2=$dbpdo->prepare($sqlstr2);
				$sql2->execute();
				$row_jml=$sql2->fetch(PDO::FETCH_OBJ);
				if ($row_jml->count_surat > 0) {
					$korte_count = $row_jml->count_surat;
				} else {
					$korte_count = 0;
				}
				
				switch ($i) {
					case 0:
						$color = "#FF0F00";
						break;
					
					case 1:
						$color = "#04D215";
						break;
					
					case 2:
						$color = "#0D8ECF";
						break;
					
					case 3:
						$color = "#FCD202";
						break;
					
					case 4:
						$color = "#F8FF01";
						break;
					
					case 5:
						$color = "#FF6600";
						break;
					
					case 6:
						$color = "#B0DE09";
						break;
					
					case 7:
						$color = "#FF9E01";
						break;
					
					case 8:
						$color = "#0D52D1";
						break;
					
					case 9:
						$color = "#2A0CD0";
						break;
					
					case 10:
						$color = "#8A0CCF";
						break;
					
					case 11:
						$color = "#CD0D74";
						break;
					
					case 12:
						$color = "#754DEB";
						break;
					
					case 13:
						$color = "#DDDDDD";
						break;
					
					case 14:
						$color = "#999999";
						break;
					
					case 15:
						$color = "#FF0F00";
						break;
					
					case 16:
						$color = "#04D215";
						break;
					
					case 17:
						$color = "#0D8ECF";
						break;
					
					case 18:
						$color = "#FCD202";
						break;
					
					case 19:
						$color = "#F8FF01";
						break;
					
					case 20:
						$color = "#FF6600";
						break;
					
					case 21:
						$color = "#B0DE09";
						break;
					
					case 22:
						$color = "#FF9E01";
						break;
					
					case 23:
						$color = "#0D52D1";
						break;
					
					case 24:
						$color = "#2A0CD0";
						break;
					
					case 25:
						$color = "#8A0CCF";
						break;
						
					case 26:
						$color = "#0D8ECF";
						break;
					
					default:
						$color = "#000000";
				}
				
				if ($i==0) {
					if(empty($row_tingkat->kode)) {
						$data = '{
			                    "country2": "'.$row_tingkat->name.'",
			                    "visits2": '.$korte_count.',
			                    "color": "'.$color.'"
			                }';
					} else {
						$data = '{
			                    "country2": "'.$row_tingkat->name.'",
			                    "visits2": '.$korte_count.',
			                    "color": "'.$color.'"
			                }';
					}
				} else {
					if(empty($row_tingkat->kode)) {
						$data = $data . ', {
			                    "country2": "'.$row_tingkat->name.'",
			                    "visits2": '.$korte_count.',
			                    "color": "'.$color.'"
			                }';
					} else {
						$data = $data . ', {
			                    "country2": "'.$row_tingkat->name.'",
			                    "visits2": '.$korte_count.',
			                    "color": "'.$color.'"
			                }';
					}
					
				}
				
				$i++;
			}
			?>

			<?php
			echo '
			<script type="text/javascript">
				var chart;

				var chartData_pinjam = [
					'.$data.'
				];
			</script> ';
			?>

			<script type="text/javascript">
				AmCharts.ready(function () {
					// SERIAL CHART
					chart = new AmCharts.AmSerialChart();
					chart.dataProvider = chartData_pinjam;
					chart.categoryField = "country2";
					// the following two lines makes chart 3D
					chart.depth3D = 20;
					chart.angle = 30;

					// AXES
					// category
					var categoryAxis = chart.categoryAxis;
					categoryAxis.labelRotation = 90;
					categoryAxis.dashLength = 5;
					categoryAxis.gridPosition = "start";

					// value
					var valueAxis = new AmCharts.ValueAxis();
					valueAxis.title = "Jumlah Peminjam per Bulan";
					valueAxis.dashLength = 5;
					chart.addValueAxis(valueAxis);

					// GRAPH            
					var graph = new AmCharts.AmGraph();
					graph.valueField = "visits2";
					graph.colorField = "color";
					graph.balloonText = "<span style='font-size:10px'>[[category]]: <b>[[value]]</b></span>";
					graph.type = "column";
					graph.lineAlpha = 0;
					graph.fillAlphas = 1;
					chart.addGraph(graph);
					
					// CURSOR
					var chartCursor = new AmCharts.ChartCursor();
					chartCursor.cursorAlpha = 0;
					chartCursor.zoomable = false;
					chartCursor.categoryBalloonEnabled = false;
					chart.addChartCursor(chartCursor);                

					// WRITE
					chart.write("chartdiv_pinjam");
				});
			</script>

			<div id="chartdiv_pinjam" style="width: 100%; height: 300px;"></div>
		</form>
	</div>			
</div>
