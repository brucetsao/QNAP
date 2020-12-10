<?php

   	include("../Connections/iotcnn.php");		//使用資料庫的呼叫程式
	
	$link=Connection();		//產生mySQL連線物件

	$result=mysql_query("del FROM DHT where * ;",$link);		//將dhtdata的資料找出來(只找最後50筆
	print $result ;
?>

<html>
   <head>
      <title>Sensor Data</title>		
   </head>
<body>
 
</body>
</html>
