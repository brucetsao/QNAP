
<html>
  <head>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart2);


       function drawChart2() {
        // Some raw data (not necessarily accurate)
        var data2 = google.visualization.arrayToDataTable([
         ['DateTime', 'Humidity'],
      ['2018-11-29 16:42:28',58.000000],['2018-11-29 16:42:29',56.000000],['2018-11-29 16:42:36',61.000000],['2018-11-29 16:42:38',61.000000],['2018-11-29 16:42:38',57.000000],['2018-11-29 16:42:39',61.000000],['2018-11-29 16:42:44',62.000000],['2018-11-29 16:42:47',58.000000],['2018-11-29 16:42:48',61.000000],['2018-11-29 16:42:48',50.000000],['2018-11-29 16:42:49',61.000000],['2018-11-29 16:43:01',61.000000],['2018-11-29 16:43:04',58.000000],['2018-11-29 16:43:04',61.000000],['2018-11-29 16:43:07',60.000000],['2018-11-29 16:43:09',60.000000],['2018-11-29 16:43:11',51.000000],['2018-11-29 16:43:15',63.000000],['2018-11-29 16:43:24',59.000000],['2018-11-29 16:43:27',60.000000],['2018-11-29 16:43:28',59.000000],['2018-11-29 16:43:40',57.000000],['2018-11-29 16:43:48',60.000000],['2018-11-29 16:43:51',57.000000],['2018-11-29 16:43:51',59.000000],['2018-11-29 16:43:56',61.000000],['2018-11-29 16:44:01',61.000000],['2018-11-29 16:44:04',53.000000],['2018-11-29 16:44:07',61.000000],['2018-11-29 16:44:11',59.000000],['2018-11-29 16:44:12',59.000000],['2018-11-29 16:44:19',61.000000],['2018-11-29 16:44:28',59.000000],['2018-11-29 16:44:30',61.000000],['2018-11-29 16:44:43',58.000000],['2018-11-29 16:44:50',57.000000],['2018-11-29 16:44:51',60.000000],['2018-11-29 16:45:01',58.000000],['2018-11-29 16:45:12',61.000000],['2018-11-29 16:45:12',57.000000],['2018-11-29 16:45:14',59.000000],['2018-11-29 16:45:20',58.000000],['2018-11-29 16:45:27',52.000000],['2018-11-29 16:45:45',58.000000],['2018-11-29 16:45:53',59.000000],['2018-11-29 16:45:54',59.000000],['2018-11-29 16:45:55',59.000000],['2018-11-29 16:45:55',59.000000],['2018-11-29 16:45:59',58.000000],['2018-11-29 16:46:00',58.000000],      ]);


        var options2 = {
          title: ' ',
          hAxis: {title: 'DateTime',  titleTextStyle: {color: '#444'}},
          vAxis: {title: 'Humidity' , minValue: 0} ,
          series: {
            0: { color: '#ff0000' },
            1: { color: '#0000ff' },
          }		  
        };

        var chart2 = new google.visualization.AreaChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);
      }
    </script>
  </head>
  <body>
    <div id="chart_div2" style="width: 90%; height: 500px;"></div>
  </body>
</html>