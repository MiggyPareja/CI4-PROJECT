<?php $session = session() ?>

<div class="container mt-3" >
  <div class="row">
    <div class="col-md-3">
      <h3 id="calTitle">Add Appointment</h3>
      <?php if ($session->getFlashdata('Edit')) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= $session->getFlashdata('Edit');?>
          </div>
      <?php endif; ?>
      <?php if ($session->getFlashdata('Calendar')) : ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <?= $session->getFlashdata('Calendar');?>
          </div>
      <?php endif; ?>
<form id="add-form" action="<?=base_url('/Calendar/add')?>" method="post">
      <input type="hidden" name="id" id="eventId">
      <?= csrf_field() ?>
          <div class="form-gr oup">
            <label for="appointment">Appointment Name</label>
            <input type="text" name="appointment" class="form-control" id="appointment">
            <span class="text-danger"><small><?= validation_show_error('appointment'); ?></small></span>
          </div>
          <div class="form-group">
            <label for="notes">Notes</label>
            <textarea name="notes" id="notes"  class="form-control overflow-auto" style="height: 75px; resize: none;"></textarea>
            <span class="text-danger"><small><?= validation_show_error('notes'); ?></small></span>
          </div>
          <div class="form-row">
            <div class="col">
              <label for="start_date">Start Date/Time</label>
              <input type="datetime-local" name="start_date" class="form-control" id="start_date" min="<?php echo date('Y-m-d');?>T00:00" >
              <span class="text-danger"><small><?= validation_show_error('start_date'); ?></small></span>
            </div>
            <div class="col">
              <label for="end_date">End Date/Time</label>
              <input type="datetime-local" name="end_date" class="form-control" id="end_date" min="<?php echo date('Y-m-d');?>T00:00" >
              <span class="text-danger"><small><?= validation_show_error('end_date'); ?></small></span>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-3">Add Appointment</button>
        </form>
<form id="edit-form" action="<?=base_url('/Calendar/update')?>" method="post" hidden>
      <?= csrf_field() ?>
      <div>
      </div>
      <input type="text" name="edit-eventId" id="edit-eventId" hidden>
          <div class="form-group">
            <label for="edit-appointment">Appointment Name</label>
            <input type="text" name="edit-appointment" class="form-control" id="edit-appointment"value="<?=old('edit-appointment')?>" required >
          </div>
          <div class="form-group">
            <label for="edit-notes">Notes</label>
            <textarea name="edit-notes" id="edit-notes"  class="form-control overflow-auto"style="height: 75px;  resize: none;"value="<?=old('edit-notes')?>"></textarea>
          </div>
          <div class="form-row">
            <div class="col">
              <label for="editStart_date">Start Date/Time</label>
              <input type="datetime-local" name="editStart_date" class="form-control" id="editStart_date" min="<?php echo date('Y-m-d');?>T00:00" value="<?=old('editStart_date')?>" required>
            </div>
            <div class="col">
              <label for="editEnd_date">End Date/Time</label>
              <input type="datetime-local" name="editEnd_date" class="form-control" id="editEnd_date" min="<?php echo date('Y-m-d');?>T00:00" value="<?=old('editEnd_date')?>" required>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-3" id="update-btn">Update Appointment</button>
          <button class="btn btn-secondary mt-3" type="button" id="back-btn"><a class="text-decoration-none text-white" href="<?=base_url('/calendar')?>">Back</a></button>
</form>
      </div>
        <div class="col-md-9">
          <div id="calendar"></div>
        </div>
  </div>
</div>

<div id="eventModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Event Details</h4>
      </div>
      <div class="modal-body">
        <p hidden><strong>ID:</strong> <span id="eventID" ></span></p>
        <p><strong>Title:</strong> <span id="eventTitle"></span></p>
        <p><strong>Description:</strong> <span class="text-break" id="eventDesc"></span></p>
        <p><strong>Start:</strong> <span id="eventStart"></span></p>
        <p><strong>End:</strong> <span id="eventEnd"></span></p>
      </div>
      
      <div class="modal-footer" >
        <a class="btn btn-danger" href="<?= base_url('/Calendar/delete/')?>" id="delete-btn">Delete</a>
        <a class="btn btn-primary" id="edit-btn" >Edit</a>
       
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
      </div>
    </div>
  </div>
</div>





