<?php $page_session = \Config\Services::session();?>

<div class="container py-2">
  <div class="row justify-content-center align-items-center">
    <div class="col col-sm-8 col-md-6 col-lg-4 col-xl-4 bg-light border rounded shadow">
      <h1 class="text-center mb-4">Register</h1>
      <?php if ($page_session->getTempdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= $page_session->getTempdata('success');?>
        </div>
      <?php endif; ?>
      <?= form_open(); ?>
        <div class="form-group">
          <label for="username">Username: </label>
          <input class="form-control" type="text" name="username" id="username" value="<?=set_value('username');?>">
          <span class="text-danger"><small><?= validation_show_error('username'); ?></small></span>
        </div>
        <div class="form-group">
          <label for="email">Email: </label>
          <input class="form-control" type="text" name="email" id="email" value="<?=set_value('email');?>">
          <span class="text-danger"><small><?= validation_show_error('email'); ?></small></span>
        </div>
        <div class="form-group">
          <label for="password">Password: </label>
          <input class="form-control" type="password" name="password" id="password" value="<?=set_value('password');?>">
          <span class="text-danger"><small><?= validation_show_error('password'); ?></small></span>
        </div>
        <div class="form-group">
          <label for="cpassword">Confirm Password: </label>
          <input class="form-control" type="password" name="cpassword" id="cpassword">
          <span class="text-danger"><small><?= validation_show_error('cpassword'); ?></small></span>
        </div>
        <div class="form-group">
          <label for="mobile">Mobile: </label>
          <input class="form-control" type="mobile" name="mobile" id="mobile" value="<?=set_value('mobile');?>">
          <span class="text-danger"><small><?= validation_show_error('mobile'); ?></small></span>
        </div>
        <div class="form-group">
          <input class="form-control btn btn-primary mb-2" type="submit" name="register" value="Register">
            <a class="form-control btn btn-secondary mb-2" href="<?=base_url();?>">Back</a>
        </div>
        <div class="form-group d-flex align-items-center">
          <p class="m-0">Already have an account?</p>
          <a class="btn btn-link" href="<?=base_url('/login');?>">Login</a>
        </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
