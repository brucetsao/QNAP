<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? 
$macdata =$_GET['mac']; 

?>


<frameset cols="30%,30%,30%">
  <frame src="ShowGuagfromhumidity.php<? echo '?mac=.$macdata'?>"
  <frame src="ShowGuagfromTempC.php"><? echo '?mac=.$macdata'?>"
  <frame src="ShowGuagfromTempC.php"><? echo '?mac=.$macdata'?>"
</frameset>
.