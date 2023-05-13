    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">


    <script>
        
//-------------------------------------------------------//
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'listMonth,dayGridMonth,timeGridWeek,timeGridDay'
    },
    nowIndicator: true,
    height: 550,
    initialView: 'listMonth',
    events: '<?= base_url("/calendar/get") ?>',
    eventClick: function(info) {
      var eventId = info.event.id;
      var eventTitle = info.event.title;
      var eventDescription = info.event.extendedProps.appoint_desc;
      var eventStart = info.event.start.toLocaleString();
      var eventEnd = info.event.end.toLocaleString();
      $('#eventID').text(eventId);
      $('#eventTitle').text(eventTitle);
      $('#eventStart').text(eventStart);
      $('#eventEnd').text(eventEnd);
      $('#eventDesc').text(eventDescription);
      $('#eventModal').modal('show');
      
    },
  });
  calendar.render();
});

</script>
</body>
</html>