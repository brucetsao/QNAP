
<?php
 
   	include("../comlib.php");		//使用資料庫的呼叫程式
   	include("../Connections/iotcnn.php");		//使用資料庫的呼叫程式
		//	Connection() ;
  	$link=Connection();		//產生mySQL連線物件



	$qrystr="SELECT mac , count(mac) as tt FROM  ncnuiot.t0_dhtdata WHERE 1 group by mac order by mac  " ;		//將dhtdata的資料找出來

	$d00 = array();		// declare blank array of d00
	$d01 = array();		// declare blank array of d00
	
	$result=mysql_query($qrystr,$link);		//將dhtdata的資料找出來(只找最後5

  if($result!==FALSE){
	 while($row = mysql_fetch_array($result)) 
	 {
			array_push($d00, $row["mac"]);		//將mac欄位資料push到d00 陣列
			array_push($d01, $row["tt"]);		//將tt欄位資料push到d01 陣列
		}// 會跳下一列資料

  }
			
	
	 mysql_free_result($result);	// 關閉資料集
 
	 mysql_close($link);		// 關閉連線





?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DHT Guage_List_Chart_T0</title>
<link href="webcss.css" rel="stylesheet" type="text/css" />

</head>
<body>
<?php
include 'title.php';
?>


  <div align="center">
  this  made by BruceTsao 2020/04/30
   <table border="1" align = center cellspacing="1" cellpadding="1">		
		<tr>
			<td>MAC Address</td>
			<td>Record Counts</td>            
			<td>Display Detail</td>
		</tr>

      <?php 
		  if(count($d00) >0)
		  {
				for($i=count($d00)-1;$i >=0  ;$i=$i-1)
					{
						echo sprintf("<tr><td>%s</td><td>%d</td><td><a href='ShowDHT_Chartlist.php?mac=%s'>顯示曲線圖</a></td></tr>", $d00[$i],$d01[$i],
						  $d00[$i]);
					 }
		 }
      ?>

   </table>

</div>

</form>
<?php
include 'footer.php';
?>

</body>
</html>
