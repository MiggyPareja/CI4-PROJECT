<?php $page_session = \Config\Services::session(); ?>
<div class="container py-5">
  <div class="row justify-content-center align-items-center">
    <div class="col col-sm-8 col-md-6 col-lg-4 col-xl-4 bg-light border rounded shadow">
            <h1 class="text-center mb-4">Login</h1>
            <?php if ($page_session->getTempdata('errmsg')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $page_session->getTempdata('errmsg'); ?>
                </div>
            <?php endif; ?>
            <?php if ($page_session->getTempdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $page_session->getTempdata('error'); ?>
                </div>
            <?php endif; ?>
            <?= form_open(); ?>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input class="form-control form-control-lg" type="text" name="email" id="">
                    <span class="text-danger"><small><?= validation_show_error('email'); ?></small></span>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input class="form-control form-control-lg" type="password" name="password" id="">
                    <span class="text-danger"><small><?= validation_show_error('password'); ?></small></span>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="login">Login</button>
                    <a href="<?= base_url('/') ?>" class="btn btn-secondary btn-lg btn-block mt-2">Back to Welcome Page</a>
                </div>
                <div class="form-group text-center">
                    <p>Don't have an account? <a href="<?= base_url('/register') ?>">Sign up</a></p>
                </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
