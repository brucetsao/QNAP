
<?php
   	include("../Connections/iotcnn.php");		//使用資料庫的呼叫程式
		//	Connection() ;
  	$link=Connection();		//產生mySQL連線物件
//	mysql_select_db($link, "ncnuiot") ;
	$temp0=$_GET["mac"];		//取得POST參數 : MAC address
	$temp1=$_GET["s"];		//取得POST參數 : temperature
//	$temp3=$_GET["lat"];		//取得POST參數 : lat
//	$temp4=$_GET["lon"];		//取得POST參數 : long

	$sysdt = getdatetime() ;
//	$ddt = getdataorder() ;
	
	//http://ncnu.arduino.org.tw:9999/t0/soundtadd.php?mac=AABBCCDDEEFF&s=45.7
	

//INSERT INTO t1_sound (id, mac, crtdatetime, utime, decibel) VALUES (NULL, '112233445566', CURRENT_TIMESTAMP, '20200514104200', 56.7);	
	$query = "INSERT INTO ncnuiot.t1_sound (mac,utime,decibel) VALUES ('".$temp0."','".$sysdt."',".$temp1.")"; 
	//組成新增到dhtdata資料表的SQL語法

	echo $query ;
	echo "<br>" ;


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

 
?>
    <?php
         /* Defining a PHP Function */
         function getdataorder($dt) {
        	//   $dt = getdate() ;
				$splitTimeStamp = explode(" ",$dt);
				$ymd = $splitTimeStamp[0] ;
				$hms = $splitTimeStamp[1] ;
				$vdate = explode('-', $ymd);
				$vtime = explode(':', $hms);
				$yyyy =  str_pad($vdate[0],4,"0",STR_PAD_LEFT);
				$mm  =  str_pad($vdate[1] ,2,"0",STR_PAD_LEFT);
				$dd  =  str_pad($vdate[2] ,2,"0",STR_PAD_LEFT);
				$hh  =  str_pad($vtime[0] ,2,"0",STR_PAD_LEFT);
				$min  =  str_pad($vtime[1] ,2,"0",STR_PAD_LEFT);
				$sec  =  str_pad($vtime[2] ,2,"0",STR_PAD_LEFT);
			/*
				echo "***(" ;
				echo $dt ;
				echo "/" ;
				echo $yyyy ;
				echo "/" ;
				echo $mm ;
				echo "/" ;
				echo $dd ;
				echo "/" ;
				echo $hh ;
				echo "/" ;
				echo $min ;
				echo "/" ;
				echo $sec ;
				echo ")<br>" ;
			*/
			return ($yyyy.$mm.$dd.$hh.$min.$sec)  ;
         }
         function getdataorder2($dt) {
        	//   $dt = getdate() ;
				$splitTimeStamp = explode(" ",$dt);
				$ymd = $splitTimeStamp[0] ;
				$hms = $splitTimeStamp[1] ;
				$vdate = explode('-', $ymd);
				$vtime = explode(':', $hms);
				$yyyy =  str_pad($vdate[0],4,"0",STR_PAD_LEFT);
				$mm  =  str_pad($vdate[1] ,2,"0",STR_PAD_LEFT);
				$dd  =  str_pad($vdate[2] ,2,"0",STR_PAD_LEFT);
				$hh  =  str_pad($vtime[0] ,2,"0",STR_PAD_LEFT);
				$min  =  str_pad($vtime[1] ,2,"0",STR_PAD_LEFT);
				
			return ($yyyy.$mm.$dd.$hh.$min)  ;
         }
         function getdatetime() {
           $dt = getdate() ;
				$yyyy =  str_pad($dt['year'],4,"0",STR_PAD_LEFT);
				$mm  =  str_pad($dt['mon'] ,2,"0",STR_PAD_LEFT);
				$dd  =  str_pad($dt['mday'] ,2,"0",STR_PAD_LEFT);
				$hh  =  str_pad($dt['hours'] ,2,"0",STR_PAD_LEFT);
				$min  =  str_pad($dt['minutes'] ,2,"0",STR_PAD_LEFT);
				$sec  =  str_pad($dt['seconds'] ,2,"0",STR_PAD_LEFT);

			return ($yyyy.$mm.$dd.$hh.$min.$sec)  ;
         }
		          function trandatetime1($dt) {
				$yyyy =  substr($dt,0,4);
				$mm  =   substr($dt,4,2);
				$dd  =   substr($dt,6,2);
				$hh  =   substr($dt,8,2);
				$min  =   substr($dt,10,2);
				$sec  =   substr($dt,12,2);

			return ($yyyy."/".$mm."/".$dd." ".$hh.":".$min.":".$sec)  ;
		 }
      ?>
