
<?php
 
   	include("../comlib.php");		//使用資料庫的呼叫程式
   	include("../Connections/iotcnn.php");		//使用資料庫的呼叫程式
		//	Connection() ;
  	$link=Connection();		//產生mySQL連線物件

	$mid=$_GET["mac"];		//取得POST參數 : mac address
			//SELECT * FROM ncnuiot.t0_dhtdata where mac = 'AABBCCDDEEFF' order by utime desc limit 0,120 
		//AABBCCDDEEFF
	$qrystr=sprintf("SELECT * FROM ncnuiot.t0_dhtdata where mac = '%s' order by utime desc limit 0,120 ",$mid) ;		//將dhtdata的資料找出來
	//echo $qrystr."<br>" ;
//	int aa[] = {1,3,45,6,7} ;  == 	$aa = array(4,5,6,7,8,9);
//	int bb[] = {} ;  ==  $bb = array();
	$d00 = array();		// declare blank array of d00
	$d01 = array();	// declare blank array of d01
	$d02 = array();	// declare blank array of d02
	$d03 = array();	// declare blank array of d03
	$d04 = array();	// declare blank array of d03
	$d05 = array();	// declare blank array of d03
	
	$result=mysql_query($qrystr,$link);		//將dhtdata的資料找出來(只找最後5
//	echo "step 02 . <br>" ;
  if($result!==FALSE){
	 while($row = mysql_fetch_array($result)) 
	 {
			array_push($d00, $row["utime"]);		// $row[欄位名稱] 就可以取出該欄位資料
			array_push($d01, $row["temp"]);	// array_push(某個陣列名稱,加入的陣列的內容
			array_push($d02, $row["humid"]);
			array_push($d03, $row["mac"]);
			array_push($d04, $row["lat"]);
			array_push($d05, $row["longi"]);
		}// 會跳下一列資料s

  }
			
//	echo "step 03 . <br>" ;		
	 mysql_free_result($result);	// 關閉資料集
//	echo "step 04 . <br>" ;	 
	 mysql_close($link);		// 關閉連線
//	echo "step 05 . <br>" ;	 	




?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DHT Chart_for_Chart_T0</title>
<link href="webcss.css" rel="stylesheet" type="text/css" />

	<script src="/code/highcharts.js"></script>
    <script src="/code/highcharts-more.js"></script>
    <script src="/code/modules/exporting.js"></script>
    <script src="/code/modules/export-data.js"></script>
    <script src="/code/modules/accessibility.js"></script>	
</head>
<body>
<?php
include 'title.php';
?>
<button onclick="goBack()">Go Back</button>

<script>
function goBack() {
  window.history.back();
}
</script>
<div id="container1" style="min-width: 95%; height: 600px; margin: 0 auto"></div>
<p>
<div id="container2" style="min-width: 95%; height: 600px; margin: 0 auto"></div>
<p>


</form>


<script type="text/javascript">

 //-----------particle--------------

Highcharts.chart('container1', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Temperature by MAC:<? echo $mid?>',	//印出mac address
		fontsize: 30
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
		<?php
		//[ <?php 取資料應出來  
	for($i=count($d00)-1;$i >=0  ;$i=$i-1)
		{
			echo "'";
			echo trandatetime3($d00[$i]);
			echo "',";
		}
		?>
        ]
    },
    yAxis: {
        title: {
            text: '.C'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Temperaturte',
        data: [
		<?php
		//[ <?php 取資料應出來  
	for($i=count($d00)-1;$i >=0  ;$i=$i-1)
		{
			echo $d01[$i];
			echo ",";
		}
		?>
        ]} ]
});
 //---------Color Temperaturte----------------
Highcharts.chart('container2', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Humidity  by MAC:<? echo $mid?>',
		fontsize: 30
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
		<?php
		//[ <?php 取資料應出來  
		for($i=0;$i < count($d00);$i=$i+1)
		{
			echo "'";
			echo trandatetime3($d00[$i]);
			echo "',";
		}
		?>
        ]
    },
    yAxis: {
        title: {
            text: '%'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Percent %',
        data: [
		<?php
		//[ <?php 取資料應出來  
		for($i=0;$i < count($d02);$i=$i+1)
		{
			echo $d02[$i];
			echo ",";
		}
		?>
        ]} ]
});
		</script>
<div align="center">

	<?php echo "Data Gererated by Device's MAC:".$mid ?>;
   <table border="1" cellspacing="1" cellpadding="1">		
		<tr>
			<td>Date Time</td>
			<td>temperature</td>
			<td>humidity</td>
			<td>GPS</td>
		</tr>

      <?php 
		  if(count($d00) >0)
		  {
				for($i=count($d00)-1;$i >=0  ;$i=$i-1)
					{
						echo sprintf("<tr><td>%s</td><td>%f</td><td>%f</td><td>(%f,%f)</td></tr>", 
						  trandatetime4($d00[$i]), $d01[$i], $d02[$i], $d04[$i], $d05[$i]);
					 }
		 }
      ?>

   </table>

</div>        
  this  made by BruceTsao 2020/04/30
  <?php
include 'footer.php';
?>
</body>
</html>
