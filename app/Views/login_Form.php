<?php $page_session = \Config\Services::session();?>
<div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-sm-12 col-md-8 col-lg-6 col-xl-4 border border-dark rounded">
                <h1>Login</h1>
                <?php if ($page_session->getTempdata('errmsg')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $page_session->getTempdata('errmsg');?>
                    </div>
                <?php endif; ?>
                <?php if ($page_session->getTempdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $page_session->getTempdata('error');?>
                    </div>
                <?php endif; ?>
                <?= form_open(); ?>
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input class="form-control" type="text" name="email" id="">
                        <span class="text-danger"><small><?= validation_show_error('email'); ?></small></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input class="form-control" type="password" name="password" id="">
                        <span class="text-danger"><small><?= validation_show_error('password'); ?></small></span>
                    </div>
                    <div class="form-group">
                        <input class="form-control btn btn-primary" type="submit" name="login" value="Login">
                    </div>
                    <div class="form-group">
                        <a href="<?=base_url('/register')?>">Don't Have an Account?</a>
                    </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>