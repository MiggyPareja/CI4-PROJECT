<?php $page_session = \Config\Services::session();
   $page_session ->markAsTempdata(['success','error'],2);
?>
    <div class="container" >
        <div class="row justify-content-center align-items-center">
            <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-4 border border-dark rounded">
                <h1>Register</h1>
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
                    </div>
                    <div class="form-group">
                        <a href="<?=base_url('/login');?>">Already Have an Account?</a>
                    </div>
                    
                <?= form_close(); ?>
            </div>
        </div>
    </div>
    