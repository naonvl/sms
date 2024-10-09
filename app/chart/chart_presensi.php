<?php
  $from_date  = $_POST['from_date'];
  $to_date    = $_POST['to_date'];
  
  if($from_date == "") {
    $from_date = date("d-m-Y");
  }

  if($to_date == "") {
    $to_date = date("d-m-Y");
  } 
?>

<form role="form" action="" method="post" name="dashboard_sales" id="dashboard_sales" enctype="multipart/form-data">
  <table width="100%">
    <tr>
      <td style="text-align: right;">Presensi Harian &nbsp; </td>
      <td style="padding-top: 15px" width="15%">
          <div class="col-sm-12">
            <input type="text" id="from_date" name="from_date" class="form-control date-picker" autocomplete="off" data-date-format="dd-mm-yyyy" value="<?php echo $from_date ?>">&nbsp;
          </div>
      </td>
      <td style="padding-top: 15px" width="15%">    
          <div class="col-sm-12">
            <input type="text" id="to_date" name="to_date" class="form-control date-picker" autocomplete="off" data-date-format="dd-mm-yyyy" value="<?php echo $to_date ?>">&nbsp;
          </div>
      </td>
      <td style="padding-top: 0px">
          <div class="col-sm-6">
            <button type="submit" name="submit" id="submit" class="btn btn-white btn-succes btn-bold" value="refresh">
              <i class="ace-icon fa fa-refresh bigger-120 green"></i>
              Refresh
            </button>
          </div>
      </td>
    </tr>
  </table>
</form>

<!-- Styles -->
<style>
#chartdiv {
  width: 90%;
  height: 700px;
}
</style>

<!-- Resources -->
<script src="app/chart/lib_amcharts/index.js" type="text/javascript"></script>
<script src="app/chart/lib_amcharts/xy.js" type="text/javascript"></script>
<script src="app/chart/lib_amcharts/animated.js" type="text/javascript"></script>


<!-- Chart code -->
<script>
am5.ready(function() {


// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  panX: false,
  panY: false,
  wheelX: "panX",
  wheelY: "zoomX",
  layout: root.verticalLayout
}));


// Add legend
// https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
var legend = chart.children.push(am5.Legend.new(root, {
  centerX: am5.p50,
  x: am5.p50
})) 


<?php
  $dbpdo = DB::create();

  $from_date = date("Y-m-d", strtotime($from_date));
  $to_date = date("Y-m-d", strtotime($to_date));

  $string = '
      var data = [
        ';

  //get kelas
  $i = 0;
  $sqlstr = "select distinct b.kelas, c.tingkat, a.idkelas from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where ifnull(a.alumni,0)=0 order by b.kelas";
  $sql=$dbpdo->prepare($sqlstr);
  $sql->execute();
  while($datawhs = $sql->fetch(PDO::FETCH_OBJ)) {
    
    $sqlstr = "select count(a.nis) count_hadir, a.hadir, a.ijin, a.sakit, a.alpa, a.cuti, a.nis from phsiswa a left join siswa b on a.nis=b.nis left join presensiharian c on a.idpresensi=c.replid where a.hadir>0 and b.idkelas='$datawhs->idkelas' and c.tanggal1>='$from_date' and c.tanggal1<='$to_date' and ifnull(b.alumni,0)=0 group by b.idkelas";
    $sql1=$dbpdo->prepare($sqlstr);
    $sql1->execute();
    $data_hadir = $sql1->fetch(PDO::FETCH_OBJ);
    $count_hadir = numberreplace($data_hadir->count_hadir);

    $sqlstr = "select count(a.nis) count_absen, a.hadir, a.ijin, a.sakit, a.alpa, a.cuti, a.nis from phsiswa a left join siswa b on a.nis=b.nis left join presensiharian c on a.idpresensi=c.replid where ifnull(a.hadir,0)=0 and b.idkelas='$datawhs->idkelas' and c.tanggal1>='$from_date' and c.tanggal1<='$to_date' and ifnull(b.alumni,0)=0 group by b.idkelas";
    $sql1=$dbpdo->prepare($sqlstr);
    $sql1->execute();
    $data_absen = $sql1->fetch(PDO::FETCH_OBJ);
    $count_absen = numberreplace($data_absen->count_absen);

    if($i == 0) {
      $string = $string .  '{
          "kelas": "' . $datawhs->kelas .'",
          "hadir": ' . $count_hadir .',
          "nohadir": ' . $count_absen .'
        }';
    } else {
      $string = $string .  ',{
        "kelas": "' . $datawhs->kelas .'",
          "hadir": ' . $count_hadir .',
          "nohadir": ' . $count_absen .'
        }';
    }

    $i++;
  }

  $string = '' . $string . ']';
  echo $string;

?>

// Data
/*var data = [{
  kelas: "2017",
  hadir: 23.5,
  nohadir: 18.1
}, {
  kelas: "2018",
  hadir: 26.2,
  nohadir: 22.8
}, {
  kelas: "2019",
  hadir: 30.1,
  nohadir: 23.9
}, {
  kelas: "2020",
  hadir: 29.5,
  nohadir: 25.1
}, {
  kelas: "2021",
  hadir: 24.6,
  nohadir: 25
}];*/


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
  categoryField: "kelas",
  renderer: am5xy.AxisRendererY.new(root, {
    inversed: true,
    cellStartLocation: 0.1,
    cellEndLocation: 0.9
  })
}));

yAxis.data.setAll(data);

var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
  renderer: am5xy.AxisRendererX.new(root, {
    strokeOpacity: 0.1
  }),
  min: 0
}));


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
function createSeries(field, name) {
  var series = chart.series.push(am5xy.ColumnSeries.new(root, {
    name: name,
    xAxis: xAxis,
    yAxis: yAxis,
    valueXField: field,
    categoryYField: "kelas",
    sequencedInterpolation: true,
    tooltip: am5.Tooltip.new(root, {
      pointerOrientation: "horizontal",
      labelText: "[bold]{name}[/]\n{categoryY}: {valueX}"
    })
  }));

  series.columns.template.setAll({
    height: 15, //am5.p100
    strokeOpacity: 0
  });


  series.bullets.push(function() {
    return am5.Bullet.new(root, {
      locationX: 1,
      locationY: 0.5,
      sprite: am5.Label.new(root, {
        centerY: am5.p50,
        text: "{valueX}",
        populateText: true
      })
    });
  });

  series.bullets.push(function() {
    return am5.Bullet.new(root, {
      locationX: 1,
      locationY: 0.5,
      sprite: am5.Label.new(root, {
        centerX: am5.p100,
        centerY: am5.p50,
        text: "{name}",
        fill: am5.color(0xffffff),
        populateText: true
      })
    });
  });

  series.data.setAll(data);
  series.appear();

  return series;
}

createSeries("hadir", "Hadir");
createSeries("nohadir", "Tidak Hadir");


// Add legend
// https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
var legend = chart.children.push(am5.Legend.new(root, {
  centerX: am5.p50,
  x: am5.p50
}));

legend.data.setAll(chart.series.values);


// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
  behavior: "zoomY"
}));
cursor.lineY.set("forceHidden", true);
cursor.lineX.set("forceHidden", true);


// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
chart.appear(1000, 100);

}); // end am5.ready()
</script>

<!-- HTML -->
<div id="chartdiv"></div>

<?php
  include 'chart_presensi_pie.php';
?>