<?php

   	include("../connect.php");		//使用資料庫的呼叫程式
	$mac=$_GET['mac'];
	$link=Connection();		//產生mySQL連線物件
	$sqlstr = 	"SELECT * FROM `dhtdata` WHERE Mac = '".$mac."' order by `datetime` desc limit 1,1 " ;
	$result=mysql_query($sqlstr,$link);		//將dhtdata的資料找出來(只找最後50筆
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
          ['Celsius', 
		  <? 
		   while($row = mysql_fetch_array($result)) 
		   {
		         echo  $row["celsius"];
		     }
		   ?>
      ]]);

        var options = {
          width: 300, height: 300,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

     }
    </script>
  </head>
  <body>

  	    <div id="chart_div" style="width: 300px; height: 300spx;"></div>
 </body>
</html>
