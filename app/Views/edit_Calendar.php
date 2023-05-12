<div class="d-flex justify-content-center align-items-center vh-100">
  <div class="d-flex justify-content-center ">
    <form action="<?=base_url('/calendar/update')?>" method="post" class="col-12 border border-dark rounded p-4">
      <h1>Edit Appointment</h1>
      <input type="hidden" name="id" id="edit_eventId" >
      <div class="form-group">
        <label for="edit_appointment">Appointment:</label>
        <input type="text" name="edit_appointment" class="form-control" id="edit_appointment"  required>
      </div>
      <div class="form-group">
        <label for="edit_notes">Notes:</label>
        <textarea name="edit_notes" id="edit_notes" class="form-control" ></textarea>
      </div>
      <div class="form-group">
        <label for="edit_start_date">Start Date/Time:</label>
        <input type="datetime-local" name="edit_start_date" class="form-control" id="edit_start_date" min="<?php echo date('Y-m-d');?>T00:00" required>
      </div>
      <div class="form-group">
        <label for="edit_end_date">End Date/Time:</label>
        <input type="datetime-local" name="edit_end_date" class="form-control" id="edit_end_date" min="<?php echo date('Y-m-d');?>T00:00">
      </div>
      <button type="submit" class="btn btn-primary btn-block">Update</button>
      <button type="reset" class="btn btn-secondary btn-block">Clear</button>
      <button onclick="window.location.href = '<?=base_url('calendar')?>' " type="button" class="btn btn-secondary btn-block" >Back</button>
    </form>
  </div>
</div>
