<?php $session = session() ?>

<div class="container rounded mt-4 py-2">
  <div class="row mt-3">
    <div class="col-md-3">
      <form action="<?= base_url('/Calendar/add')?>" method="post">
      <?php if ($session->getFlashdata('Calendar')) : ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <?= $session->getFlashdata('Calendar');?>
        </div>
      <?php endif; ?>
        <div class="form-group">
          <label for="appointment">Appointment:</label>
          <input type="text" name="appointment" class="form-control" id="appointment" required>
        </div>
        <div class="form-group">
          <label for="notes">Notes:</label>
          <textarea name="notes" id="" cols="10" rows="5" class="form-control"></textarea>
        </div>
        <div class="form-row">
    <div class="col">
        <label for="start_date">Start Date/Time:</label>
        <input type="datetime-local" name="start_date" class="form-control" id="start_date" min ='<?php echo date('Y-m-d');?>T00:00'  required>
    </div>
    <div class="col">
        <label for="end_date">End Date/Time:</label>
        <input type="datetime-local" name="end_date" class="form-control" id="end_date" min ='<?php echo date('Y-m-d');?>T00:00'>
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


<div id="eventModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Event Details</h4>
      </div>
      <div class="modal-body">
        <p><strong>Title:</strong> <span id="eventTitle"></span></p>
        <p><strong>Description:</strong> <span id="eventDesc"></span></p>
        <p><strong>Start:</strong> <span id="eventStart"></span></p>
        <p><strong>End:</strong> <span id="eventEnd"></span></p>
      </div>
      
      <div class="modal-footer" >
        <a class="btn btn-danger" href="<?= base_url('/Calendar/delete/')?>">Delete</a>
        <button type="button" class="btn btn-primary" id="editEventButton">Edit</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
      </div>
    </div>
  </div>
</div>





