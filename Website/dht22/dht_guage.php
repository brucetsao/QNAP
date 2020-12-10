<?php require_once('../Connections/iotcnn.php');
   	$link=Connection();		//產生mySQL連線物件
	$str1 = "SELECT * FROM dhttbl order by sysdatetime  desc limit 0,30"; 
	//組成新增到dhtdata資料表的SQL語法


  //	echo $query ;

		$result1=mysql_query($str1,$link);	
?>
<html>
  <head>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		
        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
<?php 
		  if($result1 !==FALSE){
		     while($row = mysql_fetch_array($result1)) {
	        printf(" ['溫度', %f],['濕度', %f]]);", $row["temperature"], $row["humidity"]);
		     }
 		     mysql_free_result($result1);
		 }
      ?>


        var options = {
          width: 500, height: 500,
          redFrom: 35, redTo: 100,
          yellowFrom:28, yellowTo: 35,
          minorTicks: 10
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 400px; height: 120px;"></div>
  </body>
</html>