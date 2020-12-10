
<?php
 
   	include("../comlib.php");		//使用資料庫的呼叫程式
   	include("../Connections/iotcnn.php");		//使用資料庫的呼叫程式
		//	Connection() ;
  	$link=Connection();		//產生mySQL連線物件

	$mid=$_GET["mac"];		//取得POST參數 : mac address
	//SELECT * FROM ncnuiot.dht where mac = 'CC50E38CEE18' order by systime desc limit 1
	$qrystr=sprintf("SELECT * FROM ncnuiot.t0_dhtdata where mac = '%s' order by systemtime desc limit 1 ",$mid) ;		//將dhtdata的資料找出來
		// limit 1  取一筆，取n筆  limit n ( n必為數字)
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
		}// 會跳下一列資料

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
<title>DHT Sensor Guage Chart</title>
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
<div id="container3" style="min-width: 95%; height: 600px; margin: 0 auto"></div>
<p>	
<div id="container4" style="min-width: 95%; height: 600px; margin: 0 auto"></div>
<p>
<div id="container5" style="min-width: 95%; height: 600px; margin: 0 auto"></div>
<p>	
<div id="container6" style="min-width: 95%; height: 600px; margin: 0 auto"></div>
<p>


</form>
  this  made by BruceTsao 2020/04/30


<script type="text/javascript">

 //---------Color Temperaturte----------------
Highcharts.chart('container1', {

    chart: {
        type: 'gauge',
        plotBackgroundColor: null,
        plotBackgroundImage: null,
        plotBorderWidth: 0,
        plotShadow: false
    },

    title: {
        text: 'Temperature by MAC:<? echo $mid?> at <? echo trandatetime4($d00[0])?>',
    },

    pane: {
        startAngle: -120,
        endAngle: 120,
        background: [{
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#FFF'],
                    [1, '#333']
                ]
            },
            borderWidth: 0,
            outerRadius: '109%'
        }, {
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#333'],
                    [1, '#FFF']
                ]
            },
            borderWidth: 1,
            outerRadius: '107%'
        }, {
            // default background
        }, {
            backgroundColor: '#DDD',
            borderWidth: 0,
            outerRadius: '105%',
            innerRadius: '103%'
        }]
    },

    // the value axis
    yAxis: {
        min: -10,
        max: 50,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 10,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        labels: {
            step: 1,
            rotation: 'auto'
        },
        title: {
            text: '°C(Celsius)'
        },
        plotBands: [{
            from: -10,
            to: 22,
            color: '#DDDF0D' // yellow
        }, {
            from: 22,
            to: 26,
            color: '#00FF00' // green
        },{
            from: 26,
            to: 30,
            color: '#FF8000' // yellow
        }, {
            from: 30,
            to: 50,
            color: '#FF0000' // red
        }]
    },

    series: [{
        name: 'Celsius',	//抬頭
        data: [
		<?php
		// 資料區，只能一筆資料

			echo $d01[0];

		?>		
		],
        tooltip: {
            valueSuffix: ' °C'	//出現單位
        }
    }]

});

 //---------Color humidity----------------
Highcharts.chart('container2', {

    chart: {
        type: 'gauge',
        plotBackgroundColor: null,
        plotBackgroundImage: null,
        plotBorderWidth: 0,
        plotShadow: false
    },

    title: {
        text: 'Humidity by MAC:<? echo $mid?> at <? echo trandatetime4($d00[0])?>',
    },

    pane: {
        startAngle: -150,
        endAngle: 150,
        background: [{
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#FFF'],
                    [1, '#333']
                ]
            },
            borderWidth: 0,
            outerRadius: '109%'
        }, {
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#333'],
                    [1, '#FFF']
                ]
            },
            borderWidth: 1,
            outerRadius: '107%'
        }, {
            // default background
        }, {
            backgroundColor: '#DDD',
            borderWidth: 0,
            outerRadius: '105%',
            innerRadius: '103%'
        }]
    },

    // the value axis
    yAxis: {
        min: 0,
        max: 100,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 10,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        labels: {
            step: 1,
            rotation: 'auto'
        },
        title: {
            text: '%(Percent)'
        },
        plotBands: [{
            from: 0,
            to: 50,
            color: '#55BF3B' //  green
        }, {
            from: 50,
            to: 85,
            color: '#DDDF0D' //yellow
        }, {
            from: 85,
            to: 100,
            color: '#DF5353' // red
        }]
    },

    series: [{
        name: 'humidity',
        data: [
		<?php

			echo $d02[0];

		?>		
		],
        tooltip: {
            valueSuffix: ' %'
        }
    }]

});

