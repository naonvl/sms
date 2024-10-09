<html>
    <head>
    </head>
    <body>

      <?php
            session_start();

            if (($_SESSION["logged"] == 0)) {
              echo 'Access denied';
              exit;
            }
        ?>
        <?php
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Master Barang.xls");

            include_once ("include/queryfunctions.php");
            include_once ("include/functions.php");
            include_once ("include/function_excel.php");

            include 'class/class.select.php';
            include 'class/class.selectview.php';

            $select = new select;
            $selectview = new selectview;

			$code	             	=    $_REQUEST['code'];
			$old_code		    	=    $_REQUEST['old_code'];
			$name            		=    $_REQUEST['name'];
			$item_group_id       	=    $_REQUEST['item_group_id'];
			$all			       	=    $_REQUEST['all'];
        ?>

        <table border="1" id="dynamic-table" class="table table-striped table-bordered table-hover">
        	<tr>
                <th colspan="8" class="center" style="font-weight:bold ">Master Data Barang</th>
			</tr>
			<thead>
				<tr>
                    <th class="center" style="font-weight:bold ">No.</th>
                    <th>Kode System</th>
                  	<th>Kode</th>
                  	<th>Nama Barang</th>
                  	<th>Kelompok Barang</th>
                  	<th>Unit</th>
                  	<th>Peminjaman Barang</th>
                  	<th>Aktif</th>
				</tr>
			</thead>

			<tbody>
                <?php
					$sql=$select->list_item($kode, $all, $active, $code, $old_code, $name, $item_group_id);
					while($row_item=$sql->fetch(PDO::FETCH_OBJ)){
					
					$i++;
						
				?>
                                            
                  <tr>
                      <td align="center"><?php echo $i ?></td>
                      <td><?php echo $row_item->code ?></td>
                    	<td><?php echo $row_item->old_code ?></td>
                    	<td><?php echo $row_item->name ?></td>
                    	<td><?php echo $row_item->item_group_name ?></td>
                    	<td><?php echo $row_item->uom_code_sales ?></td>
                    	<td align="center">
							<?php if ($row_item->item_booking == 1) { ?>
								YA
							<?php } ?>
						</td>
						<td>
							<?php if ($row_item->active == 1) { ?>
								AKTIF
							<?php } ?>
						</td>
					</tr>
                
                <?php
                    }
                ?>
                
		</tbody>
	</table>
    </body>
</html>