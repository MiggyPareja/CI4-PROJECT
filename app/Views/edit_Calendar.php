<div class="d-flex justify-content-center align-items-center vh-100">
  <div class="d-flex justify-content-center ">
    <form action="<?=base_url('/calendar/update/')?>" method="POST" class="col-12 border border-dark rounded p-4">
    <h1>Edit Appointment</h1>
      <input type="hidden" name="id" id="eventId" >
      <div class="form-group">
        <label for="appointment" >Appointment:</label>
        <input type="text" name="appointment" class="form-control" id="edit_Title"     required>
      </div>
      <div class="form-group">
        <label for="notes">Notes:</label>
        <textarea name="notes" id="edit_desc" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label for="start_date">Start Date/Time:</label>
        <input type="datetime-local" name="start_date" class="form-control" id="edit_start" min="<?php echo date('Y-m-d');?>T00:00"  required>
      </div>
      <div class="form-group">
        <label for="end_date">End Date/Time:</label>
        <input type="datetime-local" name="end_date" class="form-control" id="edit_end" min="<?php echo date('Y-m-d');?>T00:00"  >
      </div>
      <button type="submit" class="btn btn-primary btn-block">Update</button>
      <button type="reset" class="btn btn-secondary btn-block">Clear</button>
      <button onclick="window.location.href = '<?=base_url('calendar')?>' " type="button" class="btn btn-secondary btn-block" >Back</button>
    </form>
  </div>
</div>