//------------------
 //---------Color Temperaturte----------------
Highcharts.chart('container3', {

    chart: {
        type: 'gauge',
        plotBackgroundColor: null,
        plotBackgroundImage: null,
        plotBorderWidth: 0,
        plotShadow: false
    },

    title: {
        text: 'Temperature by MAC:<? echo $mid?> at <? echo trandatetime4($d00[0])?>',
    },

    pane: {
        startAngle: -120,
        endAngle: 120,
        background: [{
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#FFF'],
                    [1, '#333']
                ]
            },
            borderWidth: 0,
            outerRadius: '109%'
        }, {
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#333'],
                    [1, '#FFF']
                ]
            },
            borderWidth: 1,
            outerRadius: '107%'
        }, {
            // default background
        }, {
            backgroundColor: '#DDD',
            borderWidth: 0,
            outerRadius: '105%',
            innerRadius: '103%'
        }]
    },

    // the value axis
    yAxis: {
        min: -10,
        max: 50,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 10,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        labels: {
            step: 1,
            rotation: 'auto'
        },
        title: {
            text: '°C(Celsius)'
        },
        plotBands: [{
            from: -10,
            to: 22,
            color: '#DDDF0D' // yellow
        }, {
            from: 22,
            to: 26,
            color: '#00FF00' // green
        },{
            from: 26,
            to: 30,
            color: '#FF8000' // yellow
        }, {
            from: 30,
            to: 50,
            color: '#FF0000' // red
        }]
    },

    series: [{
        name: 'Celsius',	//抬頭
        data: [
		<?php
		// 資料區，只能一筆資料

			echo $d01[0];

		?>		
		],
        tooltip: {
            valueSuffix: ' °C'	//出現單位
        }
    }]

});

 //---------Color Temperaturte----------------
Highcharts.chart('container4', {

    chart: {
        type: 'gauge',
        plotBackgroundColor: null,
        plotBackgroundImage: null,
        plotBorderWidth: 0,
        plotShadow: false
    },

    title: {
        text: 'Temperature by MAC:<? echo $mid?> at <? echo trandatetime4($d00[0])?>',
    },

    pane: {
        startAngle: -120,
        endAngle: 120,
        background: [{
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#FFF'],
                    [1, '#333']
                ]
            },
            borderWidth: 0,
            outerRadius: '109%'
        }, {
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#333'],
                    [1, '#FFF']
                ]
            },
            borderWidth: 1,
            outerRadius: '107%'
        }, {
            // default background
        }, {
            backgroundColor: '#DDD',
            borderWidth: 0,
            outerRadius: '105%',
            innerRadius: '103%'
        }]
    },

    // the value axis
    yAxis: {
        min: -10,
        max: 50,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 10,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        labels: {
            step: 1,
            rotation: 'auto'
        },
        title: {
            text: '°C(Celsius)'
        },
        plotBands: [{
            from: -10,
            to: 22,
            color: '#DDDF0D' // yellow
        }, {
            from: 22,
            to: 26,
            color: '#00FF00' // green
        },{
            from: 26,
            to: 30,
            color: '#FF8000' // yellow
        }, {
            from: 30,
            to: 50,
            color: '#FF0000' // red
        }]
    },

    series: [{
        name: 'Celsius',	//抬頭
        data: [
		<?php
		// 資料區，只能一筆資料

			echo $d01[0];

		?>		
		],
        tooltip: {
            valueSuffix: ' °C'	//出現單位
        }
    }]

});

 //---------Color Temperaturte----------------
