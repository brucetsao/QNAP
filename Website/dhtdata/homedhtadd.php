<?php
   	include("../Connections/iotcnn.php");		//使用資料庫的呼叫程式
		//	Connection() ;
   	
   	$link=Connection();		//產生mySQL連線物件

	$temp0=$_GET["MAC"];		//取得POST參數 : humidity
	$temp1=$_GET["H"];		//取得POST參數 : humidity
	$temp2=$_GET["T"];		//取得POST參數 : temperature
	$temp3=$_GET["L"];		//取得POST參數 : temperature


//	$query = "INSERT INTO `HomeDHT` (`humidity`,`temperature`) VALUES ('".$temp1."','".$temp2."')"; 
	$query = "INSERT INTO `HomeDHT` (`mac`,`humid`,`temp`,`light`) VALUES ('".$temp0."',".$temp1.",".$temp2.",".$temp3.")"; 
	//組成新增到dhtdata資料表的SQL語法




	if (mysql_query($query,$link))
		{
				echo "Successful <br>" ;
		}
		else
		{
				echo "Fail <br>" ;
		}
		
			;			//執行SQL語法
	echo "<br>" ;
	mysql_close($link);		//關閉Query
	   	echo $query ;

 
?>
