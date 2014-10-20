<script type="text/javascript" src="/dash/javascript/jquery.jqplot.min.js"></script> 
<script type="text/javascript" src="/dash/javascript/jqplot.barRenderer.min.js"></script> 
<script type="text/javascript" src="/dash/javascript/jqplot.highlighter.min.js"></script> 
<script type="text/javascript" src="/dash/javascript/jqplot.cursor.min.js"></script> 
<script type="text/javascript" src="/dash/javascript/jqplot.canvasTextRenderer.min.js"></script> 
<script type="text/javascript" src="/dash/javascript/jqplot.canvasAxisTickRenderer.min.js"></script> 
<script type="text/javascript" src="/dash/javascript/jqplot.pieRenderer.min.js"></script> 

<script type="text/javascript">
$(document).ready(function(){
  var data = [
    ['Ticketed', <?php echo $event['wristbands']['withTicketsOnly']; ?>],['Retail', 9], ['Light Industry', 14], 
    ['Out of home', 16],['Commuting', 7], ['Orientation', 9]
  ];
  var plot1 = jQuery.jqplot ('chart7', [data], 
    { 
      seriesDefaults: {
        // Make this a pie chart.
        renderer: jQuery.jqplot.PieRenderer, 
        rendererOptions: {
          // Put data labels on the pie slices.
          // By default, labels show the percentage of the slice.
          showDataLabels: true
        }
      }, 
      legend: { show:true, location: 'e', showSwatches: true}
    }
  );
});
</script>