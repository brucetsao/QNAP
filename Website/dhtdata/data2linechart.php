<?php

   	include("../connect.php");		//使用資料庫的呼叫程式
	
	$link=Connection();		//產生mySQL連線物件

	$result=mysql_query("SELECT * FROM `dhtdata` WHERE Mac = 'F0038CE7A873' order by `datetime` desc limit 1,30 ",$link);		//將dhtdata的資料找出來(只找最後50筆
	$result1=mysql_query("SELECT * FROM `dhtdata` WHERE Mac = 'F0038CE7A873' order by `datetime` desc limit 1,30 ",$link);		//將dhtdata的資料找出來(只找最後50筆
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['DateTime', 'celsius', 'fahrenheit'],
      <?php 
		  if($result1!==FALSE){
		     while($row = mysql_fetch_array($result1)) {
		        printf("['%s',%s,%s],", 
		           $row["datetime"], $row["celsius"], $row["fahrenheit"]);
		     }
		     mysql_free_result($result1);
		   
		  }
      ?>
		  
        ]);

        var options = {
          title: 'temperature',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
<body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
   <h1>DHT Sensor readings</h1>		

   <table border="1" cellspacing="1" cellpadding="1">		
		<tr>
			<td>datatime;</td>
			<td>Humidity Data</td>
			<td>celsius</td>
			<td>fahrenheit</td>
		</tr>

      <?php 
		  if($result!==FALSE){
		     while($row = mysql_fetch_array($result)) {
		        printf("<tr><td> &nbsp;%s </td><td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td></tr>", 
		           $row["datetime"], $row["humidity"], $row["celsius"], $row["fahrenheit"]);
		     }
		     mysql_free_result($result);
		     mysql_close();
		  }
      ?>

   </table>
</body>
</html>
