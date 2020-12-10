<?php

   	include("../connect.php");		//使用資料庫的呼叫程式
	
	$link=Connection();		//產生mySQL連線物件

	$result=mysql_query("SELECT * FROM `dhtdata` WHERE Mac = 'F0038CE7A873' order by `datetime` desc limit 1,2 ",$link);		//將dhtdata的資料找出來(只找最後50筆

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
          ['Humidity', <? echo $row["humidity"] ?>,
        ]);

        var options = {
          width: 300, height: 300,
          redFrom: 90, redTo: 100,ß
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

 
    </script>
  </head>
  <body>
  	    <div id="chart_div" style="width: 400px; height: 120px;"></div>
ß
</body>
</html>
