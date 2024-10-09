<?php
	$from_date = date("Y-m-d", strtotime($from_date));
  	$to_date = date("Y-m-d", strtotime($to_date));

	$string1 = '[
        ';

	$sqlstr = "select count(a.nis) count_hadir, a.hadir, a.ijin, a.sakit, a.alpa, a.cuti, a.nis from phsiswa a left join siswa b on a.nis=b.nis left join presensiharian c on a.idpresensi=c.replid where a.hadir>0 and c.tanggal1>='$from_date' and c.tanggal1<='$to_date' and ifnull(b.alumni,0)=0 group by a.hadir";
    $sql1=$dbpdo->prepare($sqlstr);
    $sql1->execute();
    $data_hadir = $sql1->fetch(PDO::FETCH_OBJ);
    $count_hadir = numberreplace($data_hadir->count_hadir);

    $sqlstr = "select count(a.nis) count_absen, a.hadir, a.ijin, a.sakit, a.alpa, a.cuti, a.nis from phsiswa a left join siswa b on a.nis=b.nis left join presensiharian c on a.idpresensi=c.replid where ifnull(a.hadir,0)=0 and c.tanggal1>='$from_date' and c.tanggal1<='$to_date' and ifnull(b.alumni,0)=0 group by a.hadir";
    $sql1=$dbpdo->prepare($sqlstr);
    $sql1->execute();
    $data_absen = $sql1->fetch(PDO::FETCH_OBJ);
    $count_absen = numberreplace($data_absen->count_absen);

    $string1 = $string1 .'{ value: ' . $count_hadir .', category: "Hadir" },';
    $string1 = $string1 . '{ value: ' . $count_absen .', category: "Tidak Hadir" },';

	$string1 = '' . $string1 . ']';
  	//echo $string1;
  	
?>

<!-- Styles -->
<style>
#chartdiv_1 {
  width: 100%;
  height: 500px;
}
</style>

<!-- Resources -->
<!-- <script src="app/chart/lib_amcharts/index.js" type="text/javascript"></script> -->
<script src="app/chart/lib_amcharts/percent.js" type="text/javascript"></script>
<!-- <script src="app/chart/lib_amcharts/animated.js" type="text/javascript"></script> -->

<!-- Chart code -->
<script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv_1");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
var chart = root.container.children.push(am5percent.PieChart.new(root, {
  layout: root.verticalLayout
}));


// Create series
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
var series = chart.series.push(am5percent.PieSeries.new(root, {
  valueField: "value",
  categoryField: "category"
}));

// Set data
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
series.data.setAll(<?= $string1 ?>);

/*series.data.setAll([
  { value: 10, category: "One" },
  { value: 9, category: "Two" },
  { value: 6, category: "Three" },
  { value: 5, category: "Four" },
  { value: 4, category: "Five" },
  { value: 3, category: "Six" },
  { value: 1, category: "Seven" },
]);*/


// Play initial series animation
// https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
series.appear(1000, 100);

}); // end am5.ready()
</script>

<!-- HTML -->
<div id="chartdiv_1"></div>