Highcharts.chart('container5', {

    chart: {
        type: 'gauge',
        plotBackgroundColor: null,
        plotBackgroundImage: null,
        plotBorderWidth: 0,
        plotShadow: false
    },

    title: {
        text: 'Temperature by MAC:<? echo $mid?> at <? echo trandatetime4($d00[0])?>',
    },

    pane: {
        startAngle: -120,
        endAngle: 120,
        background: [{
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#FFF'],
                    [1, '#333']
                ]
            },
            borderWidth: 0,
            outerRadius: '109%'
        }, {
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#333'],
                    [1, '#FFF']
                ]
            },
            borderWidth: 1,
            outerRadius: '107%'
        }, {
            // default background
        }, {
            backgroundColor: '#DDD',
            borderWidth: 0,
            outerRadius: '105%',
            innerRadius: '103%'
        }]
    },

    // the value axis
    yAxis: {
        min: -10,
        max: 50,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 10,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        labels: {
            step: 1,
            rotation: 'auto'
        },
        title: {
            text: '°C(Celsius)'
        },
        plotBands: [{
            from: -10,
            to: 22,
            color: '#DDDF0D' // yellow
        }, {
            from: 22,
            to: 26,
            color: '#00FF00' // green
        },{
            from: 26,
            to: 30,
            color: '#FF8000' // yellow
        }, {
            from: 30,
            to: 50,
            color: '#FF0000' // red
        }]
    },

    series: [{
        name: 'Celsius',	//抬頭
        data: [
		<?php
		// 資料區，只能一筆資料

			echo $d01[0];

		?>		
		],
        tooltip: {
            valueSuffix: ' °C'	//出現單位
        }
    }]

});

 //---------Color Temperaturte----------------
Highcharts.chart('container6', {

    chart: {
        type: 'gauge',
        plotBackgroundColor: null,
        plotBackgroundImage: null,
        plotBorderWidth: 0,
        plotShadow: false
    },

    title: {
        text: 'Temperature by MAC:<? echo $mid?> at <? echo trandatetime4($d00[0])?>',
    },

    pane: {
        startAngle: -120,
        endAngle: 120,
        background: [{
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#FFF'],
                    [1, '#333']
                ]
            },
            borderWidth: 0,
            outerRadius: '109%'
        }, {
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#333'],
                    [1, '#FFF']
                ]
            },
            borderWidth: 1,
            outerRadius: '107%'
        }, {
            // default background
        }, {
            backgroundColor: '#DDD',
            borderWidth: 0,
            outerRadius: '105%',
            innerRadius: '103%'
        }]
    },

    // the value axis
    yAxis: {
        min: -10,
        max: 50,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 10,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        labels: {
            step: 1,
            rotation: 'auto'
        },
        title: {
            text: '°C(Celsius)'
        },
        plotBands: [{
            from: -10,
            to: 22,
            color: '#DDDF0D' // yellow
        }, {
            from: 22,
            to: 26,
            color: '#00FF00' // green
        },{
            from: 26,
            to: 30,
            color: '#FF8000' // yellow
        }, {
            from: 30,
            to: 50,
            color: '#FF0000' // red
        }]
    },

    series: [{
        name: 'Celsius',	//抬頭
        data: [
		<?php
		// 資料區，只能一筆資料

			echo $d01[0];

		?>		
		],
        tooltip: {
            valueSuffix: ' °C'	//出現單位
        }
    }]

});


		</script>
<?php
include 'footer.php';
?>
</body>
</html>
