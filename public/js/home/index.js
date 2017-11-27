 $(function(){
    timeClock();
    $('#datatable-followup').dataTable({
       "order": [[ 7, 'asc'],[6,'asc']]
    });
    $('#datatable-ins-followup').dataTable({
       "order": [[ 9, 'asc'],[7,'asc']]
    });
    $('.scroll-target').click(function(){
      $('.panel_div').collapse();
      var target = $(this).attr('data-id');
     $("html, body").animate({ scrollTop: $(target).offset().top }, 1000);
    });
    // chart data initate
    getChart();
    $('.input-href').click(function(){
        var type = $(this).attr('data-source');
        var date = $('#reportrange span').text();
        var from = date.split('-')[0];
        var to = date.split('-')[1];
        $('#hidden-form .from').val(from);
        $('#hidden-form .to').val(to);
        $('#hidden-form .type').val(type);
        getChart();
    });
    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
         var date = $('#reportrange span').text();
        var from = date.split('-')[0];
        var to = date.split('-')[1];
        $('#hidden-form .from').val(from);
        $('#hidden-form .to').val(to);
        getChart();
    });

    $('#remind-mail').on('show.bs.modal',function(e){
        var btn = $(e.relatedTarget);
        $('#remind-mail .modal-title span').text(btn.data('ins'));
        var dates = "<br>Actual recieving date : "+btn.data('recieving')+"<br> Delay :"+btn.data('due');
        $('#remind-mail #edit-body #next-text').html(dates);
    });
  });

  var strDay = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
  var strMonth = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
  function timeClock()
  {
      setTimeout("timeClock()", 1000);        
      now = new Date();
      $('.time-div').text(now.getHours()+" : "+ now.getMinutes());
      $('.day-div').text(strDay[now.getDay()]);
  }
function getChart(){
  var url = $('#hidden-form').attr('action');
  var data = $('#hidden-form').serializeArray();
  $.ajax({
    type : 'post',
    data : data,
    url : url,
    beforeSend : function(){
        //
    },
    complete : function(){
      //
    },
    success : function(res){
      if(res.success){
        var data = res.success.data;
        plotChart(data);
        $('#chart-heading').text(res.success.type);
      }
    }
  });
}

function plotChart(data){
  $("#chart-graph").html('');
  var chart_plot_01_settings = {
        series: {
          lines: {
            show: true,
            fill: true
          },
          splines: {
            show: true,
            tension: 0.4,
            lineWidth: 1,
            fill: 0.4
          },
          points: {
            radius: 4,
            show: true
          },
          shadowSize: 2
        },
        grid: {
          verticalLines: true,
          hoverable: true,
          clickable: true,
          tickColor: "#d5d5d5",
          borderWidth: 1,
          color: '#fff'
        },
        legend:{
          show:true,
          noColumns:2
        },
        colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
        xaxis: {
          tickColor: "rgba(51, 51, 51, 0.06)",
          mode: "time",
          tickSize: [1, "day"],
          tickLength: 10,
          axisLabel: "Date",
          axisLabelUseCanvas: true,
          axisLabelFontSizePixels: 12,
          axisLabelFontFamily: 'Verdana, Arial',
          axisLabelPadding: 10
        }, 
       
        yaxis: {
          ticks: 1,
          tickSize: [1],
          tickColor: "rgba(51, 51, 51, 0.06)",
        },
        tooltip: true
      }

  $.plot( $("#chart-graph"), [ data ],  chart_plot_01_settings );
}