<div class="container">
  <div class="row mt-3">
    <div class="col-md-3">
      <form action="" method="post">
        <div class="form-group">
          <label for="appointment">Appointment:</label>
          <input type="text" class="form-control" id="appointment">
        </div>
        <div class="form-group">
          <label for="notes">Notes:</label>
          <textarea name="" id="" cols="10" rows="5" class="form-control"></textarea>
        </div>
        <div class="form-row">
          <div class="col">
            <label for="start-date">Start Date:</label>
            <input type="date" class="form-control" id="start-date" value="<?php echo date('Y-m-d'); ?>">
          </div>
          <div class="col">
            <label for="end-date">End Date:</label>
            <input type="date" class="form-control" id="end-date">
          </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Post</button>
      </form>
    </div>
    <div class="col-md-9">
      <div id="calendar">

      </div>
    </div>
  </div>
</div>


<script>
 
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            height:550,
            initialView: 'dayGridMonth'
        });
        calendar.render();
      });

</script>
