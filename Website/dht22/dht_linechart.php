<?php require_once('../Connections/iotcnn.php');
   	$link=Connection();		//產生mySQL連線物件
	$str1 = "select * from (SELECT * FROM dhttbl order by sysdatetime  desc limit 0,50) as ww order by sysdatetime  asc ";				    $str2 = "select * from (SELECT * FROM dhttbl order by sysdatetime  desc limit 0,50) as ww order by sysdatetime  asc "; 
	//組成新增到dhtdata資料表的SQL語法


  //	echo $query ;

		$result1=mysql_query($str1,$link);	
		$result2=mysql_query($str2,$link);	
?>
<html>
  <head>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.setOnLoadCallback(drawChart2);

      function drawChart() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
         ['DateTime', 'Temperature'],
      <?php 
		  if($result1!==FALSE){
		     while($row = mysql_fetch_array($result1)) {
		        printf("['%s',%f],", 
		           $row["sysdatetime"], $row["temperature"]);
		     }
 		     mysql_free_result($result1);
		 }
      ?>
      ]);


        var options = {
          title: ' ',
          hAxis: {title: 'DateTime',  titleTextStyle: {color: '#333'}},
          vAxis: {title: 'Temperature' , minValue: 0} ,
          series: {
            0: { color: '#ff0000' },
            1: { color: '#00ff00' },
          }		  
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
 
       function drawChart2() {
        // Some raw data (not necessarily accurate)
        var data2 = google.visualization.arrayToDataTable([
         ['DateTime', 'Humidity'],
      <?php 
		  if($result2!==FALSE){
		     while($row = mysql_fetch_array($result2)) {
		        printf("['%s',%f],", 
		           $row["sysdatetime"], $row["humidity"]);
		     }
 		     mysql_free_result($result2);
		 }
      ?>
      ]);


        var options2 = {
          title: ' ',
          hAxis: {title: 'DateTime',  titleTextStyle: {color: '#444'}},
          vAxis: {title: 'Humidity' , minValue: 0} ,
          series: {
            0: { color: '#00ff00' },
            1: { color: '#0000ff' },
          }		  
        };

        var chart2 = new google.visualization.LineChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 90%; height: 500px;"></div>
    <div id="chart_div2" style="width: 90%; height: 500px;"></div>
  </body>
</html>