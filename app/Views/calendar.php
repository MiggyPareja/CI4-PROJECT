<div class="container border border-dark rounded mt-4 py-2">
  <div class="row mt-3">
    <div class="col-md-3">
      <form action="<?= base_url('/Calendar/add')?>" method="post">
        <div class="form-group">
          <label for="appointment">Appointment:</label>
          <input type="text" name="appointment" class="form-control" id="appointment">
        </div>
        <div class="form-group">
          <label for="notes">Notes:</label>
          <textarea name="notes" id="" cols="10" rows="5" class="form-control"></textarea>
        </div>
        <div class="form-row">
    <div class="col">
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" class="form-control" id="start_date" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-M-D');?>">
    </div>
    <div class="col">
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" class="form-control" id="end_date" min="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-M-D');?>">
        </div>
    </div>
        <button type="submit" class="btn btn-primary mt-3">Post</button>
      </form>
    </div>
    <div>
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
          headerToolbar:{
            left:"prev,next today",
            center:"title",
            right:"dayGridMonth,timeGridWeek,timeGridDay,listMonth"
          },
          height: 550,
          initialView: 'dayGridMonth',
          events: '<?= base_url("/calendar/get") ?>'
        });
        calendar.render();
      });

</script>

