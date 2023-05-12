    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script>
        setTimeout(function(){
    document.querySelector('.alert').remove();
}, 2000);

function startTime() {
  const today = new Date();
  let h = today.getHours();
  let m = today.getMinutes();
  let s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
  setTimeout(startTime, 1000);
}

function checkTime(i) {
  if (i < 10) {i = "0" + i}; 
  return i;
}
//-------------------------------------------------------//
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
    },
    themeSystem: 'bootstrap',
    height: 550,
    initialView: 'dayGridMonth',
    events: '<?= base_url("/calendar/get") ?>',
    eventClick: function(info) {
    var eventId = info.event.id;
    $('#eventTitle').text(info.event.title);
    $('#eventStart').text(info.event.start.toLocaleString());
    $('#eventEnd').text(info.event.end.toLocaleString());
    $('#eventDesc').text(info.event.extendedProps.appoint_desc);

    $('#eventModal').modal('show');

    $('#delete-btn').click(function() {
      if (confirm('Are you sure you want to delete this Appointment?')) {
        $.ajax({
          url: '<?= base_url("/calendar/delete") ?>', 
          type: 'POST',
          data: {id: eventId},
          success: function(response) {
            console.log(response); 
          },
          error: function(xhr, status, error) {
            console.log("Error:", error); 
              }
            });
          }
       });
          $('#edit-btn').click(function() {
          var eventId = info.event.id;
          var appointment = info.event.title;
          var notes = info.event.extendedProps.appoint_desc;
          var start = info.event.start;
          var end = info.event.end;

          // Set the values of the form fields
          $('#eventId').val(eventId);
          $('#appointment').val(appointment);
          $('#notes').val(notes);
          $('#start_date').val(start.toISOString().slice(0, 16));
          $('#end_date').val(end ? end.toISOString().slice(0, 16) : '');
        });


    }

  });
  calendar.render();
});

</script>

</body>
<link href='https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.1/css/all.css' rel='stylesheet'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">


</html>