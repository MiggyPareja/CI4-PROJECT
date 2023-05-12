<?php $session = session() ?>

<div class="container">
    <h1>Calendar</h1>
    <div class="row">
      <div class="col-md-3">
        <form action="<?=base_url('/calendar/add')?>" method="post">
        <?php if ($session->getFlashdata('Calendar')) : ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <?= $session->getFlashdata('Calendar');?>
        </div>
      <?php endif; ?>
      <input type="hidden" name="id" id="eventId">
          <div class="form-group">
            <label for="appointment">Appointment</label>
            <input type="text" name="appointment" class="form-control" id="appointment" required>
          </div>
          <div class="form-group">
            <label for="notes">Notes</label>
            <textarea name="notes" id="notes"  class="form-control"></textarea>
          </div>
          <div class="form-row">
            <div class="col">
              <label for="start_date">Start Date/Time</label>
              <input type="datetime-local" name="start_date" class="form-control" id="start_date" min="<?php echo date('Y-m-d');?>T00:00" required>
            </div>
            <div class="col">
              <label for="end_date">End Date/Time</label>
              <input type="datetime-local" name="end_date" class="form-control" id="end_date" min="<?php echo date('Y-m-d');?>T00:00">
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-3">Post</button>
        </form>
      </div>
      <div class="col-md-9">
        <div id="calendar"></div>
      </div>
    </div>
  </div>  

  <div class="table-responsive mt-3" style="height: 450px; overflow-y: scroll;">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th>#</th>
          <th>Appointment</th>
          <th>Description</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="myTable">
        <?php if (empty($todo)): ?>
          <tr>
            <td colspan="6" class="text-center"><samp>No Products/Results found.</samp></td>
          </tr>
        <?php endif; ?>
        <?php foreach ($todo as $todos) : ?>
          <tr>
            <td><?= $todos['id']; ?></td>
            <td style="max-width: 200px;"><?= $todos['Appointment']; ?></td>
            <td class="text-break"><?= $todos['appoint_desc']; ?></td>
            <td>₱<?= $todos['start_date']; ?></td>
            <td>₱<?= $todos['end_date']; ?></td>
          </tr>
          <tr class="table-spacing"></tr>
        <?php endforeach; ?>
      </tbody>
    </table>
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
        <a class="btn btn-danger" href="<?= base_url('/Calendar/delete/')?>" id="delete-btn">Delete</a>
        <a class="btn btn-warning" id="edit-btn" href="<?= base_url('/Calendar/edit_page')?>" >Edit</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
      </div>
    </div>
  </div>
</div>





