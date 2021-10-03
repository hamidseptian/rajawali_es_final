<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <!-- fullCalendar -->
  <link rel="stylesheet" href="../assets/adminlte/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="../assets/adminlte/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
 <div id="calendar"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../assets/adminlte/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Slimscroll -->
<script src="../assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../assets/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/adminlte/dist/js/demo.js"></script>
<!-- fullCalendar -->
<script src="../assets/adminlte/bower_components/moment/moment.js"></script>
<script src="../assets/adminlte/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      // header    : {
      //   left  : 'prev,next today',
      //   center: 'title',
      //   right : 'month,agendaWeek,agendaDay'
      // },
      // buttonText: {
      //   today: 'today',
      //   month: 'month',
      //   week : 'week',
      //   day  : 'day'
      // },
      // //Random default events
      events    : [


      <?php 
      $id = $_SESSION['iduser'];

        $q = mysqli_query($conn, "SELECT * from booking");
        while ($d=mysqli_fetch_array($q)) { 
          $pwm = explode(' ', $d['tanggal_mulai']);
          $ptm = explode('-', $pwm[0]);
          $tgm = $ptm[2];
          $blm = $ptm[1]-1;
          $thm = $ptm[0];
          $pjm = explode(':', $pwm[1]);
          $jm= $pjm[0];
          $mm= $pjm[1];


          $pws = explode(' ', $d['tanggal_selesai']);
          $pts = explode('-', $pws[0]);
          $tgs = $pts[2];
          $bls = $pts[1]-1;
          $ths = $pts[0];
          $pjs = explode(':', $pws[1]);
          $js= $pjs[0];
          $ms= $pjs[1];

          if ($id==$d['id_pelanggan']) {
            $bg = 'aqua';
          }else{
            $bg = 'grey';
          }


          ?>
          
        {
          title          : '<?php echo $d['kegiatan'] ?>',
          start          : new Date(<?php echo $thm ?>, <?php echo $blm ?>, <?php echo $tgm ?>, <?php echo $jm ?>, <?php echo $mm ?>),
          end            : new Date(<?php echo $ths ?>, <?php echo $bls ?>, <?php echo $tgs ?>, <?php echo $js ?>, <?php echo $ms ?>),
          backgroundColor: '<?php echo $bg ?>', //yellow
          borderColor    : '<?php echo $bg ?>' //yellow
        },
        <?php } ?>
        
      
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>
</body>
</html>
