<?php

   	include("../connect.php");		//使用資料庫的呼叫程式
	
	$link=Connection();		//產生mySQL連線物件

	$result=mysql_query("SELECT * FROM dhtdata order by `datetime` desc LIMIT 50 ",$link);		//將dhtdata的資料找出來(只找最後50筆
?>

<html>
   <head>
      <title>Sensor Data</title>		
   </head>
<body>
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
