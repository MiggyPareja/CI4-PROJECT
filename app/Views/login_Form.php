<?php $page_session = \Config\Services::session(); ?>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row">
        <div class="col-12 mx-auto border border-dark rounded p-4">
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
            <div class="form-group text-center mt-3">
                
            </div>
        </div>
    </div>
</div>
